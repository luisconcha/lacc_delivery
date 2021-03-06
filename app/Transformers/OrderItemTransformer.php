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
		protected $defaultIncludes = [ 'product' ];

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
					'id'    => (int)$model->id,
					'price' => $model->price,
					'qtd'   => $model->qtd,
				];
		}

		public function includeProduct( OrderItem $model )
		{
				return $this->item( $model->product, new ProductTransformer() );
		}
}
