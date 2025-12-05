<!-- HOME -->
<div class="page-content">
    <div class="container-fluid">
        <!-- KAPSAYICI 5 -->
        <div class="row">
            <div class="col-12 my-3">
                <input type="hidden" value="" id="filtre">
                <input type="hidden" value="<?php echo $_SESSION['UserID'] ?>" id="user">
                <button onclick="kampanya()" class="mt-1 btn btn-success">Listele</button>
            </div>
        </div>
        <input type="hidden" value="<?php echo round( microtime( true ) ); ?>" name="rand">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="" enctype="multipart/form-data" id="subeler">

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Sube Seçiniz
                                <div></div>
                            </h5>
                            <div class="position-relative form-group">
                                <div class="position-relative form-check"><label class="form-check-label">
                                        <input value="0" type="checkbox" id="Allsubeler" name="9999999" class="sube">Tümünü
                                        Seç</label></div>
                                <hr/>
								<?php

								$array = $db->from( 'sube' )->all();

								foreach ( $array as $veri ) {


									echo '<div class="position-relative form-check"><label class="form-check-label"><input value="0" name="' . $veri['id'] . '" type="checkbox" class="form-check-input sube">' . $veri['name'] . '</label></div>';


								}


								?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form method="post" action="" enctype="multipart/form-data" id="gorevler" style="display: none;">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Görev Seçiniz
                                <div></div>
                            </h5>
                            <div class="position-relative form-group">
                                <div class="position-relative form-check"><label class="form-check-label">
                                        <input value="0" type="checkbox" id="Allgorevler" name="9999999" class="gorev">Tümünü
                                        Seç</label></div>
                                <hr/>
								<?php

								$array = $db->from( 'gorev' )->all();

								foreach ( $array as $veri ) {


									echo '<div class="position-relative form-check"><label class="form-check-label"><input value="0" name="' . $veri['id'] . '" type="checkbox" class="form-check-input gorev">' . $veri['name'] . '</label></div>';


								}


								?>
                                <hr/>


                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
