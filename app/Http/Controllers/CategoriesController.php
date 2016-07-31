<?php
/**
 * File: CategoriesController.php
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
use LaccDelivery\Http\Requests\AdminCategoryRequest;
use LaccDelivery\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
		/**
		 * @var CategoryRepository
		 */
		private $repository;

		public function __construct( CategoryRepository $repository )
		{
				$this->repository = $repository;
		}

		public function index()
		{
				$listCategories = $this->repository->paginate();

				return view( 'admin.categories.index', compact( 'listCategories' ) );
		}

		public function create()
		{
				return view( 'admin.categories.create' );
		}

		public function store( AdminCategoryRequest $request )
		{
				$data = $request->all();
				$this->repository->create( $data );

				return redirect()->route( 'admin.categories.index' );
		}

		public function edit( $id )
		{
				$category = $this->repository->find( $id );

				return view( 'admin.categories.edit', compact( 'category' ) );
		}

		public function update( AdminCategoryRequest $request, $id )
		{
				$input = $request->all();
				$this->repository->find( $id )->update( $input );

				return redirect()->route( 'admin.categories.index' );
		}

		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();

				return redirect()->route( 'admin.categories.index' );
		}

}