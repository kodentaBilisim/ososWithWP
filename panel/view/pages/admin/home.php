<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Anasayfa</h4>


                </div>
            </div>
            <div class="col-12">
				<?php




				$uye = $db->from( 'kisiler' )->where( 'durum', 1 )->where( 'ek', 0 )->all();

                $Gecerliuye = $db->from( 'kisiler' )->
                where( 'ek', 0 )->
                where( 'durum', 1 )->
                or_where( 'durum', 0 )->
                where( 'cikisTarihi', date( 'Y-m-d H:i:s' ), '>' )->
                where( 'cikisTarihi', '0000-00-00 00:00:00', '!=' )->

                all();

				$istifa = $db->from( 'kisiler' )->
                where( 'durum', 0 )->
                where( 'cikisTarihi', date( 'Y-m-d H:i:s' ), '>' )->
                where( 'cikisTarihi', '0000-00-00 00:00:00', '!=' )->
                all();


				$erkek = $db->from( 'kisiler' )->
				where( 'durum', 1 )->
				where( 'cinsiyet', 'E' )->
				or_where( 'durum', 0 )->
				where( 'cikisTarihi', date( 'Y-m-d H:i:s' ), '>' )->
				where( 'cikisTarihi', '0000-00-00 00:00:00', '!=' )->
				where( 'cinsiyet', 'E' )->
				all();

                $kadin = $db->from( 'kisiler' )->
				where( 'durum', 1 )->
				where( 'cinsiyet', 'K' )->
				or_where( 'durum', 0 )->
				where( 'cikisTarihi', date( 'Y-m-d H:i:s' ), '>' )->
				where( 'cikisTarihi', '0000-00-00 00:00:00', '!=' )->
				where( 'cinsiyet', 'K' )->
				all();

				?>
                <div class="row">


                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            MEVCUT ÜYE</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count( $uye ) ?>">0  </span>
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
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            ÜYELİĞİ HENÜZ DÜŞMEMİŞ İSTİFALAR</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count( $istifa ) ?>">0  </span>
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
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            GEÇERLİ ÜYE</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count($Gecerliuye) ?>">0  </span>
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


                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Kadın</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count( $kadin ) ?>">0  </span>
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
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            ERKEK</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                              data-target="<?= count ( $erkek ) ?>">0  </span>
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
            </div>
        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
