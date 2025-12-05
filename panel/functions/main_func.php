<?php


function pageReturn( $returnPage = array() ) {


	if ( $returnPage['operation'] != 'none' ) {
		//removeFormTokenSession( $returnPage['data']['token'] );
	}

	if(!isset($returnPage['popup'])){
		$returnPage['popup'] = true;
	}

	return json_encode( $returnPage );
}

function make_seed() {
	list( $usec, $sec ) = explode( ' ', microtime() );

	return $sec + $usec * 1000000;
}

function uploadFile( $uploadFILE, $fileName = null ) {

	srand( make_seed() );
	$code          = rand();
	$dosyaUzantisi = pathinfo( $uploadFILE['name'], PATHINFO_EXTENSION );
	if ( ! isset( $fileName ) ) {
		$file = $code . '.' . $dosyaUzantisi;
	} elseif ( 'same' ) {
		$file = seoLink( str_replace( $dosyaUzantisi, '', $uploadFILE['name'] ) ) . '.' . $dosyaUzantisi;
	} else {
		$file = seoLink( $fileName ) . '.' . $dosyaUzantisi;
	}

	$target_dir = server_root_dir() . 'uploads/';

	$target_file = $target_dir . basename( $file );

	if ( move_uploaded_file( $uploadFILE["tmp_name"], $target_file ) ) {
		chmod( $target_file, 0777 );

		return array( 'fileurl' => 'uploads/' . $file, 'fileName' => $file, 'type' => $dosyaUzantisi );
	} else {
		return array( 'operation'   => 'none',
		              'hata'        => 'Dosya Yüklenemedi!',
		              'data'        => $target_file,
		              'hatadetails' => $uploadFILE['error']
		);
	}


}



function seoLink( $s ) {


	$tr  = array( 'ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '(', ')', '/', ' ', ',', '?' );
	$eng = array( 's', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '', '', '-', '-', '', '' );
	$s   = str_replace( $tr, $eng, $s );
	$s   = strtolower( $s );
	$s   = preg_replace( '/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s );
	$s   = preg_replace( '/\s+/', '-', $s );
	$s   = preg_replace( '|-+|', '-', $s );
	$s   = preg_replace( '/#/', '', $s );
	$s   = str_replace( '.', '', $s );
	$s   = trim( $s, '-' );

	return $s;
}


function stringToArray( $string ) {

	if (empty($string)){
		return array();
	}else{
		if ( is_array( $string ) ) {
			return $string;
		} else {
			return array( $string );
		}
	}




}


function tersTirnak($str){
	return str_replace('"','\"',$str);
}

function rememberMe($user):void{
	global $db;

	$login_token = bin2hex(openssl_random_pseudo_bytes(32));

	$db->delete('remember')
		->where('user',$user)
		->where('browser',md5($_SERVER['HTTP_USER_AGENT']))
		->done();

	$db->insert('remember')
	   ->set([
		   'user' => $user,
		   'token' => $login_token,
		   'time' => time()+604800,
		   'browser' => md5($_SERVER['HTTP_USER_AGENT'])
	   ]);
	setcookie("RMB", $login_token, time() + 604801,'/');
}

function qrCode($s, $w = 250, $h = 250){
	$u = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s';
	$url = sprintf($u, $w, $h, $s);
	return $url;
}

function fileMeta( $fileID, $single = null ) {
	global $db;

	$file = $db->from( 'files' )->where( 'id', $fileID )->first();

	if ( $single == null ) {
		return $file;
	} elseif ( isset( $file[ $single ] ) ) {
		return $file[ $single ];
	} else {
		return false;
	}

}

function DB(){

	global $db;

	return $db;

}

function APIRequest($url, $data = null, $arraydata = null)
{

	$data_string = json_encode($data);
	global $header;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, []);

	$result = curl_exec($ch);

	return $result;

}


function userIP(){
    if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

   return $ip;
}

function turkcetarih_formati($format, $datetime = 'now'){
    $z = date("$format", $datetime);
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}


function ayAdiGetir($ayNumarasi)
{
    $aylar = [
        1 => "Ocak",
        2 => "Şubat",
        3 => "Mart",
        4 => "Nisan",
        5 => "Mayıs",
        6 => "Haziran",
        7 => "Temmuz",
        8 => "Ağustos",
        9 => "Eylül",
        10 => "Ekim",
        11 => "Kasım",
        12 => "Aralık"
    ];

    return $aylar[$ayNumarasi] ?? "Geçersiz Ay Numarası";
}
