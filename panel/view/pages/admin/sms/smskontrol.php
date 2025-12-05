<?php

$KampanyaMeta   = $db->from( 'kampanya' )->where( 'id', $_GET['kampanya'] )->first();
$KampanyaFilter = kampanyafilter( $_GET['kampanya'] );

?>

<script>

    async function smssend() {


        $('#smssendbtn').html('GÖNDERİLİYOR...');
        $("#smssendbtn").removeClass("btn-success").addClass("btn-warning");

        await $.get("api/sms/APISMSSend.php?id=<?php echo $_GET['kampanya']; ?>", function (data) {
            obj = JSON.parse(data);

            console.log(obj.status)

            if (obj.status === 'success') {

                $('#smssendbtn').html('GÖNDERİLDİ');
                $("#smssendbtn").removeClass("btn-warning").addClass("btn-success");
                basari_alert('Rapor Sayfasına Yönlendiriliyorsunuz.')
                setTimeout(function () {
                    window.location.assign("?page=sms/kampanyaraporsingle&id=" + <?php echo $_GET['kampanya']; ?>);
                }, 3000);


            } else {

                $('#smssendbtn').html('HATA OLUŞTU');
                $("#smssendbtn").removeClass("btn-warning").addClass("btn-danger");
                //$("#hataresponse").html(obj.response);
                hata_alert(obj.hata);

            }

        });
    }

</script>
<div class="page-content">
    <div class="container-fluid">
        <section>
            <div class="row">

                <div class="col-12 text-center">
                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Gönderilecek Kişi
                            Sayısı: <?php echo kampanyameta( $_GET['kampanya'], 'count' ); ?></h3>

                        <p> <?php if ( ! empty( $KampanyaMeta['senddate'] ) ) {
								echo 'Zamanlandı: ' . $KampanyaMeta['senddate'];
							} ?></p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Mesaj Metni</h4>
                        </div>
                        <div class="card-body">
                            <p><?php echo $KampanyaMeta['mesaj'] ?></p>
                        </div>
                    </div>

                    <a href="?page=sms/gonder&kampanya=<?php echo $_GET['kampanya'] ?>" type="button"
                       class="btn btn-warning     btn-min-width ">GERİ DÖN</a>
                    <button type="button" onclick="smssend()" class="btn btn-success btn-min-width" id="smssendbtn">GÖNDER</button>
                    <div id="hataresponse"></div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Card sizing section end -->

