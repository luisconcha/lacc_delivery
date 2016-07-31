<?php
/**
 * File: ProductsController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 26/07/16
 * Time: 20:48
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Controllers;

use Illuminate\Http\Request;
use LaccDelivery\Http\Requests\AdminProductRequest;
use LaccDelivery\Models\Category;
use LaccDelivery\Repositories\ProductRepository;

class ProductsController extends Controller
{
		/**
		 * @var ProductRepository
		 */
		private $repository;

		/**
		 * @var Category
		 */
		private $category;

		public function __construct( ProductRepository $repository, Category $category )
		{
				$this->repository = $repository;
				$this->category   = $category;
		}

		public function index()
		{
				$listProducts = $this->repository->paginate();

				return view( 'admin.products.index', compact( 'listProducts' ) );
		}

		public function create()
		{
				$categories = [ '' => '--select a category--' ] + $this->category->lists( 'name', 'id' )->all();

				return view( 'admin.products.create', compact( 'categories' ) );
		}

		public function store( AdminProductRequest $request )
		{
				$data = $request->all();
				$this->repository->create( $data );

				return redirect()->route( 'admin.products.index' );
		}

		public function edit( $id )
		{
				$categories = [ '' => '--select a category--' ] + $this->category->lists( 'name', 'id' )->all();
				$product    = $this->repository->find( $id );

				return view( 'admin.products.edit', compact( 'product', 'categories' ) );
		}

		public function update( AdminProductRequest $request, $id )
		{
				$input = $request->all();
				$this->repository->find( $id )->update( $input );

				return redirect()->route( 'admin.products.index' );
		}

		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();

				return redirect()->route( 'admin.products.index' );
		}

}