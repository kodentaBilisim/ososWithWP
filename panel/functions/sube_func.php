<?php

function subeUyeList( $subeID, $durum = 1 ) {
	global $db;
	$sgk    = $db->from( 'sgk' )->where( 'uye', 1 )->where( 'sube', $subeID )->all();
	$return = [];
	foreach ( $sgk as $i ) {
		$return[] = $i['id'];
	}
	$kisiler = $db->from( 'kisiler' )->where( 'durum', $durum )->in( 'sgk', $return )->all();

	return $kisiler;
}

function ilUyeList( $subeID, $durum = 1 ) {
	global $db;

	if(strlen($subeID) == 1){
		$subeID = '00'.$subeID;
	}elseif (strlen($subeID) == 2){
		$subeID = '0'.$subeID;
	}

	$kisiID = $db->from('kisiMeta')->
	where('meta','il')->
	where('value',$subeID)->all();


	return $kisiID;
}

function subeSGKList( $subeID ) {
	global $db;
	$sgk = $db->from( 'sgk' )->where( 'uye', 1 )->where( 'sube', $subeID )->all();

	return $sgk;
}

function subeUyeListCinsiyet( $subeID, $cinsiyet ) {
	global $db;
	$sgk    = $db->from( 'sgk' )->where( 'sube', $subeID )->all();
	$return = [];
	foreach ( $sgk as $i ) {
		$return[] = $i['id'];
	}
	$kisiler = $db->from( 'kisiler' )->where( 'durum', 1 )->where( 'cinsiyet', $cinsiyet )->in( 'sgk', $return )->all();

	return $kisiler;
}

function ilUyeListCinsiyet( $subeID, $cinsiyet ) {
	global $db;
	if(strlen($subeID) == 1){
		$subeID = '00'.$subeID;
	}elseif (strlen($subeID) == 2){
		$subeID = '0'.$subeID;
	}
	$sgk    = $db->from( 'sgk' )->where( 'il', $subeID )->all();
	$return = [];
	foreach ( $sgk as $i ) {
		$return[] = $i['id'];
	}
	$kisiler = $db->from( 'kisiler' )->where( 'durum', 1 )->where( 'cinsiyet', $cinsiyet )->in( 'sgk', $return )->all();

	return $kisiler;
}

function get_meta_sube($id, $meta = null)
{

	global $db;

	$return = $db->from('sube')->where('id', $id)->first();

	if ($meta == null) {
		return $return;
	} else {
		return $return[$meta];
	}


}

function get_meta_gorev($id, $meta = null)
{

	global $db;

	$return = $db->from('gorev')->where('id', $id)->first();

	if ($meta == null) {
		return $return;
	} else {
		return $return[$meta];
	}


}
