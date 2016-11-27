<?php
/**
 * File: CupomController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 23/11/16
 * Time: 22:57
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers\Api;

use LaccDelivery\Http\Controllers\Controller;
use LaccDelivery\Repositories\CupomRepository;

class CupomController extends Controller
{
		/**
		 * @var CupomRepository
		 */
		private $repository;

		public function __construct( CupomRepository $cupomRepository )
		{
				$this->repository = $cupomRepository;
		}

		public function show( $cupomCode )
		{
				return $this->repository->skipPresenter( false )->findByCode( $cupomCode );
		}
}