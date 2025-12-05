<?php
$city = "HATAY"; // Şehir adı
$image_url = "http://www.mgm.gov.tr/sunum/tahmin-show-2.aspx?m=" . $city . "&basla=1&bitir=5";
echo "<img src='{$image_url}' alt='5 Günlük Hava Durumu - {$city}'>";
?>