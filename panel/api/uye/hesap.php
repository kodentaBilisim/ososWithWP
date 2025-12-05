<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$excelToKeys = [
			'B' => 'tc',
			'G' => 'adres',
			'H' => 'not',
			'J' => 'istifaTarihi',
			'K' => 'cikisTarihi'
		];
		$v           = $_POST;


		foreach ( $v as $key => $value ) {
			unset( $v[ $key ] );
			$v[ $excelToKeys[ $key ] ] = $value;
		}

		if ( empty( $v['tc'] ) ) {
			echo pageReturn( array(
				'operation' => 'redirect',
				'id'        => $_POST['B'],
				'location'  => '?page=uye/istifa&fileID=' . $v['fileID'],
				'sleep'     => '0',
				'data'      => $v
			) );
			die();
		}

		$userCheck = $db->from( 'kisiler' )->where( 'tc', $v['tc'] )->first();

		$randID = rand( 0, 10000 );


		if ( $userCheck ):

			$db->update( 'kisiler' )->where( 'id', $userCheck['id'] )->set( [
				'durum'        => 0,
				'istifaTarihi' => date( 'Y-m-d H:i:s', strtotime( $v['istifaTarihi'] ) ),
				'cikisTarihi'  => date( 'Y-m-d H:i:s', strtotime( $v['cikisTarihi'] ) ),
			] );

			$db->insert( 'kisiMeta' )->set( [
				'kisi'  => $userCheck['id'],
				'value' => $v['adres'],
				'meta'  => 'adres',
				'rand'  => $randID,
			] );
			$db->insert( 'kisiMeta' )->set( [
				'kisi'  => $userCheck['id'],
				'value' => $v['not'],
				'meta'  => 'not',
				'rand'  => $randID,
			] );


		endif;

		echo pageReturn( array(
			'operation' => 'redirect',
			'id'        => $_POST['B'],
			'location'  => '?page=uye/istifa&fileID=' . $v['fileID'],
			'sleep'     => '0',
			'data'      => $v
		) );

}
