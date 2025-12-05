<?php include 'header.php' ?>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card overflow-hidden border-0">
                        <div class="row g-0">

                            <div class="col-lg-12 d-block" id="login">
                                <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x" id="danger" style="display: none" data-original-class="toast-container position-absolute p-3">
                                    <div class="toast fade show">
                                        <div class="toast-header">
                                            <strong class="me-auto"> <?= langTranslateArr('hata', $SiteLang) ?></strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            <div class="alert alert-danger mb-xl-0" role="alert">
                                                <?= langTranslateArr('userEmail', $SiteLang) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-lg-5 p-4">
                                    <?php
                                    if ($_SESSION['lang'] == 'en') {
                                        echo '<a href="/panel/?lang=tr" class="dropdown-item notify-item language py-2" data-lang="en" title="TÜRKÇE">
                            <img src="/view/panel/assets/images/tr.png" alt="user-image" class="me-2 rounded" height="18">
                           
                        </a>';
                                    } else {
                                        echo '<a href="/panel/?lang=en" class="dropdown-item notify-item language py-2" title="ENGLISH">
                            <img src="/view/panel/assets/images/en.png" alt="user-image" class="me-2 rounded" height="18">
                           
                        </a>';
                                    }

                                    ?>
                                    <div>
                                        <h5 class="text-primary"><?= langTranslateArr('wellcome', $SiteLang) ?></h5>
                                    </div>

                                    <div class="mt-4">


                                            <div class="mb-3">
                                                <label for="username" class="form-label"><?= langTranslateArr('username', $SiteLang) ?></label>
                                                <input type="text" class="form-control" id="kullaniciadi" name="kullaniciadi" placeholder="<?= langTranslateArr('username', $SiteLang) ?>">
                                            </div>

                                           <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Beni Hatırla</label>
                                            </div>-->

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" onclick="forgotpassword()" type="submit"><?= langTranslateArr('gonder', $SiteLang) ?></button>

                                                <div class="loading alert alert-warning" style="display: none" role="alert" >
                                                   <?= langTranslateArr('wait', $SiteLang) ?>
                                                </div>

                                            </div>



                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->

    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
<?php include 'footer.php' ?>
