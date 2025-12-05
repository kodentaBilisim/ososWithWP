<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$excelToKeys = [
			'A' => 'sgk',
			'B' => 'name',
			'C' => 'adres',
			'D' => 'telefon',
			'E' => 'faks',
			'F' => 'calisan',
			'G' => 'acilisTarihi'
		];

		$v = $_POST;
		foreach ( $v as $key => $value ) {
			unset( $v[ $key ] );
			$v[ $excelToKeys[ $key ] ] = $value;
		}

		$firmaID = firmaIDbyName( $v['name'] );



		$SGKCheck = $db->from( 'sgk' )->where( 'sgk', $v['sgk'] )->first();

		if ( ! $SGKCheck ) {

			$db->insert( 'sgk' )->set( [
				'sgk'     => $v['sgk'],
				'firma'   => $firmaID,
				'sube'    => 1,
				'note'    => '',
				'unvan'   => $v['name'],
				'adres'   => str_replace('   ',' ',$v['adres']),
				'telefon' => $v['telefon'],
				'faks'    => $v['faks'],
				'calisan' => $v['calisan'],
				'uye'     => 0,
				'acilis'  => date( 'Y-m-d', strtotime( $v['acilisTarihi'] ) ),
			] );

		}


		echo pageReturn( array(
			'operation' => 'redirect',
			'id' => $v['sgk'],
			'meta' => 'A',
			'mevcut' => ($SGKCheck)?true:false
		) );

}
