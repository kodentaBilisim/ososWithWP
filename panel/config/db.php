<?php

// TARİH TİME ZONE
date_default_timezone_set( 'Europe/Istanbul' );

define( 'DB_SERVER', 'srv-captain--db-db' );
define( 'DB_USERNAME', 'ososWP' );
define( 'DB_PASSWORD', 'rbmLvuerNCP76Z0W' );
define( 'DB_DATABASE', 'osospanel' );

require_once server_root_dir() . '/classes/BasicDB.php';
require_once server_root_dir() . '/classes/NetGSM.php';
require_once server_root_dir() . '/classes/XMLtoJSON.php';


$dbhost = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpass = DB_PASSWORD;
$dbname = DB_DATABASE;


$db = new BasicDB( $dbhost, $dbname, $dbuser, $dbpass, 'utf8', 'new_' );
$db2 = new BasicDB( $dbhost, 'osossys', $dbuser, $dbpass, 'utf8', 'new_' );

$netgsm = new netGSM( '8503461309', 'zxdsl831C..','OS.OGRT.SEN' );

$XMLtoJSON = new XMLtoJSON();
