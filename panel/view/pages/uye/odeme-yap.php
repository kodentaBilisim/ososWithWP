<?php

$talimat = uyeTalimat($_SESSION['UserID']);

if ($talimat) {

    $talimatData = json_decode($talimat['data'], true);
}

$uyeMeta = uyeMeta($_SESSION['UserID']);
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

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <a role="button" class="btn btn-success" href="/panel/?page=step-by-step&step=information">
                            OTOMATİK ÖDEME TALİMATINI GÜNCELLE
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5>OTOMATİK ÖDEME TALİMATINI İPTAL ET</h5>

                        <?php

                        echo createForm(
                            [
                                'id' => 'serialize',
                                'buttonText' => 'ÖDEME TALİMATINI İPTAL ET',
                                'btnclass' => 'btn-warning',
                                'elements' => [
                                    [
                                        'type' => 'hidden',
                                        'value' => 'odeme/talimatekle',
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

                <?php if (!$uyeMeta['utoken']) { ?>
                    <div class="card">
                        <div class="card-body">


                            <div class="alert alert-warning" role="alert">
                                Otomatik Ödeme Talimatınız için kartınız bulunmamaktadır! Kart
                                bilgileriniz sistemlerimizde kesinlikle kayıt altına alınmamaktadır. Bankanız
                                aracılığıyla talimat işlemleri gerçekleştirilmektedir!
                            </div>

                            <?php if ($talimat['status']): ?>
                                <a role="button" class="btn btn-success" href="?page=odeme-talimati"> OTOMATİK ÖDEME
                                    İÇİN KART
                                    EKLE </a>

                            <?php else: ?>
                                <a role="button" class="btn btn-success" href="#">ÖNCELİKLE TALİMAT BİLGİLERİ GİRİNİZ</a>
                            <?php endif; ?>


                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                Otomatik Ödeme Talimatınız için kartınız bulunmaktadır!
                            </div>

                            <a role="button" class="btn btn-success" href="?page=odeme-talimati"> YENİ KART
                                EKLE </a></div>

                        <?php

                        echo createForm(
                            [
                                'id' => 'serialize',
                                'buttonText' => 'Kayıtlı Kartlarımı Sil',
                                'btnclass' => 'btn-danger',
                                'elements' => [
                                    [
                                        'type' => 'hidden',
                                        'value' => 'odeme/kart-sil',
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
                <?php } ?>
            </div>
            <div class="col-lg-6">
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
                                    <td class="text-muted"><?= uyeToplamOdemeBekleyen($_SESSION['UserID']) ?>
                                        TL
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <a role="button" class="btn btn-success" href="?page=tek-seferlik"> TEK SEFERLİK ÖDEME YAP</a>
                    </div><!-- end card body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Otomatik Tahsilat
                            Durumu: <?= ($talimat['status']) ? 'Açık' : 'Kapalı' ?></h5>

                        <?php if ($talimat['status']) { ?>
                            <div class="alert alert-success" role="alert">
                                <?= date('d.m.Y H:i:s', $talimatData['date']) ?> tarih ve
                                saatinde <?= $talimatData['amount'] ?> TL tutarında aidatınızın
                                ayın <?= $talimat['gun'] ?>. günde kartınızdan otomatik olarak tahsil edilmesini
                                istediğinizi bildirdiniz. Otomatik ödeme talebinizi yukarıdaki menüden
                                güncelleyebilirsiniz.
                            </div>
                        <?php } ?>


                    </div>
                </div>

            </div>

        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
