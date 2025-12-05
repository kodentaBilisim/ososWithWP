<?php

$menu = array(
	'admin' => array(
		array(
			'name'     => 'Anasayfa',
			'icon'     => '<i class="las la-home"></i>',
			'dropdown' => false,
			'URL'      => '/panel'
		),
		[
			'name' => 'EXCEL',
			'icon' =>  '<i class="las la-upload"></i>',
			'dropdown' =>  true,
			'SUB' => [
                [
                    'name' => 'ÜYELER',
                    'URL' => '?page=uye/kayit',
                    'dropdown' => false
                ],
                [
                    'name' => 'İSTİFALAR',
                    'URL' => '?page=uye/istifa',
                    'dropdown' => false
                ],
                [
                    'name' => 'HESAP DÖKÜMÜ',
                    'URL' => '?page=uye/hesap',
                    'dropdown' => false
                ],
                [
                    'name' => 'YÜKLEMELER',
                    'URL' => '?page=uye/islem',
                    'dropdown' => false
                ]
            ]
        ],
        array(
            'name' => 'Kurumlar',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => false,
            'URL' => '?page=firma/list'
        ),
        array(
            'name' => 'İller',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => false,
            'URL' => '?page=iller/list'
        ),
		array(
            'name' => 'Üye Ara',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => false,
            'URL' => '?page=uye/bul'
        ),
        array(
            'name' => 'Ödeme Bilgileri',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => true,
            'SUB' => [
                [
                    'name' => 'Otomatik Talimat Verenler',
                    'URL' => '?page=odeme/otomatik',
                    'dropdown' => false
                ],
                [
                    'name' => 'İllere Göre Aidat Tutarı',
                    'URL' => '?page=odeme/il-total',
                    'dropdown' => false
                ],
                [
                    'name' => 'Bugün Yapılan İşlemler',
                    'URL' => '?page=odeme/bugun',
                    'dropdown' => false
                ],
                [
                    'name' => 'Bu ay Yapılan İşlemler',
                    'URL' => '?page=odeme/buay',
                    'dropdown' => false
                ],
                [
                    'name' => 'Aylık Rapor',
                    'URL' => '?page=odeme/rapor',
                    'dropdown' => false
                ],
                [
                    'name' => 'Toplam Rapor (Kişi)',
                    'URL' => '?page=odeme/rapor_total',
                    'dropdown' => false
                ]
            ]
        ),
        array(
            'name' => 'SMS GÖNDER',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => true,
            'SUB' => [
                [
                    'name' => 'Kurumlara Göre',
                    'URL' => '?page=sms/firmalar',
                    'dropdown' => false
                ],
                [
                    'name' => 'İllere Göre',
                    'URL' => '?page=sms/subeler',
                    'dropdown' => false
                ]
            ]
        ),
    ),
    'user' => array(
        array(
            'name' => 'Anasayfa',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => false,
            'URL' => '?page=/'
        ),
        array(
            'name' => 'Kurumlar',
            'icon' => '<i class="las la-home"></i>',
			'dropdown' => false,
			'URL'      => '?page=firma/list'
		),
		array(
			'name'     => 'İller',
			'icon'     => '<i class="las la-home"></i>',
			'dropdown' => false,
			'URL'      => '?page=iller/list'
		),
        array(
            'name' => 'Ödeme Bilgileri',
            'icon' => '<i class="las la-home"></i>',
            'dropdown' => true,
            'SUB' => [
                [
                    'name' => 'Otomatik Talimat Verenler',
                    'URL' => '?page=odeme/otomatik',
                    'dropdown' => false
                ],
                [
                    'name' => 'İllere Göre Aidat Tutarı',
                    'URL' => '?page=odeme/il-total',
                    'dropdown' => false
                ],
                [
                    'name' => 'Bugün Yapılan İşlemler',
                    'URL' => '?page=odeme/bugun',
                    'dropdown' => false
                ],
                [
                    'name' => 'Bu ay Yapılan İşlemler',
                    'URL' => '?page=odeme/buay',
                    'dropdown' => false
                ]
            ]
        ),
		array(
			'name'     => 'Yüklemeler',
			'icon'     => '<i class="las la-home"></i>',
			'dropdown' => false,
			'URL'      => '?page=uye/islem'
		),
	),
    'uye' => array(
        array(
            'name'     => 'Anasayfa',
            'icon'     => '<i class="las la-home"></i>',
            'dropdown' => false,
            'URL' => '/panel'
        ),

    )
);

