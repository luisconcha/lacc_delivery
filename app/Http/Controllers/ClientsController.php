<?php
/**
 * File: ClientsController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 29/07/16
 * Time: 22:51
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers;

use Illuminate\Http\Request;
use LaccDelivery\Http\Requests\AdminClientRequest;
use LaccDelivery\Repositories\ClientRepository;
use LaccDelivery\Services\ClientService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientsController extends Controller
{
		/**
		 * @var ClientRepository
		 */
		private $repository;

		/**
		 * @var ClientService
		 */
		private $clientService;

		public function __construct( ClientRepository $repository, ClientService $clientService )
		{
				$this->repository    = $repository;
				$this->clientService = $clientService;
		}

		public function index()
		{
				$listClients = $this->repository->paginate( 50 );

				return view( 'admin.clients.index', compact( 'listClients' ) );
		}

		public function create()
		{
				return view( 'admin.clients.create' );
		}

		public function store( AdminClientRequest $request )
		{
				$data = $request->all();
				$this->clientService->create( $data );

				return redirect()->route( 'admin.clients.index' );
		}

		public function edit( $id )
		{
				$client = $this->repository->find( $id );

				return view( 'admin.clients.edit', compact( 'client' ) );
		}

		public function update( AdminClientRequest $request, $id )
		{
				$input = $request->all();
				$this->clientService->update( $input, $id );

				return redirect()->route( 'admin.clients.index' );
		}

		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();

				return redirect()->route( 'admin.clients.index' );
		}
}