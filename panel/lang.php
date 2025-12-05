<?php

session_start();

if($_GET['lang'] == 'tr' OR $_GET['lang'] == 'en'){
	$_SESSION['lang'] = $_GET['lang'];
}

$geldigi_sayfa = $_SERVER['HTTP_REFERER'];
header("Refresh: 0; url=".$geldigi_sayfa."");
