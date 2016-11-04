<?php
/**
 * File: OrderService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 31/07/16
 * Time: 15:11
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Services;

use LaccDelivery\Models\Order;
use LaccDelivery\Repositories\CupomRepository;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Repositories\ProductRepository;

class OrderService
{
		/**
		 * @var OrderRepository
		 */
		private $orderRepository;

		/**
		 * @var CupomRepository
		 */
		private $cupomRepository;

		/**
		 * @var ProductRepository
		 */
		private $productRepository;

		public function __construct(
			OrderRepository $orderRepository,
			CupomRepository $cupomRepository,
			ProductRepository $productRepository
		)
		{
				$this->orderRepository   = $orderRepository;
				$this->cupomRepository   = $cupomRepository;
				$this->productRepository = $productRepository;
		}

		public function listOrder()
		{
				$listOrders = $this->orderRepository->paginate();
				foreach ( $listOrders as $list ) :
						$this->getStatus( $list );
				endforeach;

				return $listOrders;
		}

		public function getOrder( $id )
		{
				$order = $this->orderRepository->find( $id );
				$this->getStatus( $order );

				return $order;
		}

		public function getPrepareListStatus()
		{
				$arrStatus = [
					'0' => Order::PROCESSING,
					'1' => Order::SHIPPED,
					'2' => Order::COMPLETED,
					'3' => Order::SUSPENDED,
					'4' => Order::UNKNOWN,
				];

				return $arrStatus;
		}

		private function getStatus( $order )
		{
				switch ( $order->status ):
						case '0':
								$order->status = Order::PROCESSING;
								break;
						case '1':
								$order->status = Order::SHIPPED;
								break;
						case '2':
								$order->status = Order::COMPLETED;
								break;
						case '3':
								$order->status = Order::SUSPENDED;
								break;
						case '4':
								$order->status = Order::UNKNOWN;
								break;
				endswitch;

				return $order;
		}

		public function create( array $data )
		{
				\DB::beginTransaction();
				try {
						$data[ 'status' ] = 0;
						if ( isset( $data[ 'cupom_id' ] ) ) {
								unset( $data[ 'cupom_id' ] );
						}
						if ( isset( $data[ 'cupom_code' ] ) ) {
								$cupom              = $this->cupomRepository->findByField( 'code', $data[ 'cupom_code' ] )->first();
								$data[ 'cupom_id' ] = $cupom->id;
								$cupom->used        = 1;
								$cupom->save();
								unset( $data[ 'cupom_code' ] );
						}
						$items = $data[ 'items' ];
						unset( $data[ 'items' ] );
						$order = $this->orderRepository->create( $data );
						$total = 0;
						foreach ( $items as $item ) :
								$item[ 'price' ] = $this->productRepository->find( $item[ 'product_id' ] )->price;
								$order->items()->create( $item );
								$total += $item[ 'price' ] * $item[ 'qtd' ];
						endforeach;
						$order->total = $total;
						if ( isset( $cupom ) ) {
								$order->total = $total - $cupom->value;
						}
						$order->save();
						\DB::commit();

						return $order;
				}
				catch ( \Exception $e ) {
						\DB::rollback();
						throw $e;
				}

		}

		public function updateStatus( $idOrder, $idDeliverMan, $status )
		{
				$order = $this->orderRepository->getByIdAndDeliveryman( $idOrder, $idDeliverMan );
				if ( $order instanceof Order ) {
						$order->status = $status;
						$order->save();

						return $order;
				}

				return false;
		}

}