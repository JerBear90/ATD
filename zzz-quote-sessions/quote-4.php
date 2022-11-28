<?php
$CurrentUsername = $_SESSION['rep'];

//SALES CONVERSION UPDATE start
$trackid = $_SESSION['trackid'];
if (!empty($trackid)) {
	$zipadjustrating = GetRatingRep($shippingfromzip,$shippingtozip,$totaldistance);
	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '3. Shipment Details' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

    
$strQuote_shippingfromstateabbr = postdb('strQuote_shippingfromstateabbr');
$strQuote_shippingtostateabbr = postdb('strQuote_shippingtostateabbr');
$strQuote_shippingfromstate = postdb('strQuote_shippingfromstate');
$strQuote_shippingtostate = postdb('strQuote_shippingtostate');
$strQuote_shippingfromcity = postdb('strQuote_shippingfromcity');
$strQuote_shippingtocity = postdb('strQuote_shippingtocity');
$strQuote_shippingfromzip = postdb('strQuote_shippingfromzip');
$strQuote_shippingtozip = postdb('strQuote_shippingtozip');
$strQuote_vehicle_operational = postdb('strQuote_vehicle_operational');
$strQuote_vehicle_trailer = postdb('strQuote_vehicle_trailer');
$totaldistance = postdb('totaldistance');

$shippingfrom_sales = postdb('shippingfrom_sales');

$auto_year = postdb('auto_year');
$auto_make = postdb('auto_make');
$auto_model = postdb('auto_model');
$auto_price = postdb('auto_price');

$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');
$auto_year2 = postdb('auto_year2');
$auto_make2 = postdb('auto_make2');
$auto_model2 = postdb('auto_model2');
$auto_price2 = postdb('auto_price2');
$auto_year3 = postdb('auto_year3');
$auto_make3 = postdb('auto_make3');
$auto_model3 = postdb('auto_model3');
$auto_price3 = postdb('auto_price3');
$auto_year4 = postdb('auto_year4');
$auto_make4 = postdb('auto_make4');
$auto_model4 = postdb('auto_model4');
$auto_price4 = postdb('auto_price4');
$auto_year5 = postdb('auto_year5');
$auto_make5 = postdb('auto_make5');
$auto_model5 = postdb('auto_model5');
$auto_price5 = postdb('auto_price5');

$customer_name = postdb('customer_name');
$customer_email = postdb('customer_email');
$customer_phone = postdb('customer_phone');
$customer_movedate = postdb('customer_movedate');

if (session('repeat_email') != "") {
	$customer_email = session("repeat_email");
}

$customer_namearr = explode(" ", $customer_name);

if (sizeof($customer_namearr) > 1) {
	$first_name =  $customer_namearr[0];
	$last_name = $customer_namearr[0];
} else {
	$first_name = $customer_name;
}

$depositpervehicle = postdb('depositpervehicle');
$carrierdiscount = postdb('carrierdiscount');
$depositdiscount = postdb('depositdiscount');
$discstatus = postdb('discstatus');
$ps = postdb('ps');

$helpfulhintmention = postdb('helpfulhintmention');

$DaysWaitingPickupTotalOrders = postdb('DaysWaitingPickupTotalOrders');
$DaysWaitingPickupAvg = postdb('DaysWaitingPickupAvg');
$DaysWaitingDeliverTotalOrders = postdb('DaysWaitingDeliverTotalOrders');
$DaysWaitingDeliverAvg = postdb('DaysWaitingDeliverAvg');
$DaysWaitingAvg = postdb('DaysWaitingAvg');

$rating_origin = postdb('rating_origin');
$rating_dest = postdb('rating_dest');
$rating_vehicle = postdb('rating_vehicle');

$strDeposit = postdb('strDeposit');

$pricetier = postdb('pricetier');

if ($howmany == "onevehicle") {
	$strTotalPrice = postdb('strtotalprice');
	$strBalance = $strTotalPrice - $strDeposit;
} else {
	$strTotalPrice = postdb('strtotalprice');
	$strBalance = $strTotalPrice - $strDeposit;
}


//SALES CONVERSION UPDATE start
$trackid = $_SESSION['trackid'];
if (!empty($trackid)) {
	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '2. Customer Info' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

?>
<style>
    .ui-dialog-titlebar-close {
        display: none;
    }
</style>


<script id="demo" type="text/javascript">

$(document).ready(function() {



	// validate signup form on keyup and submit
	var validator = $("#mainform").validate({
		rules: {
			strCustFirstName: "required",
			strCustLastName: "required",
			strCustEmail: "required",


			strVehicle_ComingFrom: {
				required: function(element) {return $("#strVehicle_ComingFrom_yes:unchecked").length == 0;}
			},


			<?php if($numvehicles == 1) { ?>



				strVehicle_StockNum: {
					required: function(element) {return $("#strVehicle_ComingFrom").val()=='Auto Auction'}
				},




			<?php } else {
    			for ($counter=1; $counter<=$numvehicles; $counter++) {
			?>


				strVehicle_StockNum<?php echo $counter ?>: {
					required: function(element) {return $("#strVehicle_ComingFrom").val()=='Auto Auction'}
				},




			<?php
                }
			}
			?>

			strDateAvailable: {
				date: true,
				required: true
			}



		},
		messages: {
			strDateAvailable: {
				required: "Please enter a Pickup Date",
				date: "Please enter a valid Pickup Date"
			},
			agreetoterms: "You must agree to the Terms & Conditions before proceeding."
		},

		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.insertAfter(element);
		},
		// specifying a submitHandler prevents the default submit, good for the demo
		submitHandler: function() {
			document.mainform.submit();
			//alert('submitted!');
		},
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});


    $( "#strDateAvailable" ).datepicker({
		minDate: '0d',
		maxDate: '+21d',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>'	});
				

});

</script>





<form action="?step=5" method="post" name="mainform" id="mainform">    
<input type="hidden" name="strQuote_shippingfromstateabbr" value="<?php echo $strQuote_shippingfromstateabbr ?>">
<input type="hidden" name="strQuote_shippingtostateabbr" value="<?php echo $strQuote_shippingtostateabbr ?>">
<input type="hidden" name="strQuote_shippingfromstate" value="<?php echo $strQuote_shippingfromstate ?>">
<input type="hidden" name="strQuote_shippingtostate" value="<?php echo $strQuote_shippingtostate ?>">
<input type="hidden" name="strQuote_shippingfromzip" value="<?php echo $strQuote_shippingfromzip ?>">
<input type="hidden" name="strQuote_shippingtozip" value="<?php echo $strQuote_shippingtozip ?>">

<input type="hidden" name="strQuote_shippingfromcity" value="<?php echo $strQuote_shippingfromcity ?>">
<input type="hidden" name="strQuote_shippingtocity" value="<?php echo $strQuote_shippingtocity ?>">



<input type="hidden" name="strQuote_vehicle_operational" value="<?php echo $strQuote_vehicle_operational ?>">
<input type="hidden" name="strQuote_vehicle_trailer" value="<?php echo $strQuote_vehicle_trailer ?>">
<input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">

<input type="hidden" id="strBalance_init" name="strBalance_init" value="<?php echo $strBalance ?>">
<input type="hidden" id="strBalance" name="strBalance" value="<?php echo $strBalance ?>">
<input type="hidden" id="strDeposit" name="strDeposit" value="<?php echo $strDeposit ?>">
<input type="hidden" name="depositpervehicle" value="<?php echo $depositpervehicle ?>">
<input type="hidden" id="carrierdiscount" name="carrierdiscount" value="<?php echo $carrierdiscount ?>">
<input type="hidden" name="depositdiscount" value="<?php echo $depositdiscount ?>">
<input type="hidden" name="discstatus" value="<?php echo $discstatus ?>">
<input type="hidden" name="ps" value="<?php echo $ps ?>">

<input type="hidden" name="helpfulhintmention" value="<?php echo $helpfulhintmention ?>">

<input type="hidden" name="shippingfrom_sales" value="<?php echo $shippingfrom_sales ?>">

<input type="hidden" id="strTotalPrice_init" name="strTotalPrice_init" value="<?php echo $strTotalPrice ?>">
<input type="hidden" id="strTotalPrice" name="strTotalPrice" value="<?php echo $strTotalPrice ?>">

<input type="hidden" id="pricetier" name="pricetier" value="<?php echo $pricetier ?>">


<input type="hidden" name="howmany" value="<?php echo $howmany ?>">
<input type="hidden" name="numvehicles" value="<?php echo $numvehicles ?>">

<input type="hidden" name="rating_origin" value="<?php echo $rating_origin ?>">
<input type="hidden" name="rating_dest" value="<?php echo $rating_dest ?>">
<input type="hidden" name="rating_vehicle" value="<?php echo $rating_vehicle ?>">

<input type="hidden" id="auto_price_init_1" name="auto_price_init_1" value="<?php echo $auto_price ?>">
<input type="hidden" id="auto_price_init_2" name="auto_price_init_2" value="<?php echo $auto_price2 ?>">
<input type="hidden" id="auto_price_init_3" name="auto_price_init_3" value="<?php echo $auto_price3 ?>">
<input type="hidden" id="auto_price_init_4" name="auto_price_init_4" value="<?php echo $auto_price4 ?>">
<input type="hidden" id="auto_price_init_5" name="auto_price_init_5" value="<?php echo $auto_price5 ?>">


<input type="hidden" id="auto_price1" name="auto_price" value="<?php echo $auto_price ?>">
<input type="hidden" id="auto_price2" name="auto_price2" value="<?php echo $auto_price2 ?>">
<input type="hidden" id="auto_price3" name="auto_price3" value="<?php echo $auto_price3 ?>">
<input type="hidden" id="auto_price4" name="auto_price4" value="<?php echo $auto_price4 ?>">
<input type="hidden" id="auto_price5" name="auto_price5" value="<?php echo $auto_price5 ?>">

<input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
<input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
<input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">

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


<input type="hidden" id="auto_copartauction_cost" name="auto_copartauction_cost" value="0">

<input type="hidden" name="DaysWaitingPickupTotalOrders" value="<?php echo $DaysWaitingPickupTotalOrders ?>">
<input type="hidden" name="DaysWaitingPickupAvg" value="<?php echo $DaysWaitingPickupAvg ?>">
<input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<?php echo $DaysWaitingDeliverTotalOrders ?>">
<input type="hidden" name="DaysWaitingDeliverAvg" value="<?php echo $DaysWaitingDeliverAvg ?>">
<input type="hidden" name="DaysWaitingAvg" value="<?php echo $DaysWaitingAvg ?>">

<input type="hidden" name="strSalesRep" value="<?php echo $CurrentUsername ?>">


<div id="dialog" title="Confirmation Required" style="display:none;"></div>


<div class="smart-forms">

    <div class="section fieldentry" style="margin: 20px 0 60px;">
        <div class="frm-row">
            <div class="colm colm12 ordersteps" style="text-align: center">
                <img src="/wp-content/themes/atdv2/images/checkout-prog-2.png" alt="Step 2 - Customer" />
            </div>
        </div>
    </div>


    <div class="section fieldentry" style="margin-bottom: 70px;">
        <div class="frm-row">
            <div class="colm colm3">
                <div class="imagebox">
            		<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" />
            		<div>We make it easy to setup your shipment and get on the road ... door to door.</div>
            	</div>
            </div>
            <div class="colm colm4 quotesummary1">
	            <p><span class="quotelabel1">From</span>
                <?php echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?></p>
                
                <p><span class="quotelabel1">To</span>
                <?php echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?></p>
                
                
                <?php if ($howmany != "onevehicle") { ?>
                <p><span class="quotelabel1">Vehicles</span>
                	<?php echo "$auto_make - $auto_model" ?><br>
                	<?php if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
                	<?php if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
                	<?php if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
                	<?php if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
				<?php } else { ?>
				<p><span class="quotelabel1">Vehicle</span>

                    <?php echo "$auto_make - $auto_model" ?>
				<?php } ?></p>
				
				<p><span class="quotelabel1">Condition</span>
				<?php echo $strQuote_vehicle_operational  ?> and Rolls, Brakes, Steers</p>
				
				<p><span class="quotelabel1">Trailer</span>
				<?php echo $strQuote_vehicle_trailer  ?></p>


            </div>
            <div class="colm colm5">
	            <div class="quotelistbox1">
		            <div class="quotelistboxicon"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div>
		            <ul class="quotelist1">
		            	<li>Total Door-to-Door Price: <?php echo $strTotalPrice ?> USD</li>
			            <li>Pay only the deposit of <?php echo $strDeposit  ?> USD today</li>
			            <li>Balance of <?php echo $strBalance  ?> USD due to the driver upon delivery</li>
			            <li>There are no taxes or hidden fees</li>
			            <li>Insurance Up To 150,000 USD Included</li>
			            <li>Cancel anytime prior to assignment with full refund</li>
		            </ul>
	            </div>
	            
            </div>
        </div>  
    </div> 





    <div class="section fieldentry" style="margin-bottom: 40px;">
        <div class="frm-row">
            <div class="colm colm6">
            
                <div class="frm-row">
                    <div class="colm colm12">
                        First Name
                        <label class="field append-icon">
                            <input type="text" name="strCustFirstName" id="strCustFirstName" size="30" value="<?php echo $first_name ?>" data-idealforms-rules="required">
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Last Name
                        <label class="field append-icon">
                            <input type="text" name="strCustLastName" id="strCustLastName" size="30" value="<?php echo $last_name ?>"  data-idealforms-rules="required">
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">       
                        Company <span class="optional1">(optional)</span>
                        <input type="text" name="strCustCompany" id="strCustCompany" size="30">
                    </div>
                </div>
<!--
                <div class="frm-row">
                    <div class="colm colm12">            
                        Phone Number:
                        <label class="field append-icon">
                            <input type="text" name="strCustPhone1" id="strCustPhone1" size="30" value="<?php echo $customer_phone ?>"  data-idealforms-rules="required">
                            <label for="strCustPhone1" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
-->
                <div class="frm-row">
                    <div class="colm colm12">            
                        E-Mail Address
                        <label class="field append-icon">
                            <input type="text" name="strCustEmail" id="strCustEmail" size="30" value="<?php echo $customer_email ?>"  data-idealforms-rules="required email">
                        </label>
                    </div>
                </div>
                
                
            </div>


			<div class="colm colm1"></div>
            <div class="colm colm5">
	            <div style="font-weight:bold; font-size: 20px; color: #095BC2; margin-bottom: 15px;">First Date Your Vehicle Is Available To Ship</div>
	            <span class="nobold">
	            Depending on level of service, vehicles are typically assigned a carrier in...<br>
				&nbsp;&nbsp;&nbsp;• 1-7 days (Standard - 85% probability)<br>
				&nbsp;&nbsp;&nbsp;• 1-4 Days (Expedited - 90% probability)<br>
				&nbsp;&nbsp;&nbsp;• 1-2 Days (Rush - 95% probability)<br>
				All from the first date available.<br><br>
				</span>
                
                <span style="color: #095BC2;">First Date Available To Ship</span>
                <div class="frm-row">
                    <div class="colm colm7"> 
		                <label class="field append-icon">
		                	<input type="text" id="strDateAvailable" name="strDateAvailable" placeholder="mm/dd/yyyy" readonly="readonly">
		                    <label for="strDateAvailable" class="field-icon"><i class="fa fa-calendar"></i></label>  
		                </label>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div class="section fieldentry" style="margin-bottom: 40px;">
        

        
        
        <div class="frm-row">
            <div class="colm colm10">
                <?php if ($howmany != "onevehicle") { ?>
                	Are these vehicles coming from a dealer, auto auction or Copart?
                <?php } else { ?>
                	Is this vehicle coming from a dealer, auto auction or Copart?
                <?php } ?>
                
                <br />
                
                <label class="option" style="display:inline;">
    			    <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_yes" value="yes" onclick="$('#vehicle_comingfrom_spec').show();">
                    <span class="radio"></span> Yes
                </label>

    			<label class="option" style="display:inline;">
    			    <?php if($howmany != "onevehicle") { ?>
                    	<input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="comingfromno();">
                    <?php } else { ?>
                    <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="$('#vehicle_comingfrom_spec').hide();$('#vehicle_comingfrom_stocknum').hide();<? if(session('admin')=="") { ?>$('#vehicle_comingfrom_vin').hide();<?php } ?>$('#strVehicle_VIN').val('');$('#vehicle_comingfrom_buyernum').hide();$('#strVehicle_BuyerNum').val('');$('#vehicle_comingfrom_lotnum').hide();$('#strVehicle_LotNum').val('');$('#strVehicle_ComingFrom option')[0].selected = true;">
                    <?php } ?>
    			    <span class="radio"></span> No
                </label>
                

                
                <?php if ($howmany != "onevehicle") { ?>
                	<script type="text/javascript">
                
                	function comingfromno() {
                
                		<?php
                		for ($counter=1; $counter<=$numvehicles; $counter++) {
                		?>
                		    $('#vehicle_comingfrom_spec').hide();
                            $('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();
                			<?php if(session('admin')=="") { ?>
                			    $('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                			<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');

                			$('#strVehicle_ComingFrom option')[0].selected = true;
                		<?php } ?>
                	}
                
                
                	function choosevehiclefrom() {
                		if($('#strVehicle_ComingFrom').val()=='') {
                
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                				<?php if(session('admin')=="") { ?>
                				$('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                				<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			<?php } ?>
                
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');
                
                			//Show VIN for Each Vehicle
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                			$('#vehicle_comingfrom_vin<?php echo $counter ?>').show();
                			<?php } ?>
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {
                
                			//Cleanup other fields
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                				<?php if(session('admin')=="") { ?>
                				$('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                				<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			<?php } ?>
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                
                			//Show Stock Number for Each Vehicle
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                			$('#vehicle_comingfrom_stocknum<?php echo $counter ?>').show();
                			<?php } ?>
                
                
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
                
                			//Cleanup other fields
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                			$('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();
                			$('#strVehicle_StockNum<?php echo $counter ?>').val('');
                			<?php } ?>
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                			//Show Buyer Number
                			$('#vehicle_comingfrom_lotnum').show();
                
                			//Show VIN for Each Vehicle
                			<?php
                			for ($counter=1; $counter<=$numvehicles; $counter++) {
                			?>
                			$('#vehicle_comingfrom_vin<?php echo $counter ?>').show();
                			<?php } ?>
                
                
                
                		}
                
                
                	}
                
                
                
                	</script>
                
                
                
                <?php } else { ?>
                	<script type="text/javascript">
                	function choosevehiclefrom() {
                		if($('#strVehicle_ComingFrom').val()=='') {
                
                			<?php if(session('admin')=="") { ?>
                			$('#vehicle_comingfrom_vin').hide();
                			<?php } ?>
                
                			$('#strVehicle_VIN').val('');
                
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');
                
                			//Show VIN for Each Vehicle
                			$('#vehicle_comingfrom_vin').show();
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {
                
                			//Cleanup other fields
                			<?php if(session('admin')=="") { ?>
                			$('#vehicle_comingfrom_vin').hide();
                			<?php } ?>
                			$('#strVehicle_VIN').val('');
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                			$('#vehicle_comingfrom_lotnum').hide();
                			$('#strVehicle_LotNum').val('');

                			//Show Stock Number for Each Vehicle
                			$('#vehicle_comingfrom_stocknum').show();
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_stocknum').hide();
                			$('#strVehicle_StockNum').val('');
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                			$('#vehicle_comingfrom_lotnum').show();
                
                			//Show VIN for Each Vehicle
                			$('#vehicle_comingfrom_vin').show();
                		}
                
                	}
                	</script>
                <?php } ?>
                                
                
                
                
            </div>
        </div>
        
        <div id="vehicle_comingfrom_spec" style="display:none;">
            <div class="frm-row">
                <div class="colm colm4">
                    <?php if ($howmany != "onevehicle") { ?>
                		Where are they coming from?
                	<?php } else { ?>
                		Where is it coming from?
                	<?php } ?>
                	<br>
                	<label for="strVehicle_ComingFrom" class="field select">
                    	<select name="strVehicle_ComingFrom" id="strVehicle_ComingFrom" onchange="choosevehiclefrom();">
                        	<option value="">-- PLEASE SELECT --</option>
                        	<option value="Dealer">Dealer</option>
                        	<option value="Auto Auction">Auto Auction</option>
                        	<option value="Copart">Copart</option>
                    	</select>
                	<i class="arrow"></i>
                    </label>
                </div>
            </div>
        </div>
        
        <div id="vehicle_comingfrom_buyernum" style="display:none;">
            <div class="frm-row">
                <div class="colm colm4">
                    Your buyer number:<br>
                    <input type="text" name="strVehicle_BuyerNum" id="strVehicle_BuyerNum" size="20" maxlength="99">
                </div>
            </div>
        	
        </div>
        <div id="vehicle_comingfrom_lotnum" style="display:none;">
            <div class="frm-row">
                <div class="colm colm4">
                    Your lot number:<br>
                    <input type="text" name="strVehicle_LotNum" id="strVehicle_LotNum" size="20" maxlength="99">
                </div>
            </div>
        	
        </div>
        
        <div id="vehicle_comingfrom_vin" style="display:none;margin-top:15px;">
    		LAST 6 digits of the Vehicle VIN:
            <input type="text" name="strVehicle_VIN" id="strVehicle_VIN" size="8" maxlength="6">
    	</div>
    
    	<div id="vehicle_comingfrom_stocknum" style="display:none;margin-top:15px;">
    		Auto Auction Lot/Stock Number:
    		<label class="field append-icon">
                <input type="text" name="strVehicle_StockNum" id="strVehicle_StockNum" size="8">
            </label>
    	</div>
          
    </div>


	<div class="section fieldentry" style="margin-bottom: 40px;">
		<div class="frm-row">
            <div class="colm colm3">
                <button type="submit" class="goonbutton">
                    Continue&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
	</div>
		



</form>
</div>
</div>
</div>
