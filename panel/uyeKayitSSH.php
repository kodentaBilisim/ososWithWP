<?php
//$debug = true;
require_once '/var/www/html/panel/env.php';
require_once '/var/www/html/panel/functions.php';


$kayitlar = $db->from('import')->where('status', 0)->where('type', 'kayit')->first();

$istatistik = [];

if (!is_array($kayitlar)) {
    echo 'KAYIT YOK';
    die();


}


$uyeler = json_decode( file_get_contents( $kayitlar['file'] ), true );
$i      = 0;

$rand = time();

function ifEmptyZero( $data ) {
	if ( empty( $data ) ) {
		return 0;
	} else {
		return $data;
	}
}

foreach ( $uyeler as $v ) {


    if ($i == 0) {
        $i++;
        continue;
    } else {
        $i++;
    }

    $excelToKeys = [
        'A' => 'siraNo',
        'B' => 'tc',
        'C' => 'name',
        'D' => 'cinsiyet',
        'E' => 'uyelikTarihi',
        'F' => 'dogrulamaKodu',
        'G' => 'YKKararNo',
        'H' => 'telefon',
        'I' => 'ePosta',
        'J' => 'SGK',
        'K' => 'firma',
    ];

    foreach ($v as $key => $value) {
        unset($v[$key]);
        $v[$excelToKeys[$key]] = $value;
    }


    if ( ! $v['tc'] ) {
		continue;
	}


	if ( empty( $v['SGK'] ) or ! isset( $v['SGK'] ) ) {
		$SGK   = [ 1, false ];
		$il[5] = 0;
	} else {

		$firmaID = firmaIDbyName( $v['firma'] );
		$SGK     = sgkIDbyName( $v['SGK'], $v['firma'] );
		$il      = explode( '.', $v['SGK'] );
		if (substr($il[5],0,1) == 0){
			$il[5] = substr($il[5],1,3);
		}

		if (substr($il[5],0,1) == 0){
			$il[5] = substr($il[5],1,2);
		}



	}


	$userCheck = $db->from( 'kisiler' )->where( 'tc', $v['tc'] )->first();




	if ( !is_int($v['siraNo']) OR is_int($v['siraNo']) < 1 ) {


        $userCheck2 = $db->from('kisiler')->where('tc', $v['tc'])->where('SGK', $SGK[0])->cnt();


        if ($userCheck2 > 0) {
            echo pageReturn(array(
                                'data' => 'MEVCUT ÜYE1'
                            ));

            $db->update('kisiler')->where('id', $userCheck['id'])->set([
                                                                           'rand' => $rand
                                                                       ]);
        } else {
            $db->insert('kisiler')->set([
                                            'name' => ifEmptyZero($v['name']),
                                            'tc' => ifEmptyZero($v['tc']),
                                            'cinsiyet' => ifEmptyZero($v['cinsiyet']),
                                            'siraNo' => ifEmptyZero($v['siraNo']),
                                            'uyelikTarihi' => date(
                                                'Y-m-d', strtotime(
                                                           str_replace('/', '.', $v['uyelikTarihi'])
                                                       )
                                            ),
                                            'dogrulamaKodu' => ifEmptyZero($v['dogrulamaKodu']),
                                            'YKKararNo' => ifEmptyZero($v['YKKararNo']),
                                            'telefon' => ifEmptyZero($v['telefon']),
                                            'durum' => 1,
                                            'rand' => $rand,
                                            'createDateTime' => date('Y-m-d H:i:s', $rand),
                                            'istifaTarihi' => NULL,
                                            'cikisTarihi' => NULL,
                                            'gorev' => 50,
                                            'SGK' => $SGK[0],
                                            'il' => $il[5],
                                            'ek' => 1,
                                            'sube' => 1,
                                            'temsilci' => 0,
                                            'updateTime' => time(),
                                        ]);

            echo pageReturn(array(
                                'data' => 'MEVCUT ÜYE. YENİ SGK EKLENDİ'
                            ));

        }


	} else {
		if ( ! $userCheck ) {

            $db->insert('kisiler')->set([
                                            'name' => ifEmptyZero($v['name']),
                                            'tc' => ifEmptyZero($v['tc']),
                                            'cinsiyet' => ifEmptyZero($v['cinsiyet']),
                                            'siraNo' => ifEmptyZero($v['siraNo']),
                                            'uyelikTarihi' => date(
                                                'Y-m-d H:i:s', strtotime(
                                                                 str_replace('/', '.', $v['uyelikTarihi'])
                                                             )
                                            ),
                                            'dogrulamaKodu' => ifEmptyZero($v['dogrulamaKodu']),
                                            'YKKararNo' => ifEmptyZero($v['YKKararNo']),
                                            'telefon' => ifEmptyZero($v['telefon']),
                                            'durum' => 1,
                                            'rand' => $rand,
                                            'ePosta' => $v['ePosta'],
                                            'createDateTime' => date('Y-m-d H:i:s', $rand),
                                            'istifaTarihi' => NULL,
                                            'cikisTarihi' => NULL,
                                            'gorev' => 50,
                                            'SGK' => $SGK[0],
                                            'il' => $il[5],
                                            'ek' => 0,
                                            'sube' => 1,
                                            'temsilci' => 0,
                                            'updateTime' => time(),
                                            'fiili' => 0,
                                        ]);


            $kisiID = $db->lastInsertId();

            echo pageReturn(array(
                                'data' => 'YENİ EKLENDİ',
                                'tc' => $v['tc']
                            ));

        } elseif ($userCheck and $userCheck['durum'] == 1) {
            echo pageReturn(array(
                                'data' => 'MEVCUT ÜYE'
                            ));

            $db->update('kisiler')->where('id', $userCheck['id'])->set([
                                                                           'rand' => $rand,
                                                                           'uyelikTarihi' => date(
                                                                               'Y-m-d', strtotime(
                                                                                          str_replace(
                                                                                              '/', '.',
                                                                                              $v['uyelikTarihi']
                                                                                          )
                                                                                      )
                                                                           ), 'SGK' => $SGK[0],
                                                                       ]);
        } elseif ($userCheck and $userCheck['durum'] == 0) {
            $db->update('kisiler')->where('id', $userCheck['id'])->set([
                                                                           'durum' => 1,
                                                                           'istifaTarihi' => NULL,
                                                                           'cikisTarihi' => NULL,
                                                                       ]);
            $db->insert('kisiMeta')->set([
                                             'kisi' => $userCheck['id'],
                                             'value' => date('Y-m-d H:i:s', strtotime($v['uyelikTarihi'])),
                                             'meta' => 'uyelik',
                                             'rand' => $rand
                                         ]);

            echo pageReturn(array(
                                'data' => 'İSTİFADAN ÜYEYE GEÇTİ',
                                'tc' => $v['tc']
                            ));
        }

    }


}


