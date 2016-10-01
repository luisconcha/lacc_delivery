<?php
/**
 * File: PasswordGrantVerifier.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 30/09/16
 * Time: 22:42
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\OAuth2;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
		public function verify( $username, $password )
		{
				$credentials = [
					'email'    => $username,
					'password' => $password,
				];
				if ( Auth::once( $credentials ) ) {
						return Auth::user()->id;
				}

				return false;
		}

}