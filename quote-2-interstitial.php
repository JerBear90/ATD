<?php
global $DEATDepositInitial;
$_SESSION['DEATDeposit'] = $DEATDepositInitial;

$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);
	
$CurrentUsername = $_COOKIE['rep'];


//Check Banned IPs & GUIDs
$currentip = GetIP();
$banned = CheckBan($currentip,$guid);
if ($banned == "1") {
    redirect('https://www.autotransportdirect.com/?quoteerror=limit'); 
}
// $pic = $_GET['pic'];

$DateAvailable = postdb('DateAvailable');
$shippingnextseven = postdb('shippingnextseven');
$clearsession = postdb('clearsession');

$shippingfromzipentry = postdb('shippingfromzipentry');
$shippingfromzip = postdb('shippingfromzip');
$shippingfromcity = postdb('shippingfromcity');
$shippingfromstate = postdb('shippingfromstate');
$shippingtozipentry = postdb('shippingtozipentry');
$shippingtozip = postdb('shippingtozip');
$shippingtocity = postdb('shippingtocity');
$shippingtostate = postdb('shippingtostate');

//Key West Fix
if ($shippingfromzip=='33040') {
	$shippingfromzip='33041';
}

if ($shippingtozip=='33040') {
	$shippingtozip='33041';
}


$auto_year = postdb('auto_year');
$auto_make = postdb('auto_make');
$auto_model = postdb('auto_model');
$vehicle_operational = postdb('vehicle_operational');
$vehicle_trailer = postdb('vehicle_trailer');

$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');

if ($numvehicles=="1") {
	$howmany = "onevehicle";
	$multi_vehicle=0;
} else {
	$multi_vehicle=1;
}

$auto_year2 = postdb('auto_year2');
$auto_make2 = postdb('auto_make2');
$auto_model2 = postdb('auto_model2');
$auto_year3 = postdb('auto_year3');
$auto_make3 = postdb('auto_make3');
$auto_model3 = postdb('auto_model3');
$auto_year4 = postdb('auto_year4');
$auto_make4 = postdb('auto_make4');
$auto_model4 = postdb('auto_model4');
$auto_year5 = postdb('auto_year5');
$auto_make5 = postdb('auto_make5');
$auto_model5 = postdb('auto_model5');



// Auto Enclosed Check START
$auto_enclosedonly=0;
$vehicle_trailer_forced=0;

if (!empty($auto_year)) {	
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year2 && $auto_enclosedonly==0)) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year2'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year3 && $auto_enclosedonly==0)) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year3'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year4 && $auto_enclosedonly==0)) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year4'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year5 && $auto_enclosedonly==0)) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year5'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}


