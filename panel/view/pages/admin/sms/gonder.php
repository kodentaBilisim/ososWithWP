<?php

$KampanyaMeta = $db->from( 'kampanya' )->where( 'id', $_GET['kampanya'] )->first();
$KampanyaFilter = kampanyafilter( $_GET['kampanya'] );

?>
<!-- HOME -->
<div class="page-content">
    <div class="container-fluid">
        <section>
            <div class="row">

                <div class="col-12 text-center">
                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Oluşturulacak SMS aşağıdaki filtreye göre gönderilecektir - Gönderilecek Kişi
                            Sayısı: <?php echo kampanyameta( $_GET['kampanya'], 'count' ); ?></h3>

                    </div>
                </div>
                <div class="col-12 mb-3">
                    <a href="/panel/api/sms/cinsiyet.php?cinsiyet=K&id=<?php echo $_GET['kampanya'] ?>" type="button"
                       class="btn btn-primary btn-min-width ">KADINLAR</a>
                    <a href="/panel/api/sms/cinsiyet.php?cinsiyet=E&id=<?php echo $_GET['kampanya'] ?>" type="button"
                       class="btn btn-info btn-min-width mx-1">ERKEKLER</a>
                    <a href="/panel/api/sms/cinsiyet.php?cinsiyet=all&id=<?php echo $_GET['kampanya'] ?>" type="button"
                       class="btn btn-success btn-min-width mr-1">TÜM LİSTELENENLER</a>
                    <a href="?page=sms/kisilistesi&kampanya=<?php echo $_GET['kampanya'] ?>" target="_blank"
                       type="button" class="btn btn-warning btn-min-width ">KİŞİ LİSTESİ</a>
                </div>
            </div>
            <div class="row">
				<?php

				if ( isset( $KampanyaFilter['subeler'] ) ) {

					?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Şubeler ve Görevler</h4>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">

												<?php foreach ( $KampanyaFilter['subeler'] as $sube ) {
													if ( $sube == 9999999 ) {
														continue;
													} ?>
                                                    <li class="list-group-item">
														<?php echo ilgetirbyID( $sube ) ?>
                                                    </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">

												<?php foreach ( $KampanyaFilter['gorevler'] as $gorev ) {
													if ( $gorev == 9999999 ) {
														continue;
													} ?>
                                                    <li class="list-group-item">
														<?php echo get_meta_gorev( $gorev, 'name' ) ?>
                                                    </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } elseif ( isset( $KampanyaFilter['firmalar'] ) ) { ?>


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">İşyerleri ve Görevler</h4>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">

												<?php foreach ( $KampanyaFilter['firmalar'] as $sube ) {
													if ( $sube == 9999999 ) {
														continue;
													}


                                                    ?>
                                                    <li class="list-group-item">
														<?php echo sgk_meta($sube)['sgk']. '('.ilgetirbyID(sgk_meta($sube)['il']).')' . '<pre>' . str_replace( '    ', '', sgk_meta($sube)['adres'] ) . '</pre>'; ?>
                                                    </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">

												<?php foreach ( $KampanyaFilter['gorevfirma'] as $gorev ) {
													if ( $gorev == 9999999 or get_meta_gorev( $gorev, 'birim' ) == 1 ) {
														continue;
													}


													?>
                                                    <li class="list-group-item">
														<?php echo get_meta_gorev( $gorev, 'name' ) ?>
                                                    </li>
												<?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

				<?php } ?>


                <div class="col-md-6">
                    <!--<div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Dosya Yükle</h4>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">

                                <div class="card-text">
                                    <p class="card-text"> Dosya yüklendikten sonra mesaja eklemeniz için link
                                        oluşturulacaktır </p>
                                </div>

                                <form id="serialize">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="personelfile"
                                                   name="personelfile">
                                            <input type="text" id="urlfile" class="form-control my-1"
                                                   style="display: none"
                                                   name="urlfile">
                                            <input type="hidden" class="form-control" name="type" id="type"
                                                   value="upload">
                                            <input type="hidden" class="form-control" name="type2" id="type2"
                                                   value="smsfile">
                                        </div>
                                    </div>

                                    <div class="form-actions right">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="ft-check"></i> YÜKLE
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">LİNK KISALT</h4>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">

                                <form id="serialize" class="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="userinput1" class="sr-only">LINK</label>
                                            <input type="text" id="url" class="form-control"
                                                   placeholder="LİNKİ BURAYA YAPIŞTIRINIZ" name="url">

                                            <input type="hidden" class="form-control" name="type" id="type"
                                                   value="APIURLShort">
                                        </div>
                                    </div>

                                    <div class="form-actions right">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="ft-check"></i> KISALT
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">GÖNDERİM ZAMANI</h4>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <p><?php /*if ( ! empty( $KampanyaMeta['senddate'] ) ) {
										echo 'Daha önce zamanlandı: ' . $KampanyaMeta['senddate'];
									} */?></p>
                                <p>Gönderim zamanı eklerseniz SMS o saatte gönderilmeye başlanır!</p>
                                <form id="serialize" class="form">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="card-text">GÜN</label>
                                            <select id="gun" name="gun" class="form-control-sm form-control">
												<?php
/*
												for ( $i = 1; $i < 32; $i ++ ) {
													$select = '';
													if ( $i == date( 'd', time() ) ) {
														$select = 'selected';
													}
													echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option>';
												}

												*/?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="card-text">AY</label>
                                            <select id="ay" name="ay" class="form-control-sm form-control">
												<?php
/*
												$aylar = array(
													'OCAK',
													'ŞUBAT',
													'MART',
													'NİSAN',
													'MAYIS',
													'HAZİRAN',
													'TEMMUZ',
													'AĞUSTOS',
													'EYLÜL',
													'EKİM',
													'KASIM',
													'ARALIK'
												);

												for ( $i = 0; $i < 12; $i ++ ) {
													$select = '';
													$k      = $i + 1;
													if ( $k == date( 'm', time() ) ) {
														$select = 'selected';
													}

													echo '<option value="' . $k . '" ' . $select . '>' . $aylar[ $i ] . '</option>';
												}

												*/?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="card-text">YIL</label>
                                            <select id="yil" name="yil" class="form-control-sm form-control">
                                                <option value=""></option>
												<?php
/*
												for ( $i = 0; $i < 12; $i ++ ) {
													$select = '';
													$k      = $i + 2022;
													if ( $k == date( 'Y', time() ) ) {
														$select = 'selected';
													}

													echo '<option value="' . $k . '" ' . $select . '>' . $k . '</option>';
												}

												*/?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mt-1">

                                        <div class="col-3">
                                            <label class="card-text">SAAT</label>
                                            <select id="saat" name="saat" class="form-control-sm form-control">

												<?php
/*
												$aylar = array(
													'09',
													'10',
													'11',
													'12',
													'13',
													'14',
													'15',
													'16',
													'17',
													'18',
													'19',
													'20'
												);

												for ( $i = 0; $i < 12; $i ++ ) {
													$select = '';
													$k      = date( 'H', time() ) + 1;
													if ( $aylar[ $i ] == $k ) {
														$select = 'selected';
													}

													echo '<option value="' . $aylar[ $i ] . '" ' . $select . '>' . $aylar[ $i ] . '</option>';
												}

												*/?>

                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="card-text">DAKİKA</label>
                                            <select id="dakika" name="dakika" class="form-control-sm form-control">

												<?php
/*
												for ( $i = 0; $i < 60; $i ++ ) {
													$select = '';

													if ( $i < 10 ) {
														$k = '0' . $i;
													} else {
														$k = $i;
													}

													echo '<option value="' . $k . '" ' . $select . '>' . $k . '</option>';
												}

												*/?>

                                            </select>
                                        </div>

                                    </div>
                                    <input type="hidden" class="form-control" name="type" id="type"
                                           value="APISMSZamanla">
                                    <input type="hidden" class="form-control" name="kampanya" id="kampanya"
                                           value="<?php /*echo $_GET['kampanya']; */?>">
                                    <div class="form-actions right">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="ft-check"></i> GÖNDERİM ZAMANI EKLE
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>-->

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SMS İÇERİĞİ</h4>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">

                                <form id="serialize" class="form">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <fieldset class="form-group">
                                                <textarea class="form-control" name="mesaj" id="mesaj"
                                                          rows="6"><?php if ( ! empty( $KampanyaMeta['mesaj'] ) ) {
														echo $KampanyaMeta['mesaj'];
													} ?></textarea>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="kampanya" id="kampanya"
                                           value="<?php echo $_GET['kampanya']; ?>">
                                    <input type="hidden" class="form-control" name="postUrl" id="postUrl"
                                           value="sms/APISMSMesaj">
                                    <div class="form-actions right">
                                        <button type="submit" class="mt-4 btn btn-outline-primary">
                                            <i class="ft-check"></i> GÖNDERİME HAZIRLA
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
<!-- Card sizing section end -->

