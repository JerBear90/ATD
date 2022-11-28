<!DOCTYPE html>   
<html>
<head>
	<meta charset="utf-8">
	<title>Your Title</title>
</head>
<body>


<?php
$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);

echo $getOrderInfo->shippingfromcity;


?>
	
	
</body>
</html>