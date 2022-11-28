<?php
$CurrentUsername = $_SESSION['rep'];



//Check Banned IPs & GUIDs
$currentip = GetIP();
$banned = CheckBan($currentip,$guid);
if ($banned == "1") {
    redirect('https://www.autotransportdirect.com/?quoteerror=limit'); 
}


$DateAvailable = postdb('DateAvailable');
$shippingnextseven = postdb('shippingnextseven');
$clearsession = postdb('clearsession');

$shippingfromzip = postdb('shippingfromzip');
$shippingfromcity = postdb('shippingfromcity');
$shippingfromstate = postdb('shippingfromstate');
$shippingtozip = postdb('shippingtozip');
$shippingtocity = postdb('shippingtocity');
$shippingtostate = postdb('shippingtostate');

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


//Set session data
$_SESSION["DateAvailable"] = $DateAvailable;
$_SESSION["shippingnextseven"] = $shippingnextseven;

$_SESSION["shippingfromzip"] = $shippingfromzip;
$_SESSION["shippingfromcity"] = $shippingfromcity;
$_SESSION["shippingfromstate"] = $shippingfromstate;
$_SESSION["shippingtozip"] = $shippingtozip;
$_SESSION["shippingtocity"] = $shippingtocity;
$_SESSION["shippingtostate"] = $shippingtostate;

$_SESSION["auto_year"] = $auto_year;
$_SESSION["auto_make"] = $auto_make;
$_SESSION["auto_make_index"] = $_POST["auto_make_index"];
$_SESSION["auto_model"] = $auto_model;
$_SESSION["auto_model_index"] = $_POST["auto_model_index"];

$_SESSION["vehicle_operational"] = $vehicle_operational;
$_SESSION["vehicle_trailer"] = $vehicle_trailer;

$_SESSION["howmany"]=$howmany;
$_SESSION["numvehicles"]=$numvehicles;

if ($howmany != "onevehicle") {
	$_SESSION["auto_year2"] = $auto_year2;
	$_SESSION["auto_make2"] = $auto_make2;
	$_SESSION["auto_model2"] = $auto_model2;
	$_SESSION["auto_year3"] = $auto_year3;
	$_SESSION["auto_make3"] = $auto_make3;
	$_SESSION["auto_model3"] = $auto_model3;
	$_SESSION["auto_year4"] = $auto_year4;
	$_SESSION["auto_make4"] = $auto_make4;
	$_SESSION["auto_model4"] = $auto_model4;
	$_SESSION["auto_year5"] = $auto_year5;
	$_SESSION["auto_make5"] = $auto_make5;
	$_SESSION["auto_model5"] = $auto_model5;
}


if (session('SRCUsername') != '') {
    $CurrentUsername = session('SRCUsername');
}


//Find cities/states from zip codess
if (!empty($shippingfromzip)) {
	$sql = "select City,CityAliasName,State from zipcodesv2 where ZipCode='$shippingfromzip' ORDER BY FIELD(CityType,'P','B'), City";
	$citiesinzip = $wpdb->get_results($sql,ARRAY_A);

	if ($wpdb->num_rows > 1) {
        $shippingfromcities = array();
        foreach ($citiesinzip as $citystate) {
        	array_push($shippingfromcities, $citystate);
        }
	} elseif ($wpdb->num_rows == 1) {
    	foreach ($citiesinzip as $cityinzip) {
            $shippingfromcity = $cityinzip["CityAliasName"];
            $shippingfromstate = $cityinzip["State"];
    	}
	} else {
    	redirect('https://www.autotransportdirect.com/?quoteerror=notfoundfrom');
	}
}

