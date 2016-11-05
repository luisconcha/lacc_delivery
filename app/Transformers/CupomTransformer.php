<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\Cupom;

/**
 * Class CupomTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class CupomTransformer extends TransformerAbstract
{

		/**
		 * Transform the \Cupom entity
		 *
		 * @param \Cupom $model
		 *
		 * @return array
		 */
		public function transform( Cupom $model )
		{
				return [
					'id'         => (int)$model->id,
					'code'       => $model->code,
					'value'      => $model->value,
					'used'       => $model->used,
				];
		}
}
