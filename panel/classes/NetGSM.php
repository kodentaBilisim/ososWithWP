<?php

class netGSM {

	public $header;
	public $footer;
	public $username;
	public $title;
	public $password;
	public $url;

	public function __construct( $username, $password, $title) {

		$this->title = $title;
		$this->username = $username;
		$this->password = $password;

		$this->header = '<?xml version="1.0" encoding="UTF-8"?>
 <mainbody>
 <header>
 <company dil="TR">Netgsm</company>        
 <usercode>' . $username . '</usercode>
 <password>' . $password . '</password>
 <type>1:n</type>
 <msgheader>'.$this->title.'</msgheader>';

		$this->footer = '</mainbody>';



	}

	public function send( $mesaj, $telefonlar, $kampanyaID, $date = null ) {



		$body = '';
		if ( $date != null ) {
			$date = date( 'dmYHi', strtotime( $date ) );
			$body .= '<startdate>' . $date . '</startdate>';
		}

		$body .= '</header>';
		$body .= '<body>';
		$body .= '<msg>';
		$body .= '<![CDATA[' . $this->mesajFormat($mesaj) . ']]>';
		$body .= '</msg>';
		foreach ( stringToArray($telefonlar) as $telefon ) {
			$body .= '<no>' . $telefon . '</no>';
		}
		$body .= '</body>';


		$xmlBody = $this->header . $body . $this->footer;


		$response = $this->xmlPost( 'https://api.netgsm.com.tr/sms/send/xml', $xmlBody );

		$response = explode( ' ', $response );

		if ( $response[0] == 00 ) {
			return [ 'basari' => $response[1] ];
		} elseif ( $response[0] == 20 ) {
			return [ 'hata' => 20, 'mesaj' => 'Mesaj metni hatalı. Kontrol Ediniz' ];
		} elseif ( $response[0] == 80 ) {
			return [ 'hata' => 80, 'mesaj' => 'Gönderim sınır aşımı' ];
		} else {
			return [ 'hata' => $response[0], 'mesaj' => 'API sorunu. Teknik desteğe danışınız' ];
		}
	}

	public function xmlPost( $PostAddress, $xmlData ) {

		//return '00 123456';

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $PostAddress );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Content-Type: text/xml" ) );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $xmlData );
		$result = curl_exec( $ch );

		return $result;
	}

	public function smsRapor( $ID ) {

		return $this->smsRaporGet( $ID );
	}

	public function smsRaporGet( $ID ) {

		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'POST',
			CURLOPT_POSTFIELDS     => '<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:raporV3 xmlns:ns3="http://sms/">
            <username>' . $this->username . '</username>
            <password>' . $this->password . '</password>
            <bulkid>' . $ID . '</bulkid>
            <status>100</status>
            <detail>1</detail>
        </ns3:raporV3>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>',
			CURLOPT_HTTPHEADER     => array(
				'Content-Type: text/xml'
			),
		) );

		$response = curl_exec( $curl );

		curl_close( $curl );

		return $response;
	}

	public function mesajFormat($mesaj){


		$mesaj = nl2br( $mesaj, false );

		return str_replace('<br>','\n',$mesaj);


	}


}
