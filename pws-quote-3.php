<?php
$getOrderInfoinit = $_COOKIE['OrderInfo'];
$getOrderInfo = json_decode($getOrderInfoinit);
/*
echo '<pre>';
print_r($_COOKIE);
echo '</pre>';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
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
    if ($_COOKIE['rep'] == "claydough" || $_COOKIE['rep'] == "mrupers" || $_COOKIE['rep'] == "john") {
       $debug=1; 
    }
}


if ($howmany == "onevehicle") {
	//echo 'Auto Year '.$auto_year.'Auto Make => '.$auto_make.' Auto Model => '.$auto_model.' SFZ => '.$shippingfromzip.' STZ => '.$shippingtozip.' Enclosed => '.$enclosed.' AP => '.$auto_priceadjustment.' Debug => '.$debug;
	$quoteresponse = GetQuote16($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);

	$quoteresponse_explode = explode("|", $quoteresponse);
	
	$subtotal_std = $quoteresponse_explode[0]; 
	$deposit_std = $quoteresponse_explode[1]; 
	$deposit_std1 = $deposit_std;
	$totalprice = $quoteresponse_explode[2];
	$totalprice1 = $totalprice;
	
	$subtotal_exp = $quoteresponse_explode[3]; 
	$deposit_exp = $quoteresponse_explode[4]; 
	$deposit_exp1 = $deposit_exp;
	$totalprice_exp = $quoteresponse_explode[5];
	$totalprice1_exp = $totalprice_exp;
	
	$subtotal_rush = $quoteresponse_explode[6]; 
	$deposit_rush = $quoteresponse_explode[7]; 
	$deposit_rush1 = $deposit_rush;
	$totalprice_rush = $quoteresponse_explode[8];
	$totalprice1_rush = $totalprice_rush;
	
	$shipprice1 = $subtotal_std;
	//Change price on vehicle condition
	if ($vehicle_operational == "Non-Running") {
		$totalprice = $totalprice + $nonrunning;
		$totalprice_exp = $totalprice_exp + $nonrunning;
		$totalprice_rush = $totalprice_rush + $nonrunning;
	}

    

} else {
	
	$deposittotal_std = 0;
	$deposittotal_exp = 0;
	$deposittotal_rush = 0;

	$quoteresponse = GetQuote16($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
	$quoteresponse_explode = explode("|", $quoteresponse);
	
	$subtotal_std = $quoteresponse_explode[0]; 
	$deposit_std = $quoteresponse_explode[1]; 
	$deposit_std1 = $deposit_std;
	$totalprice = $quoteresponse_explode[2];
	$totalprice1 = $totalprice;

	$subtotal_exp = $quoteresponse_explode[3]; 
	$deposit_exp = $quoteresponse_explode[4];
	$deposit_exp1 = $deposit_exp;
	$totalprice_exp = $quoteresponse_explode[5];
	$totalprice1_exp = $totalprice_exp;

	$subtotal_rush = $quoteresponse_explode[6]; 
	$deposit_rush = $quoteresponse_explode[7];
	$deposit_rush1 = $deposit_rush;
	$totalprice_rush = $quoteresponse_explode[8];
	$totalprice1_rush = $totalprice_rush;
	
	$shipprice1 = $subtotal_std;
	
	$deposittotal_std = $deposittotal_std + $deposit_std;
	$deposittotal_exp = $deposittotal_exp + $deposit_exp;
	$deposittotal_rush = $deposittotal_rush + $deposit_rush;
	
	
	
	if (!empty($auto_make2) && !empty($auto_model2)) {
		
		$quoteresponse = GetQuote16($auto_year2,$auto_make2,$auto_model2,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
		$quoteresponse_explode = explode("|", $quoteresponse);

		$subtotal2_std = $quoteresponse_explode[0]; 
		$deposit2_std = $quoteresponse_explode[1]; 
		$totalprice2 = $quoteresponse_explode[2];
	
		$subtotal2_exp = $quoteresponse_explode[3]; 
		$deposit2_exp = $quoteresponse_explode[4]; 
		$totalprice2_exp = $quoteresponse_explode[5];
	
		$subtotal2_rush = $quoteresponse_explode[6]; 
		$deposit2_rush = $quoteresponse_explode[7]; 
		$totalprice2_rush = $quoteresponse_explode[8];
		
		$shipprice2 = $subtotal2_std;
		$shipprice2_exp = $subtotal2_exp;
		$shipprice2_rush = $subtotal2_rush;
		
		$deposittotal_std = $deposittotal_std + $deposit2_std;
		$deposittotal_exp = $deposittotal_exp + $deposit2_exp;
		$deposittotal_rush = $deposittotal_rush + $deposit2_rush;
	}

	if (!empty($auto_make3) && !empty($auto_model3)) {
		$quoteresponse = GetQuote16($auto_year3,$auto_make3,$auto_model3,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
		$quoteresponse_explode = explode("|", $quoteresponse);
		
		$subtotal3_std = $quoteresponse_explode[0]; 
		$deposit3_std = $quoteresponse_explode[1]; 
		$totalprice3 = $quoteresponse_explode[2];
	
		$subtotal3_exp = $quoteresponse_explode[3]; 
		$deposit3_exp = $quoteresponse_explode[4]; 
		$totalprice3_exp = $quoteresponse_explode[5];
	
		$subtotal3_rush = $quoteresponse_explode[6]; 
		$deposit3_rush = $quoteresponse_explode[7]; 
		$totalprice3_rush = $quoteresponse_explode[8];
		
		$shipprice3 = $subtotal3_std;
		$shipprice3_exp = $subtotal3_exp;
		$shipprice3_rush = $subtotal3_rush;
		
		$deposittotal_std = $deposittotal_std + $deposit3_std;
		$deposittotal_exp = $deposittotal_exp + $deposit3_exp;
		$deposittotal_rush = $deposittotal_rush + $deposit3_rush;
		
	}

	if (!empty($auto_make4) && !empty($auto_model4)) {
		$quoteresponse = GetQuote16($auto_year4,$auto_make4,$auto_model4,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
		$quoteresponse_explode = explode("|", $quoteresponse);
		
		$subtotal4_std = $quoteresponse_explode[0]; 
		$deposit4_std = $quoteresponse_explode[1]; 
		$totalprice4 = $quoteresponse_explode[2];
	
		$subtotal4_exp = $quoteresponse_explode[3]; 
		$deposit4_exp = $quoteresponse_explode[4]; 
		$totalprice4_exp = $quoteresponse_explode[5];
	
		$subtotal4_rush = $quoteresponse_explode[6]; 
		$deposit4_rush = $quoteresponse_explode[7]; 
		$totalprice4_rush = $quoteresponse_explode[8];
		
		$shipprice4 = $subtotal4_std;
		$shipprice4_exp = $subtotal4_exp;
		$shipprice4_rush = $subtotal4_rush;
		
		$deposittotal_std = $deposittotal_std + $deposit4_std;
		$deposittotal_exp = $deposittotal_exp + $deposit4_exp;
		$deposittotal_rush = $deposittotal_rush + $deposit4_rush;
	}

	if (!empty($auto_make5) && !empty($auto_model5)) {
		$quoteresponse = GetQuote16($auto_year4,$auto_make4,$auto_model4,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug);
		$quoteresponse_explode = explode("|", $quoteresponse);
		
		$subtotal5_std = $quoteresponse_explode[0]; 
		$deposit5_std = $quoteresponse_explode[1]; 
		$totalprice5 = $quoteresponse_explode[2];
	
		$subtotal5_exp = $quoteresponse_explode[3]; 
		$deposit5_exp = $quoteresponse_explode[4]; 
		$totalprice5_exp = $quoteresponse_explode[5];
	
		$subtotal5_rush = $quoteresponse_explode[6]; 
		$deposit5_rush = $quoteresponse_explode[7]; 
		$totalprice5_rush = $quoteresponse_explode[8];
		
		$shipprice5 = $subtotal5_std;
		$shipprice5_exp = $subtotal5_exp;
		$shipprice5_rush = $subtotal5_rush;
		
		$deposittotal_std = $deposittotal_std + $deposit5_std;
		$deposittotal_exp = $deposittotal_exp + $deposit5_exp;
		$deposittotal_rush = $deposittotal_rush + $deposit5_rush;
	}
	
	
	$nonrunningcharge=0;

	//Change price on vehicle condition
	if ($vehicle_operational == "Non-Running") {
		$nonrunningcharge = $numvehicles * $nonrunning;
	}
	$subtotalcarrier = 0;
	$subtotalcarrierexp = 0;
	$subtotalcarrierrush = 0;
	
	if (isset($shipprice1)) {
		$subtotalcarrier = $subtotalcarrier + $subtotal_std;
		$subtotalcarrierexp = $subtotalcarrierexp + $subtotal_exp;
		$subtotalcarrierrush = $subtotalcarrierrush + $subtotal_rush;
	}
	if (isset($shipprice2)) {
		$subtotalcarrier = $subtotalcarrier + $subtotal2_std;
		$subtotalcarrierexp = $subtotalcarrierexp + $subtotal2_exp;
		$subtotalcarrierrush = $subtotalcarrierrush + $subtotal2_rush;
	}
	if (isset($shipprice3)) {
		$subtotalcarrier = $subtotalcarrier + $subtotal3_std;
		$subtotalcarrierexp = $subtotalcarrierexp + $subtotal3_exp;
		$subtotalcarrierrush = $subtotalcarrierrush + $subtotal3_rush;
	}
	if (isset($shipprice4)) {
		$subtotalcarrier = $subtotalcarrier + $subtotal4_std;
		$subtotalcarrierexp = $subtotalcarrierexp + $subtotal4_exp;
		$subtotalcarrierrush = $subtotalcarrierrush + $subtotal4_rush;
	}
	if (isset($shipprice5)) {
		$subtotalcarrier = $subtotalcarrier + $subtotal5_std;
		$subtotalcarrierexp = $subtotalcarrierexp + $subtotal5_exp;
		$subtotalcarrierrush = $subtotalcarrierrush + $subtotal5_rush;
	}





	$deposit_std = $deposittotal_std;
	$deposit_exp = $deposittotal_exp;
	$deposit_rush = $deposittotal_rush;
	
	$totalprice = $subtotalcarrier + $deposittotal_std + $nonrunningcharge;
	$totalprice_exp = $subtotalcarrierexp + $deposittotal_exp + $nonrunningcharge;
	$totalprice_rush = $subtotalcarrierrush + $deposittotal_rush + $nonrunningcharge;

}

if ($howmany == "onevehicle") {
	$strDeposit = $deposit_std;
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

<script type="text/javascript">
	
	var formcount1 = localStorage.getItem('formcount');

    console.log("formcount1="+formcount1);
	
	
	/*if(formcount1 > 4 )
	{
	     console.log("IF");
	     alert("Quote limit is exceeded.");
	     window.location.href = "https://www.autotransportdirect.com/?e=l";
	     
	}*/
	
	
	
	if(formcount1 == null || formcount1 == '')
	{
	   localStorage.setItem('formcount', '1');    
	}
	else
	{
	   
	   var formcount2 = parseInt(formcount1) + 1;
	   
	   console.log("formcount2=" + formcount2);  
	   
	   localStorage.setItem('formcount', formcount2);  
	}
	
	
