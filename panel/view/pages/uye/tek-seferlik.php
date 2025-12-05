<?php

$talimat = uyeTalimat($_SESSION['UserID']);

if ($talimat) {

    $talimatData = json_decode($talimat['data'], true);
}


?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">ÜYE BİLGİLERİ</h4>


                </div>
            </div>

        </div>
        <!-- start page title -->
        <div class="row">

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr>
                                    <th class="ps-0" scope="row">Üye Adı :</th>
                                    <td class="text-muted"><?= uyeMeta($_SESSION['UserID'])['name'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">TC :</th>
                                    <td class="text-muted"><?= uyeMeta($_SESSION['UserID'])['tc'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Telefon :</th>
                                    <td class="text-muted"><?= uyeMeta($_SESSION['UserID'])['telefon'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Üyelik Tarihi :</th>
                                    <td class="text-muted"><?= date('d.m.Y H:i:s', strtotime(uyeMeta($_SESSION['UserID'])['uyelikTarihi'])) ?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr>
                                    <th class="ps-0" scope="row">Ödenen Aidat :</th>
                                    <td class="text-muted"><?= uyeToplamOdeme($_SESSION['UserID']) ?> TL</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Bekleyen Aidat :</th>
                                    <td class="text-muted"><?= uyeToplamOdemeBekleyen($_SESSION['UserID']) ?> TL</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5>KREDİ KARTI İLE AİDAT ÖDE</h5>
                        <?php
/*
                        $merchant_id = $scriptConfig['merchant_id'];
                        $merchant_key = $scriptConfig['merchant_key'];
                        $merchant_salt = $scriptConfig['merchant_salt'];

                        $merchant_ok_url = $scriptConfig['merchant_ok_url'];
                        $merchant_fail_url = $scriptConfig['merchant_fail_url'];*/

                        echo createForm(
                            [
                                'id' => 'serialize',
                                'buttonText' => 'Kartla Ödeme İçin Devam et',
                                'btnclass' => 'btn-primary',
                                'elements' => [
                                    [
                                        'type' => 'text',
                                        'label' => 'Ödeme Tutarı (TL)',
                                        'name' => 'tutar',
                                        'id' => 'tutar',
                                        'value' =>  uyeToplamOdemeBekleyen($_SESSION['UserID']),
                                        'collabel' => 8,
                                        'colinput' => 4,
                                    ],
                                    [
                                        'type' => 'hidden',
                                        'value' => 'odeme/sepet',
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
            </div>

        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
