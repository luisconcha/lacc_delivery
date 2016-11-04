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
					'id'         => (int)$model->id,
					'address'    => $model->address,
					'created_at' => $model->created_at,
					'updated_at' => $model->updated_at,
				];
		}
}
