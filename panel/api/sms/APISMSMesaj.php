<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':
		$veriable = $_POST;

		if ( ! empty( $veriable['mesaj'] ) ) {


			$db->update( 'kampanya' )->where( 'id', $veriable['kampanya'] )->set( [
				'mesaj' => $veriable['mesaj']
			] );

			$location = '?page=sms/smskontrol&kampanya=' . $veriable['kampanya'];
			echo pageReturn( array(
				'operation' => 'redirect',
				'basari'    => 'SMS İÇERİĞİNİ KONTROL EDEREK GÖNDERİNİZ',
				'location'  => $location,
				'sleep'  => 5000
			) );
		} else {
			echo pageReturn( array( 'operation' => 'none', 'hata' => 'MESAJ ALANI BOŞ OLAMAZ.' ) );

		}

}