if (!empty($auto_make) && !empty($auto_model) && $auto_enclosedonly==0) {	
	$sql = "select auto_enclosedonly from automobiles where auto_make='$auto_make' and auto_model='$auto_model'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_make2) && !empty($auto_model2) && $auto_enclosedonly==0) {	
	$sql = "select auto_enclosedonly from automobiles where auto_make='$auto_make2' and auto_model='$auto_model2'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_make3) && !empty($auto_model3) && $auto_enclosedonly==0) {	
	$sql = "select auto_enclosedonly from automobiles where auto_make='$auto_make3' and auto_model='$auto_model3'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_make4) && !empty($auto_model4) && $auto_enclosedonly==0) {	
	$sql = "select auto_enclosedonly from automobiles where auto_make='$auto_make4' and auto_model='$auto_model4'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_make5) && !empty($auto_model5) && $auto_enclosedonly==0) {	
	$sql = "select auto_enclosedonly from automobiles where auto_make='$auto_make5' and auto_model='$auto_model5'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}

if ($auto_enclosedonly==1) {
	$vehicle_trailer='Enclosed';
	$vehicle_trailer_forced=1;
}
// Auto Enclosed Check END



//Set session data
$getOrderInfo->DateAvailable = $DateAvailable;

$getOrderInfo->shippingfromzip = $shippingfromzip;
$getOrderInfo->shippingfromcity = $shippingfromcity;
$getOrderInfo->shippingfromstate = $shippingfromstate;
$getOrderInfo->shippingtozip = $shippingtozip;
$getOrderInfo->shippingtocity = $shippingtocity;
$getOrderInfo->shippingtostate = $shippingtostate;

$getOrderInfo->auto_year = $auto_year;
$getOrderInfo->auto_make = $auto_make;
$getOrderInfo->auto_model = $auto_model;

$getOrderInfo->vehicle_operational = $vehicle_operational;
$getOrderInfo->vehicle_trailer = $vehicle_trailer;

$getOrderInfo->howmany = $howmany;
$getOrderInfo->numvehicles = $numvehicles;

if ($howmany != "onevehicle") {
	$getOrderInfo->auto_year2 = $auto_year2;
	$getOrderInfo->auto_make2 = $auto_make2;
	$getOrderInfo->auto_model2 = $auto_model2;
	$getOrderInfo->auto_year3 = $auto_year3;
	$getOrderInfo->auto_make3 = $auto_make3;
	$getOrderInfo->auto_model3 = $auto_model3;
	$getOrderInfo->auto_year4 = $auto_year4;
	$getOrderInfo->auto_make4 = $auto_make4;
	$getOrderInfo->auto_model4 = $auto_model4;
	$getOrderInfo->auto_year5 = $auto_year5;
	$getOrderInfo->auto_make5 = $auto_make5;
	$getOrderInfo->auto_model5 = $auto_model5;
}


$getOrderInfoWrite = json_encode($getOrderInfo);
setcookie("OrderInfo", $getOrderInfoWrite, 0, "/");


if ($_COOKIE['SRCUsername'] != '') {
    $CurrentUsername = $_COOKIE['SRCUsername'];
}



//Find cities/states from zip codess
if (!empty($shippingfromzipentry) && empty($shippingfromzip)) {
	$shippingfromzip=$shippingfromzipentry;
	$sql = "select City,CityAliasName,State from zipcodesv2 where ZipCode='$shippingfromzip' ORDER BY FIELD(CityType,'P','B'), City limit 0,1";
	$citiesinzip = $wpdb->get_results($sql,ARRAY_A);

	if ($wpdb->num_rows > 1) {
        $shippingfromcities = array();
        foreach ($citiesinzip as $citystate) {
        	array_push($shippingfromcities, $citystate);
        }
	} elseif ($wpdb->num_rows == 1) {
    	foreach ($citiesinzip as $cityinzip) {
            $shippingfromcity = $cityinzip["CityAliasName"];
            $shippingfromcity = ucwords(strtolower($shippingfromcity));
            $shippingfromstate = $cityinzip["State"];
    	}
	} else {
    	redirect('https://www.autotransportdirect.com/?quoteerror=notfoundfrom');
	}
}

if (!empty($shippingtozipentry) && empty($shippingtozip)) {
	$shippingtozip=$shippingtozipentry;
	$sql = "select City,CityAliasName,State from zipcodesv2 where ZipCode='$shippingtozip' ORDER BY FIELD(CityType,'P','B'), City limit 0,1";
	$citiesinzip = $wpdb->get_results($sql,ARRAY_A);
	
	if ($wpdb->num_rows > 1) {
        $shippingtocities = array();
        foreach ($citiesinzip as $citystate) {
        	array_push($shippingtocities, $citystate);
        }
	} elseif ($wpdb->num_rows == 1) {
    	foreach ($citiesinzip as $cityinzip) {
            $shippingtocity = $cityinzip["CityAliasName"];
            $shippingtocity = ucwords(strtolower($shippingtocity));
            $shippingtostate = $cityinzip["State"];
    	}
	} else {
    	redirect('https://www.autotransportdirect.com/?quoteerror=notfoundto');
	}
}

//Convert forts and saints
if (substr($shippingfromcity, 0, 3)=='ft ' || substr($shippingfromcity, 0, 4)=='ft. ') {
    $shippingfromcity = str_ireplace('ft. ', 'Fort ', $shippingfromcity);
    $shippingfromcity = str_ireplace('ft ', 'Fort ', $shippingfromcity);
}
if (substr($shippingfromcity, 0, 3)=='st ' || substr($shippingfromcity, 0, 4)=='st. ') {
    $shippingfromcity = str_ireplace('st. ', 'Saint ', $shippingfromcity);
    $shippingfromcity = str_ireplace('st ', 'Saint ', $shippingfromcity);
}
if (substr($shippingtocity, 0, 3)=='ft ' || substr($shippingtocity, 0, 4)=='ft. ') {
    $shippingtocity = str_ireplace('ft. ', 'Fort ', $shippingtocity);
    $shippingtocity = str_ireplace('ft ', 'Fort ', $shippingtocity);
}
if (substr($shippingtocity, 0, 3)=='st ' || substr($shippingtocity, 0, 4)=='st. ') {
    $shippingtocity = str_ireplace('st. ', 'Saint ', $shippingtocity);
    $shippingtocity = str_ireplace('st ', 'Saint ', $shippingtocity);
}


//Get Distance
$totaldistance = getdistance($shippingfromzip,$shippingtozip);
/*

echo $totaldistance . "!";
exit;
*/

if ($totaldistance==0) {
    redirect('https://www.autotransportdirect.com/?quoteerror=distance&quoteaction=redo');
}


//SALES CONVERSION UPDATE start
/*
if(!empty($CurrentUsername)) {
	//Grab this user's last session time and guid
	$sql = "SELECT UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(dateupdated) AS seconds_ago,dateupdated,trackid from sale_conversion where username='$CurrentUsername' order by dateupdated desc limit 0,1";
	$gettime = $wpdb->get_row($sql,ARRAY_A);

	//If we couldn't find a session for this user, start a new one
	if ($wpdb->num_rows == 0) {
		$newsession = 1;
	//If we found a session, calculate the time difference and if it is less than or equal to 30 seconds, update the record and set the session guid.
	} else {
        $timediff = $gettime['seconds_ago'];
        if($timediff <= 180 && ($clearsession != 1 || empty($clearsession))) {
			$trackid = $gettime['trackid'];
			setcookie("trackid", $trackid, 0, "/");
			$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '1. Quote Summary' where trackid = '$trackid'";
			$wpdb->query($sql);
	   	} else {
	   		$newsession = 1;
		}
	}
} else {
	$newsession = 1;
}
*/

$newsession = 1;

if ($newsession == 1) {
	$trackid = uniqid(true);
	setcookie("trackid", $trackid, 0, "/");
	$ipnumber = getClientIP();

	if ($shippingfromstate == "0" || empty($shippingfromstate)) {
		$sql = "select State from zipcodesv2 where ZipCode = '$shippingfromzip' limit 0,1";
		$RsZip = $wpdb->get_row($sql,ARRAY_A);
        $shippingfromstate = $RsZip['State'];
	}

	if ($shippingtostate == "0" || empty($shippingtostate)) {
		$sql = "select State from zipcodesv2 where ZipCode = '$shippingtozip' limit 0,1";
		$RsZip2 = $wpdb->get_row($sql,ARRAY_A);
		$shippingtostate = $RsZip2['State'];
		
	}

    
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    
	$sql = "insert into sale_conversion (sitename,trackid,guid,username,dateadded,dateupdated,sale_status,ipnumber,quote_distance,fromzip,fromstate,tozip,tostate,num_of_vehicles,auto_year,auto_make,auto_model,user_agent) values ('autotransportdirect.com','$trackid','$guid','$CurrentUsername',NOW(),NOW(),'1. Quote Summary','$ipnumber','$totaldistance','$shippingfromzip','$shippingfromstate','$shippingtozip','$shippingtostate','$numvehicles','$auto_year','$auto_make','$auto_model','$useragent')";
	$wpdb->query($sql);
}

//SALES CONVERSION UPDATE end



if ($shippingfromstate == 'HI' || $shippingtostate == 'HI') {
    redirect('https://www.autotransportdirect.com/?quoteerror=HI'); 
}


if ($shippingfromstate == 'AK' || $shippingtostate == 'AK') {
    redirect('https://www.autotransportdirect.com/?quoteerror=AK'); 
}



?>
<!--
	<br><br><br>

	<div align="center"><strong>Please Wait....We are calculating your quote.</strong></div>
	<br><br><br><br><br><br><br><br><br>
-->


<div class="interstitialcontent" style="font-size:30px; line-height:40px; width:85%; margin:0 auto; text-align: center;">
    <br>
    Your very reliable auto shipping quote will appear in <span id="timer">10</span> seconds ...
    <br><br>
    <div align="center" style="margin-top:15px">
    <img src="//d36b03yirdy1u9.cloudfront.net/images/5star-orange2.png" /><br>
    <span style="font-weight:bold;color:#f2a93b;">Google Plus</span> members give <span style="font-weight:bold;color:#f2a93b;">5 STARS</span> (373 Reviews) to<br>
    <strong>Direct Express Auto Transport</strong>
    </div>
    <br><br>
<!--     <div class="trustpilot-widget" style="height:150px;" data-locale="en-US" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="5195d470000064000530e14c" data-style-height="150px" data-style-width="100%" data-theme="light"></div> -->
    
    <div style="float:left;margin-right:20px;"><iframe width="284" height="160" src="https://www.youtube.com/embed/OAcKVBn0zzI?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe></div><div style="margin-top:15px;"></div>Did you know <strong>Direct Express Auto Transport</strong> originated the instant online quote calculator<br>to ship your car? 
    <div style="clear:both;"></div><br>
    
    <div align="center" style="margin-top:15px">
    <img src="//d36b03yirdy1u9.cloudfront.net/images/5star-blue2.png" /><br>
    <span style="font-weight:bold;color:#605f64;">Better Business Bureau</span> gives <span style="font-weight:bold;color:#605f64;">5 STARS</span> (157 Reviews) to<br>
    <strong>Direct Express Auto Transport</strong>
    </div>
    <br><br>
    <img src="//d36b03yirdy1u9.cloudfront.net/images-v3/auto_transport_promo_v2-m.jpg" style="float:right;margin-left:20px;border:1px solid #666;" /><div style="margin-top:35px;"></div><strong>We respect your privacy</strong> and do not ask for your name, email address or phone number prior to giving a quote. 
    <div style="clear:both;"></div><br>
</div>



<form action="?step=3" method="post" name="mainform" id="mainform" target="_top">
<input type="hidden" name="shippingfromzip" value="<?php echo $shippingfromzip ?>">
<input type="hidden" name="shippingfromcity" value="<?php echo $shippingfromcity ?>">
<input type="hidden" name="shippingfromstate" value="<?php echo $shippingfromstate ?>">
<input type="hidden" name="shippingtozip" value="<?php echo $shippingtozip ?>">
<input type="hidden" name="shippingtocity" value="<?php echo $shippingtocity ?>">
<input type="hidden" name="shippingtostate" value="<?php echo $shippingtostate ?>">
<input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">
<input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
<input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
<input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">
<input type="hidden" name="vehicle_operational" value="<?php echo $vehicle_operational ?>">
<input type="hidden" name="vehicle_trailer" value="<?php echo $vehicle_trailer ?>">
<input type="hidden" name="vehicle_trailer_forced" value="<?php echo $vehicle_trailer_forced ?>">
<input type="hidden" name="howmany" value="<?php echo $howmany ?>">
<input type="hidden" name="numvehicles" value="<?php echo $numvehicles ?>">


<?php if($howmany != "onevehicle") { ?>
<input type="hidden" name="auto_year2" value="<?php echo $auto_year2 ?>">
<input type="hidden" name="auto_make2" value="<?php echo $auto_make2 ?>">
<input type="hidden" name="auto_model2" value="<?php echo $auto_model2 ?>">
<input type="hidden" name="auto_year3" value="<?php echo $auto_year3 ?>">
<input type="hidden" name="auto_make3" value="<?php echo $auto_make3 ?>">
<input type="hidden" name="auto_model3" value="<?php echo $auto_model3 ?>">
<input type="hidden" name="auto_year4" value="<?php echo $auto_year4 ?>">
<input type="hidden" name="auto_make4" value="<?php echo $auto_make4 ?>">
<input type="hidden" name="auto_model4" value="<?php echo $auto_model4 ?>">
<input type="hidden" name="auto_year5" value="<?php echo $auto_year5 ?>">
<input type="hidden" name="auto_make5" value="<?php echo $auto_make5 ?>">
<input type="hidden" name="auto_model5" value="<?php echo $auto_model5 ?>">
<?php } ?>

</form>
<script language="JavaScript">
<?php if($_COOKIE['admin']!="") { ?>
	document.mainform.submit();
<?php } else { ?>
	$(function() {
	  setTimeout(function() {
	   $('#mainform').submit();
	  }, 5000);
	});
<?php } ?>
</script>
