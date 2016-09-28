<?php
/**
 * File: CheckoutController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 26/07/16
 * Time: 20:48
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Repositories\ProductRepository;
use LaccDelivery\Repositories\UserRepository;
use LaccDelivery\Services\OrderService;

class CheckoutController extends Controller
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
		 * @var ProductRepository
		 */
		private $productRepository;

		/**
		 * @var OrderService
		 */
		private $orderService;

		public function __construct(
			OrderRepository $orderRepository,
			UserRepository $userRepository,
			ProductRepository $productRepository,
			OrderService $orderService )
		{
				$this->orderRepository   = $orderRepository;
				$this->userRepository    = $userRepository;
				$this->productRepository = $productRepository;
				$this->orderService      = $orderService;
		}

		public function index()
		{
				$clientId   = $this->userRepository->find( Auth::user()->id )->client->id;
				$listOrders = $this->orderRepository->scopeQuery( function ( $query ) use ( $clientId ) {
						return $query->where( 'client_id', '=', $clientId );
				} )->paginate();

				return view( 'customer.order.index', compact( 'listOrders' ) );
		}

		public function create()
		{
				$listProduct = $this->productRepository->getList();
				return view( 'customer.order.create', compact( 'listProduct' ) );
		}

		public function store( Request $request )
		{
				$data                = $request->all();
				$clientId            = $this->userRepository->find( Auth::user()->id )->client->id;
				$data[ 'client_id' ] = $clientId;
				$this->orderService->create( $data );

				return redirect()->route( 'customer.order.index' );
		}

}