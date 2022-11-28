<!DOCTYPE html>   
<html>
<head>
	<meta charset="utf-8">
	<title>Your Title</title>
</head>
<body>
	
<script>


/*
var getOrderInfo = jQuery.parseJSON(readCookie("OrderInfo"));
console.log(getOrderInfo.shippingfromcity);

getOrderInfo.shippingfromcity = "Rich People City";


createCookie('OrderInfo',JSON.stringify(getOrderInfo));


var getOrderInfo2 = jQuery.parseJSON(readCookie("OrderInfo"));
console.log(getOrderInfo2.shippingfromcity);
*/

</script>


<?php
$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);

echo $getOrderInfo->shippingfromcity;


$getOrderInfo->shippingfromcity = "Rich People City";


$getOrderInfo2 = json_encode($getOrderInfo);

setcookie("OrderInfo", $getOrderInfo2, 0, "/");


?>
	
</body>
</html>