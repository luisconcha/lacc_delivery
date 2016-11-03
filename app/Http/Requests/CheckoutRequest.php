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

use Illuminate\Http\Request as HttpRequest;

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
		public function rules( HttpRequest $request )
		{
				/**
				 * exists:cupoms,code,used,0
				 * se_existe:nome_tbl,nome_campo,outro_nome_campo,outro_nome_campo=0
				 */
				$rules = [
					'cupom_code' => 'exists:cupoms,code,used,0',
				];
				$this->buildRulesItems( 0, $rules );
				$items = $request->get( 'items', [] );
				$items = !is_array( $items ) ? [] : $items;
				foreach ( $items as $key => $val ):
						$this->buildRulesItems( $key, $rules );
				endforeach;

				return $rules;
		}

		/**
		 * Metodo responsável por criar as regras para as todas as linha de items que
		 * forem enviadaspara o servidor podem ser no mínimo 1
		 * @param       $key
		 * @param array $rules
		 */
		public function buildRulesItems( $key, array &$rules )
		{
				$rules[ "items.$key.product_id" ] = 'required';
				$rules[ "items.$key.qtd" ]        = 'required';
		}
}