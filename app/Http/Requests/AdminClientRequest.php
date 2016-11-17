<?php
namespace LaccDelivery\Http\Requests;

class AdminClientRequest extends Request
{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize()
		{
				return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array
		 */
		public function rules()
		{
				return [
					'user.name'  => 'required',
					'user.email' => 'required|email|unique:users,email'
				];

		}
}
