<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\Product;

/**
 * Class ProductTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{

		/**
		 * Transform the \Product entity
		 *
		 * @param \Product $model
		 *
		 * @return array
		 */
		public function transform( Product $model )
		{
				return [
					'id'    => (int)$model->id,
					'name'  => $model->name,
					'price' => $model->price,
				];
		}
}
