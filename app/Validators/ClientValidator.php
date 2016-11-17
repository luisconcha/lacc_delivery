<?php
namespace LaccDelivery\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
		protected $rules = [
			ValidatorInterface::RULE_CREATE => [
				'user.name'  => 'required',
				'user.email' => 'required|email|unique:users,email',
			],
			ValidatorInterface::RULE_UPDATE => [
				'user.name'  => 'sometimes|required',
				'user.email' => 'sometimes|required|email|unique:users,email',
			],
		];
}
