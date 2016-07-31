<?php
/**
 * File: UserService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 31/07/16
 * Time: 16:48
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Services;

use LaccDelivery\Repositories\UserRepository;

class UserService
{
		private $userRepository;

		public function __construct( UserRepository $userRepository )
		{
				$this->userRepository = $userRepository;
		}

		public function getDeliverymen()
		{
				return $this->userRepository->findWhere( [ 'role' => 'deliveryman' ], ['name','id'] );
		}

}