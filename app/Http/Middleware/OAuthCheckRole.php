<?php
/**
 * File: OAuthCheckRole.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 01/10/16
 * Time: 00:27
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use LaccDelivery\Repositories\UserRepository;

class OAuthCheckRole
{
		/**
		 * @var UserRepository
		 */
		private $userRepository;

		public function __construct( UserRepository $userRepository )
		{
				$this->userRepository = $userRepository;
		}

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure                 $next
		 *
		 * @return mixed
		 */
		public function handle( $request, Closure $next, $role )
		{
				//Pega id do user autenticado na api
				$idUser = Authorizer::getResourceOwnerId();
				$user   = $this->userRepository->find( $idUser );
				if ( $user->role != $role ) {
						abort( 403, 'Access Forbidden' );
				}

				return $next( $request );
		}
}