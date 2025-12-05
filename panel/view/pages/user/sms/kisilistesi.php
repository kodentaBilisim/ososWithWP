<?php

$KampanyaFilter = smsmeta( $_GET['kampanya'] );
?>
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
                                <table id="personel"
                                       class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İsim</th>
                                        <th>TC</th>
                                        <th>Telefon</th>
                                        <th>Doğum Tarihi</th>
                                        <th>Cinsiyet</th>
                                        <th>Şube</th>
                                        <th>Görev</th>
                                        <th>Firma</th>
                                        <th>İşyeri</th>
                                        <th></th>
                                        <th></th>


                                    </tr>
                                    </thead>
                                    <tbody>
									<?php


									foreach ( $KampanyaFilter as $veri ) {


										if ( $veri['cinsiyet'] == 'K' ) {
											$cinsiyet = 'KADIN';
										} else if ( $veri['cinsiyet'] == 'E' ) {
											$cinsiyet = 'ERKEK';

										} else {
											$cinsiyet = 'TANIMLANMAMIŞ';
										}


										if ( empty( $veri['dogum'] ) or $veri['dogum'] == null or $veri['dogum'] == '0000-00-00' ) {
											$dogum = 'TANIMLANMAMIŞ';
										} else {
											$dogum = date( 'd.m.Y', strtotime( $veri['dogum'] ) );

										}

										?>
                                        <tr id="silbtn-<?php echo $veri["id"]; ?>-1">
                                            <td><?php echo $veri["id"]; ?></td>
                                            <td>  <?php echo $veri["name"]; ?> </td>
                                            <td>  <?php echo $veri["tc"]; ?> </td>
                                            <td>  <?php echo $veri["telefon"]; ?> </td>
                                            <td>  <?php echo $dogum; ?> </td>
                                            <td>  <?php echo $cinsiyet; ?> </td>
                                            <td>  <?php echo get_meta_sube( $veri["sube"], 'name' ); ?> </td>
                                            <td>  <?php echo get_meta_gorev( $veri["gorev"], 'name' ); ?> </td>
                                            <td>  <?php echo firma_meta( $veri["firma"] )['name']; ?> </td>
                                            <td>  <?php echo sgk_meta( $veri["SGK"])['sgk']; ?> </td>
                                            <td><a href="home.php?page=kisi/kisi-duzenle&id=<?php echo $veri["id"]; ?>"
                                                   class="btn btn-success">Düzenle</a></td>
                                            <td><a href="#" id="silbtn-<?php echo $veri["id"]; ?>"
                                                   onclick="deletecontent(<?php echo $veri["id"]; ?>,'kisi','#silbtn-<?php echo $veri["id"]; ?>')"
                                                   class="btn btn-danger">SİL</a></td>

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
