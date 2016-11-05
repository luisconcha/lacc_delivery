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
		protected $availableIncludes = [ 'client' ];

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

		public function includeClient( User $model )
		{
				if ( $model->client ) {
						return $this->item( $model->client, new ClientTransformer() );
				} else {
						return null;
				}
		}
}
