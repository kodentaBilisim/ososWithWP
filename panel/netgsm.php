<?php

include "classes/NetGSM1.php";

use BrediMedia\NetgsmClass\NetGSMv2;

// NetGSM sınıfını başlat
$netgsm = new NetGSMv2(
	'08503026774',     // NETGSM API kullanıcı adı
	'AD8$8AE',             // NETGSM API şifresi
	'OZANCIRIK',     // Mesaj başlığı (gönderici adı)
	'TR',                // Karakter kodlaması (TR, UTF, UCS2)
	'',                  // Partner kodu (opsiyonel)
	''                   // IYS filtresi (opsiyonel)
);

$messages = [
	[
		'msg' => 'Test mesajı',
		'no' => '5050566774'
	]
];


try {
	// SMS gönder
	$response = $netgsm->send1toN('Test mesajı','5050566774');

	// Yanıtı kontrol et
	if (isset($response['code']) && $response['code'] == '00') {
		echo "SMS başarıyla gönderildi. JobID: " . $response['jobid'];
	} else {
		echo "SMS gönderimi başarısız. Hata: " . $netgsm->getErrorDescription($response['code']);
	}
} catch (Exception $e) {
	echo "Hata: " . $e->getMessage();
}