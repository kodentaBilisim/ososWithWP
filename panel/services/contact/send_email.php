<?php

// Kullanıcı bilgilerini mail atar

require_once '../../env.php';
require_once '../../functions.php';

$UserID = $_GET['UserID'];
$TemplateID = $_GET['Template'];

/*
$User = metaUser($UserID);

$Template = $db->from('mailsablon')
           ->where('id',$TemplateID)
           ->first();


if($TemplateID == 1){

	$content = str_replace('##BİLDİRİ YAZAR SAHİBİ##',$User['name'],$Template[$User['lang']]);

}

$content = str_replace('/##BASEURL##/','/'.$scriptConfig['root_folder'].'/',$content);
$content = str_replace('## username ##',$User['username'],$content);
$content = str_replace('## password ##',base64_decode($User['passbase64']),$content);
$content = str_replace('##ETKİNLİK ADI##',$scriptConfig['header_title'],$content);

echo sendmail( $User['username'], $scriptConfig['header_title'], $content );*/



