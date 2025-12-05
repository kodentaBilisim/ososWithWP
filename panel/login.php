<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title><?=$scriptConfig['base_title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="view/assets/images/favicon.ico">
    <base href="<?=$scriptConfig['mainURL']?>">
    <!-- Layout config Js -->
    <script src="view/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="view/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="view/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="view/assets/css/app.min.css" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="view/assets/css/custom.min.css" rel="stylesheet" type="text/css"/>

    <script>
        if (location.protocol !== 'https:') {
            location.replace(`https:${location.href.substring(location.protocol.length)}`);
        }
    </script>

</head>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden border-0">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6 d-block" id="login">
                                <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x"
                                     id="danger" style="display: none"
                                     data-original-class="toast-container position-absolute p-3">
                                    <div class="toast fade show">
                                        <div class="toast-header">
                                            <strong class="me-auto">Hata</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            <div class="alert alert-danger mb-xl-0" role="alert">
                                                <strong> Kullanıcı Adı veya Şifre Hatalı!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($_GET['reset'])):?>
                                <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x"
                                     id="danger" style="display: block"
                                     data-original-class="toast-container position-absolute p-3">
                                    <div class="toast fade show">
                                        <div class="toast-header">
                                            <strong class="me-auto">Hata</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            <div class="alert alert-success mb-xl-0" role="alert">
                                                <strong> Şifreniz sıfırlandı. Kayıtlı E-Posta adresinize veya telefonunuza SMS ile gönderildi!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="p-lg-5 p-4">
                                    <div class="row">
                                        <div class="col-6"><h5 class="text-primary">Hoş geldiniz...</h5>
                                            <p class="text-muted">Lütfen giriş yapınız</p></div>
                                        <div class="col-6 d-flex justify-content-end">
                                                <img src="view/assets/logo.png" class="img-fluid " style="object-fit: contain; max-width: 100px" alt="" height="18">
                                             </div>
                                    </div>

                                    <div class="mt-4">


                                        <div class="mb-3">
                                            <label for="username" class="form-label">Kullanıcı Adı</label>
                                            <input type="text" class="form-control" id="kullaniciadi"
                                                   name="kullaniciadi" placeholder="Kullanıcı Adı">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Şifre</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                       placeholder="Şifre" id="sifre" name="sifre">
                                                <input type="hidden" name="token" id="token"
                                                       value="<?= setFormTokenSession() ?>">
                                                <button onclick="eyeopen()" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <!-- <div class="form-check">
											 <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
											 <label class="form-check-label" for="auth-remember-check">Beni Hatırla</label>
										 </div>-->

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" onclick="login()" type="submit">Giriş
                                                Yap
                                            </button>
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

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="view/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="view/assets/libs/simplebar/simplebar.min.js"></script>
<script src="view/assets/libs/node-waves/waves.min.js"></script>
<script src="view/assets/libs/feather-icons/feather.min.js"></script>
<script src="view/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="view/assets/js/plugins.js"></script>
<script src="view/assets/js/login.js"></script>

<!-- password-addon init -->
<script src="view/assets/js/pages/password-addon.init.js"></script>
</body>

<script>


    function eyeopen(){

        const pass = document.getElementById('sifre');

        if(pass.type === 'password'){
            pass.type = "text";
        }else{
            pass.type = "password";
        }
    }

</script>

</html>
