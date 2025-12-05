<?php

require_once '../api_include.php';


switch ( $requestMethod ) {
	case 'GET':


		$KampanyaID = $_GET['id'];

		$Kampanya = $db->from( 'kampanya' )->where( 'id', $KampanyaID )->first();

		$array = json_decode( $Kampanya['data'], true );

		$cinsiyet = $_GET['cinsiyet'];

		if ( $cinsiyet == 'K' ) {

			$array['cinsiyet'] = array( "K" );

		} elseif ( $cinsiyet == 'E' ) {

			$array['cinsiyet'] = array( "E" );

		} elseif ( $cinsiyet == 'all' ) {

			$array['cinsiyet'] = array( "E", "K", 0 );

		}

		$json = json_encode( $array );

		$Kampanya = $db->update( 'kampanya' )->where( 'id', $KampanyaID )->set( [
			'data' => $json
		] );

		header( "Location:/panel/?page=sms/gonder&kampanya=" . $KampanyaID );

}
