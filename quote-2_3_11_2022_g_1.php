<?php
/*
global $DEATDepositInitial;
$_SESSION['DEATDeposit'] = $DEATDepositInitial;
*/

$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);
	
$CurrentUsername = $_COOKIE['rep'];


//Check Banned IPs & GUIDs
$currentip = GetIP();
$banned = CheckBan($currentip,$guid);
if ($banned == "1") {
    redirect('https://www.staging.autotransportdirect.com/?quoteerror=limit'); 
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


if (empty($auto_year) || empty($auto_make) || empty($auto_model)) {
	redirect('https://www.staging.autotransportdirect.com/?quoteerror=yearmakemodel');
}


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
if (!empty($auto_year2) && $auto_enclosedonly==0) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year2'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year3) && $auto_enclosedonly==0) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year3'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year4) && $auto_enclosedonly==0) {
	$sql = "select auto_enclosedonly from year_multiplier where auto_year='$auto_year4'";
	$checkenclosedonly = $wpdb->get_results($sql,ARRAY_A);
	foreach ($checkenclosedonly as $eo) {
        $auto_enclosedonly = $eo["auto_enclosedonly"];
	}
}
if (!empty($auto_year5) && $auto_enclosedonly==0) {
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
    	redirect('https://www.staging.autotransportdirect.com/?quoteerror=notfoundfrom');
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
    	redirect('https://www.staging.autotransportdirect.com/?quoteerror=notfoundto');
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
    redirect('https://www.staging.autotransportdirect.com/?quoteerror=distance&quoteaction=redo');
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
    
	$sql = "insert into sale_conversion (sitename,trackid,guid,username,dateadded,dateupdated,sale_status,ipnumber,quote_distance,fromzip,fromcity,fromstate,tozip,tocity,tostate,num_of_vehicles,auto_year,auto_make,auto_model,user_agent) values ('autotransportdirect.com','$trackid','$guid','$CurrentUsername',NOW(),NOW(),'1. Quote Summary','$ipnumber','$totaldistance','$shippingfromzip','$shippingfromcity','$shippingfromstate','$shippingtozip','$shippingtocity','$shippingtostate','$numvehicles','$auto_year','$auto_make','$auto_model','$useragent')";
	$wpdb->query($sql);
}

//SALES CONVERSION UPDATE end



if ($shippingfromstate == 'HI' || $shippingtostate == 'HI') {
    redirect('https://www.staging.autotransportdirect.com/?quoteerror=HI'); 
}


if ($shippingfromstate == 'AK' || $shippingtostate == 'AK') {
    redirect('https://www.staging.autotransportdirect.com/?quoteerror=AK'); 
}



?>
<style>
body.page-id-21054 {
	display: none !important;
}
	
</style>

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
document.mainform.submit();
</script>
