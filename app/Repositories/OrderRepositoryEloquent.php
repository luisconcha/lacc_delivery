<?php
namespace LaccDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
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
		public function getByIdAndDeliveryman( $idOrder, $idDeliveryman )
		{
				$result = $this->with( [ 'client', 'items', 'cupom' ] )->findWhere( [ 'id' => $idOrder, 'user_deliveryman_id' => $idDeliveryman ] );
				$result = $result->first();
				if ( $result ) {
						//recupera o produto
						$result->items->each( function ( $item ) {
								$item->product;
						} );
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
}
