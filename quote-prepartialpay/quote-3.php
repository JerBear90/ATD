<?php
$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);
    
$_SESSION['DEATDeposit'] = $_SESSION['DEATDeposit'];    
$CurrentUsername = $_COOKIE['rep'];

$qid = postdb('qid');
setcookie("qid", $qid, 0, "/");

$quotetoday = postdb('quotetoday');
$quotetodayorderid = postdb('orderid');
if ($quotetoday == "1") {
    setcookie("intquote", '1', 0, "/");
    AuditTrail($quotetodayorderid,$CurrentUsername,"Clicked on Quote Today");
}

$incompleteclick = postdb('incompleteclick');
$incompleteorderid = postdb('orderid');
if ($incompleteclick == "1") {
    AuditTrail($incompleteorderid,'',"User clicked to complete order from email.");
}

$shippingfromzip = postdb('shippingfromzip');
$shippingfromcity = postdb('shippingfromcity');
$shippingfromstate = postdb('shippingfromstate');
$shippingfromstateabbr = GetStateAbbr($shippingfromstate);
$shippingfromstateabbr = strtoupper($shippingfromstateabbr);
$shippingtozip = postdb('shippingtozip');
$shippingtocity = postdb('shippingtocity');
$shippingtostate = postdb('shippingtostate');
$shippingtostateabbr = GetStateAbbr($shippingtostate);
$shippingtostateabbr = strtoupper($shippingtostateabbr);

$totaldistance = postdb('totaldistance');

$shippingfromcitystate = postdb('shippingfromcitystate');
$shippingtocitystate = postdb('shippingtocitystate');

if ($shippingfromcitystate!="") {
    $citystate=explode(",", $shippingfromcitystate);
    $shippingfromcity = $citystate[0];
    $shippingfromstate = trim($citystate[1]);
    $shippingfromstateabbr = $shippingfromstate;
}

echo $shippingfromstatedisp;


if ($shippingtocitystate!="") {
    $citystate=explode(",", $shippingtocitystate);
    $shippingtocity = $citystate[0];
    $shippingtostate = trim($citystate[1]);
    $shippingtostateabbr = $shippingtostate;
}
$shippingfromstatedisp = GetStateName($shippingfromstate);
$shippingtostatedisp = GetStateName($shippingtostate);


$auto_year = postdb('auto_year');
$auto_model = postdb('auto_model');
$auto_make = postdb('auto_make');

$vehicle_operational = postdb('vehicle_operational');
$vehicle_trailer = postdb('vehicle_trailer');
$vehicle_trailer_forced = postdb('vehicle_trailer_forced');

$customer_name = postdb('customer_name');
$customer_email = postdb('customer_email');

$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');
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



