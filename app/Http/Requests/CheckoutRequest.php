<?php
/**
 * File: CheckoutRequest.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 02/10/16
 * Time: 22:04
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
namespace LaccDelivery\Http\Requests;

class CheckoutRequest extends Request
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
				/**
				 * exists:cupoms,code,used,0
				 * se_existe:nome_tbl,nome_campo,outro_nome_campo,outro_nome_campo=0
				 */
				return [
					'cupom_code'         => 'exists:cupoms,code,used,0',
					'items.0.product_id' => 'required',
					'items.0.qtd'        => 'required',
				];
		}
}