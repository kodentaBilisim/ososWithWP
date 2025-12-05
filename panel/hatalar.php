<?php

session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

$merchant_id = $scriptConfig['merchant_id'];
$merchant_key = $scriptConfig['merchant_key'];
$merchant_salt = $scriptConfig['merchant_salt'];

$query = "SELECT id, gun,user, lastPayment FROM new_talimat WHERE status = 1";
$stmt = $db->query($query);

// Güncel tarih
$currentDate = new DateTime();
$currentDay = $currentDate->format('j'); // Ayın gün numarası

// Satırları işle
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $lastPayment = new DateTime($row['lastPayment']);
    $interval = $currentDate->diff($lastPayment);

    // 1 aydan fazla geçmiş mi kontrol et
    if ($interval->m > 1 || ($interval->m == 1 && $interval->d > 0)) {
      echo json_encode($row).'<br>';
    }
}

echo 'İŞLEM TAMAMLANDI - ÖDEME';