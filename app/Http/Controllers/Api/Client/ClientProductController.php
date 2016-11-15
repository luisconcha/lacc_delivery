<?php
/**
 * File: ClientProductController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 12/11/16
 * Time: 21:06
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers\Api\Client;

use LaccDelivery\Http\Controllers\Controller;
use LaccDelivery\Repositories\ProductRepository;

class ClientProductController extends Controller
{
		/**
		 * @var ProductRepository
		 */
		private $productRepository;

		public function __construct( ProductRepository $productRepository )
		{
				$this->productRepository = $productRepository;
		}

		public function index()
		{
				$productList = $this->productRepository->skipPresenter( false )->all();

				return $productList;
		}
}