<?php
/**
 * File: DeliverymanCheckoutController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 02/10/16
 * Time: 20:13
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;
use LaccDelivery\Http\Controllers\Controller;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Repositories\UserRepository;
use LaccDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
		/**
		 * @var OrderRepository
		 */
		private $orderRepository;
		/**
		 * @var UserRepository
		 */
		private $userRepository;
		/**
		 * @var OrderRepository
		 */
		private $orderService;

		public function __construct(
			OrderRepository $orderRepository,
			UserRepository $userRepository,
			OrderService $orderService
		)
		{
				$this->orderRepository = $orderRepository;
				$this->userRepository  = $userRepository;
				$this->orderService    = $orderService;
		}

		public function index()
		{
				$idUser = Authorizer::getResourceOwnerId();
				$orders = $this->orderRepository->with( 'items' )->scopeQuery( function ( $query ) use ( $idUser ) {
						return $query->where( 'user_deliveryman_id', '=', $idUser );
				} )->paginate();

				return $orders;
		}

		public function show( $idOrder )
		{
				$idDeliveryman = Authorizer::getResourceOwnerId();

				return $this->orderRepository->getByIdAndDeliveryman( $idOrder, $idDeliveryman );
		}

		public function updateStatus( Request $request, $idOrder )
		{
				$idDeliveryman = Authorizer::getResourceOwnerId();
				$order         = $this->orderService->updateStatus( $idOrder, $idDeliveryman, $request->get( 'status' ) );
				if ( $order ) {
						return $order;
				}
				abort( 400, 'Order not found ' );
		}

}