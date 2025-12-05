<?php


$islem = $db->from( 'import' )->where( 'id', $_GET['id'] )->first();

$islemDate = json_decode( $islem['data'], true )['rand'];
$islemType = ( $islem['type'] == 'kayit' ) ? 'KAYIT' : 'İSTİFA';


?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">İşlem Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">İşlemler</a></li>
                            <li class="breadcrumb-item active">İşlem Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <!-- Tab panes -->

            <div class="row">
                <div class="col-xxl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-3"><?= date( 'd.m.Y H:i:s', $islemDate ) ?>
                                tarihli <?= $islemType ?> işleminin ayrıntıları</h5>
                        </div>
                    </div><!-- end card -->
                </div>
				<?php if ( $islem['type'] == 'kayit' ):


					$uyelerİslem = $db->from( 'kisiler' )->where( 'createDateTime', date( 'Y-m-d H:i:s', $islemDate ) )->in('il',json_decode($_SESSION['yetki'],true))->all();


					?>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Üyeler</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count( $uyelerİslem ) ?>">0  </span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded fs-3">
                                                            <i class="bx bx-user-circle text-primary"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
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
                                                <th>Üye Adı</th>
                                                <th>KURUM</th>
                                                <th>İL</th>
                                                <th>Üyelik Tarihi</th>
                                                <th></th>
                                            </tr>


                                            </thead>
                                            <tbody>

				                            <?php

				                            $i = 0;
				                            foreach ( $uyelerİslem as $uye ) {

					                            if(!in_array($uye['il'],json_decode($_SESSION['yetki'],true))){
						                            continue;
					                            }

					                            ?>

                                                <tr>
                                                    <td><?= $uye['name'] ?></td>
                                                    <td><?= (sgk_meta($uye['SGK']) == 0?'KURUM YOK':sgk_meta($uye['SGK'])['name']) ?></td>
                                                    <td><?= ilgetirbyID( $uye['il'] ) ?></td>
                                                    <td data-sort="<?= strtotime( $uye['uyelikTarihi'] ) ?>"><?= date( 'd.m.Y', strtotime( $uye['uyelikTarihi'] ) ) ?></td>
                                                    <td>


                                                        <a target="_blank"
                                                           href="uye/ayrinti&id=<?= $uye['id'] ?>"
                                                           class="btn btn-info  ">Ayrıntıları Göster
                                                        </a>


                                                    </td>


                                                </tr>
					                            <?php $i ++;
				                            } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                    </div>
				<?php elseif ( $islem['type'] == 'istifa' ):

					$istifaİslem = $db->from( 'kisiler' )->in('il',json_decode($_SESSION['yetki'],true))->where( 'durum', 0 )->where( 'updateTime', json_decode( $islem['data'], true )['uploadDateTime'] )->all();


					$iller = $db->from( 'il' )->orderBy( 'id', 'ASC' )->all();


				?>

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            İstifalar</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count( $istifaİslem ) ?>">0  </span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-primary rounded fs-3">
                                                            <i class="bx bx-user-circle text-primary"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

            </div>
            <div class="row">
                <div class="col-xxl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">İstifalar</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table id="personel"
                                       class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                       style="width:100%">
                                    <thead>

                                    <tr>
                                        <th>Üye Adı</th>
                                        <th>TELEFON</th>
                                        <th>KURUM</th>
                                        <th>İL</th>
                                        <th>Üyelik Tarihi</th>
                                        <th>NOT</th>
                                        <th></th>
                                    </tr>


                                    </thead>
                                    <tbody>

							        <?php

							        $i = 0;
							        foreach ( $istifaİslem as $uye ) {


								        if(!in_array($uye['il'],json_decode($_SESSION['yetki'],true))){
									        continue;
								        }


								        ?>

                                        <tr>
                                            <td><?= $uye['name'] ?></td>
                                            <td><?= $uye['telefon'] ?></td>
                                            <td><?= (sgk_meta($uye['SGK']) == 0?'KURUM YOK':sgk_meta($uye['SGK'])['name']) ?></td>

                                            <td><?= ilgetirbyID( $uye['il'] ) ?></td>
                                            <td data-sort="<?= strtotime( $uye['uyelikTarihi'] ) ?>"><?= date( 'd.m.Y', strtotime( $uye['uyelikTarihi'] ) ) ?></td>
                                            <td><?php echo kisiGetir('id',$uye['id'])['not'] ?></td>
                                            <td>


                                                <a target="_blank"
                                                   href="uye/ayrinti&id=<?= $uye['id'] ?>"
                                                   class="btn btn-info  ">Ayrıntıları Göster
                                                </a>


                                            </td>


                                        </tr>
								        <?php $i ++;
							        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>
	        <?php endif; ?>

        </div>
    </div>
</div>
</div>
