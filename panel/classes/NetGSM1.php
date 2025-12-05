<?php

namespace BrediMedia\NetgsmClass;

/**
 * NETGSM JSON API SMS işlemleri için PHP sınıfı
 *
 * Bu sınıf, NETGSM'in JSON API'sini kullanarak SMS gönderme, sorgulama ve iptal işlemlerini yapar.
 */
class NetGSMv2
{
	/**
	 * @var string API URL'si
	 */
	private $apiUrl = 'https://api.netgsm.com.tr/sms/rest/v2';

	/**
	 * @var string Kullanıcı adı
	 */
	private $username;

	/**
	 * @var string Şifre
	 */
	private $password;

	/**
	 * @var string Mesaj başlığı (gönderici adı)
	 */
	private $msgHeader;

	/**
	 * @var string Karakter kodlaması (TR, UTF, UCS2)
	 */
	private $encoding;

	/**
	 * @var string Partner kodu (opsiyonel)
	 */
	private $partnerCode;

	/**
	 * @var string IYS filtresi (opsiyonel)
	 */
	private $iysFilter;

	/**
	 * @var array Hata kodları ve açıklamaları
	 */
	private $errorCodes = [
		'00' => 'İşlem başarılı',
		'20' => 'Mesaj metni hatalı veya boş',
		'30' => 'Geçersiz kullanıcı adı, şifre veya API erişim izni yok',
		'40' => 'Mesaj başlığı (gönderici adı) sistemde tanımlı değil',
		'50' => 'Teknik hata',
		'60' => 'Arama kriterlerine göre listelenecek kayıt yok',
		'70' => 'Hatalı sorgulama yapıldı',
		'80' => 'Gönderilecek numara hatalı',
		'100' => 'Sistem hatası',
		'101' => 'Mesaj kutusu dolu',
		'102' => 'Kapalı yada kapsama dışında',
		'103' => 'Meşgul',
		'104' => 'Hat aktif değil',
		'105' => 'Hatalı numara',
		'106' => 'SMS red, karaliste',
		'111' => 'Zaman aşımı',
		'112' => 'Mobil cihaz SMS gönderimine kapalı',
		'113' => 'Mobil cihaz desteklemiyor',
		'114' => 'Yönlendirme başarısız',
		'115' => 'Çağrı yasaklandı',
		'116' => 'Tanımlanamayan abone',
		'117' => 'Yasadışı abone',
		'119' => 'Sistemsel hata'
	];

	/**
	 * @var array SMS durum kodları
	 */
	private $statusCodes = [
		'0' => 'İletilmeyi bekleyenler',
		'1' => 'İletilmiş olanlar',
		'2' => 'Zaman aşımına uğramış olanlar',
		'3' => 'Hatalı veya kısıtlı numara',
		'4' => 'Operatöre gönderilemedi',
		'11' => 'Operatör tarafından kabul edilmemiş olanlar',
		'12' => 'Gönderim hatası olanlar',
		'13' => 'Mükerrer olanlar',
		'15' => 'Gönderilen numara kara listede',
		'16' => 'İYS Ret',
		'17' => 'İYS Hatası'
	];

	/**
	 * @var array Operatör kodları
	 */
	private $operatorCodes = [
		'20' => 'Türk Telekom',
		'30' => 'Turkcell',
		'40' => 'Vodafone',
		'41' => 'Vodafone'
	];

	/**
	 * NetGSM sınıfı yapıcı metodu
	 *
	 * @param string $username Kullanıcı adı
	 * @param string $password Şifre
	 * @param string $msgHeader Mesaj başlığı (gönderici adı)
	 * @param string $encoding Karakter kodlaması (TR, UTF, UCS2)
	 * @param string $partnerCode Partner kodu (opsiyonel)
	 * @param string $iysFilter IYS filtresi (opsiyonel)
	 */
	public function __construct(
		string $username,
		string $password,
		string $msgHeader,
		string $encoding = 'TR',
		string $partnerCode = '',
		string $iysFilter = ''
	)
	{
		$this->username = $username;
		$this->password = $password;
		$this->msgHeader = $msgHeader;
		$this->encoding = $encoding;
		$this->partnerCode = $partnerCode;
		$this->iysFilter = $iysFilter;
	}

