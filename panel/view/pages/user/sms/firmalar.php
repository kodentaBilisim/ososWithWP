<?php if ( ! isset( $_GET['firma'] ) ) { ?>
    <div class="page-content">
        <div class="container-fluid">
            <section class="users-list-wrapper">
                <div class="users-list-filter px-1">

                </div>
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table id="example"
                                           class="table table-bordered dt-responsive table-striped align-middle"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>İsim</th>
                                            <th>Düzenle</th>

                                        </tr>
                                        </thead>
                                        <tbody>
										<?php

										$Kurumlar = $db->from( 'firma' )->where( 'uye', 1 )->all();
										foreach ( $Kurumlar as $veri ) {

											$UserListId   = $veri["id"];
											$UserListName = $veri["name"];


											?>
                                            <tr>
                                                <td><?php echo $UserListId; ?></td>
                                                <td>
													<?php echo $UserListName; ?>
                                                </td>
                                                <td>
                                                    <a href="sms/firmalar?firma=<?php echo $UserListId; ?>"
                                                       class="btn btn-success">SEÇ</a></td>

                                            </tr>
											<?php


										}

										?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php } else { ?>
    <!-- HOME -->
    <div class="page-content">
        <div class="container-fluid">
            <!-- KAPSAYICI 5 -->
            <div class="col-12 my-3">
                <input type="hidden" value="" id="filtre">
                <input type="hidden" value="<?php echo $_SESSION['UserID'] ?>" id="user">
                <button onclick="kampanya()" class="mt-1 btn btn-success">Listele</button>
            </div>
            <input type="hidden" value="<?php echo round( microtime( true ) ); ?>" name="rand">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="" enctype="multipart/form-data" id="firmalar">

                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">İşyeri Seçiniz
                                    <div></div>
                                </h5>
                                <div class="position-relative form-group">
                                    <div class="position-relative form-check"><label class="form-check-label">
                                            <input value="0" type="checkbox" id="Allfirmalar" name="9999999"
                                                   class="firma">Tümünü
                                            Seç</label></div>
                                    <hr/>
									<?php

									$array = $db->from( 'sgk' )->where( 'firma', $_GET['firma'] )->all();

									foreach ( $array as $veri ) {


										echo '<div class="position-relative fir temsilcisecildi form-check"><label class="form-check-label"><input value="0" name="' . $veri['id'] . '" type="checkbox" class="form-check-input firma">' . $veri['sgk'] . '<pre>' . str_replace( '    ', '', $veri['adres'] ) . '</pre>' . '</label></div>';


									}


									?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form method="post" action="" enctype="multipart/form-data" id="gorevlerfirma"
                          style="display: none;">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Görev Seçiniz
                                    <div></div>
                                </h5>
                                <div class="position-relative form-group">
                                    <div class="position-relative form-check"><label class="form-check-label">
                                            <input value="0" type="checkbox" id="Allgorevlerfirma" name="9999999"
                                                   class="gorevfirma">Tümünü Seç</label></div>
                                    <hr/>
									<?php

									$array = $db->from( 'gorev' )->all();

									foreach ( $array as $veri ) {


										echo '<div class="position-relative form-check subegorev temsilcisecildi"><label class="form-check-label"><input value="0" name="' . $veri['id'] . '" type="checkbox" class="form-check-input gorevfirma">' . $veri['name'] . '</label></div>';


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

<?php } ?>