//SALES CONVERSION UPDATE start
$trackid = $_COOKIE['trackid'];
if (!empty($trackid)) {
	$zipadjustrating = GetRatingRep($shippingfromzip,$shippingtozip,$totaldistance);
	$sql = "update sale_conversion set fromzip='$shippingfromzip',tozip='$shippingtozip',quote_distance='$totaldistance',zipadjustrating='$zipadjustrating',dateupdated=NOW(),sale_status = '1. Quote Summary' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

if($vehicle_trailer == "Enclosed") {
	$enclosed = 1;
} else {
	$enclosed = 0;
}

//echo $_SESSION['intquote'] . '!';
if ($_SESSION['intquote'] == 1) {
    if ($_COOKIE['rep'] == "claydough" || $_COOKIE['rep'] == "mrupers") {
       $debug=1; 
    }
}




if ($howmany == "onevehicle") {
	$totalprice = GetQuote($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
	$shipprice1 = $totalprice-$_SESSION['DEATDeposit'];
	//Change price on vehicle condition
	if ($vehicle_operational == "Non-Running") {
		$totalprice = $totalprice + 150;
	}

    

} else {
	
	$shipprice1 = GetQuote($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
	$shipprice1 = $shipprice1-$_SESSION['DEATDeposit'];

	$lowestdepositamount = $_SESSION['DEATDeposit'];
	$currentdepositamount = $lowestdepositamount;
	
	if (!empty($auto_make2) && !empty($auto_model2)) {
		$shipprice2 = GetQuote($auto_year2,$auto_make2,$auto_model2,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice2 = $shipprice2-$_SESSION['DEATDeposit'];if (!empty($auto_make2) && !empty($auto_model2));
		$currentdepositamount = $_SESSION['DEATDeposit'];
		
		if ($currentdepositamount < $lowestdepositamount) {
			$lowestdepositamount = $currentdepositamount;
		}

		
	}

	if (!empty($auto_make3) && !empty($auto_model3)) {
		$shipprice3 = GetQuote($auto_year3,$auto_make3,$auto_model3,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice3 = $shipprice3-$_SESSION['DEATDeposit'];
		$currentdepositamount = $_SESSION['DEATDeposit'];
		
		if ($currentdepositamount < $lowestdepositamount) {
			$lowestdepositamount = $currentdepositamount;
		}
	}

	if (!empty($auto_make4) && !empty($auto_model4)) {
		$shipprice4 = GetQuote($auto_year4,$auto_make4,$auto_model4,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice4 = $shipprice4-$_SESSION['DEATDeposit'];
		$currentdepositamount = $_SESSION['DEATDeposit'];
		
		if ($currentdepositamount < $lowestdepositamount) {
			$lowestdepositamount = $currentdepositamount;
		}
	}

	if (!empty($auto_make5) && !empty($auto_model5)) {
		$shipprice5 = GetQuote($auto_year5,$auto_make5,$auto_model5,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice5 = $shipprice5-$_SESSION['DEATDeposit'];
		$currentdepositamount = $_SESSION['DEATDeposit'];
		
		if ($currentdepositamount < $lowestdepositamount) {
			$lowestdepositamount = $currentdepositamount;
		}
	}
	
	
	$subtotaldeposits = $lowestdepositamount * $numvehicles;
	$nonrunningcharge=0;

	//Change price on vehicle condition
	if ($vehicle_operational == "Non-Running") {
		$nonrunningcharge = $numvehicles * 150;
	}

	$subtotalcarrier = 0;
	
	if (isset($shipprice1)) {
		$subtotalcarrier = $subtotalcarrier + $shipprice1;
	}
	if (isset($shipprice2)) {
		$subtotalcarrier = $subtotalcarrier + $shipprice2;
	}
	if (isset($shipprice3)) {
		$subtotalcarrier = $subtotalcarrier + $shipprice3;
	}
	if (isset($shipprice4)) {
		$subtotalcarrier = $subtotalcarrier + $shipprice4;
	}
	if (isset($shipprice5)) {
		$subtotalcarrier = $subtotalcarrier + $shipprice5;
	}

    //echo "subtotalcarrier: " . $subtotalcarrier . "<br>";
	//echo "subtotaldeposits: " . $subtotaldeposits . "<br>";

	if ($numvehicles<2) {
		$depositdiscount = 0 * $numvehicles;
		$carrierdiscount = 0 * $numvehicles;
	} elseif ($numvehicles>=2 && $numvehicles<=6) {
		$depositdiscount = 25 * $numvehicles;
		//$carrierdiscount = 25 * $numvehicles;
		$carrierdiscount = 0 * $numvehicles;
	} elseif ($numvehicles >= 7 && $numvehicles <= 10) {
		$depositdiscount = 50 * $numvehicles;
		//$carrierdiscount = 50 * $numvehicles;
		$carrierdiscount = 0 * $numvehicles;
	}

	//echo "carrierdiscount: " . $carrierdiscount . "<br>";
	//echo "depositdiscount: " . $depositdiscount . "<br>";


	$totalcarrier = $subtotalcarrier - $carrierdiscount;
	$totaldeposit = $subtotaldeposits - $depositdiscount;

	$depositpervehicle = $totaldeposit / $numvehicles;

	//echo "totalcarrier: " . $totalcarrier . "<br>";
	//echo "totaldeposit: " . $totaldeposit . "<br>";
	//echo "nonrunningcharge: " . $nonrunningcharge . "<br>";


	$totalprice = $totalcarrier + $totaldeposit + $nonrunningcharge;
	//echo "totalprice: " . $totalprice . "<br>";

}

if ($howmany == "onevehicle") {
	$strDeposit = $_SESSION['DEATDeposit'];
	$depositpervehicle = $_SESSION['DEATDeposit'];
} else {
	$strDeposit = $totaldeposit;
}



$sql = "update sale_conversion set quote_amount='$totalprice',deposit='$strDeposit' where trackid = '$trackid'";
$wpdb->query($sql);


$rating_origin = GetCancelPerc($shippingfromzip,"pickup_zip",0);
$rating_dest = GetCancelPerc($shippingtozip,"deliver_zip",0);
$rating_vehicle = 0;

if ($rating_vehicle != 0) {
	$rating_avg = ($rating_origin+$rating_dest+$rating_vehicle)/3;
} else {
	$rating_avg = ($rating_origin+$rating_dest)/2;
}
$rating_avg = floor($rating_avg);



//Check average days waiting
$GetDaysWaitingPickupAvg=avgDaysWaiting("Pickup_State",$shippingfromstateabbr);
$DaysWaitingPickupAvgArr = explode("|", $GetDaysWaitingPickupAvg);
$DaysWaitingPickupAvg = round($DaysWaitingPickupAvgArr[0]);
$DaysWaitingPickupTotalOrders = $DaysWaitingPickupAvgArr[1];


$GetDaysWaitingDeliverAvg=avgDaysWaiting("Deliver_State",$shippingtostateabbr);
$DaysWaitingDeliverAvgArr = explode("|", $GetDaysWaitingDeliverAvg);
$DaysWaitingDeliverAvg = round($DaysWaitingDeliverAvgArr[0]);
$DaysWaitingDeliverTotalOrders = $DaysWaitingDeliverAvgArr[1];


if ($DaysWaitingPickupAvg==0 || $DaysWaitingDeliverAvg==0) {
	$DaysWaitingAvg=0;
} else {
	$DaysWaitingAvg = ($DaysWaitingPickupAvg+$DaysWaitingDeliverAvg)/2;
}
$DaysWaitingAvg=floor($DaysWaitingAvg);






//Get Message Text
$msg_textstart = "";

$shippingfromzip3 = substr($shippingfromzip,0,3);
$shippingtozip3 = substr($shippingtozip,0,3);
$Message_From='';
$Message_To='';

//Check for Zip Message Start
/*
$sql="select NearCity, Status from ziprateadjust where partialzip='$shippingfromzip3'";
$AlertZip = $wpdb->get_row($sql,ARRAY_A);
if ($wpdb->num_rows != 0) {
    $NearCity_from = $AlertZip['NearCity'];
	$MessageStatus_from = $AlertZip['Status'];
}

if ($NearCity_from != "" && $MessageStatus_from != "") {
	if ($MessageStatus_from == "2") {
		$recommendstatus_from = "much";
	}
	$Message_From = "<b style='color:#000'>Helpful Hint:</strong><br>It might be $recommendstatus_from easier and quicker shipping from <strong>$NearCity_from</strong>.";
}


//Check for Zip Message Start
$sql="select NearCity, Status from ziprateadjust where partialzip='$shippingtozip3'";
$AlertZip = $wpdb->get_row($sql,ARRAY_A);
if ($wpdb->num_rows != 0) {
    $NearCity_to = $AlertZip['NearCity'];
	$MessageStatus_to = $AlertZip['Status'];
}

if ($NearCity_to != "" && $MessageStatus_to != "") {
	if ($MessageStatus_to == "2") {
		$recommendstatus_to = "much";
	}
	$Message_To = "<b style='color:#000'>Helpful Hint:</strong><br>It might be $recommendstatus_to easier and quicker shipping from <strong>$NearCity_to</strong>.";
}
*/

$sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$shippingfromzip' limit 1";
$shippingfromlatlong = $wpdb->get_row($sql,ARRAY_A);
if ($wpdb->num_rows != 0) {
    $fromlat = $shippingfromlatlong['Latitude'];
	$fromlong = $shippingfromlatlong['Longitude'];
}

$sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$shippingtozip' limit 1";
$shippingtolatlong = $wpdb->get_row($sql,ARRAY_A);
if ($wpdb->num_rows != 0) {
    $tolat = $shippingtolatlong['Latitude'];
	$tolong = $shippingtolatlong['Longitude'];
}

?>



<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Permanent+Marker');

#map1, #map2 {
    margin: 10px 0 10px 0;
    border: 1px solid #666;
    width: 100%;
    height: 220px;
}
.mapmsg {
	width: 100%;
	margin-bottom: 10px;
	color: #000099;
	font-size: 15px;
}

.ui-widget-overlay {
	opacity: 0.6;
}

<?php 
if($_COOKIE['admin']=="") {
?>
    #map1, #map2 {
        display: none;
    }
    

<?php } ?>



.setupship {
    margin-top: 10px;
/*     padding: 50px 0 0; */
}

.setupshipcol {
	text-align: center;
    font-size: 16px;
    padding: 0px 40px !important;
/*     border-right: 1px solid #eee; */
}

/*
.setupshipcol:first-child {
	border-left: 1px solid #eee;
}
*/

.setupship {
	text-align: center;
}

.pricerow {
    font-size: 23px;
    line-height: 27px;
}

.setupshipcol p {
    margin: 10px 0 !important;
}

.setupshipment {
    margin: 3px 0 0 0;
    font-weight: bold;
}

.submitbutton3 {
	padding:10px 30px;
	margin:0 0 8px 0 !important;
	border:0;
	cursor:pointer !important;
	color:#fff !important;
	font-size: 18px;
	font-weight: bold;
    -moz-border-radius: 3px !important;
    border-radius: 3px !important;
    line-height: 23px;
	background-color: #ff8300;
	background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(255, 131, 0)), to(rgb(246, 73, 0)));
	background-image: -webkit-linear-gradient(top, rgb(255, 131, 0), rgb(246, 73, 0));
	background-image: -moz-linear-gradient(top, rgb(255, 131, 0), rgb(246, 73, 0));
	background-image: -o-linear-gradient(top, rgb(255, 131, 0), rgb(246, 73, 0));
	background-image: -ms-linear-gradient(top, rgb(255, 131, 0), rgb(246, 73, 0));
	background-image: linear-gradient(top, rgb(255, 131, 0), rgb(246, 73, 0));
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='#ff8300', EndColorStr='#f64900');
}

.submitbutton3:hover {
	color:#fff !important;
	background-color: #ff7900;
	background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(255, 121, 0)), to(rgb(247, 44, 0)));
	background-image: -webkit-linear-gradient(top, rgb(255, 121, 0), rgb(247, 44, 0));
	background-image: -moz-linear-gradient(top, rgb(255, 121, 0), rgb(247, 44, 0));
	background-image: -o-linear-gradient(top, rgb(255, 121, 0), rgb(247, 44, 0));
	background-image: -ms-linear-gradient(top, rgb(255, 121, 0), rgb(247, 44, 0));
	background-image: linear-gradient(top, rgb(255, 121, 0), rgb(247, 44, 0));
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='#ff7900', EndColorStr='#f72c00');
}

