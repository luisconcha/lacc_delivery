<?php
/**
 * File: OrdersController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 31/07/16
 * Time: 00:08
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers;

use LaccDelivery\Http\Requests\AdminOrderRequest;
use LaccDelivery\Models\Order;
use LaccDelivery\Models\User;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Services\OrderService;
use LaccDelivery\Services\UserService;

class OrdersController extends Controller
{
		/**
		 * @var OrderRepository
		 */
		private $repository;

		/**
		 * @var OrderService
		 */
		private $service;

		/**
		 * @var User
		 */
		private $userService;

		public function __construct( OrderRepository $repository, OrderService $service, UserService $userService )
		{
				$this->repository  = $repository;
				$this->service     = $service;
				$this->userService = $userService;
		}

		public function index()
		{
				$listOrders = $this->service->listOrder();

				return view( 'admin.orders.index', compact( 'listOrders' ) );
		}

		public function edit( $id )
		{
				$listDeliveryman = [ '' => '--select deliveryman--' ] + $this->userService->getDeliverymen()->lists( 'name', 'id' )->all();
				$arrStatus       = [ '' => '--select status--' ] + $this->service->getPrepareListStatus();
				$order           = $this->service->getOrder( $id );
				$totalPurchase   = 0;
				$selectedStatus  = array_search( $order->status, $arrStatus );

				return view( 'admin.orders.edit', compact( 'order', 'listDeliveryman', 'arrStatus', 'selectedStatus', 'totalPurchase' ) );
		}

		public function update( AdminOrderRequest $orderRequest, $id )
		{
				$data = $orderRequest->all();
				$this->repository->find( $id )->update( $data );

				return redirect()->route( 'admin.orders.edit', [ 'id' => $id ] );
		}

}