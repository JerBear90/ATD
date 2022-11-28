<!DOCTYPE html>   
<html>
<head>
	<meta charset="utf-8">
	<title>Your Title</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	
<script>
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}	

	
	
var OrderInfo = {
    DateAvailable: "2017/10/31",
    shippingnextseven: "",
    intquote: "0",
    shippingfromzip: "90210",
    shippingfromcity: "Beverly Hills",
    shippingfromstate: "CA",
    shippingtozip: "55438",
    shippingtocity: "Bloomington",
    shippingtostate: "MN",    
    vehicle_operational: "vehicle_operational",
    vehicle_trailer: "Open",
    howmany: "onevehicle",
    numvehicles: "1",
    auto_year: "2017",
    auto_make: "Audi",
    auto_model: "A4 Sedan",    
    auto_year2: "",
    auto_make2: "",
    auto_model2: "",
    auto_year3: "",
    auto_make3: "",
    auto_model3: "",
    auto_year4: "",
    auto_make4: "",
    auto_model4: "",
    auto_year5: "",
    auto_make5: "",
    auto_model5: ""
}

var jsonOrderInfo = JSON.stringify(OrderInfo);
createCookie('OrderInfo',jsonOrderInfo);

var getOrderInfo = jQuery.parseJSON(readCookie("OrderInfo"));

console.log(getOrderInfo.shippingfromcity);

</script>
	
<div id="output"></div>
</body>
</html>