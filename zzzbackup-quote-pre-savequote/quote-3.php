<?php
    
$_SESSION['DEATDeposit'] = $_SESSION['DEATDeposit'];    
$CurrentUsername = $_SESSION['rep'];
$shippingfromzip = postdb('shippingfromzip');
$shippingfromcity = postdb('shippingfromcity');
$shippingfromstate = postdb('shippingfromstate');
$shippingfromstatedisp = GetStateName($shippingfromstate);
$shippingfromstateabbr = GetStateAbbr($shippingfromstate);
$shippingfromstateabbr = strtoupper($shippingfromstateabbr);
$shippingtozip = postdb('shippingtozip');
$shippingtocity = postdb('shippingtocity');
$shippingtostate = postdb('shippingtostate');
$shippingtostatedisp = GetStateName($shippingtostate);
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

if ($shippingtocitystate!="") {
    $citystate=explode(",", $shippingtocitystate);
    $shippingtocity = $citystate[0];
    $shippingtostate = trim($citystate[1]);
    $shippingtostateabbr = $shippingtostate;
}


$auto_year = postdb('auto_year');
$auto_model = postdb('auto_model');
$auto_make = postdb('auto_make');

$vehicle_operational = postdb('vehicle_operational');
$vehicle_trailer = postdb('vehicle_trailer');
$_SESSION['vehicle_operational'] = $vehicle_operational;
$_SESSION['vehicle_trailer'] = $vehicle_trailer;


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