	/**
	 * Tarih formatını NETGSM'in beklediği formata dönüştürür (ddMMyyyyHHmm)
	 *
	 * @param string|\DateTime $date Dönüştürülecek tarih (string veya DateTime nesnesi)
	 * @return string NETGSM formatında tarih (ddMMyyyyHHmm)
	 * @throws \InvalidArgumentException Geçersiz tarih formatı
	 */
	private function formatDate($date): string
	{
		// Eğer tarih boşsa null döndür
		if (empty($date)) {
			return '';
		}

		// Eğer DateTime nesnesi ise direkt formatla
		if ($date instanceof \DateTime) {
			return $date->format('dmYHi');
		}

		// String ise, formatını tespit et ve dönüştür
		if (is_string($date)) {
			// Zaten doğru formatta ise (ddMMyyyyHHmm)
			if (preg_match('/^\d{12}$/', $date)) {
				return $date;
			}

			// yyyy-MM-dd HH:mm:ss veya yyyy-MM-dd HH:mm formatı
			if (preg_match('/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}(:\d{2})?$/', $date)) {
				$dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $date) ?: \DateTime::createFromFormat('Y-m-d H:i', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// dd.MM.yyyy HH:mm:ss veya dd.MM.yyyy HH:mm formatı
			if (preg_match('/^\d{2}\.\d{2}\.\d{4}\s\d{2}:\d{2}(:\d{2})?$/', $date)) {
				$dateTime = \DateTime::createFromFormat('d.m.Y H:i:s', $date) ?: \DateTime::createFromFormat('d.m.Y H:i', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// dd/MM/yyyy HH:mm:ss veya dd/MM/yyyy HH:mm formatı
			if (preg_match('/^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}(:\d{2})?$/', $date)) {
				$dateTime = \DateTime::createFromFormat('d/m/Y H:i:s', $date) ?: \DateTime::createFromFormat('d/m/Y H:i', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// yyyy/MM/dd HH:mm:ss veya yyyy/MM/dd HH:mm formatı
			if (preg_match('/^\d{4}\/\d{2}\/\d{2}\s\d{2}:\d{2}(:\d{2})?$/', $date)) {
				$dateTime = \DateTime::createFromFormat('Y/m/d H:i:s', $date) ?: \DateTime::createFromFormat('Y/m/d H:i', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// Sadece tarih (yyyy-MM-dd)
			if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
				$dateTime = \DateTime::createFromFormat('Y-m-d', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// Sadece tarih (dd.MM.yyyy)
			if (preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $date)) {
				$dateTime = \DateTime::createFromFormat('d.m.Y', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// Sadece tarih (dd/MM/yyyy)
			if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
				$dateTime = \DateTime::createFromFormat('d/m/Y', $date);
				if ($dateTime) {
					return $dateTime->format('dmYHi');
				}
			}

			// Unix timestamp
			if (is_numeric($date) && (int)$date == $date) {
				$dateTime = new \DateTime('@' . $date);
				return $dateTime->format('dmYHi');
			}
		}

		// Hiçbir format uyuşmadıysa hata fırlat
		throw new \InvalidArgumentException('Geçersiz tarih formatı: ' . $date);
	}

	/**
	 * Tek bir mesaj metnini birden fazla numaraya gönderir (1:N)
	 *
	 * @param string $message Mesaj metni
	 * @param array|string $phones Telefon numaraları (string veya array)
	 * @param mixed $startDate Başlangıç tarihi (opsiyonel, çeşitli formatlarda olabilir)
	 * @param mixed $endDate Bitiş tarihi (opsiyonel, çeşitli formatlarda olabilir)
	 * @return array API yanıtı
	 */
	public function send1toN(string $message, $phones, $startDate = null, $endDate = null): array
	{
		// Telefon numaralarını array'e dönüştür
		if (is_string($phones)) {
			$phoneArray = [$phones];
		} elseif (is_array($phones)) {
			$phoneArray = $phones;
		} else {
			throw new \InvalidArgumentException('Geçersiz telefon numarası formatı');
		}

		$messages = [];

		foreach ($phoneArray as $phone) {
			$messages[] = [
				'msg' => $message,
				'no' => $phone
			];
		}

		$data = [
			'msgheader' => $this->msgHeader,
			'messages' => $messages,
			'encoding' => $this->encoding,
			'iysfilter' => $this->iysFilter,
			'partnercode' => $this->partnerCode
		];

		// İleri tarihli gönderim için tarih ekle
		if ($startDate !== null) {
			$data['startdate'] = $this->formatDate($startDate);
		}

		if ($endDate !== null) {
			$data['stopdate'] = $this->formatDate($endDate);
		}

		return $this->makeRequest('send', $data);
	}

	/**
	 * API isteği gönderme metodu
	 *
	 * @param string $endpoint API endpoint'i
	 * @param array $data İstek verisi
	 * @return array API yanıtı
	 * @throws \Exception Hata durumunda
	 */
	private function makeRequest(string $endpoint, array $data): array
	{
		$url = $this->apiUrl . '/' . $endpoint;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password)
		]);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			throw new \Exception('cURL Hatası: ' . curl_error($ch));
		}

		curl_close($ch);

		$result = json_decode($response, true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new \Exception('JSON çözümleme hatası: ' . json_last_error_msg());
		}

		return $result;
	}

	/**
	 * SMS sorgulama metodu
	 *
	 * @param array $options Sorgulama seçenekleri
	 *                      - jobid: İş ID'si (string)
	 *                      - type: Sorgulama tipi (string, 0: JobID ile, 1: Tarih aralığı ile)
	 *                      - bulkid: Toplu gönderim ID'si (string, opsiyonel)
	 *                      - status: Mesaj durumu (string, opsiyonel)
	 *                      - startdate: Başlangıç tarihi (string, format: dd.MM.yyyy HH:mm:ss, type=1 için gerekli)
	 *                      - stopdate: Bitiş tarihi (string, format: dd.MM.yyyy HH:mm:ss, type=1 için gerekli)
	 *                      - pagesize: Sayfa başına kayıt sayısı (int, opsiyonel)
	 *                      - pagenumber: Sayfa numarası (int, opsiyonel)
	 * @return array API yanıtı
	 */
	public function querySMS(array $options): array
	{
		$data = [];

		// JobID ile sorgulama
		if (isset($options['jobid'])) {
			$data['jobid'] = $options['jobid'];
		}

		// JobIDs ile sorgulama (çoklu)
		if (isset($options['jobids']) && is_array($options['jobids'])) {
			$data['jobids'] = $options['jobids'];
		}

		// Sorgulama tipi
		if (isset($options['type'])) {
			$data['type'] = $options['type'];
		}

		// Toplu gönderim ID'si
		if (isset($options['bulkid'])) {
			$data['bulkid'] = $options['bulkid'];
		}

		// Mesaj durumu
		if (isset($options['status'])) {
			$data['status'] = $options['status'];
		}

		// Tarih aralığı ile sorgulama
		if (isset($options['startdate'])) {
			$data['startdate'] = $options['startdate'];
		}

		if (isset($options['stopdate'])) {
			$data['stopdate'] = $options['stopdate'];
		}

		// Sayfalama
		if (isset($options['pagesize'])) {
			$data['pagesize'] = $options['pagesize'];
		}

		if (isset($options['pagenumber'])) {
			$data['pagenumber'] = $options['pagenumber'];
		}

		// Uygulama adı
		if (isset($options['appname'])) {
			$data['appname'] = $options['appname'];
		}

		return $this->makeRequest('report', $data);
	}

	/**
	 * Hata kodu açıklamasını döndürür
	 *
	 * @param string $code Hata kodu
	 * @return string Hata açıklaması
	 */
	public function getErrorDescription(string $code): string
	{
		return $this->errorCodes[$code] ?? 'Bilinmeyen hata kodu';
	}

	/**
	 * SMS durum kodu açıklamasını döndürür
	 *
	 * @param string $code Durum kodu
	 * @return string Durum açıklaması
	 */
	public function getStatusDescription(string $code): string
	{
		return $this->statusCodes[$code] ?? 'Bilinmeyen durum kodu';
	}

	/**
	 * Operatör kodu açıklamasını döndürür
	 *
	 * @param string $code Operatör kodu
	 * @return string Operatör adı
	 */
	public function getOperatorName(string $code): string
	{
		return $this->operatorCodes[$code] ?? 'Bilinmeyen operatör';
	}
}
