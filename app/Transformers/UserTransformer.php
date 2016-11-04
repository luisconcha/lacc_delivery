<?php
namespace LaccDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use LaccDelivery\Models\User;

/**
 * Class UserTransformer
 * @package namespace LaccDelivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

		/**
		 * Transform the \User entity
		 *
		 * @param \User $model
		 *
		 * @return array
		 */
		public function transform( User $model )
		{
				return [
					'id'    => (int)$model->id,
					'name'  => $model->name,
					'email' => $model->email,
					'role'  => $model->role,
				];
		}
}