.levelofservice {
	border: 0.1rem solid #e6e7eb;
    border-radius: 0.3rem;
    box-shadow: 0 0.2rem 0.4rem 0 #9d9ea3;
    box-shadow: 0 0.2rem 0.4rem 0 rgba(0,0,0,0.06);
    padding: 20px 40px 0 !important;
    background: #f3f4f8;
    margin: 0 8px;
    width: 32% !important;
    text-align: center;
}



.levelofservice:last-child {
	margin-right: 0 !important
}

.levelofservice:first-child {
	margin-left: 0 !important
}

@media (max-width: 600px) {
	.smart-forms .frm-row .colm {
		width: 100% !important;
	}
	
	.levelofservice:last-child {
		margin-right: 0 !important
	}
	
	.levelofservice:first-child {
		margin-left: 0 !important
	}
	
	.levelofservice {
		margin: 0 0 20px;
	}
	
	body .shippinginfo {
		margin: 0 !important;
	}
}


.carinfo {
	max-width: 538px;
	border: 1px solid #cecece;
    padding: 3rem;
    border-radius: 5px;
	
/*
	border: 0.1rem solid #e6e7eb;
    border-radius: 0.3rem;
    box-shadow: 0 0.2rem 0.4rem 0 #9d9ea3;
    box-shadow: 0 0.2rem 0.4rem 0 rgba(0,0,0,0.06);
    
    background: #f3f4f8;
*/
}

.shippinginfodata {
	margin-bottom: 13px;
}

@media (max-width:768px) {

	.smart-forms .frm-row .colm.ipad {
		width:100%;
		float:none;
		padding:0;
	}
	
}	

</style>