</script>

<style type="text/css">

<?php 
if($_COOKIE['admin']=="") {
?>
    #map1, #map2 {
        display: none;
    }
    

<?php } ?>



</style>
<link rel="stylesheet" type="text/css" href="https://staging.autotransportdirect.com/wp-content/themes/atdv2/pws-quote-3.css">

<!--<div class="banner">

      
          <div class="sec1">

                <div class="display">

                      <p class="spn">The Original Car Shipping</p>

                      <h1 class="head">Get An Instant Quote</h1>

                      <p class="textpara">Direct Express Auto Transport’s no personal information car shipping cost calculator has been the best since 2004.</p>

                         <a href="#" class="but">VIEW PHOTOS</a>

                </div>

          </div>
           
</div>-->



<div class="quotecontents">

    <div class="smart-forms">
    
		
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
                border-radius: 5px;
                padding: 32px !important;
                width: 95% !important;
                margin: 35px 0 0 15px!important;
			}
			
			.shippinginfolabel {
				text-align: right;
			}
			
			.shippinginfo .shippinginfodata.head {
			    font-weight: 500;
                font-family: "Poppins", Sans-serif;
                text-align: center;
                font-size: 42px;
                line-height: 40px;
                color: #333;
			}
			
			.custom_bord
			{
			        
                border-radius: 1rem;
                width: 15rem;
                height: 2px;
                background-color: #0057b1;
                margin: 20px auto 30px auto;
    
			}
			
			@media only screen and (max-width: 600px) {
				.shippinginfolabel,
				.shippinginfodata {
				    text-align: center;
				}
			    
			}
				
			</style>
			

		    
		    <div class="fieldentry">
				
				<!-----package---->
				<div class="frm-row" style="margin-bottom:0px !important;">
		            <div class="colm colm12 ">
						<form action="?step=2#customer-info" method="post" name="mainform">
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
			            <input type="hidden" name="auto_price" value="<?php echo $subtotal_std ?>">
			            <input type="hidden" name="auto_price_exp" value="<?php echo $subtotal_exp ?>">
			            <input type="hidden" name="auto_price_rush" value="<?php echo $subtotal_rush ?>">
			            
			            <input type="hidden" name="auto_price_exp" value="<?php echo $subtotal_exp ?>">
			            
			            
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
			            <input type="hidden" name="carrierdiscount" value="<?php echo $carrierdiscount ?>">
			            <input type="hidden" name="depositdiscount" value="<?php echo $depositdiscount ?>">
			            <input type="hidden" name="discstatus" value="0|0|0-0">
			            <input type="hidden" name="ps" value="<?php echo $PriceSource ?>">
			            
			            
			            <?php if($howmany != "onevehicle") { ?>
			            <input type="hidden" name="auto_year2" value="<?php echo $auto_year2 ?>">
			            <input type="hidden" name="auto_make2" value="<?php echo $auto_make2 ?>">
			            <input type="hidden" name="auto_model2" value="<?php echo $auto_model2 ?>">
			            <input type="hidden" name="auto_price2" value="<?php echo $shipprice2 ?>">
			            <input type="hidden" name="auto_price2_exp" value="<?php echo $shipprice2_exp ?>">
			            <input type="hidden" name="auto_price2_rush" value="<?php echo $shipprice2_rush ?>">
			            <input type="hidden" name="auto_year3" value="<?php echo $auto_year3 ?>">
			            <input type="hidden" name="auto_make3" value="<?php echo $auto_make3 ?>">
			            <input type="hidden" name="auto_model3" value="<?php echo $auto_model3 ?>">
			            <input type="hidden" name="auto_price3" value="<?php echo $shipprice3 ?>">
			            <input type="hidden" name="auto_price3_exp" value="<?php echo $shipprice3_exp ?>">
			            <input type="hidden" name="auto_price3_rush" value="<?php echo $shipprice3_rush ?>">
			            <input type="hidden" name="auto_year4" value="<?php echo $auto_year4 ?>">
			            <input type="hidden" name="auto_make4" value="<?php echo $auto_make4 ?>">
			            <input type="hidden" name="auto_model4" value="<?php echo $auto_model4 ?>">
			            <input type="hidden" name="auto_price4" value="<?php echo $shipprice4 ?>">
			            <input type="hidden" name="auto_price4_exp" value="<?php echo $shipprice4_exp ?>">
			            <input type="hidden" name="auto_price4_rush" value="<?php echo $shipprice4_rush ?>">
			            <input type="hidden" name="auto_year5" value="<?php echo $auto_year5 ?>">
			            <input type="hidden" name="auto_make5" value="<?php echo $auto_make5 ?>">
			            <input type="hidden" name="auto_model5" value="<?php echo $auto_model5 ?>">
			            <input type="hidden" name="auto_price5" value="<?php echo $shipprice5?>">
			            <input type="hidden" name="auto_price5_exp" value="<?php echo $shipprice5_exp ?>">
			            <input type="hidden" name="auto_price5_rush" value="<?php echo $shipprice5_rush ?>">
			            <?php } ?>
			            
			            <input type="hidden" name="strQuote_vehicle_operational" value="<?php echo $vehicle_operational ?>">
			            <input type="hidden" name="strQuote_vehicle_trailer" value="<?php echo $vehicle_trailer ?>">


			            
			            <input type="hidden" name="rating_origin" value="<?php echo $rating_origin ?>">
			            <input type="hidden" name="rating_dest" value="<?php echo $rating_dest ?>">
			            <input type="hidden" name="rating_vehicle" value="<?php echo $rating_vehicle ?>">
			            
			            <input type="hidden" name="strtotalprice" id="totalprice" value="<?php echo $totalprice ?>">
			            <input type="hidden" name="strtotalprice_exp" id="totalprice_exp" value="<?php echo $totalprice_exp ?>">
			            <input type="hidden" name="strtotalprice_rush" id="strtotalprice_rush" value="<?php echo $totalprice_rush ?>">

			            
			            <input type="hidden" name="strtotalprice1" id="totalprice1" value="<?php echo $totalprice1 ?>">
			            <input type="hidden" name="strtotalprice1_exp" id="totalprice1_exp" value="<?php echo $totalprice1_exp ?>">
			            <input type="hidden" name="strtotalprice1_rush" id="strtotalprice1_rush" value="<?php echo $totalprice1_rush ?>">
			            
			            <input type="hidden" name="strtotalprice2" id="totalprice2" value="<?php echo $totalprice2 ?>">
			            <input type="hidden" name="strtotalprice2_exp" id="totalprice2_exp" value="<?php echo $totalprice2_exp ?>">
			            <input type="hidden" name="strtotalprice2_rush" id="strtotalprice2_rush" value="<?php echo $totalprice2_rush ?>">
			            
			            <input type="hidden" name="strtotalprice3" id="totalprice3" value="<?php echo $totalprice3 ?>">
			            <input type="hidden" name="strtotalprice3_exp" id="totalprice3_exp" value="<?php echo $totalprice3_exp ?>">
			            <input type="hidden" name="strtotalprice3_rush" id="strtotalprice3_rush" value="<?php echo $totalprice3_rush ?>">
			            
			            <input type="hidden" name="strtotalprice4" id="totalprice4" value="<?php echo $totalprice4 ?>">
			            <input type="hidden" name="strtotalprice4_exp" id="totalprice4_exp" value="<?php echo $totalprice4_exp ?>">
			            <input type="hidden" name="strtotalprice4_rush" id="strtotalprice4_rush" value="<?php echo $totalprice4_rush ?>">
			            
			            <input type="hidden" name="strtotalprice5" id="totalprice5" value="<?php echo $totalprice5 ?>">
			            <input type="hidden" name="strtotalprice5_exp" id="totalprice5_exp" value="<?php echo $totalprice5_exp ?>">
			            <input type="hidden" name="strtotalprice5_rush" id="strtotalprice5_rush" value="<?php echo $totalprice5_rush ?>">
			            
			            
			            <input type="hidden" name="strDeposit" value="<?php echo $deposit_std ?>">
			            <input type="hidden" name="strDeposit_exp" value="<?php echo $deposit_exp ?>">
			            <input type="hidden" name="strDeposit_rush" value="<?php echo $deposit_rush ?>">
			            
			            
			            <input type="hidden" name="strdeposit1_std" id="strdeposit1_std" value="<?php echo $deposit_std1 ?>">
			            <input type="hidden" name="strdeposit1_exp" id="strdeposit1_exp" value="<?php echo $deposit_exp1 ?>">
			            <input type="hidden" name="strdeposit1_rush" id="strdeposit1_rush" value="<?php echo $deposit_rush1 ?>">
			            
			            <input type="hidden" name="strdeposit2_std" id="strdeposit2_std" value="<?php echo $deposit2_std ?>">
			            <input type="hidden" name="strdeposit2_exp" id="strdeposit2_exp" value="<?php echo $deposit2_exp ?>">
			            <input type="hidden" name="strdeposit2_rush" id="strdeposit2_rush" value="<?php echo $deposit2_rush ?>">
			            
			            <input type="hidden" name="strdeposit3_std" id="strdeposit3_std" value="<?php echo $deposit3_std ?>">
			            <input type="hidden" name="strdeposit3_exp" id="strdeposit3_exp" value="<?php echo $deposit3_exp ?>">
			            <input type="hidden" name="strdeposit3_rush" id="strdeposit3_rush" value="<?php echo $deposit3_rush ?>">
			            
			            <input type="hidden" name="strdeposit4_std" id="strdeposit4_std" value="<?php echo $deposit4_std ?>">
			            <input type="hidden" name="strdeposit4_exp" id="strdeposit4_exp" value="<?php echo $deposit4_exp ?>">
			            <input type="hidden" name="strdeposit4_rush" id="strdeposit4_rush" value="<?php echo $deposit4_rush ?>">
			            
			            <input type="hidden" name="strdeposit5_std" id="strdeposit5_std" value="<?php echo $deposit5_std ?>">
			            <input type="hidden" name="strdeposit5_exp" id="strdeposit5_exp" value="<?php echo $deposit5_exp ?>">
			            <input type="hidden" name="strdeposit5_rush" id="strdeposit5_rush" value="<?php echo $deposit5_rush ?>">
			            
			            <input type="hidden" name="pricetier" id="pricetier" value="1">
						
						 <input type="hidden" name="Selected_tier_name" id="Selected_tier_name" value="">
						 
						  <input type="hidden" name="Selected_tier_price" id="Selected_tier_price" value="">
			            
			           
			            
			            <?php
			            $standardprice = $totalprice;
			            $expeditedprice = $totalprice_exp;
			            $rushprice = $totalprice_rush
			            
			            
			            ?>
						
			            
			            <script type="text/javascript">
			            jQuery(document).ready(function() {
			                jQuery("#confirmLink1").click(function(e) {
			            		e.preventDefault();
			                    jQuery('#pricetier').val('1');
								
								jQuery('#Selected_tier_name').val('Standard Rate');
								jQuery('#Selected_tier_price').val('<?php echo $totalprice; ?>');
								
								
			                    document.mainform.submit();
			            	});
			            
			                jQuery("#confirmLink2").click(function(e) {
			            		e.preventDefault();
			            		jQuery('#totalprice').val('<?php echo $expeditedprice ?>');
			                    jQuery('#pricetier').val('2');
								
								jQuery('#Selected_tier_name').val('Expedited Rate');
								jQuery('#Selected_tier_price').val('<?php echo $expeditedprice; ?>');
								
			                    document.mainform.submit();
			            
			            	});
			            
			                jQuery("#confirmLink3").click(function(e) {
			            		e.preventDefault();
			            		jQuery('#totalprice').val('<?php echo $rushprice ?>');
			                    jQuery('#pricetier').val('3');
								
								jQuery('#Selected_tier_name').val('Rush Rate');
								jQuery('#Selected_tier_price').val('<?php echo $rushprice; ?>');
								
			                    document.mainform.submit();
			            
			            	});
			
			
			                
			                
			                
			                
			                });
			            </script>
			
			            <div class="package_section" id="package_main">
	            			<h1 class="head">Choose Your Rate</h1>

		                <div class="section fieldentry container">
		                    
	                        <?php
	                        
	                        if ($howmany == "onevehicle") {
	                        	$strDepositSHOW = $deposit_std;
	                        	
	                        	$balancestandard = $subtotal_std;
	                            $balanceexpedited = $subtotal_exp;
	                            $balancerush = $subtotal_rush;
	                        } else {
	                        	$strDepositSHOW = $strDeposit;
	                            $balancestandard = $totalprice - $strDeposit;
	                            $balanceexpedited = $expeditedprice - $strDeposit;
	                            $balancerush = $rushprice - $strDeposit;
	                        }

	                        ?>
	                        
	
	
	                        <div class="colm colm4 levelofservice" >
	                            <div class="p_head">
									<div class="pricerow1">Not in a hurry</div>
									<div class="pricerow">Standard Rate</div>
									<div id="displaybalancestandard" class="pricing"><sup>$</sup><?php echo $totalprice ?></div>
									<div class="custom-separator my-4 mx-auto bg-bas"></div>
								</div>
								
								<div class="p_description">
	                             <p>Usually Assigned to a carrier 1-8 days from the first date available. And then typically picked up one or two days after assigned.</p>
								</div>
								
								 <div class="due_div">
								 	$0 Due Now
								 </div>
								 
	                            <div align="center">
									<button id="confirmLink1" class="submitbutton3">Setup Standard Shipment</button>
								</div>
	                           <!-- <p style="margin-top: 10px;">
									Once your order is assigned a carrier, a nominal partial payment will be charged to the credit card, and the majority carrier balance will be due in Cash or Money Order upon delivery
	                            </p>-->
	                        </div>	                    
	                        
	                        <div class="colm colm4 levelofservice recommend">
	                           
							   <div class="p_head"> 
								  
								  <div class="pricerow1">Recommended</div>
							 	  <div class="pricerow">Expedited Rate</div>
								  <div id="displayexpeditedprice" class="pricing" ><sup>$</sup><?php echo $expeditedprice ?></div>
								  <div class="custom-separator my-4 mx-auto bg-rec"></div>
								
							  </div>
								 
							  <div class="p_description">
							  	  
	                             <p>Usually Assigned to a carrier 1-4 days from the first date available. And then typically picked up one or two days after assigned.</p>
								 
							</div>	 
								 <div class="due_div">
								 	$0 Due Now

								 </div>
								  
	                            <div align="center">
									
									<button  id="confirmLink2" class="submitbutton3">Setup Expedited Shipment</button>
								
								</div>
	                            <!--<p style="margin-top: 10px;">
									Once your order is assigned a carrier, a nominal partial payment will be charged to the credit card, and the majority carrier balance will be due in Cash or Money Order upon delivery
	                            </p>-->
	                        </div>
	           
	                        <div class="colm colm4 levelofservice">
							  
							  <div class="p_head"> 
							  
							      <div class="pricerow1">Fastest</div>
							 	  <div class="pricerow">Rush Rate</div>
								  <div id="displayexpeditedprice" class="pricing" ><sup>$</sup><?php echo $rushprice ?></div>
							  <div class="custom-separator my-4 mx-auto bg-fin"></div>
							  </div>
							
							  <div class="p_description">
	                             <p>Usually Assigned to a carrier 1-2 days from the first date available. And then typically picked up one or two days after assigned.</p>
								
							 </div>
							 
							 <div class="due_div">
							 $0 Due Now
							 </div>
							 	 
							 	 
	                         <div align="center">
								<button id="confirmLink3" class="submitbutton3">Setup Rush Shipment</button>
							</div>
	                            <!--<p style="margin-top: 10px;">
									Once your order is assigned a carrier, a nominal partial payment will be charged to the credit card, and the majority carrier balance will be due in Cash or Money Order upon delivery
	                            </p>-->
	                        </div>
							
							<div class="sectionn_note">Once your order is assigned a carrier, a nominal partial payment will be charged to the credit card, and the majority carrier balance will be due in Cash or Money Order upon delivery</div>
							
		                </div>
		                </div>
		                
			            </form>   
			            
			            
		                
		                
		        </div>
            	</div>
		    
				 <!----Order details---->
            	<div class="section fieldentry" id="shipping_more_details" >  
				     
		          <div class="container">
		         
				    <div class="shippinginfo">
	                      
						    <div class="frm-row">
							
	                            <div class="shippinginfodata head">
									My Order Details
	                            </div>
	                            <div class="custom_bord"></div>
	                        
							</div>
		                        
	                        <div class="frm-row">
	                            <div class="wb_col colm colm8" style="margin-right: 16% !important;margin-left: 16% !important;">
	                            	<div class="card-container">
	                            		<div class="colm colm12">
											<h2 class="shipping-details-header">Shipping Details</h2>
										</div>
								<div class="frm-row">									
										<div class="colm colm12 shippinginfodata">

											<div class="colm colm6">
												Transport Carrier Type:
											</div>
											<div class="colm colm6">
												<div class="text-right">
													<strong><?php echo $vehicle_trailer ?></strong>
												</div>	
											</div>
										</div>
		                       		
		                            <div class="colm colm12 shippinginfodata">
		                            	<div class="colm colm6">
		                            		Shipping From: 
		                            	</div>
		                            	<div class="colm colm6">
											<div class="text-right">
												<strong><?php echo $shippingfromcity ?>, <?php echo $shippingfromstateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingfromzip ?></strong>
											</div>
			                                
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
                        		</div>
		                        <div class="frm-row">
		                            <div class="colm colm12 shippinginfodata">
		                            	<div class="colm colm6">		                                		Shipping To:
		                            	</div> 
		                            	<div class="colm colm6">
											<div class="text-right">
												<strong><?php echo $shippingtocity ?>, <?php echo $shippingtostateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingtozip ?></strong>
											</div>
										</div>
		                                
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
			                            <div class="colm colm12 shippinginfodata">
			                            	<div class="colm colm6 rout_txt">
			                                	Route Distance: 
			                                </div>
			                                <div class="colm colm6">
												<div class="text-right rout_txt">
													<strong><?php echo number_format($totaldistance) ?> miles</strong>
												</div>
											</div>
			                            </div>
			                        </div>
			                        <?php
				                    $daysonroad = $totaldistance/500;
				                    $daysonroad = ceil($daysonroad);
				                    $daysonroadmax = $daysonroad + 2;  
				                    ?>
			                        <div class="frm-row">
			                            <div class="colm colm12 shippinginfodata">
			                                <div class="colm colm6 rout_txt">
			                                	Usual Transit Time:
			                                </div> 
											<div class="colm colm6">
												<div class="text-right">
													<strong><?php echo $daysonroad ?> to <?php echo $daysonroadmax ?> Days</strong>
												</div>
											</div>
			                            </div>
			                        </div>
									<script>										
										// Set Item
										localStorage.setItem("routedistance", "<?php echo number_format($totaldistance) ?>");
										
										// Set Item
										localStorage.setItem("transittime", "<?php echo $daysonroad ?> to <?php echo $daysonroadmax ?>");
									</script>
			                        
									<div class="frm-row">
			                         	<div class="colm colm12 shippinginfodata">
			                         		<div class="colm colm6">
			                         			Insurance Up to $100K
			                         		</div>
			                         		<div class="colm colm6">
			                         			<div class="text-right">
			                         				<strong>Included</strong>
			                         			</div>
			                         		</div>
		                         		</div>
		                         	</div>

		                         	<div class="frm-row">
			                         	<div class="colm colm12 shippinginfodata">
			                         		<div class="colm colm6">
			                         			Service Type
			                         		</div>
			                         		<div class="colm colm6">
			                         			<div class="text-right">
			                         				<strong>Door-to-door</strong>
			                         			</div>
			                         		</div>
		                         		</div>
		                         	</div>
		                         	<div class="frm-row">
			                         	<div class="colm colm12 shippinginfodata">
			                         		<div class="colm colm6">
			                         			Taxes
			                         		</div>
			                         		<div class="colm colm6">
			                         			<div class="text-right">
			                         				<strong>None</strong>
			                         			</div>
			                         		</div>
		                         		</div>
		                         	</div>

		                         </div>




		                         <div class="card-container">
			                         <div class="frm-row">
			                         	<div class="colm colm12">
			                         		<h2 class="shipping-details-header">
			                         			Vehicle Details
			                         		</h2>
			                         	</div>

			                    <div class="frm-row">
		                        <?php if ($howmany != "onevehicle") { ?>
		                            <div class="colm colm12 shippinginfodata">
		                            	<div class="colm colm6">
		                            		Types of Vehicle(s):<br/>
		                            	</div>
		                            	<div class="colm colm6">
			                            	<div class="numbutton1">1</div><div class="makemodel"><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></div><div style="clear:both"></div>
			                            	<?php if(!empty($auto_make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $auto_year2 ?> - <?php echo $auto_make2 ?> - <?php echo $auto_model2 ?></div><div style="clear:both"></div><?php } ?>
			                            	<?php if(!empty($auto_make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $auto_year3 ?> - <?php echo $auto_make3 ?> - <?php echo $auto_model3 ?></div><div style="clear:both"></div><?php } ?>
			                            	<?php if(!empty($auto_make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $auto_year4 ?> - <?php echo $auto_make4 ?> - <?php echo $auto_model4 ?></div><div style="clear:both"></div><?php } ?>
			                            	<?php if(!empty($auto_make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $auto_year5 ?> - <?php echo $auto_make5 ?> - <?php echo $auto_model5 ?></div><div style="clear:both"></div><?php } ?>
			                            </div>
		                            </div>
		                        <?php } else { ?>
		                            <div class="colm colm12 shippinginfodata">
		                            	<div class="colm colm6">
		                                	Types of Vehicle: 
		                                </div>
		                                <div class="colm colm6">
		                                	<div class="text-right">
												<strong><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></strong>
											</div>
										</div>
		                            </div>
		                        <?php } ?>



                                <div class="colm colm12 shippinginfodata">
                                    <div class="colm colm6">
                                    	Vehicle Condition: 
                                    </div>
    								<div class="colm colm6">
    									<div class="text-right">
    										<strong><?php echo $vehicle_operational ?></strong>
    									</div>
    								</div>
                                </div>

		                        </div> 
		                    </div>
			                            
			                    </div>
			                      

	                            </div>
	                            <div class="colm colm6" style="display:none">
		                            <div style="text-align: center;"><img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1-2.jpg" style="border-radius: 5px;"></div>
	                            </div>
	                        </div>
	                        				
                	</div>
	              </div>
	        	</div>
				
				
				
		    
            	<div class="section fieldentry" style="margin:0px !important;">
	            
				
	            
	            <?php if($vehicle_trailer_forced==1) { ?>
                
				<div class="bottom_services">
                    
				<div class="container">
				
				<div class="frm-row">
                    <div class="colm colm12" style="text-align: center; color: #d80202; margin-top:20px; font-size: 22px; line-height: 28px;">
                        <strong>Due to the year and/or make of your vehicle, ENCLOSED TRANSPORT is required.</strong><br/>
                    </div>
                </div>
                </div>
				</div>
                <?php } ?>


            </div>


				
				
		       
	    
		
			<!----------admin section---------->
		    
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
	            
				<div class="maps_section">	
				    
					<div class="container">
						<!--<div class="colm colm1"></div>-->
						
						<div class="colm colm7">
							<strong >Shipping From:</strong>
							<div id="map1"></div>
                            
                            <br>
                            
                            <strong >Shipping To:</strong>
                            <div id="map2"></div>
                            
						</div>
						
						<!--<div class="colm colm1"></div>-->
	            
	                    <div class="colm colm5">
	                    	
	                    	<div style="font-size:15px; text-align: center; margin-top: 36px;">
	
	                        <?php if ($_COOKIE['intquote'] != 1) { ?>
	                        	<a href="/?quoteaction=new" class="quote-btn">New Quote</a>
	                       
	                        	
	                        	<a href="#" class="quote-btn" onclick="reverselocation();">Reverse Location</a>
	
	                       
	                        	<a href="/?quoteaction=redo" class="quote-btn">Redo Quote</a>
	                        	
	                    	<?php } else { ?>
	                    		<a href="/internal-quote/?quoteaction=new" class="quote-btn" >New Internal Quote</a>
	                     
	                        	
	                        	<a href="#" class="quote-btn" onclick="reverselocation();">Reverse Location</a>
	
	                        
	                        	<a href="/internal-quote/?quoteaction=redo" class="quote-btn">Redo Internal Quote</a>
	                        <?php } ?>  
	                        
	                        
	                        <script language="JavaScript">
	                        

	                        
	                        
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
	                        
	                        
	                             
	                            <a href="#" class="quote-btn" onclick="changetrailer();">Change Type of Trailer</a>
	                            
	                            <a href="#" class="quote-btn" onclick="changeoperating();">Change Operating Condition</a>
	                        
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
                    			<td nowrap="nowrap">$<?php echo $nonrunning ?></td>
                    		</tr>
                    		<?php } ?>
                    		<tr>
                    			<td nowrap="nowrap"><strong>Deposit:</strong></td>
                    			<td nowrap="nowrap">$<?php echo $deposit_std ?></td>
                    		</tr>
                    		<tr>
                    			<td nowrap="nowrap"><strong>Total:</strong></td>
                    			<td nowrap="nowrap"><strong>$<?php echo $totalprice ?></strong></td>
                    		</tr>
                    		</table><br>
                    		<?php } ?>
                    
                    		<strong>Shipping Distance:</strong> <?php echo $totaldistance ?> miles<br>
                    		<?php
                    
                    			$deposittotal = $deposittotal_std;
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
                            //echo "<hr style='margin: 10px 0;'>" . DisplayRatingInfo($zipadjustrating);
                    		?>
        	            </div>

	                        
	                                                  	
	                    	</div>
	                    </div>
	                    
	                    <!--<div class="colm colm1"></div>-->
	                </div>
					
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
                        	<a href="https://admin.autotransportdirect.com/quote_email.asp?<?php echo $qs ?>" target="_blank" rel="shadowbox;width=700;height=200" style="text-decoration:none;"><div style="margin: 0 auto;width: 220px;padding: 10px;color: #FFF;background-color: #0062cc; font-size: 16px;font-weight: bold;text-decoration: none;-moz-border-radius: 5px;border-radius: 5px;text-align: center;">E-Mail This Quote</div></a>
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
			
			<!----------admin section---------->
			


			
			<!---logos section--->
	    
	    <div class="frm-row" style="margin: 50px 0 0px;background: #fff!important;padding: 60px 0px;">
		
			<div class="logos-sectio">
			
				<h2>People Love Direct Express Auto Transport</h2>
				<div class="custom_bord"></div>
				<div class="logos_inner">
				
					<div class="log">
						<img src="/wp-content/uploads/2022/07/download.png" alt="" />
					</div>
					
					<div class="log">
						<img src="/wp-content/uploads/2022/07/5-star-google-reviews-google-review-5-stars-11563138345tqaiumovcm.png" alt="" />
					</div>
					
					<div class="log">
						<img src="/wp-content/uploads/2022/07/trustpilot-energy-reviews.png" alt="" />
					</div>
				
				</div>
				
		
			</div>
			 <div class="section-head-main container">
				
				<div class="section-head">
					Direct Express Auto Transport is the highest rated and most reliable car shipper! Going strong since 2004.
				</div>
			
			</div>
			<div class="colm colm12">
                    <?php echo do_shortcode('[elementor-template id="76526"]') ?>
            </div>

        </div>

	    
		<!---video---->	
			
			<div class="bottom_sec_main">
			    	
			<div class="bottom_sec">
			
				<div class="bottom_sec_inner">
					
					<div class="colm colm6">
					       
						  
							
							<div class='embed-container'><iframe src='https://player.vimeo.com/video/460700109' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
							
							 <div style="text-align:center; font-size: 16px; line-height: 22px; font-weight: 600 !important;margin-top: 15px;">How Pricing Tiers Work<div style="margin-top:10px;"></div>
				    </div>
					
					</div>
					
				
                    <div class="colm colm16">
					
                        <p>Direct Express Auto Transport has shipped over 300,000 vehicles and that gives us the ability to predict the probability of how quickly yours will be assigned a driver from the date that you make it available.</p> 

						<p>Vehicles usually get picked up within one or two days of assignment to a carrier, sometimes even the same day.</p> 
						
						<p>The transit time on the road is usually one (1) day for every 500 miles distance. Allow an extra day or two for picking up and dropping off vehicles.</p>
						
						<p>The car shipping industry typically cannot guarantee shipping dates or times, because too many things may happen that can alter even the best laid plans. So dates and times are estimated.</p>
						
						<p>The price owed a carrier once assigned cannot be changed because the carrier agreed to transport the vehicle(s) based upon the posted rate. Otherwise, he may not have selected the order.</p>
						
						<p>Direct Express Auto Transport is very experienced regarding pricing. Our auto transport quote calculator was not only the first online, it is still the most sophisticated and reliable. The Standard Rate works plenty fine, but we offer more options to the customer with Expedited and Rush rates. Both Expedited and Rush rates take a lot of stress out of the process for the customer.</p> 

                        <p>Booking is easy online or please call us at <a href="tel:800-600-3750">800-600-3750</a></p>
                       
                        
                    </div>
                
					
			
			</div>
			
			</div>
		</div>	

                
           <!--  <div class="section fieldentry operations">
                
                <div class="frm-row">
	                
                    <div class="container">       
                        
						<div class="hours_oper">Hours of Operation – Weekdays</div>
						<div class="custom_bord" style="margin-top: 0px;"></div>
						
						<p class="hours">Eastern:&nbsp;9:00am&nbsp;-&nbsp;7:00pm &nbsp;|&nbsp; Central:&nbsp;8:00am&nbsp;-&nbsp;6:00pm &nbsp;|&nbsp; Mountain:&nbsp;7:00am&nbsp;-&nbsp;5:00pm &nbsp;|&nbsp; Pacific:&nbsp;6:00am&nbsp;-&nbsp;4:00pm</p>
						
						<div class="cards">We accept all major Credit Cards</div>
                        
						<div class="cards_img">
						    
						    <div class="img_logo">
						        <img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/mastercard.png" alt="Master card">
						    </div>
						    
						    <div class="img_logo">
						        <img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/amex.png" alt="American Express">
						    </div>
						    
						    <div class="img_logo">
						        <img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/visa.png" alt="Visa">
						    </div>
						    
						    <div class="img_logo">
						        <img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/discover.png" alt="Discovery">
						    </div>
						    
						</div>
						
					</div>
				</div>
				
				
				
                
        	</div> -->
                            
                                






<?php } ?>



	</div>


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