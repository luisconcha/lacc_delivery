<?php
/**
 * File: CupomsController.php
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
use LaccDelivery\Http\Requests\AdminCupomRequest;
use LaccDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{
		/**
		 * @var CupomRepository
		 */
		private $repository;

		public function __construct( CupomRepository $repository )
		{
				$this->repository = $repository;
		}

		public function index()
		{
				$listCupoms = $this->repository->paginate();

				return view( 'admin.cupoms.index', compact( 'listCupoms' ) );
		}

		public function create()
		{
				return view( 'admin.cupoms.create' );
		}

		public function store( AdminCupomRequest $request )
		{
				$data = $request->all();
				$this->repository->create( $data );

				return redirect()->route( 'admin.cupoms.index' );
		}

		public function edit( $id )
		{
				$cupom = $this->repository->find( $id );

				return view( 'admin.cupoms.edit', compact( 'cupom' ) );
		}

		public function update( AdminCupomRequest $request, $id )
		{
				$input = $request->all();
				$this->repository->find( $id )->update( $input );

				return redirect()->route( 'admin.cupoms.index' );
		}

		public function destroy( $id )
		{
				$this->repository->find( $id )->delete();

				return redirect()->route( 'admin.cupoms.index' );
		}
}