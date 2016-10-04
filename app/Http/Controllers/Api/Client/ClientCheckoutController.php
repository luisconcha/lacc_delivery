<?php
/**
 * File: ClientCheckoutController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 26/07/16
 * Time: 20:48
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaccDelivery\Http\Controllers\Controller;
use LaccDelivery\Http\Requests\CheckoutRequest;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Repositories\UserRepository;
use LaccDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
		 * @var OrderService
		 */
		private $orderService;

		public function __construct(
			OrderRepository $orderRepository,
			UserRepository $userRepository,
			OrderService $orderService )
		{
				$this->orderRepository   = $orderRepository;
				$this->userRepository    = $userRepository;
				$this->orderService      = $orderService;
		}

		public function index()
		{
				$idUser     = Authorizer::getResourceOwnerId();
				$clientId   = $this->userRepository->find( $idUser )->client->id;
				$listOrders = $this->orderRepository->with( [ 'items' ] )->scopeQuery( function ( $query ) use ( $clientId ) {
						return $query->where( 'client_id', '=', $clientId );
				} )->paginate();

				return $listOrders;
		}

//		public function store( Request $request )
//		{
//				$data                = $request->all();
//				$clientId            = $this->userRepository->find( Auth::user()->id )->client->id;
//				$data[ 'client_id' ] = $clientId;
//				$this->orderService->create( $data );
//
//				return redirect()->route( 'customer.order.index' );
//		}
		public function store( CheckoutRequest $request )
		{
				$data                = $request->all();
				$clientId            = $this->userRepository->find( Auth::user()->id )->client->id;
				$data[ 'client_id' ] = $clientId;
				$this->orderService->create( $data );

				return redirect()->route( 'customer.order.index' );
		}

		public function show( $id )
		{
				$order = $this->orderRepository->with(['client','items','cupom','deliveryman'])->find( $id ); 				//Serializa para retornar na listagem os dados do produto
				$order->items->each(function($item){
						$item->product;
				});

				return $order;
		}

}