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
                        <h4 class="card-title mb-0">Üye Listesi</h4>
                    </div><!-- end card header -->
<ul>
                    <?php


                    $users = $db->from('users')->where('type','user')->all();


                    foreach ($users as $i){
                        echo '<li>Kullanıcı adı: '.$i['email'].' - Şifre: '.base64_decode($i['passbase64']).'</li>';
                    }

                    ?>

</ul>
                    <div class="card-body">

                        <?php
                        echo createForm([
                            'id' => 'serialize',
                            'buttonText' => 'Kaydet',
                            'elements' => [
                                [
                                    'type' => 'text',
                                    'name' => 'email',
                                    'label' => 'E-Posta'
                                ],
                                [
                                    'type' => 'hidden',
                                    'name' => 'postUrl',
                                    'value' => 'users/ekle',
                                ],
                            ]
                        ])

                        ?>


                        <!-- end dropzon-preview -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->




