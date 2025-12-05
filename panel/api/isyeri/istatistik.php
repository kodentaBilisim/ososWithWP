<?php

require_once '../api_include.php';

$SGKCheck = DB()->from( 'sgk' )->all();

foreach ( $SGKCheck as $item ) {

	var_dump( $item );

	$uye = DB()->from( 'kisiler' )->where( 'SGK', $item['id'] )->all();

	if ( count( $uye ) > 0 ) {
		DB()->update( 'sgk' )->where( 'id', $item['id'] )->set( [
			'uye' => count( $uye )
		] );

		DB()->update( 'firma' )->where( 'id', $item['firma'] )->set( [
			'uye' => 1
		] );

	} else {
		DB()->update( 'sgk' )->where( 'id', $item['id'] )->set( [
			'uye' => 0
		] );

		DB()->update( 'firma' )->where( 'id', $item['firma'] )->set( [
			'uye' => 0
		] );

	}

}

$FirmaCheck = DB()->from( 'firma' )->all();

foreach ( $FirmaCheck as $firma ) {

	var_dump( $firma );

	$SGKCheck = DB()->from( 'sgk' )->where( 'firma', $firma['id'] )->all();

	if ( count( $SGKCheck ) < 1 ) {

		echo 'SİLİNDİ';

		sleep( 1 );

		$delete = DB()->delete( 'firma' )->where( 'id', $firma['id'] )->done();
	}


}

$Personel = DB()->from( 'kisiler' )->all();

foreach ( $Personel as $item ) {

	var_dump( $item );

	if ( $item['durum'] == 0 ) {

		if ( strtotime( $item['cikisTarihi'] ) < time() ) {
			DB()->delete( 'kisiler' )->where( 'id', $item['id'] )->done();
		}

	}


}


APIRequest('https://api.uptime.coach/webhook-heartbeat/a28091253ec585215ce4d6748bb0c7a2');
