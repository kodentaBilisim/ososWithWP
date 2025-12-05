<?php

$smsConfirmCode = rand(100000, 999999);

$uyeMeta = uyeMeta($_SESSION['UserID']);
$uyeTalimat = uyeTalimat($_SESSION['UserID']);
$uyeTalimatData = json_decode($uyeTalimat['data'], true);
$db->delete('kisiMeta')
    ->where('kisi', $_SESSION['UserID'])
    ->where('meta', 'smsConfirm')
    ->done();
$db->insert('kisiMeta')
    ->set([
        'meta' => 'smsConfirm',
        'kisi' => $_SESSION['UserID'],
        'rand' => 0,
        'value' => json_encode([
            'smsCode' => $smsConfirmCode,
            'senddate' => time()
        ])
    ]);

$mesaj = 'Sayın ' . $uyeMeta['name'] . '; ÖĞRETMEN SENDİKASI AİDAT SİSTEMİ üzerinden her ayın ' . $uyeTalimatData['day'] . '. gününde, kayıtlı kredi kartınızdan ' . $uyeTalimatData['amount'] . 'TL tutarında aidat ödemesi çekim talimatınız için güvenlik kodunuz: ' . $smsConfirmCode;


$response = $netgsm->send($mesaj, $uyeMeta['telefon'], $uyeTalimat['id']);

?>


<div class="card">
    <div class="card-body">


        <div class="alert alert-success mb-2" role="alert">
            <p>Sistemlerimizde kayıtlı <span class="blurred"><?=$uyeMeta['telefon']?></span> numaralı telefonunuza giden 6 haneli güvenlik kodunu giriniz!</p>
        </div>

        <?php



        echo createForm(
            [
                'id' => 'serialize',
                'buttonText' => 'GÖNDER',
                'btnclass' => 'btn-primary',
                'elements' => [
                    [
                        'type' => 'text',
                        'label' => 'GÜVENLİK KODU',
                        'name' => 'smsConfirmCode',
                        'id' => 'smsConfirmCode',
                        'collabel' => 8,
                        'colinput' => 4,
                        'class' => 'blurred'
                    ],
                    [
                        'type' => 'hidden',
                        'value' => 'stepbystep/smsConfirm',
                        'name' => 'postUrl',
                        'id' => 'postUrl',
                    ],
                    [
                        'type' => 'hidden',
                        'value' => $_SESSION['UserID'],
                        'name' => 'uyeID',
                        'id' => 'uyeID',
                    ]
                ]
            ]
        );


        ?>
    </div>
</div>