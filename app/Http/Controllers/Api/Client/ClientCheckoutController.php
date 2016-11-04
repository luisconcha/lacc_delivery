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

		private $with = [ 'client', 'items', 'cupom', 'deliveryman' ];

		public function __construct(
			OrderRepository $orderRepository,
			UserRepository $userRepository,
			OrderService $orderService )
		{
				$this->orderRepository = $orderRepository;
				$this->userRepository  = $userRepository;
				$this->orderService    = $orderService;
		}

		public function index()
		{
				$idUser     = Authorizer::getResourceOwnerId();
				$clientId   = $this->userRepository->find( $idUser )->client->id;
				$listOrders = $this->orderRepository
					->skipPresenter( false )
					->with( $this->with )
					->scopeQuery( function ( $query ) use ( $clientId ) {
							return $query->where( 'client_id', '=', $clientId );
					} )->paginate();

				return $listOrders;
		}

		public function store( CheckoutRequest $request )
		{
				$data                = $request->all();
				$idUser              = Authorizer::getResourceOwnerId();
				$clientId            = $this->userRepository->find( $idUser )->client->id;
				$data[ 'client_id' ] = $clientId;
				$o                   = $this->orderService->create( $data );

				//$o                   = $this->orderRepository->with( [ 'items' ] )->find( $o->id );
				//	return redirect()->route( 'customer.order.index' );

				return $this->orderRepository->skipPresenter( false )->with( $this->with )->find( $o->id );
		}

		public function show( $id )
		{
//				$order = $this->orderRepository->with( [ 'client', 'items', 'cupom', 'deliveryman' ] )->find( $id );
//				Serializa para retornar na listagem os dados do produto
//				$order->items->each( function ( $item ) {
//						$item->product;
//				} );
//				return $order;
				return $this->orderRepository->skipPresenter( false )->with( $this->with )->find( $id );
		}

}