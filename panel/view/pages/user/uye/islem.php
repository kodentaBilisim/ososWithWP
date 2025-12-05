<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">İşlemler</h4>


                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5>Devam eden üye veya istifa listesi işlemleri</h5>

						<?php

						$kayitlar = $db->from( 'import' )->where( 'status', 0 )->or_where( 'status', 2 )->all();

						$i = 5;

						foreach ( $kayitlar as $value ): ?>


							<?php if ( $value['status'] == 0 ): ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong>
										<?php echo date( 'd.m.Y H:i', json_decode( $value['data'], true )['uploadDateTime'] ) ?>
                                    </strong> tarihinde sisteme
                                    eklenen <?= ( $value['type'] == 'kayit' ) ? ' üye listesi' : 'istifa listesi' ?> <?= $i ?>
                                    dk içerisinde işlenecek!
                                </div>
							<?php else: ?>
                                <div class="alert alert-info" role="alert">
                                    <strong>
										<?php echo date( 'd.m.Y H:i', json_decode( $value['data'], true )['uploadDateTime'] ) ?>
                                    </strong> tarihinde sisteme
                                    eklenen <?= ( $value['type'] == 'kayit' ) ? ' üye listesi' : 'istifa listesi' ?>
                                    işleniyor...
                                </div>
							<?php endif; ?>


							<?php $i = $i + 5; endforeach; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5>Tamamlanan üye veya istifa listesi işlemleri</h5>

						<?php

						$kayitlar = $db->from( 'import' )->where( 'status', 1 )->all();

						$i = 5;

						foreach ( $kayitlar as $value ):

                            $file = explode('/',$value['file']);


                            ?>


                            <div class="alert alert-success" role="alert">
                                <strong>
									<?php echo date( 'd.m.Y H:i', json_decode( $value['data'], true )['uploadDateTime'] ) ?>
                                </strong> tarihinde sisteme
                                eklenen <?= ( $value['type'] == 'kayit' ) ? ' üye listesi' : 'istifa listesi' ?>. <br><br><a role="button" class="btn btn-warning"
                                        href="uye/islem-details?id=<?= $value['id'] ?>" target="_blank">Ayrıntılar için
                                    tıklayınız!</a>

                                <a role="button" class="btn btn-success" href="/uploads/<?=str_replace('_.json','',$file[count($file)-1])?>">YÜKLENEN DOSYA</a>
                            </div>

							<?php $i = $i + 5; endforeach; ?>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->




