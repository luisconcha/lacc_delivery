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
use LaccDelivery\Repositories\OrderRepository;

class OrderService
{
		private $orderRepository;

		public function __construct( OrderRepository $orderRepository )
		{
				$this->orderRepository = $orderRepository;
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

}