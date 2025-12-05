<?php
require_once '/var/www/html/panel/env.php';
require_once '/var/www/html/panel/functions.php';

$kayitlar = $db->from('import')->where('type', 'hesap')->where('status', 0)->first();
if ( ! is_array( $kayitlar ) ) {
	echo 'KAYIT YOK';
	die();


}

$uyeler = json_decode( file_get_contents( $kayitlar['file'] ), true );
$i      = 0;

$rand = time();

$newData = json_decode( $kayitlar['data'], true );

$newData['rand'] = $rand;
$db->update( 'import' )->where( 'id', $kayitlar['id'] )->set( [
    'status' => 2,
    'data'   => json_encode( $newData )
] );



function ifEmptyZero( $data ) {
	if ( empty( $data ) ) {
		return 0;
	} else {
		return $data;
	}
}
$matchcount = 0;
$itemcount = 0;
foreach ( $uyeler as $v ) {



	if ( $i == 0 ) {
		$i ++;
        echo 'i 0';
		continue;
	}
    if($v['D'] < 50 OR $v['D'] > 2000){
        continue;
    }

    $itemcount++;
    $eslesme = 0;
	foreach (explode( '*', $v['I'] ) as $item){




        if (stripos($item, "paytr") !== false) {
           continue;
        }



		echo $item.'||';


		if(strlen($item) > 4 AND !empty($item)){
			$match = $db->from('kisiler')->like('name',$item)->all();
		}else{
            echo 'item boş ya da 4ten küçük';
			continue;
		}

		if(count($match) > 0){
			$matchcount++;
			var_dump($match);

           $odemeCheck = $db->from('odemeler')->where('referans',$v['O'])->all();

           if(count($odemeCheck) < 1){




               $dateObj = DateTime::createFromFormat('d/m/Y-H:i:s', $v['A']);
               $date = $dateObj ? $dateObj->format('Y-m-d H:i:s') : null; // Eğer hata olursa NULL döner

               $tutar = floatval(str_replace(',', '.', str_replace(',00', '', $v['D'])));

               $db->insert('odemeler')
                   ->set([
                             'date' => $date, // DateTime nesnesini string'e çevirdik
                             'referans' => $v['O'],
                             'tutar' => $tutar,
                             'type' => 2,
                             'data' => json_encode($v),
                             'user' => $match[0]['id'],
                             'rand' => $rand
                         ]);


           }

            $eslesme = 1;
            break;
        }


    }

    if (is_array($odemeCheck)):
        if ($eslesme == 0 and count($odemeCheck) < 1    ){
            $dateObj = DateTime::createFromFormat('d/m/Y-H:i:s', $v['A']);
            $date = $dateObj ? $dateObj->format('Y-m-d H:i:s') : null; // Eğer hata olursa NULL döner

            $tutar = floatval(str_replace(',', '.', str_replace(',00', '', $v['D'])));

            $db->insert('odemeler')
                ->set([
                          'date' => $date, // DateTime nesnesini string'e çevirdik
                          'referans' => $v['O'],
                          'tutar' => $tutar,
                          'type' => 2,
                          'data' => json_encode($v),
                          'user' => 0,
                          'rand' => $rand
                      ]);
        }
    endif;


	echo " \n-------------------------------- \n";
}
echo " \n-------------İTEM: ".$itemcount."------------------- \n";
echo " \n---------------MATCH İTEM:".$matchcount."----------------- \n";
$db->update( 'import' )->where( 'id', $kayitlar['id'] )->set( [
    'status' => 1,
    'data'   => json_encode( $newData )
] );