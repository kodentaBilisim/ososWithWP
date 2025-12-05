<?php

function userCreate( $username, $email, $type ) {

	global $db;


	$password    = randomPassword();
	$firmaCreate = $db->insert( 'users' )->
	set( [
		'username'    => $username,
		'email'       => $email,
		'password'    => md5( $password ),
		'passbase64'  => base64_encode( $password ),
		'type'        => $type,
		'create_date' => date( 'Y-m-d H:i:s' )
	] );

	return $db->lastId();
}


function userMetaCreate( $userID, $meta, $value ) {

	global $db;

	if ( $meta == 'token' or $meta == 'postUrl' ) {
		return false;
	}

	$MetaCreate = $db->insert( 'userMeta' )
	                 ->set( [
		                 'meta'  => $meta,
		                 'value' => $value,
		                 'user'  => $userID
	                 ] );

	return true;

}

function userMetaRemove( $userID, $meta, $value ) {

	global $db;

	$db->delete( 'userMeta' )
	   ->where( 'user', $userID )
	   ->where( 'meta', $meta )
	   ->where( 'value', $value )
	   ->done();

	return true;

}


function userMetaEdit( $userID, $meta, $value ) {

	global $db;

	if ( $meta == 'token' or $meta == 'postUrl' ) {
		return false;
	}

	$userMeta = userMeta( $userID );

	if ( isset( $userMeta[ $meta ] ) ) {
		$MetaEdit = $db->update( 'userMeta' )
		               ->where( 'user', $userID )
		               ->where( 'meta', $meta )
		               ->set( [
			               'value' => $value,
		               ] );
	} else {
		userMetaCreate( $userID, $meta, $value );
	}

	return true;

}

function userCheck( $username, $email = null ) {

	global $db;

	if ( $email == null ) {
		$userCheck = $db->from( 'users' )
		                ->where( 'username', $username )
		                ->cnt();
	} else {
		$userCheck = $db->from( 'users' )
		                ->where( 'username', $username )
		                ->or_where( 'email', $email )
		                ->cnt();
	}
	if ( $userCheck > 0 ) {
		return false;
	}

	return true;

}

function userMetaCheck( $userID, $meta, $value ) {

	global $db;


	$userCheck = $db->from( 'userMeta' )
	                ->where( 'user', $userID )
	                ->where( 'meta', $meta )
	                ->where( 'value', $value )
	                ->first();

	if ( $userCheck ) {
		return true;
	} else {
		return false;
	}


}



function userList( $UserType ) {

	global $db;

	$Users = $db->from( 'users' )->where( 'type', $UserType )->all();

	$return = array();
	$i      = 0;
	foreach ( $Users as $User ) {

		$tableName = 'userMeta';

		$UserMeta = $db->from( $tableName )->where( 'user', $User['id'] )->all();

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



