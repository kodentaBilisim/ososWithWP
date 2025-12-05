<?php

function firmaIDbyName( $name ) {
	global $db;
	if ( empty( $name ) ) {
		return 0;
	}
	$firmaMeta = $db->from( 'firma' )->where( 'name', $name )->first();
	if ( ! $firmaMeta ) {
		$db->insert( 'firma' )->set( [
            'name' => $name,
            'sube' => 1,
            'sgk' => '[]',
            'uye' => 0,
        ] );

		return $db->lastInsertId();
	} else {
		return $firmaMeta['id'];
	}
}


function listSGKFirma( $id ) {
	global $db;

	return $db->from( 'sgk' )->where( 'firma', $id )->all();
}

function listFirmaUye( $id, $durum = 1 ) {
	global $db;

	$firmaSGKlar = $db->from( 'sgk' )->where( 'firma', $id )->all();
	$SGKIDS = [];
	foreach ($firmaSGKlar as $firmaSGK ){
		$SGKIDS[] = $firmaSGK['id'];
	}

	return $db->from( 'kisiler' )->in( 'SGK', $SGKIDS )->where('durum',$durum)->all();
}

function listSGKUye( $id, $durum = 1 ) {
	global $db;

	return $db->from( 'kisiler' )->where( 'SGK', $id )->where('durum',$durum)->all();
}

function listFirmaUyeCinsiyet( $id, $cinsiyet ) {
	global $db;
	$firmaSGKlar = $db->from( 'sgk' )->where( 'firma', $id )->all();
	$SGKIDS = [];
	foreach ($firmaSGKlar as $firmaSGK ){
		$SGKIDS[] = $firmaSGK['id'];
	}
	return $db->from( 'kisiler' )->in( 'SGK', $SGKIDS )->where( 'durum', 1 )->where( 'cinsiyet', $cinsiyet )->all();
}

function firma_meta( $SGK ) {
	global $db;
	return $db->from( 'firma' )->where( 'id', $SGK )->first();
}