<div class="quotecontents">

    <div class="smart-forms">
    
    	<div class="section fieldentry" style="margin: 20px 0 30px;">
	        <div class="frm-row">
	            <div class="colm ipad colm6 ordersteps" style="text-align: center">
	                <img src="/wp-content/themes/atdv2/images/checkout-prog-1.png" alt="Step 1 - Your Quote" />
	            </div>
	            <div class="colm ipad colm6 ordersteps" style="text-align: center">
	                <div style="font-size:40px;color:#308dff;position:relative;font-weight:bold;"><a href="tel:800-600-3750">800-600-3750</a></div>
	            </div>

	        </div>
	    </div>
	    
	    
	    <div class="frm-row" style="margin: 20px 0 10px;">
            <div class="colm colm6" style="margin: 30px 0 0 0;">
	            <img src="https://d36b03yirdy1u9.cloudfront.net/wp-content/uploads/2018/09/ratinglogos.png" /><BR><BR>
	            <div style="font-size: 20px; line-height: 28px; font-weight: 600 !important;">Direct Express Auto Transport is the highest rated and most reliable car shipper! Going strong since 2004.<div style="margin-top:10px;"></div>
	            	
	            </div>
            </div>
            <div class="colm colm1"></div>
	            
            <div class="colm colm5">
	            <div style="text-align:center; font-size: 16px; line-height: 22px; font-weight: 600 !important;">Watch Short Video<div style="margin-top:10px;"></div>
	            <style>.embed-container { border:1px solid #ccc; position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/460700109' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
	            
            </div>
        </div>
        

		 <div class="section fieldentry">
            <div class="frm-row">
                <div class="colm colm12">
                     <div style="font-size: 22px; line-height: 28px; color: #1a73e8; font-weight: bold !important; text-align: center; margin-top: 30px;">
					 $0 Due Now To Book</div>
            	</div>
            </div>
        </div>




        <?php if($vehicletype == "Oversize Vehicles" || $vehicletype == "Other") { ?>
            <div class="section fieldentry">
                <div class="frm-row">
                    <div class="colm colm12">
                        <blockquote>
                        <strong>Because of the vehicle you have chosen, we must do a custom quote for you.<br><br>Please call 800-600-3750.<br><br>Thank You!</strong>
                        </blockquote>
                    </div>
                </div>
            </div>
        <?php } else { ?>

 

			<style>
			.shippinginfo {
				font-size: 16px !important;
			    border: 1px solid #ccc;
			    border-radius: 5px;
			    padding: 32px !important;
			    width: 95% !important;
			    margin: 20px 0 0 10px!important;
			}
			
			.shippinginfolabel {
				text-align: right;
			}
			
			.shippinginfodata {
				
			}
			
			@media only screen and (max-width: 600px) {
				.shippinginfolabel,
				.shippinginfodata {
					text-align: center;
				}
			    
			}
				
			</style>
			

		    
		    <div class="section fieldentry" >
		        <div class="frm-row">
		            <div class="colm colm12 ">
			            
					<form action="?step=4" method="post" name="mainform">
		            <input type="hidden" name="strQuote_shippingfromstateabbr" value="<?php echo $shippingfromstateabbr ?>">
		            <input type="hidden" name="strQuote_shippingtostateabbr" value="<?php echo $shippingtostateabbr ?>">
		            <input type="hidden" name="strQuote_shippingfromstate" value="<?php echo $shippingfromstatedisp ?>">
		            <input type="hidden" name="strQuote_shippingtostate" value="<?php echo $shippingtostatedisp ?>">
		            <input type="hidden" name="strQuote_shippingfromcity" value="<?php echo $shippingfromcity ?>">
		            <input type="hidden" name="strQuote_shippingtocity" value="<?php echo $shippingtocity ?>">
		            <input type="hidden" name="strQuote_shippingfromzip" value="<?php echo $shippingfromzip ?>">
		            <input type="hidden" name="strQuote_shippingtozip" value="<?php echo $shippingtozip ?>">
		            <input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">
		            
		            <input type="hidden" name="shippingfrom_sales" value="<?php echo $shippingfrom_sales ?>">
		            
		            <input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
		            <input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">
		            <input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
		            <input type="hidden" name="auto_price" value="<?php echo $shipprice1 ?>">
		            
		            
		            <input type="hidden" name="DaysWaitingPickupTotalOrders" value="<?php echo $DaysWaitingPickupTotalOrders ?>">
		            <input type="hidden" name="DaysWaitingPickupAvg" value="<?php echo $DaysWaitingPickupAvg ?>">
		            <input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<?php echo $DaysWaitingDeliverTotalOrders ?>">
		            <input type="hidden" name="DaysWaitingDeliverAvg" value="<?php echo $DaysWaitingDeliverAvg ?>">
		            <input type="hidden" name="DaysWaitingAvg" value="<?php echo $DaysWaitingAvg ?>">
		            
		            
		            <?php if($_COOKIE['admin']!="" && (!empty($Message_To) || !empty($Message_From))) { ?>
		            	<input type="hidden" name="helpfulhintmention" value="">
		            <?php } ?>
		            
		            
		            <input type="hidden" name="howmany" value="<?php echo $howmany ?>">
		            <input type="hidden" name="numvehicles" value="<?php echo $numvehicles ?>">
		            <input type="hidden" name="depositpervehicle" value="<?php echo $depositpervehicle ?>">
		            <input type="hidden" name="carrierdiscount" value="<?php echo $carrierdiscount ?>">
		            <input type="hidden" name="depositdiscount" value="<?php echo $depositdiscount ?>">
		            <input type="hidden" name="discstatus" value="0|0|0-0">
		            <input type="hidden" name="ps" value="<?php echo $PriceSource ?>">
		            
		            
		            <?php if($howmany != "onevehicle") { ?>
		            <input type="hidden" name="auto_year2" value="<?php echo $auto_year2 ?>">
		            <input type="hidden" name="auto_make2" value="<?php echo $auto_make2 ?>">
		            <input type="hidden" name="auto_model2" value="<?php echo $auto_model2 ?>">
		            <input type="hidden" name="auto_price2" value="<?php echo $shipprice2 ?>">
		            <input type="hidden" name="auto_year3" value="<?php echo $auto_year3 ?>">
		            <input type="hidden" name="auto_make3" value="<?php echo $auto_make3 ?>">
		            <input type="hidden" name="auto_model3" value="<?php echo $auto_model3 ?>">
		            <input type="hidden" name="auto_price3" value="<?php echo $shipprice3 ?>">
		            <input type="hidden" name="auto_year4" value="<?php echo $auto_year4 ?>">
		            <input type="hidden" name="auto_make4" value="<?php echo $auto_make4 ?>">
		            <input type="hidden" name="auto_model4" value="<?php echo $auto_model4 ?>">
		            <input type="hidden" name="auto_price4" value="<?php echo $shipprice4 ?>">
		            <input type="hidden" name="auto_year5" value="<?php echo $auto_year5 ?>">
		            <input type="hidden" name="auto_make5" value="<?php echo $auto_make5 ?>">
		            <input type="hidden" name="auto_model5" value="<?php echo $auto_model5 ?>">
		            <input type="hidden" name="auto_price5" value="<?php echo $shipprice5?>">
		            <?php } ?>
		            
		            <input type="hidden" name="strQuote_vehicle_operational" value="<?php echo $vehicle_operational ?>">
		            <input type="hidden" name="strQuote_vehicle_trailer" value="<?php echo $vehicle_trailer ?>">
		            
		            <input type="hidden" name="rating_origin" value="<?php echo $rating_origin ?>">
		            <input type="hidden" name="rating_dest" value="<?php echo $rating_dest ?>">
		            <input type="hidden" name="rating_vehicle" value="<?php echo $rating_vehicle ?>">
		            
		            <input type="hidden" name="strtotalprice" id="totalprice" value="<?php echo $totalprice ?>">
		            <input type="hidden" name="strDeposit" value="<?php echo $strDeposit ?>">
		            
		            <input type="hidden" name="pricetier" id="pricetier" value="1">
		            
		           
		            
		            <?php
		            $standardprice = $totalprice;
		            $expeditedprice = $totalprice + ($expeditedrate * $numvehicles);
		
		            if ($numvehicles>1) {
		                //$expeditedprice = $expeditedprice - $carrierdiscount;
		            }
		            
		            $rushprice = $totalprice + ($rushrate * $numvehicles);
		            
		            if ($numvehicles>1) {
		                //$rushprice = $rushprice - $carrierdiscount;
		            }
		            ?>
		            
		            <script type="text/javascript">
		            jQuery(document).ready(function() {
		                jQuery("#confirmLink1").click(function(e) {
		            		e.preventDefault();
		                    jQuery('#pricetier').val('1');
		                    document.mainform.submit();
		            	});
		            
		                jQuery("#confirmLink2").click(function(e) {
		            		e.preventDefault();
		            		jQuery('#totalprice').val('<?php echo $expeditedprice ?>');
		                    jQuery('#pricetier').val('2');
		            
		                    if (jQuery("input[name='auto_price']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price']").val()) + <?php echo $expeditedrate ?>;
		                        jQuery("input[name='auto_price']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price2']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price2']").val()) + <?php echo $expeditedrate ?>;
		                        jQuery("input[name='auto_price2']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price3']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price3']").val()) + <?php echo $expeditedrate ?>;
		                        jQuery("input[name='auto_price3']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price4']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price4']").val()) + <?php echo $expeditedrate ?>;
		                        jQuery("input[name='auto_price4']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price5']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price5']").val()) + <?php echo $expeditedrate ?>;
		                        jQuery("input[name='auto_price5']").val(auto_price_new);
		                    }
		                    document.mainform.submit();
		            
		            	});
		            
		                jQuery("#confirmLink3").click(function(e) {
		            		e.preventDefault();
		            		jQuery('#totalprice').val('<?php echo $rushprice ?>');
		                    jQuery('#pricetier').val('3');
		            
		                    if (jQuery("input[name='auto_price']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price']").val()) + <?php echo $rushrate ?>;
		                        jQuery("input[name='auto_price']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price2']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price2']").val()) + <?php echo $rushrate ?>;
		                        jQuery("input[name='auto_price2']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price3']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price3']").val()) + <?php echo $rushrate ?>;
		                        jQuery("input[name='auto_price3']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price4']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price4']").val()) + <?php echo $rushrate ?>;
		                        jQuery("input[name='auto_price4']").val(auto_price_new);
		                    }
		                    if (jQuery("input[name='auto_price5']").val() != '') {
		                        var auto_price_new = parseInt(jQuery("input[name='auto_price5']").val()) + <?php echo $rushrate ?>;
		                        jQuery("input[name='auto_price5']").val(auto_price_new);
		                    }
		                    
		                    
		                    document.mainform.submit();
		            
		            	});
		
		
		                
		                
		                
		                
		                });
		                </script>
		
		         
		                <div class="section fieldentry">
		                    
		                        <?php
		                        
		                        if ($howmany == "onevehicle") {
		                        	$strDepositSHOW = $_SESSION['DEATDeposit'];
		                        	
		                        	$balancestandard = $totalprice - $_SESSION['DEATDeposit'];
		                            $balanceexpedited = $expeditedprice - $_SESSION['DEATDeposit'];
		                            $balancerush = $rushprice - $_SESSION['DEATDeposit'];
		                        } else {
		                        	$strDepositSHOW = $strDeposit;
		                            $balancestandard = $totalprice - $strDeposit;
		                            $balanceexpedited = $expeditedprice - $strDeposit;
		                            $balancerush = $rushprice - $strDeposit;
		
		                        }
		                        ?>
		                        


		                        <div class="colm colm4 levelofservice" >
		                            <div class="pricerow">Standard Tier<br><span style="color: red;font-size: 15px; margin-top:-6px;">(not in a hurry)</span><br><span id="displaybalancestandard" style="color: #1a73e8;font-weight: bold;">$<?php echo $totalprice ?></span></div>
		                             <p style="margin-top: 10px; padding:15px;">Assigned to a carrier 1-10 days from the first date available usually 75% of the time.</p>
		                            <div align="center"><button id="confirmLink1" class="submitbutton3" style="width:90%;background: #4ba821;">Set&#8209;up<br/>Standard<br/>Shipment</button></div>
		                            <p style="margin-top: 10px;">
										<div style="margin-bottom: 14px;">$0 Due Now</div>
										<div style="margin-bottom: 14px;">$<?php echo $strDepositSHOW ?> payment processed upon Carrier Assignment.</div>
										$<?php echo $balancestandard ?> balance to Carrier in<br/>Cash or Money Order Upon Delivery.<br><br>
										Vehicles are typically Picked Up 1-2 days after Assigned to a carrier.

		                            </p>
		                        </div>
		                        

		                        
		                        <div class="colm colm4 levelofservice" style="background: #FFFCD8;">
		                            <div class="pricerow">Expedited Tier<br><span style="color: red;font-size: 15px; margin-top:-6px;">(recommended)</span><br><span id="displayexpeditedprice" style="color: #1a73e8;font-weight: bold;">$<?php echo $expeditedprice ?></span></div>
		                             <p style="margin-top: 10px; padding:15px;">Assigned to a carrier 1-5 days from the first date available usually 85% of the time.</p> 
		                            <div align="center"><button  id="confirmLink2" class="submitbutton3" style="width:90%;background: #4ba821;">Set&#8209;up<br/>Expedited<br/>Shipment</button></div>
		                            <p style="margin-top: 10px;">
										<div style="margin-bottom: 14px;">$0 Due Now</div>
										<div style="margin-bottom: 14px;">$<?php echo $strDepositSHOW ?> payment processed upon Carrier Assignment.</div>
										$<?php echo $balanceexpedited ?> balance to Carrier in<br/>Cash or Money Order Upon Delivery.<br><br>
										Vehicles are typically Picked Up 1-2 days after Assigned to a carrier.
		                            </p>
		                        </div>
                   
		                        <div class="colm colm4 levelofservice" >
		                            <div class="pricerow">Rush Tier<br><span style="color: red;font-size: 15px; margin-top:-6px;">(fastest)</span><br><span id="displayrushprice" style="color: #1a73e8;font-weight: bold;">$<?php echo $rushprice ?></span></div>
		                             <p style="margin-top: 10px; padding:15px;">Assigned to a carrier 1-3 days from the first date available usually 90% of the time.</p>
		                            <div align="center"><button id="confirmLink3" class="submitbutton3" style="width:90%;background: #4ba821;">Set&#8209;up<br/>Rush<br/>Shipment</button></div>
		                            <p style="margin-top: 10px;">
										<div style="margin-bottom: 14px;">$0 Due Now</div>
										<div style="margin-bottom: 14px;">$<?php echo $strDepositSHOW ?> payment processed upon Carrier Assignment.</div>
										$<?php echo $balancerush ?> balance to Carrier in<br/>Cash or Money Order Upon Delivery.<br><br>
										Vehicles are typically Picked Up 1-2 days after Assigned to a carrier.

		                            </p>
		                        </div>
		                        
		                        
		                        
		                        
		                        
		                        
		                </div>
		             </form>   
			            
			            
		                
		                
		            </div
            </div>
		        </div>
		    </div>
            <div class="section fieldentry" >       
		            <div class="frm-row">
			            
			            <div class="colm colm12 shippinginfo">
				            
					        

				            
				            
                        	
	                        
		                        
			                        <div class="frm-row">
			                            <div class="colm colm12 shippinginfodata" style="font-size: 20px;">
											<strong>My Order Details</strong>
											<div style="height: 1px; border-top:1px solid #868686; margin: 20px 0 0;"></div>
			                            </div>
			                        </div>
			                        
			                        <div class="frm-row">
			                            <div class="colm colm4">

										<div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                            	Shipping From: 
												<strong><?php echo $shippingfromcity ?>, <?php echo $shippingfromstateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingfromzip ?></strong>
				                                
				                                <?php if($_COOKIE['admin']!="") { ?>
				                                    <div>
				                                    
				                                    <a href="http://maps.google.com/maps?q=<?php echo urlencode($shippingfromcity) ?>,+<?php echo urlencode($shippingfromstate) ?>+<?php echo urlencode($shippingfromzip) ?>" target="_new">Google Maps</a>
				                                    <?php
				                                    $cdpickup = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity= $shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
				                                    $cdpickup = urlencode($cdpickup);
				                                    $cdpickupstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_$shippingfromstateabbr&pickupRadius=25&pickupCity=&pickupState=$shippingfromstateabbr&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$shippingtostateabbr&deliveryRadius=25&deliveryCity=&deliveryState=$shippingtostateabbr&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
				                                    $cdpickupstate = urlencode($cdpickupstate);
				                                    ?>
				                                    
				                                	<a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cdpickup ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
				                                	&nbsp;&nbsp;
				                                	<a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cdpickupstate ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>
				                                    </div>
				                                <?php } ?>                                      
				                            </div>
		                        		</div>
				                        <div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                                Shipping To: 
												<strong><?php echo $shippingtocity ?>, <?php echo $shippingtostateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingtozip ?></strong>
				                                
				                                <?php if($_COOKIE['admin']!="") { ?>
				                                    <div>
				                                        
				                                        <a href="http://maps.google.com/maps?q=<?php echo urlencode($shippingtocity) ?>,+<?php echo urlencode($shippingtostate) ?>+<?php echo urlencode($shippingtozip) ?>" target="_new">Google Maps</a>
				                                        <?php
				                                        $cddeliver = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=$shippingtocity&pickupState=$shippingtostateabbr&pickupZip=$shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity=$shippingfromcity&deliveryState=$shippingfromstateabbr&deliveryZip=$shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
				                                        $cddeliver = urlencode($cddeliver);
				                                        $cddeliverstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_$shippingtostateabbr&pickupRadius=25&pickupCity=&pickupState=$shippingtostateabbr&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$shippingfromstateabbr&deliveryRadius=25&deliveryCity=&deliveryState=$shippingfromstateabbr&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
				                                        $cddeliverstate = urlencode($cddeliverstate);
				                                        ?>
				                                        
				                                        <a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cddeliver ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
				                                        &nbsp;&nbsp;
				                                        <a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cddeliverstate ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>
				                                    </div>
				                                <?php } ?>
				                            </div>
				
				                        </div>
				                        <div class="frm-row">
				                        <?php if ($howmany != "onevehicle") { ?>
				                            <div class="colm colm12 shippinginfodata">
				                                Types of Vehicles:<br/>
				                            
				                            	<div class="numbutton1">1</div><div class="makemodel"><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></div><div style="clear:both"></div>
				                            	<?php if(!empty($auto_make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $auto_year2 ?> - <?php echo $auto_make2 ?> - <?php echo $auto_model2 ?></div><div style="clear:both"></div><?php } ?>
				                            	<?php if(!empty($auto_make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $auto_year3 ?> - <?php echo $auto_make3 ?> - <?php echo $auto_model3 ?></div><div style="clear:both"></div><?php } ?>
				                            	<?php if(!empty($auto_make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $auto_year4 ?> - <?php echo $auto_make4 ?> - <?php echo $auto_model4 ?></div><div style="clear:both"></div><?php } ?>
				                            	<?php if(!empty($auto_make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $auto_year5 ?> - <?php echo $auto_make5 ?> - <?php echo $auto_model5 ?></div><div style="clear:both"></div><?php } ?>
				                            </div>
				                        <?php } else { ?>
				                            <div class="colm colm12 shippinginfodata">
				                                Types of Vehicle: 
												<strong><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></strong>
				                            </div>
				                        <?php } ?>
				                        </div>
				                        
				                        <div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                                Operating Condition: 
												<strong><?php echo $vehicle_operational ?> and Rolls, Brakes, Steers</strong>
				                            </div>
				                        </div>
				                        
				                        <div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                                Type of Trailer:
												<strong><?php echo $vehicle_trailer ?></strong>
				                            </div>
				                        </div>

										<div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                                Service: 
												<strong>Door-to-Door / Or as close as possible</strong>
				                            </div>
				                        </div>


										<div class="frm-row">
				                            <div class="colm colm12 shippinginfodata">
				                                Insurance: 
												<strong>Included Up To $150,000</strong>
				                            </div>
				                        </div>

			                            </div>
			                            <div class="colm colm1"></div>
			                            <div class="colm colm4">
				                            
					                        
					                        
					                        
					                        <div class="frm-row">
					                            <div class="colm colm12 shippinginfodata">
					                                Extra Charges: 
													<strong>No taxes or hidden fees / Driver tips at delivery are nice</strong>
					                            </div>
					                        </div>
					                        
					                        <div class="frm-row">
					                            <div class="colm colm12 shippinginfodata">
					                                Route Distance: 
													<strong><?php echo number_format($totaldistance) ?> miles</strong>
					                            </div>
					                        </div>
					                        <?php
						                    $daysonroad = $totaldistance/500;
						                    $daysonroad = ceil($daysonroad);
						                    $daysonroadmax = $daysonroad + 2;  
						                    ?>
					                        
					                        <div class="frm-row">
					                            <div class="colm colm12 shippinginfodata">
					                                Typical Transit Time On The Road: 
													<strong><?php echo $daysonroad ?> to <?php echo $daysonroadmax ?> Days</strong>
					                            </div>
					                        </div>
					                        
					                        <div class="frm-row">
					                            <div class="colm colm12 shippinginfodata">
					                                Due Now: <strong style="color: #1a73e8;">$0 at time of booking</strong><br>
													Your credit card won’t be charged the deposit until after we assign your vehicle(s)
					                            </div>
					                        </div>
					                        
					                        <div class="frm-row">
					                            <div class="colm colm12 shippinginfodata">
					                                Carrier Fee: 
													<strong>Paid in Cash or Money Order directly to Carrier Upon Delivery</strong>
					                            </div>
					                        </div>

			                            </div>
			                            <div class="colm colm3">
				                            <div style="text-align: center;"> <img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" style="border-radius: 5px;"></div>
			                            </div>
			                        </div>
			                        
			                        
			                        
			                        
			                        
			                        			                       


	                        		
		                        
		                        
	                        
                        
                    
                        

	                        
	                        <?php if($vehicle_trailer_forced==1) { ?>
	                        <div class="frm-row">
	                            <div class="colm colm12" style="text-align: center; color: #d80202;">
	                                <strong>Due to the year and/or make of your vehicle, enclosed transport is required.</strong><br/>
	                            </div>
	                        </div>
	                        
	                        <?php } ?>
							
  
















					    

  
  
                    </div>
			            
			            
			            
		                
		                
		            </div>
		            
		        </div>
		    </div>
		    
		    
		    
		    
		    
		    
					<div class="section fieldentry">
                        <div class="frm-row">
			
			
			
			
			
			
					    
				        <?php
			            if($_COOKIE['admin']!="") {
			            ?>
			            <style>
                   		#map1, #map2 {
						    margin: 10px 0 10px 0;
						    border: 1px solid #666;
						    width: 100%;
						    height: 220px;
						}
						.mapmsg {
							width: 100%;
							margin-bottom: 10px;
							color: #000099;
							font-size: 15px;
						}
						
						
						</style>
                   		<script language="Javascript">
						jQuery(function() {
							jQuery('#map1').gmap({ 'center': '<?php echo $fromlat ?>,<?php echo $fromlong ?>' }).bind();
							jQuery('#map1').gmap('option', 'zoom', 8);
							jQuery('#map2').gmap({ 'center': '<?php echo $tolat ?>,<?php echo $tolong ?>' }).bind();
							jQuery('#map2').gmap('option', 'zoom', 8);
						});
						</script>
														
	                   	<div class="section fieldentry" style="margin-top: 35px;">
			                <div class="frm-row">
								<div class="colm colm1"></div>
								
								<div class="colm colm5">
									<strong >Shipping From:</strong>
									<div id="map1"></div>
		                            
		                            <br>
		                            
		                            <strong >Shipping To:</strong>
		                            <div id="map2"></div>
		                            
								</div>
								
								<div class="colm colm1"></div>
			            
			                    <div class="colm colm5">
			                    	<style type="text/css">
			                    	select#honorquoteprice {
			                    		padding-top: 10px;
			                    		font-size: 15px;
			                    		width: 125px;
			                    	}
			                    	</style>
			                    	<div style="font-size:15px; text-align: center; margin-top: 36px;">
			
			                        <?php if ($_COOKIE['intquote'] != 1) { ?>
			                        	<a href="/?quoteaction=new" style="padding:5px 30px;background:blue;color:white;border: 2px solid black;font-weight:bold;font-size:12px; margin: 0 auto; text-align: center; width: 100%; display: inline-block;">New Quote</a>
			                        	<br><br>
			                        	
			                        	<a href="#" onclick="reverselocation();"><div style="padding:5px;background:#00B306;color:white;border: 2px solid black;font-weight:bold;font-size:12px;width: 100%; margin: 0 auto; text-align: center; display: inline-block;">Reverse Location</div></a>
			
			                        	<br><br>
			                        	<a href="/?quoteaction=redo" style="padding:5px 30px;background:#ffcf17;color:black;border: 2px solid black;font-weight:bold;font-size:12px; margin: 0 auto; width: 100%; display: inline-block;">Redo Quote</a>
			                        	
			                    	<?php } else { ?>
			                    		<a href="/internal-quote/?quoteaction=new" style="padding:5px 30px;background:blue;color:white;border: 2px solid black;font-weight:bold;font-size:12px; margin: 0 auto; text-align: center; width: 100%; display: inline-block;">New Internal Quote</a>
			                        	<br><br>
			                        	
			                        	<a href="#" onclick="reverselocation();"><div style="padding:5px;background:#00B306;color:white;border: 2px solid black;font-weight:bold;font-size:12px;width: 100%; margin: 0 auto; text-align: center; display: inline-block;">Reverse Location</div></a>
			
			                        	<br><br>
			                        	<a href="/internal-quote/?quoteaction=redo" style="padding:5px 30px;background:#ffcf17;color:black;border: 2px solid black;font-weight:bold;font-size:12px; margin: 0 auto; width: 100%; display: inline-block;">Redo Internal Quote</a>
			                        <?php } ?>  
			                        
			                        
			                        <script language="JavaScript">
			                        
			                            function changetrailer() {
			                            	var currenttrailer = jQuery('#vehicle_trailer').val();
			                            	if (currenttrailer=='Open') {
			                            		jQuery('#vehicle_trailer').val('Enclosed');
			                            	} else {
			                            		jQuery('#vehicle_trailer').val('Open');
			                            	}
			                            	document.getElementById("changequote").submit();
			                            }
			                        
			                            function changeoperating() {
			                            	var currentcondition = jQuery('#vehicle_operational').val();
			                            	if (currentcondition=='Running') {
			                            		jQuery('#vehicle_operational').val('Non-Running');
			                            	} else {
			                            		jQuery('#vehicle_operational').val('Running');
			                            	}
			                            	document.getElementById("changequote").submit();
			                            }
			                            
			                            function reverselocation() {
			                            	var current_shippingfromzip = jQuery('#shippingfromzip').val();
			                            	var current_shippingfromcity = jQuery('#shippingfromcity').val();
			                            	var current_shippingfromstate = jQuery('#shippingfromstate').val();
			                            	var current_shippingtozip = jQuery('#shippingtozip').val();
			                            	var current_shippingtocity = jQuery('#shippingtocity').val();
			                            	var current_shippingtostate = jQuery('#shippingtostate').val();
			                                
			                                jQuery('#shippingfromzip').val(current_shippingtozip);
			                                jQuery('#shippingfromcity').val(current_shippingtocity);
			                                jQuery('#shippingfromstate').val(current_shippingtostate);
			                                jQuery('#shippingtozip').val(current_shippingfromzip);
			                                jQuery('#shippingtocity').val(current_shippingfromcity);
			                                jQuery('#shippingtostate').val(current_shippingfromstate);
			                            	
			                            	document.getElementById("changequote").submit();
			                            }
			                        
			                        
			                            </script>
			        
			                            <form action="" method="post" name="changequote" id="changequote">
			                            <input type="hidden" name="shippingfromzip" id="shippingfromzip" value="<?php echo $shippingfromzip ?>">
			                            <input type="hidden" name="shippingfromcity" id="shippingfromcity" value="<?php echo $shippingfromcity ?>">
			                            <input type="hidden" name="shippingfromstate" id="shippingfromstate" value="<?php echo $shippingfromstatedisp ?>">
			                            <input type="hidden" name="shippingtozip" id="shippingtozip" value="<?php echo $shippingtozip ?>">
			                            <input type="hidden" name="shippingtocity" id="shippingtocity" value="<?php echo $shippingtocity ?>">
			                            <input type="hidden" name="shippingtostate" id="shippingtostate" value="<?php echo $shippingtostatedisp ?>">
			                            <input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">
			                            <input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
			                            <input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
			                            <input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">
			                            <input type="hidden" name="vehicle_operational" id="vehicle_operational" value="<?php echo $vehicle_operational ?>">
			                            <input type="hidden" name="vehicle_trailer" id="vehicle_trailer" value="<?php echo $vehicle_trailer ?>">
			                            
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
			                        
			                        
			                            <br>
			                            <a href="#" onclick="changetrailer();"><div style="padding:5px 30px;background:orange;color:black;border: 2px solid black;font-weight:bold;font-size:12px; width: 100%; display: inline-block;">Change Type of Trailer</div></a>
			                            <br><br>
			                            <a href="#" onclick="changeoperating();"><div  style="padding:5px 30px;background:purple;color:white;border: 2px solid black;font-weight:bold;font-size:12px; width: 100%; display: inline-block;">Change Operating Condition</div></a>
			                        
			                            </form>
										
										
										<div style="width:100%;border:2px solid #000;background:#eee;padding:5px;margin: 0 auto; margin-top:20px; margin-bottom:15px; text-align: center">
                            		<strong>OFFICE USE ONLY</strong><br>
                                    <?php
	                                    
	                                $cd25 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity=$shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=8&secondarySort=4&listingsPerPage=100";
                                    $cd25 = urlencode($cd25);
                                    $cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=8&secondarySort=4&listingsPerPage=100";
                                    $cd50 = urlencode($cd50);
                                    $cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=8&secondarySort=4&listingsPerPage=100";
                                    $cd100 = urlencode($cd100);
                                    ?>
                            
									<a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cd25 ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-25</a>
                            		&nbsp;&nbsp;
                                    <a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cd50 ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-50</a>
                            		&nbsp;&nbsp;
                            		<a href="http://admin.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cd100 ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-100</a>
                                    <br>
                            
                                    <?php if($_COOKIE['admin']!="") {
                                    	$qs = "cd50url=" . $cd50 . "&cd100url=" . $cd100 . "&sendfrom=" . urlencode($shippingfromcity) . ", " . urlencode($shippingfromstate) . "  " . urlencode($shippingfromzip) . "&sendto=" . urlencode($shippingtocity) . ", " . urlencode($shippingtostate) . "  " . urlencode($shippingtozip) . "&numvehicles=" . urlencode($numvehicles) . "&vehicle=" . urlencode($auto_make) . " - " . urlencode($auto_model) . "&vehicle2=" . urlencode($auto_make2) . " - " . urlencode($auto_model2) . "&vehicle3=" . urlencode($auto_make3) . " - " . urlencode($auto_model3) . "&vehicle4=" . urlencode($auto_make4) . " - " . urlencode($auto_model4) . "&vehicle5=" . urlencode($auto_make5) . " - " . urlencode($auto_model5) . "&vehicle6=" . urlencode($auto_make6) . " - " . urlencode($auto_model6) . "&vehicle7=" . urlencode($auto_make7) . " - " . urlencode($auto_model7) . "&vehicle8=" . urlencode($auto_make8) . " - " . urlencode($auto_model8) . "&vehicle9=" . urlencode($auto_make9) . " - " . urlencode($auto_model9) . "&vehicle10=" . urlencode($auto_make10) . " - " . urlencode($auto_model10) . "&operating=" . urlencode($vehicle_operational) . urlencode(" and Rolls, Brakes, Steers") . "&trailer=" . urlencode($vehicle_trailer) . "&deposit=" . urlencode($_SESSION['DEATDeposit']) . "&price=" . urlencode(number_format($totalprice));
                            
                                    	?>
                                    	<a href="https://admin.autotransportdirect.com/priceissue/?<?php echo $qs ?>" target="_blank" style="text-decoration:none;">Report Price Issue To Mike</a>
                                    	<br>
                                    <?php } ?>
                            
                            		<?php if($howmany == "onevehicle") { ?>
                            		<table style="margin:0 auto;">
                            		<tr>
                            			<td nowrap="nowrap"><strong><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?>:</strong>&nbsp;&nbsp;</td>
                            			<td nowrap="nowrap">$<?php echo $shipprice1 ?></td>
                            		</tr>
                            		<?php if($vehicle_operational == "Non-Running") { ?>
                            		<tr>
                            			<td nowrap="nowrap"><strong>Operating Condition (Non-Running):</strong></td>
                            			<td nowrap="nowrap">$150</td>
                            		</tr>
                            		<?php } ?>
                            		<tr>
                            			<td nowrap="nowrap"><strong>Deposit:</strong></td>
                            			<td nowrap="nowrap">$<?php echo $strDeposit ?></td>
                            		</tr>
                            		<tr>
                            			<td nowrap="nowrap"><strong>Total:</strong></td>
                            			<td nowrap="nowrap"><strong>$<?php echo $totalprice ?></strong></td>
                            		</tr>
                            		</table><br>
                            		<?php } ?>
                            
                            		<strong>Shipping Distance:</strong> <?php echo $totaldistance ?> miles<br>
                            		<?php
                            
                            			$deposittotal = $numvehicles * $depositpervehicle;
                            			$duecarrier = $totalprice - $deposittotal;
                            			$pricepermile = ($totalprice-$strDeposit) / $totaldistance;
                            			$pricepermile = number_format($pricepermile,2);
                            
                            
                            		if ($howmany != "onevehicle") {
                            
                            		?>
                            			<br>
                            			<strong>Types & Prices of Vehicles WITHOUT Deposit</strong>
                                        <br>
                            			<div class="numbutton1">1</div><div class="makemodel"><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?> - $<?php echo $shipprice1 ?></div><div style="clear:both"></div>
                            			<?php if (!empty($auto_make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $auto_year2 ?> - <?php echo $auto_make2 ?> - <?php echo $auto_model2 ?> - $<?php echo $shipprice2 ?></div><div style="clear:both"></div><?php } ?>
                            			<?php if (!empty($auto_make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $auto_year3 ?> - <?php echo $auto_make3 ?> - <?php echo $auto_model3 ?> - $<?php echo $shipprice3 ?></div><div style="clear:both"></div><?php } ?>
                            			<?php if (!empty($auto_make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $auto_year4 ?> - <?php echo $auto_make4 ?> - <?php echo $auto_model4 ?> - $<?php echo $shipprice4 ?></div><div style="clear:both"></div><?php } ?>
                            			<?php if (!empty($auto_make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $auto_year5 ?> - <?php echo $auto_make5 ?> - <?php echo $auto_model5 ?> - $<?php echo $shipprice5 ?></div><div style="clear:both"></div><?php } ?>
                            			<br>
                            			<strong>Deposit:</strong> $<?php echo $deposittotal ?><br>
                            			<strong>Due Carrier:</strong> $<?php echo $duecarrier ?><br>
                            			<strong>Price Per Carrier Mile:</strong> $<?php echo $pricepermile ?><br>
                            		<?php } else { ?>
                            
                            		<strong>Price Per Mile:</strong> $<?php echo $pricepermile ?> <br>
                            
                            		<?php
                            		}
                                    echo "<hr style='margin: 10px 0;'>" . DisplayRatingInfo($zipadjustrating);
                            		?>
                	            </div>

			                        
			                                                  	
			                    	</div>
			                    </div>
			                    
			                    <div class="colm colm1"></div>
			                </div>
			            </div>
						<?php
			            }
			            ?>

                
                
                        </div>
                	</div>
                



           


                
                <?php if($_COOKIE['admin']!="") {
                	$qs = "sendfrom=" . urlencode($shippingfromcity) . ",&nbsp;" . urlencode($shippingfromstate) . "&nbsp;&nbsp;" . urlencode($shippingfromzip) . "&sendto=" . urlencode($shippingtocity) . ",&nbsp;" . urlencode($shippingtostate) . "&nbsp;&nbsp;" . urlencode($shippingtozip) . "&numvehicles=" . urlencode($numvehicles) . "&vehicle=" . urlencode($auto_make) . " - " . urlencode($auto_model) . "&vehicle2=" . urlencode($auto_make2) . " - " . urlencode($auto_model2) . "&vehicle3=" . urlencode($auto_make3) . " - " . urlencode($auto_model3) . "&vehicle4=" . urlencode($auto_make4) . " - " . urlencode($auto_model4) . "&vehicle5=" . urlencode($auto_make5) . " - " . urlencode($auto_model5) . "&operating=" . urlencode($vehicle_operational) . urlencode(" and Rolls, Brakes, Steers") . "&trailer=" . urlencode($vehicle_trailer) . "&deposit=" . urlencode($_SESSION['DEATDeposit']) . "&price=" . urlencode(number_format($totalprice)) . "&rushprice=" . urlencode(number_format($rushprice)) . "&expeditedprice=" . urlencode(number_format($expeditedprice));
                	?>
                	<div class="section fieldentry">
                        <div class="frm-row">
                            <div class="colm colm12">
                            	<a href="https://admin.autotransportdirect.com/quote_email.asp?<?php echo $qs ?>" target="_blank" rel="shadowbox;width=700;height=200" style="text-decoration:none;"><div style="margin: 0 auto;width: 220px;padding: 10px;color: #FFF;background-color: #308DFF;font-size: 16px;font-weight: bold;text-decoration: none;-moz-border-radius: 5px;border-radius: 5px;text-align: center;">E-Mail This Quote</div></a>
                            </div>
                        </div>
                	</div>
                <?php } ?>
                








                <?php if($_COOKIE['admin']!="") { ?>
                    <div class="section fieldentry">
                        <div class="frm-row">
                            <div class="colm colm12">
                                
                                <?php if($debug==1) { ?>
                                <div class="debug" style="width:620px;border:2px solid #000;padding:20px;margin: 0 auto; margin-bottom:15px;"></div>
                	            <script type="text/javascript">
                	            jQuery(document).ready(function($) {
                	                $('.debuginfo').contents().appendTo('.debug');
                	            });
                	            </script>
                                <?php } ?>
                                
                            	                	            
                	              

                	        </div>
                        </div>
                	</div>
                <?php } ?>
				

                
                <div class="section fieldentry">
                    <div class="frm-row">
                        <div class="colm colm12" style="text-align: center;  font-size: 1.1em;margin-bottom: 20px;">
                            
	                        <p>Door-to-Door Service.&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Insurance Up To $150,000 Included&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;No taxes or hidden fees.</p>
	                        
	                        

                        </div>
                    </div>
                    
                    <div class="frm-row" style="margin-bottom: 30px !important;">
	                    <div class="colm colm12" style="text-align: center;padding: 20px 0 40px;">
		                    <!-- TrustBox widget - Carousel -->
							<div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5195d470000064000530e14c" data-style-height="130px" data-style-width="100%" data-theme="light" data-stars="5" data-schema-type="Organization">
							  <a href="https://www.trustpilot.com/review/autotransportdirect.com" target="_blank">Trustpilot</a>
							</div>
							<!-- End TrustBox widget -->
	                    </div>


                    </div>
                    
                    
                    <div class="frm-row">
                        <div class="colm colm12" style="text-align: center;  font-size: 1.1em;">       
                            <p>Hours of Operation – Weekdays<br>Eastern:&nbsp;9:00am&nbsp;-&nbsp;8:00pm &nbsp;|&nbsp; Central:&nbsp;8:00am&nbsp;-&nbsp;7:00pm &nbsp;|&nbsp; Mountain:&nbsp;7:00am&nbsp;-&nbsp;6:00pm &nbsp;|&nbsp; Pacific:&nbsp;6:00am&nbsp;-&nbsp;5:00pm</p>
						</div>
					</div>
					
					<div class="frm-row" style="padding: 30px 0;">


						<div class="colm colm6 mobnopad mobnoborder mobcenter" style="font-size: 1.1em; padding: 0 40px; text-align: center;margin-top:10px;">
							<div style="background: #efefef; padding: 40px; border-radius: 10px;">
                            <p>There are no taxes or hidden fees.</p>
                            <p>The balance due is made payable to the carrier with either Cash or Money Order upon delivery.</p>
                            <p>Your vehicle is fully insured while on the transport carrier.</p>
                            <p>Direct Express Auto Transport originated the instant online car shipping quote calculator in 2004.</p>
                            <p>Nobody does it better than Direct Express Auto Transport!</p>
							</div>
                            
                        </div>
					</div>
					
                    <div class="frm-row">
                        <div class="colm colm12" style="text-align: left;  font-size: 1.1em;">
	                        <p>Direct Express Auto Transport has shipped over 300,000 vehicles and that gives us the ability to predict the probability of how quickly yours will be assigned a driver from the date that you make it available.</p> 

							<p>Vehicles usually get picked up within one or two days of assignment to a carrier, sometimes even the same day.</p> 
							
							<p>The transit time on the road is usually one (1) day for every 500 miles distance. Allow an extra day or two for picking up and dropping off vehicles.</p>
							
							<p>The car shipping industry typically cannot guarantee shipping dates or times, because too many things may happen that can alter even the best laid plans. So dates and times are estimated.</p>
							
							<p>The price owed a carrier once assigned cannot be changed because the carrier agreed to transport the vehicle(s) based upon the posted rate. Otherwise, he may not have selected the order.</p>
							
							<p>Direct Express Auto Transport is very experienced regarding pricing. Our auto transport quote calculator was not only the first online, it is still the most sophisticated and reliable. The Standard Rate works plenty fine, but we offer more options to the customer with Expedited and Rush rates. Both Expedited and Rush rates take a lot of stress out of the process for the customer.</p> 

                            <p>Booking is easy online or please call us at</p>
                            <div style="font-size:40px;color:#308dff;position:relative;margin-top:15px; font-weight:bold;">
                            800-600-3750
                            </div>
                            
                            
                            <font style="font-size:14px;">
                            We accept all major Credit Cards<br>
                            </font>
                            <img src="//d36b03yirdy1u9.cloudfront.net/images/Credit-Card-Logos.jpg">
                        </div>
                    </div>
            	</div>
                                
                                






<?php } ?>



</div>



<!-- Google Code for 1. Quote Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1070891707;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "2ANICMOaQxC7hdL-Aw";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1070891707/?value=0&amp;label=2ANICMOaQxC7hdL-Aw&amp;guid=ON&amp;script=0"/>
</div>
</noscript>










