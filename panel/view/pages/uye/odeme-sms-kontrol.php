<?php
$userMeta = uyeMeta($_SESSION['UserID']);


?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">TALİMATINIZI ONAYLAYINIZ</h4>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="alert alert-warning" role="alert">
                            Otomatik Ödeme Talimatınız için <?=$userMeta['telefon']?> numaralı telefonunuza gönderilen ONAY SMS'ine EVET yazarak yanıt veriniz. Onayınıza kadar talimatınız geçerli olmayacaktır.
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
