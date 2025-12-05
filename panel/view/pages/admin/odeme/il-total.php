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
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Üyeler</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">

                        <table id="personel"
                               class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th>İL</th>
                                <th>TOPLAM AİDAT</th>


                            </tr>


                            </thead>
                            <tbody>


                            <?php foreach (ilgetir() as $ilID => $ilTitle) { ?>

                                <tr>
                                    <td><?= $ilTitle ?></td>
                                    <td><?= ilTotalAidat($ilID) ?></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>