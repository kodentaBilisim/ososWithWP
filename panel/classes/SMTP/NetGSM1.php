<?php

namespace BrediMedia\NetgsmClass;

/**
 * NETGSM JSON API SMS işlemleri için PHP sınıfı
 * 
 * Bu sınıf, NETGSM'in JSON API'sini kullanarak SMS gönderme, sorgulama ve iptal işlemlerini yapar.
 */
class NetGSM
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
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->msgHeader = $msgHeader;
        $this->encoding = $encoding;
        $this->partnerCode = $partnerCode;
        $this->iysFilter = $iysFilter;
    }

    /**
     * SMS gönderme metodu
     * 
     * @param array $messages Mesaj ve numara bilgilerini içeren dizi
     * @param string|null $startDate Başlangıç tarihi (opsiyonel, format: yyyyMMddHHmm)
     * @param string|null $endDate Bitiş tarihi (opsiyonel, format: yyyyMMddHHmm)
     * @return array API yanıtı
     */
    public function sendSMS(array $messages, ?string $startDate = null, ?string $endDate = null): array
    {
        $data = [
            'msgheader' => $this->msgHeader,
            'messages' => $messages,
            'encoding' => $this->encoding,
            'iysfilter' => $this->iysFilter,
            'partnercode' => $this->partnerCode
        ];

        // İleri tarihli gönderim için tarih ekle
        if ($startDate !== null) {
            $data['startdate'] = $startDate;
        }

        if ($endDate !== null) {
            $data['stopdate'] = $endDate;
        }

        return $this->makeRequest('send', $data);
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
