<div class="card">
    <div class="card-body">
        <h5>OTOMATİK ÖDEME</h5>

        <?php

        echo createForm(
            [
                'id' => 'serialize',
                'buttonText' => 'Kaydet',
                'btnclass' => 'btn-primary',
                'elements' => [
                    [
                        'type' => 'text',
                        'label' => 'Aylık Otomatik Çekilmesini İstediğiniz Tutar (TL)',
                        'name' => 'amount',
                        'id' => 'amount',
                        'collabel' => 8,
                        'colinput' => 4,
                    ],
                    [
                        'type' => 'select',
                        'label' => 'Aidatın Çekilmesini İstediğiniz Gün',
                        'name' => 'day',
                        'id' => 'day',
                        'collabel' => 8,
                        'colinput' => 4,
                        'option' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
                    ],
                    [
                        'type' => 'hidden',
                        'value' => 'stepbystep/aidat-bilgileri',
                        'name' => 'postUrl',
                        'id' => 'postUrl',
                    ],
                    [
                        'type' => 'hidden',
                        'value' => 1,
                        'name' => 'autoPayment',
                        'id' => 'autoPayment',
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
        <div class="alert alert-warning mt-2" role="alert">
            <p>İLK ÖDEMENİZ BUGÜN YAPILACAKTIR. TALİMATINIZ ÖNÜMÜZDEKİ AYDAN İTİBAREN İŞLEME KONULACAKTIR</p>
        </div>
    </div>
</div>
