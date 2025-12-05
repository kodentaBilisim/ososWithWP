<?php

// TARİH TİME ZONE
date_default_timezone_set('Europe/Istanbul');

define('DB_SERVER', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '..');
define('DB_DATABASE', '');

require_once  server_root_dir().'/classes/BasicDB.php';

$dbhost = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpass = DB_PASSWORD;
$dbname = DB_DATABASE;


$db = new BasicDB($dbhost, $dbname, $dbuser, $dbpass,'utf8','main_');
