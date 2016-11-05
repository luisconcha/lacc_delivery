<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\Client;

/**
 * Class ClientTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

		/**
		 * Transform the \Client entity
		 *
		 * @param \Client $model
		 *
		 * @return array
		 */
		public function transform( Client $model )
		{
				return [
					'id'      => (int)$model->id,
					'phone'   => $model->address,
					'address' => $model->address,
					'zipcode' => $model->zipcode,
					'city'    => $model->city,
					'state'   => $model->state,
				];
		}
}
