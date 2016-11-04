<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
		//Metodos para serializar os relacionamentos por padrão
		//protected $defaultIncludes = [ 'cupom', 'items' ];
		//Metodos para serializar os relacionamentos sobre demanda
		protected $availableIncludes = [ 'cupom', 'items', 'client' ];

		/**
		 * Transform the \Order entity
		 *
		 * @param \Order $model
		 *
		 * @return array
		 */
		public function transform( Order $model )
		{
				return [
					'id'         => (int)$model->id,
					'total'      => (float)$model->total,
					'created_at' => $model->created_at,
					'updated_at' => $model->updated_at,
				];
		}

		//many to one -> Cupom
		public function includeCupom( Order $model )
		{
				if ( !$model->cupom ) {
						return null;
				}

				return $this->item( $model->cupom, new CupomTransformer() );
		}

		//One to many -> OrderItem
		public function includeItems( Order $model )
		{
				return $this->collection( $model->items, new OrderItemTransformer() );
		}

		public function includeClient( Order $model )
		{
				return $this->item( $model->client, new ClientTransformer() );
		}
}
