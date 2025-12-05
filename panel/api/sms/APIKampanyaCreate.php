<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$veri   = $_POST['query'];
		$filtre = $veri['filt'];
		$user   = $veri['user'];

		$db->insert( 'kampanya' )->set( [
			'user'       => $user,
			'date'       => date( 'Y-m-d H:i:s', time() ),
			'campaignId' => 0,
			'data'       => $filtre,
			'mesaj'      => '',
			'senddate'   => '',
			'operator'   => 'NETGSM',
			'ek'   => '[]',
			'rapor'   => '',
			'raporTime'   => '',
		] );
		echo $db->lastId();
}