//SALES CONVERSION UPDATE start
$trackid = $_SESSION['trackid'];
if (!empty($trackid)) {
	$zipadjustrating = GetRatingRep($shippingfromzip,$shippingtozip,$totaldistance);
	$sql = "update sale_conversion set fromzip='$shippingfromzip',tozip='$shippingtozip',quote_distance='$totaldistance',zipadjustrating='$zipadjustrating',dateupdated=NOW(),sale_status = '2. Quote Summary' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

if($vehicle_trailer == "Enclosed") {
	$enclosed = 1;
} else {
	$enclosed = 0;
}

if (session('rep') == "claydough") {
    $debug=1;
} else {
    $debug=0;
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


	if (!empty($auto_make2) && !empty($auto_model2)) {
		$shipprice2 = GetQuote($auto_year2,$auto_make2,$auto_model2,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice2 = $shipprice2-$_SESSION['DEATDeposit'];if (!empty($auto_make2) && !empty($auto_model2));
	}

	if (!empty($auto_make3) && !empty($auto_model3)) {
		$shipprice3 = GetQuote($auto_year3,$auto_make3,$auto_model3,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice3 = $shipprice3-$_SESSION['DEATDeposit'];
	}

	if (!empty($auto_make4) && !empty($auto_model4)) {
		$shipprice4 = GetQuote($auto_year4,$auto_make4,$auto_model4,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice4 = $shipprice4-$_SESSION['DEATDeposit'];
	}

	if (!empty($auto_make5) && !empty($auto_model5)) {
		$shipprice5 = GetQuote($auto_year5,$auto_make5,$auto_model5,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,0);
		$shipprice5 = $shipprice5-$_SESSION['DEATDeposit'];
	}
	
	
	$subtotaldeposits = $_SESSION['DEATDeposit'] * $numvehicles;
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

	if ($numvehicles<3) {
		$depositdiscount = 0 * $numvehicles;
		$carrierdiscount = 0 * $numvehicles;
	} elseif ($numvehicles>=3 && $numvehicles<=6) {
		$depositdiscount = 25 * $numvehicles;
		$carrierdiscount = 25 * $numvehicles;
	} elseif ($numvehicles >= 7 && $numvehicles <= 10) {
		$depositdiscount = 50 * $numvehicles;
		$carrierdiscount = 50 * $numvehicles;
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


$sql = "update sale_conversion set quote_amount='$totalprice' where trackid = '$trackid'";
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


if ($howmany == "onevehicle") {
	$strDeposit = $_SESSION['DEATDeposit'];
	$depositpervehicle = $_SESSION['DEATDeposit'];
} else {
	$strDeposit = $totaldeposit;
}




//Get Message Text
$msg_textstart = "";

$shippingfromzip3 = substr($shippingfromzip,0,3);
$shippingtozip3 = substr($shippingtozip,0,3);


//Check for Zip Message Start
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
if(session('admin')=="") {
?>
    #map1, #map2 {
        display: none;
    }
    

<?php } ?>



.setupship {
    margin-top: 10px;
    padding: 15px 0 0 5%;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

.setupshipcol {
    text-align: center;
    font-size: 16px;
}

.setupshipcol .pricerow {
    font-size: 23px;
}

.setupshipcol p {
    margin: 10px 0 !important;
}

.setupshipcol .setupshipment {
    margin: 3px 0 0 0;
    font-weight: bold;
}

.submitbutton3{
	padding:10px 30px;
	margin:0;
	border:0;
	background: #2fde2f;
	cursor:pointer !important;
	color:#000;
	font-size: 18px;
	font-weight: bold;
	-moz-border-radius: 5px;
    border-radius: 5px;
}


</style>


<?php if(session('admin')!="") { ?>
<script language="Javascript">
jQuery(function() {
	jQuery('#map1').gmap({ 'center': '<?php echo $fromlat ?>,<?php echo $fromlong ?>' }).bind();
	jQuery('#map1').gmap('option', 'zoom', 8);
	jQuery('#map2').gmap({ 'center': '<?php echo $tolat ?>,<?php echo $tolong ?>' }).bind();
	jQuery('#map2').gmap('option', 'zoom', 8);
});
</script>
<?php } ?>

<div id="dialog" title="Confirmation Required" style="display:none;">
Did you notify the customer of the helpful hint?
</div>



<script language="Javascript">
jQuery(function(){
   function show_popup(){
      jQuery(".interstitialcontent").hide();
      jQuery(".quotecontents").fadeIn('fast');
   };
   
   <?php if(session('admin')!="") { ?>
        show_popup();
   <?php } else { ?>
        //show_popup();
        window.setTimeout( show_popup, 15000 ); // 5 seconds
   <?php } ?>

});
</script>

<div class="interstitialcontent" style="font-size:30px; line-height:40px; width:85%; margin:0 auto; text-align: center">
    <br>
    Your very reliable auto shipping quote will appear in <span id="timer">15</span> seconds...
    <br><br>
    <div class="trustpilot-widget" style="height:150px;" data-locale="en-US" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="5195d470000064000530e14c" data-style-height="150px" data-style-width="100%" data-theme="light"></div>
    
<!--     <img src="//d36b03yirdy1u9.cloudfront.net/images/face-m.jpg" style="float:left;margin-right:20px;border:1px solid #666;" /> -->
    <div style="float:left;margin-right:20px;"><iframe width="284" height="160" src="https://www.youtube.com/embed/OAcKVBn0zzI?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe></div><div style="margin-top:15px;"></div>Did you know <strong>Direct Express Auto Transport</strong> originated the instant online quote calculator<br>to ship your car? 
    <div style="clear:both;"></div>
    
    <div align="center" style="margin-top:15px">
    <img src="//d36b03yirdy1u9.cloudfront.net/images/5star.png" /><br>
    <span style="font-weight:bold;color:#f4b222;">Google Plus</span> members give <span style="font-weight:bold;color:#f4b222;">5 STARS</span> to<br>
    <strong>Direct Express Auto Transport</strong>
    </div>
    <br>
    <img src="//d36b03yirdy1u9.cloudfront.net/images-v3/auto_transport_promo_v2-3.jpg" style="float:right;margin-left:20px;border:1px solid #666;" /><div style="margin-top:35px;"></div><strong>We respect your privacy</strong> and do not ask for your name, email address or phone number prior to giving a quote. 
    <div style="clear:both;"></div><br>
</div>



<div class="quotecontents" style="display:none;">

    <div class="smart-forms">
    
        <div class="section fieldentry">
            <div class="frm-row">
                <div class="colm colm12">
                    <h1 style="text-align:center;">Book It Now Securely Online!<br></h1>
                </div>
            </div>
        </div>

        <div style="margin:5px 0 10px 0;width:100%;border-top:#999999 solid thin;"></div>



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

 


            <div class="section fieldentry">
                <div class="frm-row">
                    <div class="colm colm3">
                        <div class="stateleft">
                            <?php
                            if(session('admin')!="") {
                            ?>
                                <img src="//d36b03yirdy1u9.cloudfront.net/images/states/<?php echo $shippingfromstateabbr ?>.jpg" />
                            <?php } else { ?>
                                <img src="//d36b03yirdy1u9.cloudfront.net/images/states/<?php echo $shippingfromstateabbr ?>.jpg" />
                                <div style="margin:10px 0; font-weight:bold;font-size:1.2em;"><?php echo $shippingfromstatedisp ?></div>
                            <?php } ?>
                        
                            <div id="map1"></div>
                            <?php if (!empty($Message_From)) { ?>
                            	<div class="mapmsg">
                            	<?php echo $Message_From ?>
                            	</div>
                            <?php } ?>
                        
                        
                            
                            <?php
                            if(session('admin')!="") {
                            ?>
                            	<style type="text/css">
                            	select#honorquoteprice {
                            		padding-top: 10px;
                            		font-size: 15px;
                            		width: 125px;
                            	}
                            	</style>
                            	<div style="font-size:15px;">
   
                            	<a href="/?quoteaction=new" style="padding:5px 30px;background:blue;color:white;border: 2px solid black;font-weight:bold;font-size:12px;">New Quote</a>
                            	<br><br>
                            	<a href="/?quoteaction=redo" style="padding:5px 30px;background:#ffcf17;color:black;border: 2px solid black;font-weight:bold;font-size:12px;">Redo Quote</a>
                            	</div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
      
                    <div class="colm colm6 shippinginfo" style="font-size: 1.1em;">
                        
                        <div class="frm-row">
                            <div class="colm colm4">
                                Shipping From:
                            </div>
                            <div class="colm colm8">
                                <strong><?php echo $shippingfromcity ?>, <?php echo $shippingfromstateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingfromzip ?></strong>
                                
                                <?php if(session('admin')!="") { ?>
                                    <div>
                                    <a href="http://www.mapquest.com/maps/map.adp?city=<?php echo urlencode($shippingfromcity) ?>&state=<?php echo urlencode($shippingfromstateabbr) ?>&address=&zip=<?php echo urlencode($shippingfromzip) ?>&country=us&zoom=6" target="_new">MapQuest</a>
                                    		&nbsp;&nbsp;
                                    		<a href="http://maps.google.com/maps?q=<?php echo urlencode($shippingfromcity) ?>,+<?php echo urlencode($shippingfromstate) ?>+<?php echo urlencode($shippingfromzip) ?>" target="_new">Google Maps</a>
                                    <?php
                                    $cdpickup = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity= $shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
                                    $cdpickup = urlencode($cdpickup);
                                    $cdpickupstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_$shippingfromstateabbr&pickupRadius=25&pickupCity=&pickupState=$shippingfromstateabbr&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$shippingtostateabbr&deliveryRadius=25&deliveryCity=&deliveryState=$shippingtostateabbr&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
                                    $cdpickupstate = urlencode($cdpickupstate);
                                    ?>
                                    <br>
                                	<a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cdpickup ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
                                	&nbsp;&nbsp;
                                	<a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cdpickupstate ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>
                                    </div>
                                <?php } ?>                                
                                        
                            </div>
                            
                        </div>

                        
                        <div class="frm-row">
                            <div class="colm colm4">
                                Shipping To: 
                            </div>
                            <div class="colm colm8">
                                <strong><?php echo $shippingtocity ?>, <?php echo $shippingtostateabbr ?>&nbsp;&nbsp;&nbsp;<?php echo $shippingtozip ?></strong>
                                <?php if(session('admin')!="") { ?>
                                    <div>
                                        <a href="http://www.mapquest.com/maps/map.adp?city=<?php echo urlencode($shippingtocity) ?>&state=<?php echo urlencode($shippingtostateabbr) ?>&address=&zip=<?php echo urlencode($shippingtozip) ?>&country=us&zoom=6" target="_new">MapQuest</a>
                                        &nbsp;&nbsp;
                                        <a href="http://maps.google.com/maps?q=<?php echo urlencode($shippingtocity) ?>,+<?php echo urlencode($shippingtostate) ?>+<?php echo urlencode($shippingtozip) ?>" target="_new">Google Maps</a>
                                        <?php
                                        $cddeliver = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=$shippingtocity&pickupState=$shippingtostateabbr&pickupZip=$shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity=$shippingfromcity&deliveryState=$shippingfromstateabbr&deliveryZip=$shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
                                        $cddeliver = urlencode($cddeliver);
                                        $cddeliverstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_$shippingtostateabbr&pickupRadius=25&pickupCity=&pickupState=$shippingtostateabbr&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$shippingfromstateabbr&deliveryRadius=25&deliveryCity=&deliveryState=$shippingfromstateabbr&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=1&secondarySort=4&listingsPerPage=100";
                                        $cddeliverstate = urlencode($cddeliverstate);
                                        ?>
                                        <br>
                                        <a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cddeliver ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
                                        &nbsp;&nbsp;
                                        <a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cddeliverstate ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        
                        
                        
                        
                        <div class="frm-row">
                        <?php if ($howmany != "onevehicle") { ?>
                            <div class="colm colm4">
                                Types of Vehicles:
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
                                Type of Vehicle:
                            </div>
                            <div class="colm colm8">
                                <strong><?php echo $auto_year ?> - <?php echo $auto_make ?> - <?php echo $auto_model ?></strong>
                            </div>
                        <?php } ?>
                        </div>
                        
                        <div class="frm-row">
                            <div class="colm colm4">
                                Operating Condition:
                            </div>
                            <div class="colm colm8">
                                <strong><?php echo $vehicle_operational ?> and Rolls, Brakes, Steers</strong>
                            </div>
                        </div>
                        
                        <div class="frm-row">
                            <div class="colm colm4">
                                Type of Trailer:
                            </div>
                            <div class="colm colm8">
                                <strong><?php echo $vehicle_trailer ?></strong>
                            </div>
                        </div>
                    </div>

                    <div class="colm colm3">
                        <div class="stateright">
                            <?php
                            if(session('admin')!="") {
                            ?>
                                <img src="//d36b03yirdy1u9.cloudfront.net/images/states/<?php echo $shippingtostateabbr ?>.jpg" />
                            <?php } else { ?>
                                    <img src="//d36b03yirdy1u9.cloudfront.net/images/states/<?php echo $shippingtostateabbr ?>.jpg" />
                                    <div style="margin-top:15px; font-weight:bold;font-size:1.2em"><?php echo $shippingtostatedisp ?></div>
                            <?php } ?>
                        
                        
                            <div id="map2"></div>
                            <?php if (!empty($Message_To)) { ?>
                            	<div class="mapmsg">
                            	<?php echo $Message_To ?>
                            	</div>
                            <?php } ?>
                            
                        
                        
                            <?php
                            if(session('admin')!="") {
                            ?>
                            	<div style="font-size:15px;">
          
                        
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
                        
                        
                            </script>
                        
                            <form action="" method="post" name="changequote" id="changequote">
                            <input type="hidden" name="shippingfromzip" value="<?php echo $shippingfromzip ?>">
                            <input type="hidden" name="shippingfromcity" value="<?php echo $shippingfromcity ?>">
                            <input type="hidden" name="shippingfromstate" value="<?php echo $shippingfromstatedisp ?>">
                            <input type="hidden" name="shippingtozip" value="<?php echo $shippingtozip ?>">
                            <input type="hidden" name="shippingtocity" value="<?php echo $shippingtocity ?>">
                            <input type="hidden" name="shippingtostate" value="<?php echo $shippingtostatedisp ?>">
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
                            <a href="#" onclick="changetrailer();"><div style="padding:5px 30px;background:orange;color:black;border: 2px solid black;font-weight:bold;font-size:12px;">Change Type of Trailer</div></a>
                            <br>
                            <a href="#" onclick="changeoperating();"><div  style="padding:5px 30px;background:purple;color:white;border: 2px solid black;font-weight:bold;font-size:12px;">Change Operating Condition</div></a>
                        
                            </form>
                        
                        	</div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

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
            
            
            <?php if(session('admin')!="" && (!empty($Message_To) || !empty($Message_From))) { ?>
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
            <input type="hidden" name="auto_price5" value="<?php echo $shipprice6 ?>">
            <?php } ?>
            
            <input type="hidden" name="strQuote_vehicle_operational" value="<?php echo $vehicle_operational ?>">
            <input type="hidden" name="strQuote_vehicle_trailer" value="<?php echo $vehicle_trailer ?>">
            
            <input type="hidden" name="nearorigincity" value="<?php session("nearorigincity") ?>">
            <input type="hidden" name="neardestcity" value="<?php session("neardestcity") ?>">
            
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
                $expeditedprice = $expeditedprice - $carrierdiscount;
            }
            
            $rushprice = $totalprice + ($rushrate * $numvehicles);
            
            if ($numvehicles>1) {
                $rushprice = $rushprice - $carrierdiscount;
            }
            ?>
            
            <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("#confirmLink1").click(function(e) {
            		e.preventDefault();
                    jQuery('#pricetier').val('1');
                    <?php if(session('admin')!="" && (!empty($Message_To) || !empty($Message_From))) { ?>
                        repcheck();
                    <?php } else { ?>
                        document.mainform.submit();
                    <?php } ?>
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
                    <?php if(session('admin')!="" && (!empty($Message_To) || !empty($Message_From))) { ?>
                        repcheck();
                    <?php } else { ?>
                        document.mainform.submit();
                    <?php } ?>
            
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
                    <?php if(session('admin')!="" && (!empty($Message_To) || !empty($Message_From))) { ?>
                        repcheck();
                    <?php } else { ?>
                        document.mainform.submit();
                    <?php } ?>
            
            	});


                
                function repcheck() {
                    jQuery("#dialog").dialog({
                	  modal: true,
                	  buttons : {
                	    "YES" : function() {
                	    	document.mainform.helpfulhintmention.value='yes';
                	    	document.mainform.submit();
                	    },
                	    "NO" : function() {
                	    	document.mainform.helpfulhintmention.value='no';
                	      	jQuery(this).dialog("close");
                	    },
                	    "IGNORE" : function() {
                	    	document.mainform.helpfulhintmention.value='ignore';
                	    	document.mainform.submit();
                	    }
                	  }
                	});
                
                
                	jQuery("#dialog").dialog("open");
                }
                
                
                });
                </script>
                
                
                
                <div class="section fieldentry" style="margin-bottom: 12px;">
                    <div class="frm-row" style="border-top: 1px solid #CCC; padding-top: 10px;">
                        <div class="colm colm12">
                            <div style="font-weight:bold; text-align: center; font-size: .9em;">
                            Hours of Operation – Weekdays &nbsp;|&nbsp; Eastern:&nbsp;9:00am&nbsp;-&nbsp;8:00pm &nbsp;|&nbsp; Central:&nbsp;8:00am&nbsp;-&nbsp;7:00pm &nbsp;|&nbsp; Mountain:&nbsp;7:00am&nbsp;-&nbsp;6:00pm &nbsp;|&nbsp; Pacific:&nbsp;6:00am&nbsp;-&nbsp;5:00pm
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="section fieldentry">
                    <div class="frm-row selectpricinglabel" style="display:none;">
                        <div class="colm colm12">
                            <div style="font-weight:bold; text-align: center;">
                                Select 1 of 3 Pricing Levels
                            </div>
                        </div>
                    </div>
                    <div class="frm-row setupship" style="padding-bottom:20px;">
                        <?php
                        $balancestandard = $totalprice - $_SESSION['DEATDeposit'];
                        $balanceexpedited = $expeditedprice - $_SESSION['DEATDeposit'];
                        $balancerush = $rushprice - $_SESSION['DEATDeposit'];
                        ?>
                        <div class="colm colm3 setupshipcol">
                            <div class="pricerow">Standard Price<br/><strong>$<span id="displaybalancestandard"><?php echo $totalprice ?></span></strong></div>
                            <p>Typically Assigned in 1-7 Days*</p>
                            <p>Probability of that is 80%</p>
                            <input type="button" id="confirmLink1" value="Select Standard" class="submitbutton3">
                            <div class="setupshipment">to set-up shipment</div>
                            <div class="priceexplain">
                            Credit Card Deposit $<?php echo $_SESSION['DEATDeposit'] ?><br>
                            Balance To Driver At Destination $<span id="balancestandard"><?php echo $balancestandard ?></span>
                            </div>
                        </div>
                        <div class="colm colm1"></div>
                        <div class="colm colm3 setupshipcol">
                            <div class="pricerow">Expedited Price<br/><strong>$<span id="displayexpeditedprice"><?php echo $expeditedprice ?></span></strong></div>
                            <p>Typically Assigned in 1-4 Days*</p>
                            <p>Probability of that is 85%</p>
                            <input type="button" id="confirmLink2" value="Select Expedited" class="submitbutton3">
                            <div class="setupshipment">to set-up shipment</div>
                            <div class="priceexplain">
                            Credit Card Deposit $<?php echo $_SESSION['DEATDeposit'] ?><br>
                            Balance To Driver At Destination $<span id="balanceexpedited"><?php echo $balanceexpedited ?></span>
                            </div>
                        </div>
                        <div class="colm colm1"></div>
                        <div class="colm colm3 setupshipcol">
                            <div class="pricerow">Rush Price<br/><strong>$<span id="displayrushprice"><?php echo $rushprice ?></span></strong></div>
                            <p>Typically Assigned in 1-2 Days*</p>
                            <p>Probability of that is 90%</p>
                            <input type="button" id="confirmLink3" value="Select Rush" class="submitbutton3">
                            <div class="setupshipment">to set-up shipment</div>
                            <div class="priceexplain">
                            Credit Card Deposit $<?php echo $_SESSION['DEATDeposit'] ?><br>
                            Balance To Driver At Destination $<span id="balancerush"><?php echo $balancerush ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                


                
                <?php if(session('admin')!="") {
                	$qs = "sendfrom=" . urlencode($shippingfromcity) . ",&nbsp;" . urlencode($shippingfromstate) . "&nbsp;&nbsp;" . urlencode($shippingfromzip) . "&sendto=" . urlencode($shippingtocity) . ",&nbsp;" . urlencode($shippingtostate) . "&nbsp;&nbsp;" . urlencode($shippingtozip) . "&numvehicles=" . urlencode($numvehicles) . "&vehicle=" . urlencode($auto_make) . " - " . urlencode($auto_model) . "&vehicle2=" . urlencode($auto_make2) . " - " . urlencode($auto_model2) . "&vehicle3=" . urlencode($auto_make3) . " - " . urlencode($auto_model3) . "&vehicle4=" . urlencode($auto_make4) . " - " . urlencode($auto_model4) . "&vehicle5=" . urlencode($auto_make5) . " - " . urlencode($auto_model5) . "&operating=" . urlencode($vehicle_operational) . urlencode(" and Rolls, Brakes, Steers") . "&trailer=" . urlencode($vehicle_trailer) . "&deposit=" . urlencode($_SESSION['DEATDeposit']) . "&price=" . urlencode(number_format($totalprice));
                	?>
                	<div class="section fieldentry">
                        <div class="frm-row">
                            <div class="colm colm12">
                            	<a href="http://www.autotransportdirect.com/quote_email.asp?<?php echo $qs ?>" rel="shadowbox;width=700;height=200" style="text-decoration:none;"><div style="margin: 0 auto;width: 220px;padding: 10px;color: #FFF;background-color: #308DFF;font-size: 16px;font-weight: bold;text-decoration: none;-moz-border-radius: 5px;border-radius: 5px;text-align: center;">E-Mail This Quote</div></a>
                            </div>
                        </div>
                	</div>
                <?php } ?>
                


                <?php if(session('admin')!="") { ?>
                    <div class="section fieldentry">
                        <div class="frm-row">
                            <div class="colm colm12">
                            	<div style="width:420px;border:2px solid #000;background:#eee;padding:5px;margin: 0 auto; margin-bottom:15px; text-align: center">
                            		<strong>OFFICE USE ONLY</strong><br>
                                    <?php
                                    $cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=8&secondarySort=4&listingsPerPage=100";
                                    $cd50 = urlencode($cd50);
                                    $cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$shippingfromcity&pickupState=$shippingfromstateabbr&pickupZip=$shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$shippingtocity&deliveryState=$shippingtostateabbr&deliveryZip=$shippingtozip&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=8&secondarySort=4&listingsPerPage=100";
                                    $cd100 = urlencode($cd100);
                                    ?>
                            
                                    <a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cd50 ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-50</a>
                            		&nbsp;&nbsp;
                            		<a href="http://www.autotransportdirect.com/admin2k7/redir.asp?url=<?php echo $cd100 ?>&orderid=0&type=centraldispatchsearch" target="_new">CD-100</a>
                                    <br>
                            
                                    <?php if(session('admin')!="") {
                                    	$qs = "cd50url=" . $cd50 . "&cd100url=" . $cd100 . "&sendfrom=" . urlencode($shippingfromcity) . ", " . urlencode($shippingfromstate) . "  " . urlencode($shippingfromzip) . "&sendto=" . urlencode($shippingtocity) . ", " . urlencode($shippingtostate) . "  " . urlencode($shippingtozip) . "&numvehicles=" . urlencode($numvehicles) . "&vehicle=" . urlencode($auto_make) . " - " . urlencode($auto_model) . "&vehicle2=" . urlencode($auto_make2) . " - " . urlencode($auto_model2) . "&vehicle3=" . urlencode($auto_make3) . " - " . urlencode($auto_model3) . "&vehicle4=" . urlencode($auto_make4) . " - " . urlencode($auto_model4) . "&vehicle5=" . urlencode($auto_make5) . " - " . urlencode($auto_model5) . "&vehicle6=" . urlencode($auto_make6) . " - " . urlencode($auto_model6) . "&vehicle7=" . urlencode($auto_make7) . " - " . urlencode($auto_model7) . "&vehicle8=" . urlencode($auto_make8) . " - " . urlencode($auto_model8) . "&vehicle9=" . urlencode($auto_make9) . " - " . urlencode($auto_model9) . "&vehicle10=" . urlencode($auto_make10) . " - " . urlencode($auto_model10) . "&operating=" . urlencode($vehicle_operational) . urlencode(" and Rolls, Brakes, Steers") . "&trailer=" . urlencode($vehicle_trailer) . "&deposit=" . urlencode($_SESSION['DEATDeposit']) . "&price=" . urlencode(number_format($totalprice));
                            
                                    	?>
                                    	<a href="/priceissue/?<?php echo $qs ?>" target="_blank" style="text-decoration:none;">Report Price Issue To Mike</a>
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
                            			<? if (!empty($auto_make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $auto_year2 ?> - <?php echo $auto_make2 ?> - <?php echo $auto_model2 ?> - $<?php echo $shipprice2 ?></div><div style="clear:both"></div><?php } ?>
                            			<? if (!empty($auto_make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $auto_year3 ?> - <?php echo $auto_make3 ?> - <?php echo $auto_model3 ?> - $<?php echo $shipprice3 ?></div><div style="clear:both"></div><?php } ?>
                            			<? if (!empty($auto_make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $auto_year4 ?> - <?php echo $auto_make4 ?> - <?php echo $auto_model4 ?> - $<?php echo $shipprice4 ?></div><div style="clear:both"></div><?php } ?>
                            			<? if (!empty($auto_make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $auto_year5 ?> - <?php echo $auto_make5 ?> - <?php echo $auto_model5 ?> - $<?php echo $shipprice5 ?></div><div style="clear:both"></div><?php } ?>
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
                	</div>
                <?php } ?>


                <div class="section fieldentry">
                    <div class="frm-row">
                        <div class="colm colm12" style="text-align: center;  font-size: 1.1em;">
                            <div style="font-weight:bold;font-size:18px;">Door to Door Service</div>
                            
                            <br>
                            
                            <p>Place a nominal deposit of <strong>$<?php echo $strDeposit ?></strong> to set up your shipment, which is included in your quote.</p>
                            <p>There are no taxes or hidden fees.</p>
                            <p>The balance due is made payable to the carrier with either Cash or Money Order upon delivery.</p>
                            <p>Your vehicle is fully insured while on the transport carrier.</p>
                            
                            <p>Rated <img src="//d36b03yirdy1u9.cloudfront.net/images/stars-orange.jpg" style="vertical-align:baseline;display:inline-block;position:relative;"/> by Google + Reviews</p>
                            <p><strong>We originated the online car shipping quote calculator.</strong></p>
                            <p><strong>Nobody does it better than Direct Express Auto Transport!</strong></p>
                            <p>* We have shipped over 100,000 vehicles and that gives us the ability to predict the probability of how quickly yours will be assigned a driver from the date that you make it available. Once assigned a carrier, vehicles usually get picked up within 1 or 2 days, sometimes the same day. The transit time then is usually one day for every 500 miles distance. We cannot guarantee any shipping dates or times, nor change the price owed a carrier once assigned. You may add or subtract any dollar amount prior to your vehicle assignment but not below the Standard rate. We are very experienced and knowledgeable regarding pricing. Our auto transport quote calculator was not only the first online, it is still the most sophisticated and reliable. The Standard Rate works plenty fine, but we offer more options to the customer with Expedited and Rush rates.</p>
                            Booking is easy online or please call<br />
                            <div style="font-size:40px;color:#308dff;position:relative;margin-top:15px; font-weight:bold;">
                            800-600-3750
                            </div>
                            
                            
                            <font style="font-size:14px;">
                            We accept major Credit Cards<br>
                            </font>
                            <img src="//d36b03yirdy1u9.cloudfront.net/images/Credit-Card-Logos.jpg">
                        </div>
                    </div>
            	</div>
                                
                                




</form>

<?php } ?>



<div class="section fieldentry">
    <div id="promobar">
        <div class="frm-row">
            <div class="colm colm3">
                <div class="promo-box">
                    <img alt="car carrier" src="//d36b03yirdy1u9.cloudfront.net/images-v3/auto_transport_promo_v2-1.jpg">
                    <div class="promo-text">This is the place to perform auto transport quotes to ship your car reliably.</div>
                </div>
            </div>
            <div class="colm colm3">
                <div class="promo-box">
                    <img alt="Auto Transport To Your State" src="//www.autotransportdirect.com/services/stateimage/index.php">
                    <div class="promo-text">We were the first to have an online state to state car shipping quotes calculator.</div>
                </div>
            </div>
            <div class="colm colm3">
                <div class="promo-box">
                    <img alt="Auto Transport Representative" src="//d36b03yirdy1u9.cloudfront.net/images-v3/auto_transport_promo_v2-3.jpg">
                    <div class="promo-text">Our customer service specialists provide the most affordable auto shipping rates.</div>
                </div>
            </div>
            <div class="colm colm3">
                <div class="promo-box">
                    <img alt="Auto Transport Family" src="//d36b03yirdy1u9.cloudfront.net/images-v3/auto_transport_promo_v2-4.jpg">
                    <div class="promo-text">Our car transport rates calculator is used by dealers, movers and people like you.</div>
                </div>
            </div>
            </div>

		</div>
	</div>
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










