<?php

$scriptConfig = array(
    'root_folder' => 'panel',
    'base_title' => 'Özel Sektör Öğretmenleri Sendikası',
    'header_title' => 'Öğretmen Sendikası',
    'request_folder' => 'api',
    'mainURL' => 'https://ogretmensendikasi.org/panel/',
    'status' => 'develop', //develop or production
    'merchant_id' => '417422', //develop or production
    'merchant_key' => 'JBL8afznw92p5noq', //develop or production
    'merchant_salt' => 'p5BztJpbsaxBZR49', //develop or production
    'merchant_ok_url' => 'https://ogretmensendikasi.org/panel/?page=paytrcallback&ok', //develop or production
    'merchant_fail_url' => 'https://ogretmensendikasi.org/panel/?page=paytrcallback&fail', //develop or production
    'paytrTestMode' => "0", //develop or production
    'non3d_test_failed' => "0", //develop or production
    'currency' => "TL",
    'payment_type' => "card",
    'post_url' => "https://www.paytr.com/odeme",
    'installment_count' => "0"
);

// VERİTABANI BİLGİLERİ config/db.php içinde



function server_root_dir(){
    return '/var/www/html/panel/';
}
