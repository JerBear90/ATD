<!DOCTYPE html>   
<html>
<head>
	<meta charset="utf-8">
	<title>Your Title</title>
</head>
<body>
<?php

$OrderInfo = json_decode($_COOKIE['OrderInfo']);

var_dump($OrderInfo);
echo '<hr>';

$shippingfromcity = $OrderInfo->shippingfromcity;

echo $shippingfromcity;
?>
	
</body>
</html>