if (!empty($shippingtozip)) {
	$sql = "select City,CityAliasName,State from zipcodesv2 where ZipCode='$shippingtozip' ORDER BY FIELD(CityType,'P','B'), City";
	$citiesinzip = $wpdb->get_results($sql,ARRAY_A);
	
	if ($wpdb->num_rows > 1) {
        $shippingtocities = array();
        foreach ($citiesinzip as $citystate) {
        	array_push($shippingtocities, $citystate);
        }
	} elseif ($wpdb->num_rows == 1) {
    	foreach ($citiesinzip as $cityinzip) {
            $shippingtocity = $cityinzip["CityAliasName"];
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


//Find Zip Codes from city/state
if (empty($shippingfromzip)) {
    if (empty($shippingfromcity) || empty($shippingfromstate)) {
		//Did not fill out zip code and did not full fill out city/state req.
		redirect('https://www.autotransportdirect.com/?quoteerror=from');
	}
    
    $sql = "select ZipCode from zipcodesv2 where (City = '$shippingfromcity' or CityAliasName = '$shippingfromcity') and State = '$shippingfromstate' limit 1";
	$fromzips = $wpdb->get_results($sql,ARRAY_A);
    
	if ($wpdb->num_rows > 0) {
        foreach ($fromzips as $fromzip) {
        	$shippingfromzip = $fromzip['ZipCode'];
        }
	} else {
    	redirect('https://www.autotransportdirect.com/?quoteerror=notfoundfrom&quoteaction=redo');
	}
	
	$sql = "select State,StateName from states where state = '$shippingfromstate' limit 1";
	$fromstates = $wpdb->get_results($sql,ARRAY_A);
	foreach ($fromstates as $fromstate) {
        $shippingfromstateabbr = $fromstate['State'];
        $shippingfromstate = $fromstate['StateName'];
    }
}

if (empty($shippingtozip)) {
    if (empty($shippingtocity) || empty($shippingtostate)) {
		//Did not fill out zip code and did not full fill out city/state req.
		redirect('https://www.autotransportdirect.com/?quoteerror=to');
	}
    
    $sql = "select ZipCode from zipcodesv2 where (City = '$shippingtocity' or CityAliasName = '$shippingtocity') and State = '$shippingtostate' limit 1";
	$tozips = $wpdb->get_results($sql,ARRAY_A);

	
	if ($wpdb->num_rows > 0) {
        foreach ($tozips as $tozip) {
        	$shippingtozip = $tozip['ZipCode'];
        }
	} else {
    	redirect('https://www.autotransportdirect.com/?quoteerror=notfoundto&quoteaction=redo');
	}
	
	$sql = "select State,StateName from states where state = '$shippingtostate' limit 1";
	$tostates = $wpdb->get_results($sql,ARRAY_A);
	foreach ($tostates as $tostate) {
        $shippingtostateabbr = $tostate['State'];
        $shippingtostate = $tostate['StateName'];
    }	
}


//Get Distance
$totaldistance = getdistance($shippingfromzip,$shippingtozip);

    
//SALES CONVERSION UPDATE start
if(!empty($_SESSION['rep'])) {
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
			$_SESSION['trackid'] = $trackid;
			$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '1. Quote' where trackid = '$trackid'";
			$wpdb->query($sql);
	   	} else {
	   		$newsession = 1;
		}
	}
} else {
	$newsession = 1;
}

if ($newsession == 1) {
	$trackid = uniqid(true);
	$_SESSION['trackid'] = $trackid;
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
    
	$sql = "insert into sale_conversion (sitename,trackid,guid,username,dateadded,dateupdated,sale_status,ipnumber,quote_distance,fromzip,fromstate,tozip,tostate,num_of_vehicles,auto_year,auto_make,auto_model,user_agent) values ('autotransportdirect.com','$trackid','$guid','$CurrentUsername',NOW(),NOW(),'1. Quote','$ipnumber','$totaldistance','$shippingfromzip','$shippingfromstate','$shippingtozip','$shippingtostate','$numvehicles','$auto_year','$auto_make','$auto_model','$useragent')";
	$wpdb->query($sql);
}

//SALES CONVERSION UPDATE end



if ($shippingfromstate == 'HI' || $shippingtostate == 'HI') {
    redirect('https://www.autotransportdirect.com/?quoteerror=HI'); 
}


if ($shippingfromstate == 'AK' || $shippingtostate == 'AK') {
    redirect('https://www.autotransportdirect.com/?quoteerror=AK'); 
}



if(!empty($shippingfromcities) || !empty($shippingtocities)) {
?>  
    <div class="smart-forms">

        <div class="section fieldentry">
            <div class="frm-row">
                <div class="colm colm12">
                    <h1 style="margin: 30px 0 5px;">Choose City</h1>
                    <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                </div>
            </div>
        </div>
    	
    	
    	<div class="section fieldentry">
            <div class="frm-row">
                <div class="colm colm1"></div>
                <div class="colm colm3">
                    <div class="imagebox">
                        <img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1a-1-v4.jpg" style="width: 260px;" alt="Direct Express Auto Transport Employee" />
                    	<div>We are celebrating 10 years in business! Thank you for your support.</div>
                    </div><br>
                </div>
                <div class="colm colm7">
                	<form action="?step=3" method="post" name="mainform" id="mainform">
                	<input type="hidden" name="shippingfromzip" value="<?php echo $shippingfromzip ?>">
                	<input type="hidden" name="shippingfromcity" value="<?php echo $shippingfromcity ?>">
                	<input type="hidden" name="shippingfromstate" value="<?php echo $shippingfromstate ?>">
                	<input type="hidden" name="shippingtozip" value="<?php echo $shippingtozip ?>">
                	<input type="hidden" name="shippingtocity" value="<?php echo $shippingtocity ?>">
                	<input type="hidden" name="shippingtostate" value="<?php echo $shippingtostate ?>">
                	<input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">
                
                	<input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
                	<input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">
                	<input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
                	<input type="hidden" name="vehicle_operational" value="<?php echo $vehicle_operational ?>">
                	<input type="hidden" name="vehicle_trailer" value="<?php echo $vehicle_trailer ?>">
                
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
                
                
                    <div class="frm-row">
                	<?php if (!empty($shippingfromcities)) { ?>
                            <div class="colm colm4">
                                <strong>Shipping From:</strong>
                            </div>
                            <div class="colm colm8">
                            	<label for="shippingfromcitystate" class="field select">
                                	<select name="shippingfromcitystate" style="display:inline-block;">
                                	<?php
                                	foreach ($shippingfromcities as $shippingfromcitygrp) {
                                    	$city = $shippingfromcitygrp['CityAliasName'];
                                    	$statecode = $shippingfromcitygrp['State'];
                                    	echo "<option value='$city, $statecode'>$city, $statecode</option>";
                                    }		
                                    ?>
                                	</select>
                            	<i class="arrow"></i>
                                </label>
                            </div>
                	<?php } else { ?>
                	    <div class="colm colm4">
                    	    <strong>Shipping From:</strong>
                	    </div>
                	    <div class="colm colm8">
                        <?php echo $shippingfromcity ?>, <?php echo $shippingfromstate ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingfromzip ?>
                	    </div>
                	<?php } ?>
                    </div>
                	
                	<div class="frm-row">
                    <?php if (!empty($shippingtocities)) { ?>
                    	<div class="colm colm4">
                        	<strong>Shipping To:</strong>
                    	</div>
                    	<div class="colm colm8">
                        	<label for="shippingtocitystate" class="field select">
                            	<select name="shippingtocitystate" class="bodytext">
                                <?php
                            	foreach ($shippingtocities as $shippingtocitygrp) {
                                	$city = $shippingtocitygrp['CityAliasName'];
                                	$statecode = $shippingtocitygrp['State'];
                                	echo "<option value='$city, $statecode'>$city, $statecode</option>";
                                }		
                                ?>
                            	</select>
                                <i class="arrow"></i>
                            </label>
                    	</div>
                	<?php } else { ?>
                    	<div class="colm colm4">
                    	    <strong>Shipping To:</strong>
                    	</div>
                    	<div class="colm colm8">
                        	<?php echo $shippingtocity ?>, <?php echo $shippingtostate ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingtozip ?>
                    	</div>
                	<?php } ?>
                	</div>
                
                
                    <div class="frm-row">
                    <?php if ($howmany != "onevehicle") { ?>
                        <div class="colm colm4">
                            <strong>Types of Vehicles:</strong>
                        </div>
                        <div class="colm colm8">
                        	<div class="numbutton1">1</div><div class="makemodel"><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></div><div style="clear:both"></div>
                        	<?php if(!empty($auto_make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $auto_year2 ?> - <?php echo $auto_make2 ?> - <?php echo $auto_model2 ?></div><div style="clear:both"></div><?php } ?>
                        	<?php if(!empty($auto_make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $auto_year3 ?> - <?php echo $auto_make3 ?> - <?php echo $auto_model3 ?></div><div style="clear:both"></div><?php } ?>
                        	<?php if(!empty($auto_make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $auto_year4 ?> - <?php echo $auto_make4 ?> - <?php echo $auto_model4 ?></div><div style="clear:both"></div><?php } ?>
                        	<?php if(!empty($auto_make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $auto_year5 ?> - <?php echo $auto_make5 ?> - <?php echo $auto_model5 ?></div><div style="clear:both"></div><?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="colm colm4">
                            <strong>Type of Vehicle:</strong>
                        </div>
                        <div class="colm colm8">
                            <?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?>
                        </div>
                    <?php } ?>
                    </div>
                    
                	<div class="frm-row">
                    	<div class="colm colm4">
                            <strong>Operating Condition:</strong>
                    	</div>
                    	<div class="colm colm8">
                        	<?php echo $vehicle_operational ?> and Rolls, Brakes, Steers
                    	</div>
                	</div>
                	
                	<div class="frm-row">
                    	<div class="colm colm4">
                            <strong>Type of Trailer:</strong>
                    	</div>
                    	<div class="colm colm8">
                            <?php echo $vehicle_trailer ?>
                    	</div>
                	</div>
                	
                    <div class="frm-row">
                        <div class="colm colm4"></div>
                        <div class="colm colm6">
                            <div style="margin-bottom: 8px;"></div>
                        	<strong><span style="color: #308DFF; font-size:15px; line-height: 16px;">Your quote will appear in a few seconds right here online.</span></strong>
                            <div style="margin-bottom: 8px;"></div>
                        </div>
                    </div>
                    <div class="frm-row">
                        <div class="colm colm4"></div>
                        <div class="colm colm4">
                        	<button type="submit" class="goonbutton">
                                Go On&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                	</form>
                </div>
                <div class="colm colm1"></div>
            </div>
    	
	</div>
<?php } else { ?>

	<br><br><br>

	<div align="center"><strong>Please Wait....We are calculating your quote.</strong></div>
	<br><br><br><br><br><br><br><br><br>

	<form action="?step=3" method="post" name="mainform" target="_top">
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
<?php    
}



    
?>