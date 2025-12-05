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
                                        <th>Telefon</th>
                                        <th>İl</th>
                                        <th>Cinsiyet</th>
                                        <th>Firma</th>





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


                                        ?>
                                        <tr id="silbtn-<?php echo $veri["id"]; ?>-1">
                                            <td><?php echo $veri["id"]; ?></td>
                                            <td>  <?php echo $veri["name"]; ?> </td>

                                            <td>  <?php echo $veri["telefon"]; ?> </td>
                                            <td>  <?php echo ilgetirbyID($veri["il"]); ?> </td>
                                            <td>  <?php echo $cinsiyet; ?> </td>
                                            <td>  <?php echo sgk_meta($veri["SGK"])['name']; ?> </td>


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
