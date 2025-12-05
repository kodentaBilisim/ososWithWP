<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$excelToKeys = [
			'A' => 'siraNo',
			'B' => 'tc',
			'C' => 'name',
			'D' => 'cinsiyet',
			'E' => 'uyelikTarihi',
			'F' => 'dogrulamaKodu',
			'G' => 'YKKararNo',
			'H' => 'telefon',
			'I' => 'ePosta',
			'J' => 'SGK',
			'K' => 'firma',
		];
		$v           = $_POST;


		foreach ( $v as $key => $value ) {
			unset( $v[ $key ] );
			$v[ $excelToKeys[ $key ] ] = $value;
		}

		if ( empty( $v['SGK'] ) or $v['SGK'] == "" ) {
			$SGK = [ 1, false ];
		} else {

			$firmaID = firmaIDbyName( $v['firma'] );
			$SGK     = sgkIDbyName( $v['SGK'], $v['firma'] );

		}



		$userCheck = kisiGetir( 'tc', $v['tc'] );

		if ( ! $userCheck ) {

			$db->insert( 'kisiler' )->set( [
				'name'           => $v['name'],
				'tc'             => $v['tc'],
				'cinsiyet'       => $v['cinsiyet'],
				'siraNo'         => $v['siraNo'],
				'uyelikTarihi'   => date( 'Y-m-d H:i:s', strtotime( $v['uyelikTarihi'] ) ),
				'dogrulamaKodu'  => $v['dogrulamaKodu'],
				'YKKararNo'      => $v['YKKararNo'],
				'telefon'        => $v['telefon'],
				'durum'          => 1,
				'rand'           => $_POST['rnd'],
				'createDateTime' => date( 'Y-m-d H:i:s' ),
				'istifaTarihi'   => NULL,
				'cikisTarihi'    => NULL,
				'gorev'          => 50,
			] );


			$kisiID = $db->lastInsertId();

			$db->insert( 'kisiMeta' )->set( [
				'kisi'  => $kisiID,
				'value' => $SGK[0],
				'meta'  => 'SGK',
				'rand'  => rand( 0, 10000 )
			] );

			echo pageReturn( array(
				'data' => 'YENİ EKLENDİ',
				'tc'   => $v['tc']
			) );
			die();
		} elseif ( $userCheck and $userCheck['durum'] == 1 ) {
			if ( in_array( $SGK[0], stringToArray($userCheck['SGK']) ) ) {
				echo pageReturn( array(
					'data' => 'MEVCUT ÜYE'
				) );
				die();
			} else {

				$db->insert( 'kisiMeta' )->set( [
					'kisi'  => $userCheck['id'],
					'value' => $SGK[0],
					'meta'  => 'SGK',
					'rand'  => rand( 0, 10000 )
				] );
				echo pageReturn( array(
					'data' => 'MEVCUT ÜYE. YENİ SGK EKLENDİ'
				) );
				die();

			}
		} elseif ( $userCheck and $userCheck['durum'] == 0 ) {

			$db->update( 'kisiler' )->where( 'id', $userCheck['id'] )->set( [
				'durum'        => 1,
				'istifaTarihi' => '0000-00-00 00:00:00',
				'cikisTarihi'  => '0000-00-00 00:00:00',
			] );
			$db->insert( 'kisiMeta' )->set( [
				'kisi'  => $userCheck['id'],
				'value' => date( 'Y-m-d H:i:s', strtotime( $v['uyelikTarihi'] ) ),
				'meta'  => 'uyelik',
				'rand'  => rand( 0, 10000 )
			] );
			echo pageReturn( array(
				'data' => 'İSTİFADAN ÜYEYE GEÇTİ',
				'tc'   => $v['tc']
			) );
			die();
		}
}
