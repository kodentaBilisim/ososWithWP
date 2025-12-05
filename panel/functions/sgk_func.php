<?php

function sgkIDbyName( $SGK,$unvan ) {
	global $db;
	if ( empty( $SGK ) OR $SGK == "" ) {
		return 0;
	}
	$isyeri = $db->from( 'sgk' )->where( 'sgk', $SGK )->first();



	if ( !$isyeri ) {
		$firmaID = firmaIDbyName( $unvan );

		$il = explode('.',$SGK);
		if (substr($il[5],0,1) == 0){
			$il[5] = substr($il[5],1,3);
		}

		if (substr($il[5],0,1) == 0){
			$il[5] = substr($il[5],1,2);
		}

		$db->insert( 'sgk' )->set( [
			'sgk'     => $SGK,
			'firma'   => $firmaID,
			'sube'    => 1,
			'note'    => '',
			'unvan'   => '',
			'adres'   => str_replace( '   ', ' ', '' ),
			'telefon' => '',
			'faks'    => '',
			'calisan' => 0,
			'uye'     => 1,
			'acilis'  => NULL,
			'il' => $il[5]
		] );

		$SGKID = $db->lastInsertId();

		$firmaMeta = $db->from('firma')->where('id',$firmaID)->first();

		$firmaSGK = json_decode($firmaMeta['sgk'],true);

		if(!in_array($SGKID,$firmaSGK)){
			$firmaSGK[] = $SGKID;

			$db->update('firma')->where('id',$firmaID)
				->set([
					'sgk' => json_encode($firmaSGK)
				]);

		}

		return [$SGKID,true];
	} else {
		return [$isyeri['id'],false];
	}
}

function listPersonelSGK( $id, $durum = 1, $filter = array() ) {
	global $db;
	if ( count( $filter ) == 0 ) {
		if ( ! isset( $filter[2] ) ) {
			$filter[2] = '==';
		}
		$Users = $db->from( 'kisiler' )->where( 'sgk', $id )->where( 'durum', $durum )->all();
	} else {
		$Users = $db->from( 'kisiler' )->where( 'sgk', $id )->where( 'durum', $durum )->where( $filter[0], $filter[1], $filter[2] )->all();
	}
	$return = array();
	$i      = 0;
	foreach ( $Users as $User ) {
		$UserMeta = $db->from( 'kisiMeta' )->where( 'kisi', $User['id'] )->all();
		foreach ( $UserMeta as $meta ) {
			if ( isset( $User[ $meta['meta'] ] ) and ! is_array( $User[ $meta['meta'] ] ) ) {
				$gecici                  = $User[ $meta['meta'] ];
				$User[ $meta['meta'] ]   = array();
				$User[ $meta['meta'] ][] = $gecici;
				$User[ $meta['meta'] ][] = $meta['value'];
			} elseif ( isset( $User[ $meta['meta'] ] ) ) {
				if ( is_array( $User[ $meta['meta'] ] ) ) {
					$User[ $meta['meta'] ][] = $meta['value'];
				}
			} else {
				$User[ $meta['meta'] ] = $meta['value'];
			}
		}
		$return[ $i ] = $User;
		$i ++;
	}

	return $return;
}

function sgkUyeVar( $SGK, $firmaID ) {
	global $db;
	$db->update( 'sgk' )->where( 'sgk', $SGK )->set( [ 'uye' => 1 ] );
	$db->update( 'firma' )->where( 'id', $firmaID )->set( [ 'uye' => 1 ] );
}


function sgk_meta( $SGK ) {
	global $db;

	if(empty($SGK) OR $SGK == 1){
		return 0;
	}

	$sgKMETA = $db->from( 'sgk' )->where( 'id', $SGK )->first();

	$firmaName = $db->from( 'firma' )->where( 'id', $sgKMETA['firma'] )->first();

	$sgKMETA['name'] = $firmaName['name'];


	return $sgKMETA;


}

