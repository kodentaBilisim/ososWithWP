<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dosyalar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dosyalar</a></li>
                            <li class="breadcrumb-item active">Dosya Listesi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">İşyeri Listesi</h4>
                    </div><!-- end card header -->

                    <div class="card-body">

						<?php
						echo createForm( [
							'id'         => 'serialize',
							'buttonText' => 'Yükle',
							'elements'   => [
								[
									'type'     => 'file',
									'name'     => 'files[]',
									'id'       => 'files',
									'label'    => 'İşyeri Listesi Excel',
									'required' => true,
									'multi'    => true,
								],
								[
									'type'  => 'hidden',
									'name'  => 'upload',
									'value' => 'files',
								],
								[
									'type'  => 'hidden',
									'name'  => 'type',
									'value' => 'kayit',
								],
								[
									'type'  => 'hidden',
									'name'  => 'postUrl',
									'value' => 'isyeri/upload',
								],
							]
						] );

						?>


                        <!-- end dropzon-preview -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>


<?php if ( isset( $_GET['fileID'] ) ): ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-3"><button class="btn btn-primary" onclick="listUploadProcess('<?=fileMeta( $_GET['fileID'], 'name' )?>_.json','isyeri/ekle.php','A')">BAŞLA</button></div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: center">
                            <h3><span id="counter">0</span> / <?=$_GET['le']?></h3>
                        </div>
                    </div>

                    <div class="progress my-2" style="height: 18px;">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                             aria-valuemax="100" style="width:0%">0%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->




