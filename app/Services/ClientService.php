<?php
/**
 * File: ClientService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 30/07/16
 * Time: 01:21
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Services;

use LaccDelivery\Repositories\ClientRepository;
use LaccDelivery\Repositories\UserRepository;

class ClientService
{
		/**
		 * @var ClientRepository
		 */
		private $clientRepository;

		/**
		 * @var UserRepository
		 */
		private $userRepository;

		public function __construct( ClientRepository $clientRepository, UserRepository $userRepository )
		{
				$this->clientRepository = $clientRepository;
				$this->userRepository   = $userRepository;
		}

		public function create( array $data )
		{
				\DB::beginTransaction();
				try {
						$data[ 'user' ][ 'password' ] = bcrypt( 123456 );
						$user                         = $this->userRepository->create( $data[ 'user' ] );
						$data[ 'user_id' ]            = $user->id;
						$this->clientRepository->create( $data );
						\DB::commit();

						return response()->json([
								'success' => true,
								'message' => 'Registration successfully Complete'
						]);
				}
				catch ( \Exception $e ) {
						\DB::rollBack();

						return response()->json( [
							'success' => false,
							'message' => $e->getMessage(),
						] );
				}

		}

		public function update( array $data, $id )
		{
				\DB::beginTransaction();
				try {
						$this->clientRepository->update( $data, $id );
						$userId = $this->clientRepository->find( $id, [ 'user_id' ] )->user_id;
						$this->userRepository->update( $data[ 'user' ], $userId );
						\DB::commit();

						return response()->json( [
							'success' => true,
							'message' => 'successfully changed record',
						] );
				}
				catch ( \Exception $e ) {
						\DB::rollBack();

						return response()->json( [
							'success' => false,
							'message' => $e->getMessage(),
						] );
				}
		}

}