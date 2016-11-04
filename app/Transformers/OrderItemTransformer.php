<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{

		/**
		 * Transform the \OrderItem entity
		 *
		 * @param \OrderItem $model
		 *
		 * @return array
		 */
		public function transform( OrderItem $model )
		{
				return [
					'id'         => (int)$model->id,
					'order_id'   => $model->order_id,
					'product_id' => $model->product_id,
					'price'      => $model->price,
					'qtd'        => $model->qtd,
					'created_at' => $model->created_at,
					'updated_at' => $model->updated_at,
				];
		}
}