$newData = json_decode($kayitlar['data'], true);

$newData['rand'] = $rand;


$olmayanuyeler = $db->from('kisiler')->
where('rand', $rand, '!=')->
where('fiili', 0)->all();


foreach ($olmayanuyeler as $item) {

    $db->update('kisiler')
        ->where('id', $item['id'])
        ->set([
                  'durum' => 0,
                  'cikisTarihi' => date('Y-m-d H:i:s')
              ]);


    $db->update('talimat')
        ->where('user', $item['id'])
        ->set([
                  'status' => 0
              ]);

}

$SGK = $db->from('sgk')->all();


foreach ($SGK as $item) {


    $SayıSGKKisi = $db->from('kisiler')->where('SGK', $item['id'])->cnt();

    $db->update('sgk')->where('id', $item['id'])->set([
                                                          'uye' => $SayıSGKKisi
                                                      ]);


}

$İl = $db->from( 'il' )->all();


foreach ( $İl as $item ) {

	$ilkodu = $item['id'];

	if ( strlen( $ilkodu ) == 1 ) {
		$ilkodu = '00' . $ilkodu;
	} elseif ( strlen( $ilkodu ) == 2 ) {
		$ilkodu = '0' . $ilkodu;
	}


	$SayıİlKisi = $db->from( 'kisiler' )->where( 'il', $ilkodu )->cnt();

	$db->update( 'il' )->where( 'id', $item['id'] )->set( [
		'uye' => $SayıİlKisi
	] );


}

$db->update( 'import' )->where( 'id', $kayitlar['id'] )->set( [
    'status' => 1,
    'data'   => json_encode( $newData )
] );
