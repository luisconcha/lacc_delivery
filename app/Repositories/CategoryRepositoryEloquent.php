<?php
namespace LaccDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Repositories\CategoryRepository;
use LaccDelivery\Models\Category;
use LaccDelivery\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return Category::class;
		}

		/**
		 * Boot up the repository, pushing criteria
		 */
		public function boot()
		{
				$this->pushCriteria( app( RequestCriteria::class ) );
		}
}
