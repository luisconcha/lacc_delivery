<?php
namespace LaccDelivery\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Models\Cupom;
use LaccDelivery\Validators\CupomValidator;
use LaccDelivery\Presenters\CupomPresenter;

/**
 * Class CupomRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
		//Desativa a presenter
		protected $skipPresenter = true;

		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return Cupom::class;
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
				return CupomPresenter::class;
		}

		public function findByCode( $cupomCode )
		{
				$result = $this->model
					->where( 'code', $cupomCode )
					->where( 'used', 0 )
					->first();
				if ( $result ) {
						//verifica se o resultado esta sendo tratado com presenter
						return $this->parserResult( $result );
				}
				throw ( new ModelNotFoundException )->setModel( get_class( $this->model ) );
		}
}
