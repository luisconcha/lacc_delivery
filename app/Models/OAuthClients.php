<?php
/**
 * File: OAuthClients.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 30/09/16
 * Time: 23:27
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OAuthClients extends Model implements Transformable
{
		use TransformableTrait;

		protected $table =  'oauth_clients';

		protected $fillable = [
			'id',
			'secret',
			'name',
			'created_at',
			'update_at',
		];

}