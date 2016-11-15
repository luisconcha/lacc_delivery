<?php
namespace LaccDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Repositories\ProductRepository;
use LaccDelivery\Models\Product;
//use LaccDelivery\Validators\ProductValidator;
use LaccDelivery\Presenters\ProductPresenter;

/**
 * Class ProductRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
		protected $skipPresenter = true;

		public function getList()
		{
				return $this->model->get( [ 'name', 'id', 'price' ] );
		}

		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return Product::class;
		}

		/**
		 * Boot up the repository, pushing criteria
		 */
		public function boot()
		{
				$this->pushCriteria( app( RequestCriteria::class ) );
		}

		public function presenter()
		{
				return ProductPresenter::class;
		}

}
