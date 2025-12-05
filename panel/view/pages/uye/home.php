<?php

$talimat = $db->from('talimat')
    ->where('user', $_SESSION['UserID'])
    ->first();

$talimatData = json_decode($talimat['data'], true);

$uyeMeta = uyeMeta($_SESSION['UserID']); ?>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Otomatik Tahsilat Durumu: <?= ($talimat['status']) ? 'Açık' : 'Kapalı' ?></h5>
                        <?php if (!$talimat['status']) { ?>
                            <a href="?page=step-by-step&step=information" class="btn btn-success">OTOMATİK ÖDEME TALİMATI VER</a>
                        <?php } else { ?>

                            <div class="alert alert-success" role="alert">
                                <?= date('d.m.Y H:i:s', $talimatData['date']) ?> tarih ve
                                saatinde <?= $talimatData['amount'] ?> TL tutarında aidatınızın
                                ayın <?= $talimat['gun'] ?>. günde kartınızdan otomatik olarak tahsil edilmesini
                                istediğinizi bildirdiniz.
                            </div>
                            <a href="?page=odeme-yap" class="btn btn-success">OTOMATİK ÖDEME TALİMATINI GÜNCELLE</a>
                        <?php } ?>
                    </div>
                </div>

            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr>
                                    <th class="ps-0" scope="row">Üye Adı :</th>
                                    <td class="text-muted"><?= $uyeMeta['name'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">TC :</th>
                                    <td class="text-muted blurred"><?= $uyeMeta['tc'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Telefon :</th>
                                    <td class="text-muted blurred"><?= $uyeMeta['telefon'] ?></td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Üyelik Tarihi :</th>
                                    <td class="text-muted blurred"><?= date('d.m.Y H:i:s', strtotime($uyeMeta['uyelikTarihi'])) ?></td>
                                </tr>
                                <?php if ($uyeMeta['adresEx']): ?>
                                    <tr>
                                        <th class="ps-0" scope="row">Adres :</th>
                                        <td class="text-muted blurred"><?= $uyeMeta['adresEx'] ?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if ($uyeMeta['ePosta']): ?>
                                    <tr>
                                        <th class="ps-0" scope="row">E-Posta :</th>
                                        <td class="text-muted blurred"><?= $uyeMeta['ePosta'] ?></td>
                                    </tr>
                                <?php endif ?>
                                </tbody>
                            </table>


                        </div>
                        <?php

                        if (empty($uyeMeta['adresEx']) or empty($uyeMeta['ePosta']) or !isset($uyeMeta['adresEx']) or !isset($uyeMeta['ePosta'])) {

                            ?>
                            <div class="alert alert-success" role="alert">
                              AİDAT SİSTEMİNİ KULLANABİLMEK İÇİN E-POSTA  VE ADRESİNİZİ EKLEYİNİZ.
                            </div>
                        <?php


                            echo createForm(
                                [
                                    'id' => 'serialize',
                                    'buttonText' => 'Kaydet',
                                    'btnclass' => 'btn-primary',
                                    'elements' => [
                                        [
                                            'type' => 'text',
                                            'label' => 'Adres',
                                            'name' => 'adresEx',
                                            'id' => 'adresEx',
                                            'value' => $uyeMeta['adresEx'],
                                            'collabel' => 4,
                                            'colinput' => 8,
                                        ],
                                        [
                                            'type' => 'text',
                                            'label' => 'E-Posta',
                                            'name' => 'ePosta',
                                            'id' => 'ePosta',
                                            'value' => $uyeMeta['ePosta'],
                                            'collabel' => 4,
                                            'colinput' => 8,
                                        ],
                                        [
                                            'type' => 'hidden',
                                            'value' => 'uye/edit',
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
                        }

                        ?>
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
                                    <td class="text-muted"><?=uyeToplamOdeme($_SESSION['UserID'])?> TL</td>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Bekleyen Aidat :</th>
                                    <td class="text-muted"><?=uyeToplamOdemeBekleyen($_SESSION['UserID'])?> TL</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><a href="?page=odeme-yap" class="btn btn-success">ÖDEME YAP</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">AİDAT DÖNEMLERİ</h5>

                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            <strong> BANKA İLE YAPILAN AİDAT ÖDEMELERİ SİSTEME GECİKMELİ OLARAK EKLENMEKTEDİR. ÖNCEKİ AYLARA AİT BANKA İLE GÖNDERDİĞİNİZ AİDATLAR ÖDENMEDİ OLARAK GÖZÜKEBİLİR. DİKKATE ALMAYINIZ.  </strong>
                        </div>
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>Aidat Dönemi</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $toplamOdeme = uyeToplamOdeme($_SESSION['UserID']);

                            foreach (uyeToplamOdemeDonem($_SESSION['UserID']) as $item):


                                if ($item['tutar'] <= $toplamOdeme) {
                                    $durum = 'Ödendi';
                                    $toplamOdeme = $toplamOdeme - $item['tutar'];
                                } else {
                                    $durum = 'Ödenmedi';
                                    $toplamOdeme = $toplamOdeme - $item['tutar'];
                                }

                                if ($item['type'] == 1) {
                                    $odemeTuru = 'Kredi Kartı ile Manuel';
                                } elseif ($item['type'] == 2) {
                                    $odemeTuru = 'Banka (Havale/EFT)';
                                } elseif ($item['type'] == 3) {
                                    $odemeTuru = 'Kredi Kartı ile Otomatik';
                                }

                                ?>
                                <tr>
                                    <td data-sort="<?= strtotime($item['date']) ?>"><?= date('d.m.Y', strtotime($item['date'])) ?></td>
                                    <td><?= $item['tutar'] ?> TL</td>
                                    <td><?= $durum ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">ÖDEME DÖKÜMÜ</h5>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>
                            <tr>

                                <th>Ödeme Tarihi</th>
                                <th>Tutar</th>
                                <th>Ödeme Türü</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php


                            foreach ($db->from('odemeler')->where('user', $_SESSION['UserID'])->all() as $item):

                                $odemeData = json_decode($item['data'], true);

                                if ($odemeData['status'] == 'failed'){
                                 continue;
                                }

                                    if ($item['type'] == 1) {
                                        $odemeTuru = 'Kredi Kartı ile Manuel';
                                    } elseif ($item['type'] == 2) {
                                        $odemeTuru = 'Banka (Havale/EFT)';
                                    } elseif ($item['type'] == 3) {
                                        $odemeTuru = 'Kredi Kartı ile Otomatik';
                                    }

                                ?>
                                <tr>
                                    <td data-sort="<?= strtotime($item['date']) ?>"><?= date('d.m.Y H:i:s', strtotime($item['date'])) ?></td>
                                    <td><?= $item['tutar'] ?> TL</td>
                                    <td><?= $odemeTuru ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
