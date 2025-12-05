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
                                <th>Üye Adı</th>
                                <th>TELEFON</th>
                                <th>TC</th>
                                <th>İL</th>
                                <th>TUTAR (TL)</th>
                                <th>Üyelik Tarihi</th>
                                <th>Son Ödeme Tarihi</th>

                                <th></th>

                            </tr>


                            </thead>
                            <tbody>

                            <?php


                            $sql = "SELECT user, 
       SUM(tutar) as total_tutar,
       MAX(date) as son_tarih
FROM new_odemeler 
GROUP BY user
    ";

                            // Sorguyu hazırlama ve çalıştırma
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            // Sonuçları dizi olarak al
                            $items = [];
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


                                $personelData =  uyeMeta($row['user']);

                                ?>

                                <tr>
                                    <td><?= $personelData['name'] ?></td>
                                    <td><?= $personelData['telefon'] ?></td>
                                    <td><?= $personelData['tc'] ?></td>
                                    <td><?= ilgetirbyID($personelData['il']) ?></td>
                                    <td><?= $row['total_tutar'] ?></td>
                                    <td><?= date('d.m.Y',strtotime($personelData['uyelikTarihi'])) ?></td>
                                    <td><?= date('d.m.Y',strtotime($row['son_tarih'])) ?></td>



                                    <td>


                                        <a target="_blank"
                                           href="?page=uye/odeme-ayrinti&id=<?= $row['user'] ?>"
                                           class="btn btn-info  ">Ayrıntıları Göster
                                        </a>


                                    </td>

                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
    </div>