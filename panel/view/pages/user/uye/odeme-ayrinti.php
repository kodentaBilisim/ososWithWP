<?php

$kisiMeta = kisiGetir( 'id', $_GET['id'] );

$talimat = $db->from('talimat')
    ->where('user', $_GET['id'])
    ->first();

$talimatData = json_decode($talimat['data'], true);
?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Üye Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Üyeler</a></li>
                            <li class="breadcrumb-item active">Üye Ödeme Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-3">Üye Bilgileri</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr>
                                <th class="ps-0" scope="row">İsim:</th>
                                <td class="text-muted"><?= $kisiMeta['name'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">TC:</th>
                                <td class="text-muted"><?= $kisiMeta['tc'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Telefon:</th>
                                <td class="text-muted"><?= $kisiMeta['telefon'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">ePosta:</th>
                                <td class="text-muted"><?= $kisiMeta['ePosta'] ?></td>
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
                                <td class="text-muted"><?=uyeToplamOdeme($_GET['id'])?> TL</td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Bekleyen Aidat :</th>
                                <td class="text-muted"><?=uyeToplamOdemeBekleyen($_GET['id'])?> TL</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Otomatik Tahsilat Durumu: <?= ($talimat['status']) ? 'Açık' : 'Kapalı' ?></h5>
                </div>
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

                        $toplamOdeme = uyeToplamOdeme($_GET['id']);

                        foreach (uyeToplamOdemeDonem($_GET['id']) as $item):


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
                                <td><?= $item['tutar'] ?></td>
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


                        foreach ($db->from('odemeler')->where('user', $_GET['id'])->all() as $item):

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
                                <td><?= $item['tutar'] ?></td>
                                <td><?= $odemeTuru ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

