<?php


/*

	ENV ile temel ayar bilgileri
	functions ile de site genelinde kullanılabilir
	tüm içerik fonksiyorunları devreye alınyor
*/

session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

/*
	ENV dosyasında status bilgisi
	develop ise hata gösterimi açılıyor
*/

if ($scriptConfig['status'] == 'develop') {
    ini_set('display_errors', 'on');
    //error_reporting( E_ERROR );
    error_reporting(E_WARNING);
}

/*
	URL'yi yönlendirme ayarları
	için parçalıyoruz
*/


if (!empty($scriptConfig['root_folder'])) {
    $URL = str_replace('/' . $scriptConfig['root_folder'] . '/', '', $_SERVER['REQUEST_URI']);

} else {
    $URL = ltrim($_SERVER['REQUEST_URI'], "/");

}

$URL = rtrim($URL, "/");

/*
	Site dili kontrol ediliyor
	yoksa oluşturuluyor
*/
$URLPart = $_GET['page'];


if (isset($_GET['logout'])) {
	// LOGOUT
	session_destroy();
	header('Location: /');
} elseif (isset($_GET['aidat'])) {
	// LOGOUT
	session_destroy();
	include 'aidat.php';
} elseif (strstr($URLPart, 'paytrcallback')) {
	echo 'OK';
} elseif (isset($_GET['bildirim'])) {
	// LOGOUT


	$post = $_POST;


    ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
    #
    ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
    $merchant_key = $scriptConfig['merchant_key'];
    $merchant_salt = $scriptConfig['merchant_salt'];

    ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
    #
    ## POST değerleri ile hash oluştur.
    $hash = base64_encode(hash_hmac('sha256', $post['merchant_oid'] . $merchant_salt . $post['status'] . $post['total_amount'], $merchant_key, true));
    #
	## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
	## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.

	if ($hash != $post['hash'])
		die('PAYTR notification failed: bad hash');
	###########################################################################


	$CartMeta = $db->from('cart')->where('referans', $_POST['merchant_oid'])->first();

	if ($CartMeta) {

		$Sepet = json_decode($CartMeta['data'], true);

		$db->update('cart')
			->where('referans', $_POST['merchant_oid'])
			->set([
				      'response' => json_encode($_POST)
			      ]);


		if ($post['status'] == 'success') { ## Ödeme Onaylandı


			$db->update('talimat')->where('user', $CartMeta['user'])->set([
				                                                              'status' => 1,
				                                                              'lastPayment' => date('Y-m-d H:i:s')
			                                                              ]);


			if ($db->from('odemeler')->where('referans', $_POST['merchant_oid'])->cnt() < 1) {
				$db->insert('odemeler')->set([
					                             'user' => $CartMeta['user'],
					                             'data' => json_encode($_POST),
					                             'date' => date('Y-m-d H:i:s'),
					                             'tutar' => $_POST['total_amount'] / 100,
					                             'type' => ($Sepet['type'] ?? 1),
					                             'referans' => $_POST['merchant_oid'],
					                             'rand' => 0
				                             ]);
			} else {
				$db->update('odemeler')->
				where('referans', $_POST['merchant_oid'])->
				set([
					    'user' => $CartMeta['user'],
					    'data' => json_encode($_POST),
					    'date' => date('Y-m-d H:i:s'),
					    'tutar' => $_POST['total_amount'] / 100,
					    'type' => ($Sepet['type'] ?? 1),
					    'rand' => 0
				    ]);
			}

		} else {


			$db->insert('hatalar')->set([
				                            'user' => $CartMeta['user'],
				                            'data' => json_encode($_POST),
				                            'date' => date('Y-m-d H:i:s'),
				                            'tutar' => $_POST['total_amount'] / 100,
				                            'type' => ($Sepet['type'] ?? 1),
				                            'referans' => $_POST['merchant_oid'],
				                            'rand' => 0
			                            ]);


			if ($Sepet['type'] == 3){

				$uyemeta = uyeMeta($CartMeta['user']);


				$uyeil = ilgetirbyID($uyemeta['il']);
				$data = [
					'text' => 'Ödeme Talimatı yapılamadı. Üye Adı: ' . $uyemeta['name'] . ' Telefon: '.$uyemeta['telefon'].' İL: '.$uyeil.' Hata:' . $_POST['failed_reason_msg'],
				];

				// CURL ile POST verilerini gönder
				$curl = curl_init();
				curl_setopt_array($curl, [
					CURLOPT_URL => 'https://otomasyon.apps.ozbilisim.net/webhook/976f809b-bd5a-4341-afec-8a9b7eac109f',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => http_build_query($data),
					CURLOPT_HTTPHEADER => [
						'Content-Type: application/x-www-form-urlencoded'
					],
				]);
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);

				$mesaj = 'Sayın ' . $uyemeta['name'] . '; ÖĞRETMEN SENDİKASI AİDAT ÖDEMENİZ BANKANIZ TARAFINDAN REDDEDİLDİ. RED GEREKÇESİ: ' . $_POST['failed_reason_msg'] . '.  BİLGİLERİNİZE.';


				$uyeTalimat = uyeTalimat($CartMeta['user']);
				$uyeTalimatData = json_decode($uyeTalimat['data'], true);

				$response = $netgsm->send($mesaj, $uyemeta['telefon'], $uyeTalimat['id']);

			}




		}

	} else {
		$db->insert('odemeler')->set([
			                             'user' => 1,
			                             'data' => json_encode($_POST),
			                             'date' => date('Y-m-d H:i:s'),
			                             'tutar' => $_POST['total_amount'] / 100,
			                             'type' => 1,
			                             'referans' => $_POST['merchant_oid'],
			                             'rand' => 0
		                             ]);
	}


    if ($_POST['utoken']) {

	    $db->delete('kisiMeta')
		    ->where('meta', 'utoken')
		    ->where('kisi', $CartMeta['user'])
		    ->done();

	    $db->insert('kisiMeta')
		    ->set([
			          'meta' => 'utoken',
			          'value' => $_POST['utoken'],
			          'kisi' => $CartMeta['user'],
			          'rand' => 0
		          ]);
    }

    echo 'OK';
    exit;

} elseif (strstr($URLPart, $scriptConfig['request_folder'])) {
// API
    $URL = str_replace($scriptConfig['request_folder'] . '/', '', $URL);

    include 'api/' . $URL;


} elseif (strstr($URLPart, 'sifre-sifirla')) {
// API

    include 'sifre-sifirla.php';


} else {


    if (empty($_SESSION['UserID']) or !isset($_SESSION['UserID'])) {


        if (isset($_COOKIE['RMB']) and $_COOKIE['RMB'] != 'false') {
            $CookieToken = $_COOKIE['RMB']; // Çerez kodu.
            $Browser = md5($_SERVER['HTTP_USER_AGENT']); // Tarayıcı bilgisi.
            $time = time(); // Unix zaman.

            $loginCheck = $db->from('remember')
                ->where('token', $CookieToken)
                ->where('browser', $Browser)
                ->where('time', $time, '>')
                ->first();

            if ($loginCheck) {

                $LoginCheck = $db->from('users')
                    ->where('id', $loginCheck['user'])
                    ->first();
                foreach ($LoginCheck as $item) {
                    $_SESSION['UserID'] = $LoginCheck['id'];
                    $_SESSION['UserType'] = $LoginCheck['type'];

                }
                include 'view/index.php';
            } else {

                include 'login.php';
            }
        } else {
            include 'login.php';
        }
    } else {
        include 'view/index.php';
    }
}



