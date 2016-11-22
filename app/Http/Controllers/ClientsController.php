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
use LaccDelivery\Validators\ClientValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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

		/**
		 * @var ClientValidator
		 */
		private $clientValidator;

		public function __construct( ClientRepository $repository, ClientService $clientService, ClientValidator $clientValidator )
		{
				$this->repository      = $repository;
				$this->clientService   = $clientService;
				$this->clientValidator = $clientValidator;
		}

		public function index()
		{
				$listClients = $this->repository->paginate( 50 );

				return view( 'admin.clients.index', compact( 'listClients' ) );
		}

		public function create()
		{
				$client = [];
				return view( 'admin.clients.create', compact('client') );
		}

		public function store( Request $request )
		{
				try {
						$client = $request->all();
						$this->clientValidator->with( $client )->passesOrFail( ValidatorInterface::RULE_CREATE );
						$this->clientService->create( $client );

						return redirect()->route( 'admin.clients.index' );
				}
				catch ( ValidatorException $e ) {
						return view( "admin.clients.create", compact( 'client' ) )->withErrors( $e->getMessageBag() );
				}
		}

		public function edit( $id )
		{
				$client = $this->repository->find( $id );

				return view( 'admin.clients.edit', compact( 'client' ) );
		}

		public function update( Request $request, $id )
		{
				try {
						$client = $this->repository->find( $id );
						//Seta id do Cliente para ser validado o campo email ao momento de fazer update
						$this->clientValidator->setId( $client->user_id );
						$input = $request->all();
						$this->clientValidator->with( $input )->passesOrFail( ValidatorInterface::RULE_UPDATE );
						$this->clientService->update( $input, $id );

						return redirect()->route( 'admin.clients.index' );
				}
				catch ( ValidatorException $e ) {
						return view( "admin.clients.edit", compact( 'client' ) )->withErrors( $e->getMessageBag() );
				}
		}

		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();

				return redirect()->route( 'admin.clients.index' );
		}
}