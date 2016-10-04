<?php
/**
 * File: UserController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 01/10/16
 * Time: 22:12
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers\Api;

use LaccDelivery\Http\Controllers\Controller;
use LaccDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
		/**
		 * @var UserRepository
		 */
		private $userRepository;

		public function __construct(
			UserRepository $userRepository )
		{
				$this->userRepository    = $userRepository;
		}

		public function authenticated()
		{
				$id   = Authorizer::getResourceOwnerId();
				$user = $this->userRepository->with( 'client' )->find( $id );
				return $user;
		}

}