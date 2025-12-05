<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Şubeler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Şubeler</a></li>
                            <li class="breadcrumb-item active">Şube Listesi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Şubeler</h5>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th>Şube Adı</th>
                                <th></th>
                            </tr>


                            </thead>
                            <tbody>

							<?php

							$SubeList = $db->from( 'sube' )->all();


							foreach ( $SubeList as $Sube ) {

								?>

                                <tr>
                                    <td><?= $Sube['name'] ?></td>
                                    <td>
                                        <a class="btn btn-success" role="button"
                                           href="sube/duzenle&id=<?= $Sube['id'] ?>">AYRINTI</a>
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
