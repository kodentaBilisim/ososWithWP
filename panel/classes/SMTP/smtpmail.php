<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function mailat($konu, $mesaj)
{

    require("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
    $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
    $mail->SMTPSecure = 'tls'; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
    $mail->Host = "smtp.yandex.com"; // Mail sunucusunun adresi (IP de olabilir)
    $mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
    $mail->IsHTML(true);
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet = "utf-8";
    $mail->Username = "smtp@uzaktanisgegitimi.com"; // Gönderici adresiniz (e-posta adresiniz)
    $mail->Password = "tK2zU1LG7JKO"; // Mail adresimizin sifresi
    $mail->SetFrom("smtp@uzaktanisgegitimi.com", "UZAKTAN İSG"); // Mail atıldığında gorulecek isim ve email
    $mail->AddAddress("info@uzaktanisgegitimi.com"); // Mailin gönderileceği alıcı adres
    $mail->Subject = $konu; // Email konu başlığı
    $mail->Body = $mesaj; // Mailin içeriği
    $mail->Send();
}

function mailat3($konu, $mesaj, $eposta)
{
    require("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
    $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
    $mail->SMTPSecure = 'tls'; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
    $mail->Host = "smtp.yandex.com"; // Mail sunucusunun adresi (IP de olabilir)
    $mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
    $mail->IsHTML(true);
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet = "utf-8";
    $mail->Username = "smtp@uzaktanisgegitimi.com"; // Gönderici adresiniz (e-posta adresiniz)
    $mail->Password = "tK2zU1LG7JKO"; // Mail adresimizin sifresi
    $mail->SetFrom("smtp@uzaktanisgegitimi.com", "UZAKTAN İSG"); // Mail atıldığında gorulecek isim ve email
    $mail->AddAddress($eposta); // Mailin gönderileceği alıcı adres
    $mail->Subject = "Uzaktan ISG Eğitimi Giriş Bilgileri"; // Email konu başlığı
    $mail->Body = $mesaj; // Mailin içeriği
    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}

function mailat2($konu, $mesaj, $eposta)
{
    require("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls'; // Güvenli baglanti icin ssl normal baglanti icin tls
    $mail->Host = "smtp.yandex.com"; // Mail sunucusuna ismi
    $mail->Port = 587; // Gucenli baglanti icin 465 Normal baglanti icin 587
    $mail->IsHTML(true);
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet = "utf-8";
    $mail->Username = "smtp@uzaktanisgegitimi.com"; // Gönderici adresiniz (e-posta adresiniz)
    $mail->Password = "tK2zU1LG7JKO"; // Mail adresimizin sifresi
    $mail->SetFrom("smtp@uzaktanisgegitimi.com", "UZAKTAN İSG"); // Mail atıldığında gorulecek isim ve email
    $mail->AddAddress($eposta); // Mailin gönderileceği alıcı adres
    $mail->Subject = "UZAKTAN ISG EGITIMI GIRIS BILGILERI"; // Konu basligi
    $mail->Body = $mesaj; // Mailin icerigi
    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}


?>
