<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Üye Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Üyeler</a></li>
                            <li class="breadcrumb-item active">Üye Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Üyeler</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table id="personel"
                               class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>

                            <tr>
                                <th></th>
                                <th>Dönem</th>
                                <th>Kişi Sayısı</th>
                                <th>Toplam Tutar</th>
                            </tr>


                            </thead>
                            <tbody>

                            <?php
                            $loop = true;
                            $ay = 1;
                            while ($loop):

                                $sql = "
        SELECT SUM(tutar) AS toplam_tutar, COUNT(*) AS satir_sayisi
        FROM new_odemeler
        WHERE MONTH(date) = " . $ay . " 
          AND YEAR(date) = YEAR(CURDATE()) 
          AND JSON_EXTRACT(data, '$.status') = 'success'
    ";

                                // Sorguyu hazırlama ve çalıştırma
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $toplamTutar = $result['toplam_tutar'];
                                $satirSayisi = $result['satir_sayisi'];





                                ?>

                                <tr>

                                    <td><?=$ay?></td>
                                    <td><?=ayAdiGetir($ay).' '.date('Y')?></td>
                                    <td><?= $satirSayisi ?></td>
                                    <td><?= $toplamTutar ?> TL</td>

                                </tr>

                                <?php

                                if ($ay == date('m')) {
                                    $loop = false;
                                } $ay++;


                            endwhile;    ?>

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>
