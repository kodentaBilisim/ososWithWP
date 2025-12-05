<?php

$KampanyaID = $_GET['id'];

$KampanyaMeta = $db->from( 'kampanya' )->where( 'id', $KampanyaID )->first();

//and $KampanyaMeta['raporTime'] > time() - 60 )



if($KampanyaMeta['raporTime'] < time() - 60){
    $rapor = $netgsm->smsRapor( $KampanyaMeta['campaignId'] );

    $db->update( 'kampanya' )->where( 'id', $KampanyaID )->set( [
        'rapor'     => json_encode(simplexml_load_string($rapor)),
        'raportime' => time()
    ] );

}else{

    $rapor = $KampanyaMeta['rapor'];
}



$toplam = 0;
$status = array();
$kredi  = 0;

echo $rapor;

// Create an XML object
var_dump(simplexml_load_string($rapor));

// Get the telno elements
//$telnoElements = $xmlObj->xpath('//mainbody/telno');

// Loop through the telno elements
foreach ($telnoElements as $telnoElement) {

    var_dump($telnoElement);


	// Get the jobid attribute
	$jobid = $telnoElement->attributes()->jobid;

	// Get the durum attribute
	$durum = $telnoElement->attributes()->durum;

	// Get the operator attribute
	$operator = $telnoElement->attributes()->operator;

	// Get the msg_boyu attribute
	$msg_boyu = $telnoElement->attributes()->msg_boyu;

	// Get the iletim_tarihi attribute
	$iletim_tarihi = $telnoElement->attributes()->iletim_tarihi;

	// Get the failreason attribute
	$failreason = $telnoElement->attributes()->failreason;
	if ( ! in_array( $durum, $status ) ) {
        echo 'EKLENDİ<br>';

		$status[ "s-" . $durum ] = 1;
	} else {
        echo 'ARTIRILDI<br>';

		$status[ "s-" .$durum ] ++;
	}
	var_dump($status);
	if ( $durum == 1 ) {
		$kredi += $msg_boyu;
	}


	$toplam ++;
}



?>
<div class="page-content">
    <div class="container-fluid">
        <section>
            <div class="row">

                <div class="col-md-6 col-12 text-center">
                    <div class="alert alert-success mb-2" role="alert">
						<?php if ( !isset($status["s-0"]) OR $status["s-0"] != 0 ) {
							echo '<h3>GÖNDERİM DEVAM EDİYOR</h3>';
						} else {
							echo '<h3>GÖNDERİM TAMAMLANDI</h3>';
						} ?>
                    </div>
                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Gönderim Zamanı: <?php echo $KampanyaMeta['date']; ?></h3>

                    </div>
                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Kesinleşmiş Harcanan Kredi: <?php echo $kredi; ?></h3>
                    </div>
                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Ulaşan Kişi: <?php echo $status["s-1"]; ?></h3>
                    </div>
                </div>
                <div class="col-md-6 col-12 text-center">

                    <div class="alert alert-light mb-2" role="alert">
                        <h3>Mesaj:</h3>
                        <strong><?php echo $KampanyaMeta['mesaj']; ?></strong>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Card sizing section end -->
