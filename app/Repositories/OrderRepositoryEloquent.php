<?php
namespace LaccDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaccDelivery\Presenters\OrderPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Models\Order;

//use LaccDelivery\Validators\OrderValidator;
/**
 * Class OrderRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
		//Desativa a presenter
		protected $skipPresenter = true;

		public function getByIdAndDeliveryman( $idOrder, $idDeliveryman )
		{
				$result = $this->with( [ 'client', 'items', 'cupom' ] )->findWhere( [ 'id' => $idOrder, 'user_deliveryman_id' => $idDeliveryman ] );
				if ( $result instanceof Collection ) {
						$result = $result->first();
				} else {
						if ( isset( $result[ 'data' ] ) && count( $result[ 'data' ] ) == 1 ) {
								$result = [
									'data' => $result[ 'data' ][ 0 ],
								];
						} else {
								throw  new ModelNotFoundException( 'Order não existe' );
						}
				}

				return $result;
		}

		/**
		 * Specify Model class name
		 *
		 * @return string
		 */
		public function model()
		{
				return Order::class;
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
				return OrderPresenter::class;
		}
}
