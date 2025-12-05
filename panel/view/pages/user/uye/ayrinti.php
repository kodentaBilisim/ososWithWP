<?php

$kisiMeta = kisiGetir( 'id', $_GET['id'] );


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
                            <li class="breadcrumb-item active">Üye Bilgileri</li>
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
                    <a href="?page=uye/odeme-ayrinti&id=<?=$_GET['id']?>" target="_blank" class="btn btn-success">ÖDEME BİLGİLERİ</a>

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
                            <tr>
                                <th class="ps-0" scope="row">İl:</th>
                                <td class="text-muted"><?= ilgetirbyID($kisiMeta['il']) ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Kurum:</th>
                                <td class="text-muted"><?= (sgk_meta($kisiMeta['SGK']) == 0?'KURUM YOK':sgk_meta($kisiMeta['SGK'])['name']) ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Cinsiyet:</th>
                                <td class="text-muted"><?= $kisiMeta['cinsiyet'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Üyelik Tarihi:</th>
                                <td class="text-muted"><?= $kisiMeta['uyelikTarihi'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">istifaTarihi:</th>
                                <td class="text-muted"><?= $kisiMeta['istifaTarihi'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">cikisTarihi:</th>
                                <td class="text-muted"><?= $kisiMeta['cikisTarihi'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">Doğrulama Kodu:</th>
                                <td class="text-muted"><?= $kisiMeta['dogrulamaKodu'] ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0" scope="row">YKKararNo:</th>
                                <td class="text-muted"><?= $kisiMeta['YKKararNo'] ?></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div>

        </div>
    </div>
</div>
</div>
