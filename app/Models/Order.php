<?php
namespace LaccDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
		use TransformableTrait;

		protected $fillable = [
			'client_id',
			'user_deliveryman_id',
			'total',
			'status',
		];

		//Statuts of order
		const PROCESSING = 'Processing';
		const SHIPPED    = 'Shipped';
		const COMPLETED  = 'Completed';
		const SUSPENDED  = 'Suspended';
		const UNKNOWN    = 'Unknown';

		public function items()
		{
				return $this->hasMany( OrderItem::class );
		}

		public function deliveryman()
		{
				return $this->belongsTo( User::class, 'user_deliveryman_id', 'id' );
		}

		public function client()
		{
				return $this->belongsTo( Client::class, 'client_id', 'id' );
		}

		public function cupom()
		{
				return $this->belongsTo( Cupom::class );
		}
}
