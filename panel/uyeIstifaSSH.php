<?php
require_once '/var/www/html/panel/env.php';
require_once '/var/www/html/panel/functions.php';

$kayitlar = $db->from( 'import' )->where( 'status', 0 )->where( 'type', 'istifa' )->first();
if(!is_array($kayitlar)){
	echo 'KAYIT YOK';
	die();


}
$db->update( 'import' )->where( 'id', $kayitlar['id'] )->set( [
		'status' => 2
	] );


$uyeler = json_decode( file_get_contents( $kayitlar['file'] ), true );
$i      = 0;

$rand = rand( 9999, 9999999999 );

function ifEmptyZero( $data ) {
	if ( empty( $data ) ) {
		return 0;
	} else {
		return $data;
	}
}

foreach ( $uyeler as $v ) {


	if ( $i == 0 ) {
		$i ++;
		continue;
	}

	$excelToKeys = [
		'B' => 'tc',
		'G' => 'adres',
		'H' => 'not',
		'J' => 'istifaTarihi',
		'K' => 'cikisTarihi'
	];

	foreach ( $v as $key => $value ) {
		unset( $v[ $key ] );
		$v[ $excelToKeys[ $key ] ] = $value;
	}

	if ( empty( $v['tc'] ) ) {
		echo pageReturn( array(
			'operation' => 'redirect',
			'id'        => $_POST['B'],
			'location'  => 'uye/istifa?fileID=' . $v['fileID'],
			'sleep'     => '0',
			'data'      => $v
		) );
	}

	$userCheck = $db->from( 'kisiler' )->where( 'tc', $v['tc'] )->first();
	$randID    = rand( 0, 10000 );

	if ( $userCheck ):

		$db->update( 'kisiler' )->where( 'id', $userCheck['id'] )->set( [
			'durum'        => 0,
			'istifaTarihi' => date( 'Y-m-d H:i:s', strtotime( $v['istifaTarihi'] ) ),
			'cikisTarihi'  => date( 'Y-m-d H:i:s', strtotime( $v['cikisTarihi'] ) ),
			'updateTime'  => json_decode($kayitlar['data'],true)['uploadDateTime'],
		] );

		$db->insert( 'kisiMeta' )->set( [
			'kisi'  => $userCheck['id'],
			'value' => ifEmptyZero( $v['adres'] ),
			'meta'  => 'adres',
			'rand'  => $randID,
		] );
		$db->insert( 'kisiMeta' )->set( [
			'kisi'  => $userCheck['id'],
			'value' => ifEmptyZero( $v['not'] ),
			'meta'  => 'not',
			'rand'  => $randID,
		] );
	else:

		echo json_encode( [ 'KAYITLI DEĞİL', $v['tc'] ] );


	endif;


}

$db->update( 'import' )->where( 'id', $kayitlar['id'] )->set( [
		'status' => 1
	] );
