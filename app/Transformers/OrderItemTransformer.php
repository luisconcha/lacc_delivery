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
		protected $availableIncludes = [ 'products' ];


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

		public function includeProducts( Order $model )
		{
				return $this->item( $model->products, new ProductTransformer() );
		}
}
