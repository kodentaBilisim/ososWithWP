<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kurumlar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kurumlar</a></li>
                            <li class="breadcrumb-item active">Firma Listesi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">İŞYERİ</h5>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered dt-responsive table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th>İşyeri Adı</th>
                                <th>ÜYE SAYISI</th>

                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php

							$FirmaList = $db->from( 'firma' )->all();


							foreach ( $FirmaList as $Firma ) {



								?>

                                <tr>
                                    <td><?= $Firma['name'] ?></td>
                                    <td><?= count( listFirmaUye( $Firma['id'] ) ) ?></td>

                                    <td>
                                        <a class="btn btn-success" role="button"
                                           href="?page=firma/duzenle&id=<?= $Firma['id'] ?>">AYRINTI</a>
                                    </td>


                                </tr>
							<?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
