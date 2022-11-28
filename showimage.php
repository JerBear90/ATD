<?php
$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "http://api.autotransportdirect.com/count/",
    CURLOPT_POST           => false,
    CURLOPT_RETURNTRANSFER => true);
curl_setopt_array($ch, $curlConfig);
$randimgnum = curl_exec($ch);
curl_close($ch);

echo "Image: " . $randimgnum . "<br><br>";
echo "<img src='/wp-content/themes/atdv2/images/home-slider-$randimgnum.jpg' />";