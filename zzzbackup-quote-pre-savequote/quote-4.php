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
	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '4. Shipment Details' where trackid = '$trackid'";
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
			strCustPhone1: "required",
			strCustEmail: "required",



			<?php if($numvehiclestemp == 1) { ?>
				strVehicle_Year: "required",
				strVehicle_Make: "required",
				strVehicle_Model: "required",
			<? } else {
    			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
    			?>
    				strVehicle_Year<?php echo $counter ?>: "required",
    				strVehicle_Make<?php echo $counter ?>: "required",
    				strVehicle_Model<?php echo $counter ?>: "required",
    			<?php
                }
			}
			?>

			strVehicle_ComingFrom: {
				required: function(element) {return $("#strVehicle_ComingFrom_yes:unchecked").length == 0;}
			},


			<?php if($numvehiclestemp == 1) { ?>



				strVehicle_StockNum: {
					required: function(element) {return $("#strVehicle_ComingFrom").val()=='Auto Auction'}
				},




			<?php } else {
    			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
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

/*

	$('#strDateAvailable').datepicker({
		dateFormat: 'mm/dd/yyyy',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		minDate: '0d',
		maxDate: '+30d',
		showButtonPanel: true
	});
*/

    $( "#strDateAvailable" ).datepicker({
		minDate: '0d',
		maxDate: '+30d',
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


<input type="hidden" id="auto_copartauction_cost" name="auto_copartauction_cost" value="0">

<input type="hidden" name="DaysWaitingPickupTotalOrders" value="<?php echo $DaysWaitingPickupTotalOrders ?>">
<input type="hidden" name="DaysWaitingPickupAvg" value="<?php echo $DaysWaitingPickupAvg ?>">
<input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<?php echo $DaysWaitingDeliverTotalOrders ?>">
<input type="hidden" name="DaysWaitingDeliverAvg" value="<?php echo $DaysWaitingDeliverAvg ?>">
<input type="hidden" name="DaysWaitingAvg" value="<?php echo $DaysWaitingAvg ?>">

<input type="hidden" name="strSalesRep" value="<?php echo $CurrentUsername ?>">


<div id="dialog" title="Confirmation Required" style="display:none;"></div>


<div class="smart-forms">

    <div class="section fieldentry">
        <div class="frm-row">
            <div class="colm colm12">

                <h1 style="text-align:center;">It Takes Only 5 Minutes To Setup Your Shipment<br></h1>
            </div>
        </div>
    </div>

    <div style="margin:5px 0 10px 0;width:100%;border-top:#999999 solid thin;"></div>

    <div class="section fieldentry">
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm4">
                <div class="imagebox">
            		<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" />
            		<div>We make it easy to setup your shipment and get on the road ... door to door.</div>
            	</div>
            </div>
            <div class="colm colm6">
                
                <div class="frm-row">
                    <div class="colm colm4">
                        <strong>Shipping From:</strong>
                    </div>
                    <div class="colm colm8">
                        <?php echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?>
                    </div>
                </div>
                
                
                <div class="frm-row">
                    <div class="colm colm4">
                        <strong>Shipping To:</strong>
                    </div>
                    <div class="colm colm8">
                        <?php echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?>
                    </div>
                </div>
                
                <div class="frm-row">
                <?php if ($howmany != "onevehicle") { ?>
                    <div class="colm colm4">
                        <strong>Types of Vehicles:</strong>
                    </div>
                    <div class="colm colm8">
                    	<?php echo "$auto_make - $auto_model" ?><br>
                    	<?php if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
                    	<?php if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
                    	<?php if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
                    	<?php if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
                	</div>
                <?php } else { ?>
                    <div class="colm colm4">
                        <strong>Type of Vehicle:</strong>
                    </div>
                    <div class="colm colm8">
                        <?php echo "$auto_make - $auto_model" ?>
                    </div>
                <?php } ?>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm4">
                        <strong>Operating Condition:</strong>
                    </div>
                    <div class="colm colm8">
                        <?php echo $strQuote_vehicle_operational  ?> and Rolls, Brakes, Steers
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm4">
                        <strong>Type of Trailer:</strong>
                    </div>
                    <div class="colm colm8">
                        <?php echo $strQuote_vehicle_trailer  ?>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-top:15px;font-weight: bold; font-size: 25px;" align="center">
                        	<div style="width:100%;border-top:#999999 solid thin;"></div>
                        	Total Price: <span style="color:#308dff">$<div id="totalprice" style="display:inline;"><?php echo $strTotalPrice ?></div></span>
                        </div>
                        
                        <div style="margin-top:15px; text-align: center;line-height: 20px;">
                            <strong>
                            Only the deposit of $<?php echo $strDeposit  ?> is required to setup your order.<br/>
                            The balance of $<?php echo $strBalance  ?> is paid to the driver upon delivery.<br/>
                            There is no tax.
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="colm colm1"></div>
        </div>  
    </div> 



    <div class="section fieldentry">
        <div class="frm-row">
            <div class="colm colm12" style="border-top:1px solid #999; border-bottom:1px solid #999;">
                <strong>Please fill out the detail below.</strong>
            </div>
        </div>
    </div>

    <div class="section fieldentry">
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
            
                <div class="frm-row">
                    <div class="colm colm12">
                        First Name:
                        <label class="field append-icon">
                            <input type="text" name="strCustFirstName" id="strCustFirstName" size="30" value="<?php echo $first_name ?>" data-idealforms-rules="required">
                            <label for="strCustFirstName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Last Name:
                        <label class="field append-icon">
                            <input type="text" name="strCustLastName" id="strCustLastName" size="30" value="<?php echo $last_name ?>"  data-idealforms-rules="required">
                            <label for="strCustLastName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">       
                        Company:
                        <input type="text" name="strCustCompany" id="strCustCompany" size="30">
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">            
                        Phone Number:
                        <label class="field append-icon">
                            <input type="text" name="strCustPhone1" id="strCustPhone1" size="30" value="<?php echo $customer_phone ?>"  data-idealforms-rules="required">
                            <label for="strCustPhone1" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">            
                        E-Mail Address:
                        <label class="field append-icon">
                            <input type="text" name="strCustEmail" id="strCustEmail" size="30" value="<?php echo $customer_email ?>"  data-idealforms-rules="required email">
                            <label for="strCustEmail" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                
                
            </div>
            <div class="colm colm5" style="margin-top:22px;">
                <div class="imagebox">
                	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-6.jpg" style="width:275px" />
                	<div>We will send you an Order Confirmation and Notice of Assignment once we have arranged your driver. </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="section fieldentry">
        
        <div class="frm-row">
            <div class="colm colm12">
                <strong>Dates</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5" style="margin:30px 0;">
                Pick the very first date your vehicle is available to be shipped. 
                That date must be within 30 days of today. 
                It typically takes one to several days to assign your vehicle.
                <br/><br/>
                First Date Available To Ship:
                <label class="field append-icon">
                	<input type="text" id="strDateAvailable" name="strDateAvailable" placeholder="mm/dd/yyyy" readonly="readonly">
                    <label for="strDateAvailable" class="field-icon"><i class="fa fa-calendar"></i></label>  
                </label>
            </div>
            <div class="colm colm5">
                <div class="imagebox">
                    <img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-3.jpg"  style="width:275px" />
                    <div>Once assigned, the transit time typically takes about one day for every 500 miles, plus a day or two on either end for pickups and deliveries. </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section fieldentry">
        
        <div class="frm-row">
            <div class="colm colm12">
                <strong>Vehicle Source</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm9">
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
                    <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="$('#vehicle_comingfrom_spec').hide();$('#vehicle_comingfrom_stocknum').hide();<? if(session('admin')=="") { ?>$('#vehicle_comingfrom_vin').hide();<?php } ?>$('#strVehicle_VIN').val('');$('#vehicle_comingfrom_buyernum').hide();$('#strVehicle_BuyerNum').val('');$('#strVehicle_ComingFrom option')[0].selected = true;">
                    <?php } ?>
    			    <span class="radio"></span> No
                </label>
                

                
                <?php if ($howmany != "onevehicle") { ?>
                	<script type="text/javascript">
                
                	function comingfromno() {
                
                		<?php
                		for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                		?>
                		    $('#vehicle_comingfrom_spec').hide();
                            $('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();
                			<?php if(session('admin')=="") { ?>
                			    $('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                			<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                			$('#strVehicle_ComingFrom option')[0].selected = true;
                		<?php } ?>
                	}
                
                
                	function choosevehiclefrom() {
                		if($('#strVehicle_ComingFrom').val()=='') {
                
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                			?>
                				<?php if(session('admin')=="") { ?>
                				$('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                				<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			<?php } ?>
                
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                
                			//Show VIN for Each Vehicle
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                			?>
                			$('#vehicle_comingfrom_vin<?php echo $counter ?>').show();
                			<?php } ?>
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {
                
                			//Cleanup other fields
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                			?>
                				<?php if(session('admin')=="") { ?>
                				$('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();
                				<?php } ?>
                			$('#strVehicle_VIN<?php echo $counter ?>').val('');
                			<?php } ?>
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                
                			//Show Stock Number for Each Vehicle
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                			?>
                			$('#vehicle_comingfrom_stocknum<?php echo $counter ?>').show();
                			<?php } ?>
                
                
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
                
                			//Cleanup other fields
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
                			?>
                			$('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();
                			$('#strVehicle_StockNum<?php echo $counter ?>').val('');
                			<?php } ?>
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                
                			//Show VIN for Each Vehicle
                			<?php
                			for ($counter=1; $counter=$numvehiclestemp; $counter++) {
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
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_buyernum').hide();
                			$('#strVehicle_BuyerNum').val('');
                
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
                
                			//Show Stock Number for Each Vehicle
                			$('#vehicle_comingfrom_stocknum').show();
                
                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
                
                			//Cleanup other fields
                			$('#vehicle_comingfrom_stocknum').hide();
                			$('#strVehicle_StockNum').val('');
                
                			//Show Buyer Number
                			$('#vehicle_comingfrom_buyernum').show();
                
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
          
    </div>





    <div class="section fieldentry">
        
        <?php if($howmany == "onevehicle") { ?>
        <div class="frm-row">
            <div class="colm colm12">
            	<strong>Vehicle Details</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        <?php } ?>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
        
            <?php 
            if ($howmany != "onevehicle") { 
                
            	if ($auto_make != "" && $auto_model !="") {
            		$vehiclenum=1;
            		$auto_yeartemp=$auto_year;
            		$auto_maketemp=$auto_make;
            		$auto_modeltemp=$auto_model;
                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-vehicleinput.php');
                }
            
            	if ($auto_make2 != "" && $auto_model2 !="") {
            		$vehiclenum=2;
            		$auto_yeartemp=$auto_year2;
            		$auto_maketemp=$auto_make2;
            		$auto_modeltemp=$auto_model2;
                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-vehicleinput.php');
                }
            
            	if ($auto_make3 != "" && $auto_model3 !="") {
            		$vehiclenum=3;
            		$auto_yeartemp=$auto_year3;
            		$auto_maketemp=$auto_make3;
            		$auto_modeltemp=$auto_model3;
                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-vehicleinput.php');
                }
            
            	if ($auto_make4 != "" && $auto_model4 !="") {
            		$vehiclenum=4;
            		$auto_yeartemp=$auto_year4;
            		$auto_maketemp=$auto_make4;
            		$auto_modeltemp=$auto_model4;
                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-vehicleinput.php');
                }
            
            	if ($auto_make5 != "" && $auto_model5 !="") {
            		$vehiclenum=5;
            		$auto_yeartemp=$auto_year5;
            		$auto_maketemp=$auto_make5;
            		$auto_modeltemp=$auto_model5;
                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-vehicleinput.php');
                }

            } else { ?>
            
                <div class="frm-row">
                    <div class="colm colm12">
                        Year:
                        <label class="field append-icon">     
                            <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Year" id="strVehicle_Year" value="<?php echo $auto_year ?>" size="20" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?><br>
                            <label for="strVehicle_Year" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">        
                        Vehicle Make:
                        <label class="field append-icon">  
                            <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Make" id="strVehicle_Make" value="<?php echo $auto_make ?>" size="20" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>>
                            <label for="strVehicle_Year" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">            
                        Vehicle Model:
                        <label class="field append-icon">  
                            <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Model" id="strVehicle_Model" value="<?php echo $auto_model ?>" size="20" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>>
                            <label for="strVehicle_Year" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">    
                    	Vehicle Color:
                        <input type="text" name="strVehicle_Color" id="strVehicle_Color" size="30" maxlength="50">
                        
                        
                    	<div id="vehicle_comingfrom_vin" style="display:none;margin-top:15px;">
                    		LAST 6 digits of the Vehicle VIN:
                            <input type="text" name="strVehicle_VIN" id="strVehicle_VIN" size="8" maxlength="6">
                    	</div>
                    
                    	<div id="vehicle_comingfrom_stocknum" style="display:none;margin-top:15px;">
                    		Auto Auction Lot/Stock Number:
                    		<label class="field append-icon">
                                <input type="text" name="strVehicle_StockNum" id="strVehicle_StockNum" size="8">
                                <label for="strVehicle_Year" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                            </label>
                    	</div>
                    </div>
                </div>
       
                <script>
            
                $(function() {
                    $( "#strVehicle_LiftKityes" ).click(function() {
                        $("#dialog-liftkit").dialog('open');
            	    });
            
                    $( "#dialog-liftkit" ).dialog({
                      modal: true,
                      width: 'auto',
                      autoOpen: false,
                      fluid: true,
                      resizable: false,
                      buttons: {
                        Ok: function() {
                          $( this ).dialog( "close" );
                          $('#strVehicle_LiftKitno').prop("checked", true);
                        }
                      }
                    });   
                    
                    $( "#strVehicle_Loweredyes" ).click(function() {
                        $("#dialog-lowered").dialog('open');
            	    });
            
                    $( "#dialog-lowered" ).dialog({
                      modal: true,
                      width: 'auto',
                      autoOpen: false,
                      fluid: true,
                      resizable: false,
                      buttons: {
                        Ok: function() {
                          $( this ).dialog( "close" );
                          $('#strVehicle_Loweredno').prop("checked", true);
                        }
                      }
                    });  
                    
                    $( "#strVehicle_Oversized_Tiresyes" ).click(function() {
                        $("#dialog-tires").dialog('open');
            	    });
            
                    $( "#dialog-tires" ).dialog({
                      modal: true,
                      width: 'auto',
                      autoOpen: false,
                      fluid: true,
                      resizable: false,
                      buttons: {
                        Ok: function() {
                          $( this ).dialog( "close" );
                          $('#strVehicle_Oversized_Tiresno').prop("checked", true);
                        }
                      }
                    });       
                    
                    
                });
                </script>
                
                <div class="frm-row">
                    <div class="colm colm12">
                    	Is The Vehicle a Convertible?<br>
                    	<label class="option" style="display:inline;">
                        	<input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleyes" value="yes">
                            <span class="radio"></span> Yes
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    	    <input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleno" value="no" checked="checked">
                            <span class="radio"></span> No
                        </label>
    
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                    	Is The Vehicle Lifted?<br>
                    	<label class="option" style="display:inline;">
                        	<input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKityes" value="yes">
                        	<span class="radio"></span> Yes
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                        	<input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKitno" value="no" checked="checked">
                        	<span class="radio"></span> No
                    	</label>
                    	<div id="dialog-liftkit" title="Sorry..." style="display:none;">
                            To place an order for a lifted vehicle,<br>please call us at 800-600-3750.
                        </div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                    	Does The Vehicle Have Low Clearance?<br>
                    	<label class="option" style="display:inline;">
                    		<input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredyes" value="yes">
                    		<span class="radio"></span> Yes
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    		<input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredno" value="no" checked="checked">
                    		<span class="radio"></span> No
                    	</label>
                        <div id="dialog-lowered" title="Sorry..." style="display:none;">
                            To place an order for a lowered vehicle,<br>please call us at 800-600-3750.
                        </div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Does The Vehicle Have Oversized Tires?<br>
                        <label class="option" style="display:inline;">
                        	<input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresyes" value="yes">
                        	<span class="radio"></span> Yes
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                        	<input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresno" value="no" checked="checked">
                        	<span class="radio"></span> No
                    	</label>
                        <div id="dialog-tires" title="Sorry..." style="display:none;">
                            To place an order for a vehicle with oversized tires,<br>please call us at 800-600-3750.
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
            
            <div class="colm colm5" style="margin-top: 20px;">
                <div class="imagebox">
            		<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-2.jpg" style="width:275px" />
            		<div>Shipments go smoother if there are no surprises. Please note any vehicle modifications here.</div>
            	</div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm7">
                Additional Vehicle Information:<br>
                <input type="text" name="strVehicle_AdditionalInfo" id="strVehicle_AdditionalInfo" size="60" maxlength="60">
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm4">
                <button type="submit" class="goonbutton">
                    Go On&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                </button>
                <div style="font-size: 13px; text-align: center;">Step 1 of 3&nbsp;&nbsp;&nbsp;</div>
            </div>
        </div>

    </div>


</form>
</div>
</div>
</div>
