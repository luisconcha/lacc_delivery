<?php
/**
 * File: customHelper.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 31/07/16
 * Time: 12:48
 * Project: lacc_la_cordova
 * Copyright: 2016
 */
if ( !function_exists( 'dataHoraBR' ) ) {
		function dataHoraBR( $date )
		{
				if ( !$date instanceof \DateTime ) {
						$date = new DateTime( $date );
				}

				return $date->format( 'd-m-Y' );
		}
}
if ( !function_exists( 'dataHoraMinutoBR' ) ) {
		function dataHoraMinutoBR( $date )
		{
				if ( $date instanceof \DateTime ) {
						$date = new Datetime( $date );
				}

				return $date->format( 'd-m-Y H:m:s' );
		}
}
if ( !function_exists( 'priceBR' ) ) {
		function priceBR( $price )
		{
				$price = number_format( $price, 2, ".", "" );

				return $price;
		}
}