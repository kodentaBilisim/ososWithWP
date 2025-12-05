<div class="tab-pane <?= ( $tab['active'] == true ? 'active' : '' ); ?>" id="<?= $tab['name'] ?>" role="tabpanel">
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-3"><?= $userMeta['name'] ?></h5>
                </div>
            </div><!-- end card -->
        </div>
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
                                                                                  data-target="<?= count( $ilUye ) ?>">0  </span>
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
                                İstifalar</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                                                  data-target="<?= count( $ilIstifa ) ?>">0  </span>
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
