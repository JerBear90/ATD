<?php

/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/

$CurrentUsername = session('rep');

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

$strCustFirstName = postdb('strCustFirstName');
$strCustLastName = postdb('strCustLastName');
$strCustCompany = postdb('strCustCompany');
$strCustPhone1 = postdb('strCustPhone1');
$strCustEmail = postdb('strCustEmail');


$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');
$depositpervehicle = postdb('depositpervehicle');
$carrierdiscount = postdb('carrierdiscount');
$depositdiscount = postdb('depositdiscount');

$discstatus = postdb('discstatus');
$ps = postdb('ps');

$pricetier = postdb('pricetier');
$helpfulhintmention = postdb('helpfulhintmention');
$shippingfrom_sales = postdb('shippingfrom_sales');
$auto_copartauction_cost = postdb('auto_copartauction_cost');

$strVehicle_Year = postdb('strVehicle_Year');
$strVehicle_Make = postdb('strVehicle_Make');
$strVehicle_Model = postdb('strVehicle_Model');
$strVehicle_Color = postdb('strVehicle_Color');
$strVehicle_Convertible = postdb('strVehicle_Convertible');
$strVehicle_LiftKit = postdb('strVehicle_LiftKit');
$strVehicle_Lowered = postdb('strVehicle_Lowered');
$strVehicle_Oversized_Tires = postdb('strVehicle_Oversized_Tires');
$strVehicle_AdditionalInfo = postdb('strVehicle_AdditionalInfo');
$strVehicle_VIN = postdb('strVehicle_VIN');
$strVehicle_StockNum = postdb('strVehicle_StockNum');

$strVehicle_Year1 = postdb('strVehicle_Year1');
$strVehicle_Make1 = postdb('strVehicle_Make1');
$strVehicle_Model1 = postdb('strVehicle_Model1');
$strVehicle_Color1 = postdb('strVehicle_Color1');
$strVehicle_Convertible1 = postdb('strVehicle_Convertible1');
$strVehicle_LiftKit1 = postdb('strVehicle_LiftKit1');
$strVehicle_Lowered1 = postdb('strVehicle_Lowered1');
$strVehicle_Oversized_Tires1 = postdb('strVehicle_Oversized_Tires1');
$strVehicle_AdditionalInfo1 = postdb('strVehicle_AdditionalInfo1');
$strVehicle_VIN1 = postdb('strVehicle_VIN1');
$strVehicle_StockNum1 = postdb('strVehicle_StockNum1');

$strVehicle_Year2 = postdb('strVehicle_Year2');
$strVehicle_Make2 = postdb('strVehicle_Make2');
$strVehicle_Model2 = postdb('strVehicle_Model2');
$strVehicle_Color2 = postdb('strVehicle_Color2');
$strVehicle_Convertible2 = postdb('strVehicle_Convertible2');
$strVehicle_LiftKit2 = postdb('strVehicle_LiftKit2');
$strVehicle_Lowered2 = postdb('strVehicle_Lowered2');
$strVehicle_Oversized_Tires2 = postdb('strVehicle_Oversized_Tires2');
$strVehicle_AdditionalInfo2 = postdb('strVehicle_AdditionalInfo2');
$strVehicle_VIN2 = postdb('strVehicle_VIN2');
$strVehicle_StockNum2 = postdb('strVehicle_StockNum2');

$strVehicle_Year3 = postdb('strVehicle_Year3');
$strVehicle_Make3 = postdb('strVehicle_Make3');
$strVehicle_Model3 = postdb('strVehicle_Model3');
$strVehicle_Color3 = postdb('strVehicle_Color3');
$strVehicle_Convertible3 = postdb('strVehicle_Convertible3');
$strVehicle_LiftKit3 = postdb('strVehicle_LiftKit3');
$strVehicle_Lowered3 = postdb('strVehicle_Lowered3');
$strVehicle_Oversized_Tires3 = postdb('strVehicle_Oversized_Tires3');
$strVehicle_AdditionalInfo3 = postdb('strVehicle_AdditionalInfo3');
$strVehicle_VIN3 = postdb('strVehicle_VIN3');
$strVehicle_StockNum3 = postdb('strVehicle_StockNum3');

$strVehicle_Year4 = postdb('strVehicle_Year4');
$strVehicle_Make4 = postdb('strVehicle_Make4');
$strVehicle_Model4 = postdb('strVehicle_Model4');
$strVehicle_Color4 = postdb('strVehicle_Color4');
$strVehicle_Convertible4 = postdb('strVehicle_Convertible4');
$strVehicle_LiftKit4 = postdb('strVehicle_LiftKit4');
$strVehicle_Lowered4 = postdb('strVehicle_Lowered4');
$strVehicle_Oversized_Tires4 = postdb('strVehicle_Oversized_Tires4');
$strVehicle_AdditionalInfo4 = postdb('strVehicle_AdditionalInfo4');
$strVehicle_VIN4 = postdb('strVehicle_VIN4');
$strVehicle_StockNum4 = postdb('strVehicle_StockNum4');

$strVehicle_Year5 = postdb('strVehicle_Year5');
$strVehicle_Make5 = postdb('strVehicle_Make5');
$strVehicle_Model5 = postdb('strVehicle_Model5');
$strVehicle_Color5 = postdb('strVehicle_Color5');
$strVehicle_Convertible5 = postdb('strVehicle_Convertible5');
$strVehicle_LiftKit5 = postdb('strVehicle_LiftKit5');
$strVehicle_Lowered5 = postdb('strVehicle_Lowered5');
$strVehicle_Oversized_Tires5 = postdb('strVehicle_Oversized_Tires5');
$strVehicle_AdditionalInfo5 = postdb('strVehicle_AdditionalInfo5');
$strVehicle_VIN5 = postdb('strVehicle_VIN5');
$strVehicle_StockNum5 = postdb('strVehicle_StockNum5');


$strVehicle_ComingFrom_choice = postdb('strVehicle_ComingFrom_choice');
$strVehicle_ComingFrom = postdb('strVehicle_ComingFrom');
$strVehicle_BuyerNum = postdb('strVehicle_BuyerNum');
$strVehicle_LotNum = postdb('strVehicle_LotNum');

$strDeposit = postdb('strDeposit');
$strDateAvailable = postdb('strDateAvailable');




$rating_origin = postdb('rating_origin');
$rating_dest = postdb('rating_dest');
$rating_vehicle = postdb('rating_vehicle');

$auto_price = postdb('auto_price');
$auto_price2 = postdb('auto_price2');
$auto_price3 = postdb('auto_price3');
$auto_price4 = postdb('auto_price4');
$auto_price5 = postdb('auto_price5');


if (!is_numeric($auto_price)) {
	$auto_price = 0;
}
if (!is_numeric($auto_price2)) {
	$auto_price2 = 0;
}
if (!is_numeric($auto_price3)) {
	$auto_price3 = 0;
}
if (!is_numeric($auto_price4)) {
	$auto_price4 = 0;
}
if (!is_numeric($auto_price5)) {
	$auto_price5 = 0;
}



$strSalesRep  = postdb('strSalesRep');

$strBalance = postdb('strBalance');
$strTotalPrice = postdb('strTotalPrice');

$DaysWaitingPickupTotalOrders = postdb('DaysWaitingPickupTotalOrders');
if (!is_numeric($DaysWaitingPickupTotalOrders)) {
	$DaysWaitingPickupTotalOrders=0;
}

$DaysWaitingPickupAvg = postdb('DaysWaitingPickupAvg');
if (!is_numeric($DaysWaitingPickupAvg)) {
	$DaysWaitingPickupAvg=0;
}

$DaysWaitingDeliverTotalOrders = postdb('DaysWaitingDeliverTotalOrders');
if (!is_numeric($DaysWaitingDeliverTotalOrders)) {
	$DaysWaitingDeliverTotalOrders=0;
}

$DaysWaitingDeliverAvg = postdb('DaysWaitingDeliverAvg');
if (!is_numeric($DaysWaitingDeliverAvg)) {
	$DaysWaitingDeliverAvg=0;
}

$DaysWaitingAvg = postdb('DaysWaitingAvg');
if (!is_numeric($DaysWaitingAvg)) {
	$DaysWaitingAvg=0;
}


$UserIPAddress = getClientIP();

if($howmany != "onevehicle") {
	$strVehicle_Year=$strVehicle_Year1;
	$strVehicle_Make=$strVehicle_Make1;
	$strVehicle_Model=$strVehicle_Model1;
	$strVehicle_AdditionalInfo=$strVehicle_AdditionalInfo1;
}


if ($discstatus != "") {
	$CDDisc = '0';
	$CDRatio = '0';
	$CDRatio_Range = '0-0';
}

if (session('repeat_customer')=="Yes") {
	$repeat_customer = "Yes";
} else {
	$repeat_customer = "No";
}

$emailrefer = session("emailrefer");
$ihrefer = session("ihrefer");
$strDateAvailableDB = strtotime($strDateAvailable);
$strDateAvailableDB = date("Y-m-d", $strDateAvailableDB);

$sql = "insert into orders (quoteid,SiteName,EmailRefer,ReferringURL,IPNumber,repeat_customer,order_date,Total,Deposit,Balance,pricetier,PriceSource,CDDiscount,CDDisc,CDRatio,CDRatio_Range,CoPart_AutoAuction_Increase,shippingfrom_sales,Status,Quote_shippingfromstate,Quote_shippingtostate,Quote_vehicle_operational,Quote_vehicle_trailer,CustFirstName,CustLastName,CustCompany,CustPhone1,CustEmail,Num_Of_Vehicles,Original_Num_Of_Vehicles,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_AdditionalInfo,Vehicle_ComingFrom,Vehicle_VIN,Vehicle_BuyerNumber,Vehicle_LotNumber,DateAvailable,DateAvailable_Initial,distance,SalesRep,rating_origin,rating_dest,rating_vehicle,DaysWaitingPickupTotalOrders,DaysWaitingPickupAvg,DaysWaitingDeliverTotalOrders,DaysWaitingDeliverAvg,DaysWaitingAvg) values  (0,'AutoTransportDirect.com','$emailrefer','$ihrefer','$UserIPAddress','$repeat_customer',NOW(),'$strTotalPrice','$strDeposit','$strBalance','$pricetier','$ps','$discstatus','$CDDisc','$CDRatio','$CDRatio_Range',$auto_copartauction_cost,'$shippingfrom_sales','INCOMPLETE','$strQuote_shippingfromstate','$strQuote_shippingtostate','$strQuote_vehicle_operational','$strQuote_vehicle_trailer','$strCustFirstName','$strCustLastName','$strCustCompany','$strCustPhone1','$strCustEmail','$numvehicles','$numvehicles','$strVehicle_Year','$strVehicle_Make','$strVehicle_Model','$strVehicle_AdditionalInfo','$strVehicle_ComingFrom','$strVehicle_VIN','$strVehicle_BuyerNum','$strVehicle_LotNum','$strDateAvailableDB','$strDateAvailableDB','$totaldistance','$strSalesRep','$rating_origin','$rating_dest','$rating_vehicle','$DaysWaitingPickupTotalOrders','$DaysWaitingPickupAvg','$DaysWaitingDeliverTotalOrders','$DaysWaitingDeliverAvg','$DaysWaitingAvg')";
$wpdb->query($sql);
$strmaxorderid = $wpdb->insert_id;
$_SESSION['orderid'] = $strmaxorderid;


if ($helpfulhintmention != "") {
	if ($helpfulhintmention == "yes") {
		$audit_notes = "Helpful hint was mentioned";
        AuditTrail($strmaxorderid,$CurrentUsername,$audit_notes);
	} elseif ($helpfulhintmention == "ignore") {
		$audit_notes = "Helpful hint was ignored";
        AuditTrail($strmaxorderid,$CurrentUsername,$audit_notes);
	}
}

if ($pricetier == 1) {
    $tiermessage = " / Standard Rate";
} elseif ($pricetier == 2) {
    $tiermessage = " / Expedited Rate";
} elseif ($pricetier == 3) {
    $tiermessage = " / Rush Rate";
}

if ($howmany == "onevehicle") {
	$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year','$strVehicle_Make','$strVehicle_Model','$strVehicle_Color','$strVehicle_VIN','$strVehicle_StockNum','$strVehicle_Convertible','$strVehicle_LiftKit','$strVehicle_LiftKit_Quantity','$strVehicle_Lowered','$strVehicle_Lowered_Quantity','$strVehicle_Oversized_Tires','$strVehicle_Oversized_Tires_Quantity','$strVehicle_AdditionalInfo',$auto_price)";
	$wpdb->query($sql);
} else {
	$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year1','$strVehicle_Make1','$strVehicle_Model1','$strVehicle_Color1','$strVehicle_VIN1','$strVehicle_StockNum1','$strVehicle_Convertible1','$strVehicle_LiftKit1','$strVehicle_LiftKit_Quantity1','$strVehicle_Lowered1','$strVehicle_Lowered_Quantity1','$strVehicle_Oversized_Tires1','$strVehicle_Oversized_Tires_Quantity1','$strVehicle_AdditionalInfo1',$auto_price)";
	$wpdb->query($sql);

	$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Vehicle #1: $strVehicle_Year1 $strVehicle_Make1 $strVehicle_Model1 $tiermessage','$auto_price')";
	$wpdb->query($sql);


	if ($strVehicle_Make2!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year2','$strVehicle_Make2','$strVehicle_Model2','$strVehicle_Color2','$strVehicle_VIN2','$strVehicle_StockNum2','$strVehicle_Convertible2','$strVehicle_LiftKit2','$strVehicle_LiftKit_Quantity2','$strVehicle_Lowered2','$strVehicle_Lowered_Quantity2','$strVehicle_Oversized_Tires2','$strVehicle_Oversized_Tires_Quantity2','$strVehicle_AdditionalInfo2',$auto_price2)";
		$wpdb->query($sql);

		$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Vehicle #2: $strVehicle_Year2 $strVehicle_Make2 $strVehicle_Model2 $tiermessage','$auto_price2')";;
		$wpdb->query($sql);

	}

	if ($strVehicle_Make3!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year3','$strVehicle_Make3','$strVehicle_Model3','$strVehicle_Color3','$strVehicle_VIN3','$strVehicle_StockNum3','$strVehicle_Convertible3','$strVehicle_LiftKit3','$strVehicle_LiftKit_Quantity3','$strVehicle_Lowered3','$strVehicle_Lowered_Quantity3','$strVehicle_Oversized_Tires3','$strVehicle_Oversized_Tires_Quantity3','$strVehicle_AdditionalInfo3',$auto_price3)";
		$wpdb->query($sql);

		$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Vehicle #3: $strVehicle_Year3 $strVehicle_Make3 $strVehicle_Model3 $tiermessage','$auto_price3')";
		$wpdb->query($sql);
	}
	
	if ($strVehicle_Make4!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year4','$strVehicle_Make4','$strVehicle_Model4','$strVehicle_Color4','$strVehicle_VIN4','$strVehicle_StockNum4','$strVehicle_Convertible4','$strVehicle_LiftKit4','$strVehicle_LiftKit_Quantity4','$strVehicle_Lowered4','$strVehicle_Lowered_Quantity4','$strVehicle_Oversized_Tires4','$strVehicle_Oversized_Tires_Quantity4','$strVehicle_AdditionalInfo4',$auto_price4)";
		$wpdb->query($sql);

		$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Vehicle #4: $strVehicle_Year4 $strVehicle_Make4 $strVehicle_Model4 $tiermessage','$auto_price4')";
		$wpdb->query($sql);
	}
	
    if ($strVehicle_Make5!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($strmaxorderid,'$strVehicle_Year5','$strVehicle_Make5','$strVehicle_Model5','$strVehicle_Color5','$strVehicle_VIN5','$strVehicle_StockNum5','$strVehicle_Convertible5','$strVehicle_LiftKit5','$strVehicle_LiftKit_Quantity5','$strVehicle_Lowered5','$strVehicle_Lowered_Quantity5','$strVehicle_Oversized_Tires5','$strVehicle_Oversized_Tires_Quantity5','$strVehicle_AdditionalInfo5',$auto_price5)";
		$wpdb->query($sql);

		$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Vehicle #5: $strVehicle_Year5 $strVehicle_Make5 $strVehicle_Model5 $tiermessage','$auto_price5')";
		$wpdb->query($sql);
	}


}


if ($howmany == "onevehicle") {
	$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Initial Shipment Total$tiermessage','$strTotalPrice')";
	$wpdb->query($sql);
} else {
	$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Multiple Vehicle Carrier Discount','-$carrierdiscount')";
	$wpdb->query($sql);

	$sql = "insert into payments (OrderID,Description,Amount) values ($strmaxorderid,'Multiple Vehicle Discounted Customer Deposit ($$DepositPerVehicle x $numvehicles)','$strDeposit')";
	$wpdb->query($sql);

}



//SALES CONVERSION UPDATE start
$trackid = $_SESSION['trackid'];
if (!empty($trackid)) {
	$sql = "update sale_conversion set dateupdated=NOW(),orderid = $strmaxorderid, sale_status = '5. Pickup/Destination Details' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end




?>

<script type="text/javascript">



$(document).ready(function() {




	// validate signup form on keyup and submit
	var validator = $("#mainform").validate({
		rules: {

			strPickup_Contact: "required",
			strPickup_Address1: "required",
			strPickup_City: "required",
			strPickup_Zip: "required",
			strDeliver_Contact: "required",
			strDeliver_Address1: "required",
			strDeliver_City: "required",
			strDeliver_Zip: "required",
			agreetoterms: "required"



		},
		messages: {
			agreetoterms: "You must agree to the Terms & Conditions before proceeding."
		},

		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.parent().next('.errormsg') );
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



});
</script>
<div class="smart-forms">


                
<form action="?step=6" method="post" name="mainform" id="mainform">
<input type="hidden" name="strOrderID" value="<?php echo $strmaxorderid ?>">
<input type="hidden" name="strDeposit" value="<?php echo $strDeposit ?>">


    <?php if(session('admin')!="") { ?>
        <div class="section fieldentry">
            <div class="frm-row">
                <div class="colm colm12">
                	<div style="width:620px;border:2px solid #000;background:#eee;padding:5px;margin: 0 auto; margin-bottom:15px; text-align: center">
                		<strong>OFFICE USE ONLY</strong><br>

                		<?php if($howmany == "onevehicle") { ?>
                		<table style="margin:0 auto;">
                		<tr>
                			<td nowrap="nowrap"><strong>Shipping From:</td>
                			<td nowrap="nowrap"><?php echo $strQuote_shippingfromcity . ", " . $strQuote_shippingfromstateabbr . " " . $strQuote_shippingfromzip ?></td>
                		</tr>
                		<tr>
                			<td nowrap="nowrap"><strong>Shipping To:</td>
                			<td nowrap="nowrap"><?php echo $strQuote_shippingtocity . ", " . $strQuote_shippingtostateabbr . " " . $strQuote_shippingtozip ?></td>
                		</tr>
                		<tr>
                			<td nowrap="nowrap"><strong>Name:</td>
                			<td nowrap="nowrap"><?php echo $strCustFirstName . " " . $strCustLastName ?></td>
                		</tr>
                		<?php if(!empty($strCustCompany)) { ?>
                		<tr>
                			<td nowrap="nowrap"><strong>Company:</td>
                			<td nowrap="nowrap"><?php echo $strCustCompany ?></td>
                		</tr>
                		<?php } ?>
                		<tr>
                			<td nowrap="nowrap"><strong>Phone:</td>
                			<td nowrap="nowrap"><?php echo $strCustPhone1 ?></td>
                		</tr>
                		<tr>
                			<td nowrap="nowrap"><strong>E-Mail Address:</td>
                			<td nowrap="nowrap"><?php echo $strCustEmail ?></td>
                		</tr>
                		<tr>
                			<td nowrap="nowrap"><strong>Ship Date:</td>
                			<td nowrap="nowrap"><?php echo $strDateAvailable ?></td>
                		</tr>

                		
                		
                		
                		
                		<tr>
                			<td nowrap="nowrap"><strong><?php echo $strVehicle_Year ?> - <?php echo $strVehicle_Make ?> - <?php echo $strVehicle_Model ?>:</strong>&nbsp;&nbsp;</td>
                			<td nowrap="nowrap">$<?php echo $auto_price ?></td>
                		</tr>
                		<?php if(!empty($strVehicle_AdditionalInfo)) { ?>
                		<tr>
                			<td nowrap="nowrap"><strong>Additional Vehicle Info:&nbsp;&nbsp;&nbsp;</strong></td>
                			<td nowrap="nowrap"><?php echo $strVehicle_AdditionalInfo ?></td>
                		</tr>
                		<?php } ?>
                		<?php if($strQuote_vehicle_operational == "Non-Running") { ?>
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
                			<td nowrap="nowrap"><strong>$<?php echo $strTotalPrice ?></strong></td>
                		</tr>
                		</table><br>
                		<?php } ?>
                
                		<strong>Shipping Distance:</strong> <?php echo $totaldistance ?> miles<br>
                		<?php
                
                			$deposittotal = $numvehicles * $depositpervehicle;
                			$duecarrier = $strDeposit - $deposittotal;
                			$pricepermile = ($strTotalPrice-$strDeposit) / $totaldistance;
                			$pricepermile = number_format($pricepermile,2);
                
                
                		if ($howmany != "onevehicle") {
                
                		?>
                			<br>
                			<strong>Types & Prices of Vehicles WITHOUT Deposit</strong>
                            <br>
                			<div class="numbutton1">1</div><div class="makemodel"><?php echo $strVehicle_Year1 ?> - <?php echo $strVehicle_Make1 ?> - <?php echo $strVehicle_Model1 ?> - $<?php echo $auto_price ?></div><div style="clear:both"></div>
                			<? if (!empty($strVehicle_Make2)) { ?><div class="numbutton1">2</div><div class="makemodel"><?php echo $strVehicle_Year2 ?> - <?php echo $strVehicle_Make2 ?> - <?php echo $strVehicle_Model2 ?> - $<?php echo $auto_price2 ?></div><div style="clear:both"></div><?php } ?>
                			<? if (!empty($strVehicle_Make3)) { ?><div class="numbutton1">3</div><div class="makemodel"><?php echo $strVehicle_Year3 ?> - <?php echo $strVehicle_Make3 ?> - <?php echo $strVehicle_Model3 ?> - $<?php echo $auto_price3 ?></div><div style="clear:both"></div><?php } ?>
                			<? if (!empty($strVehicle_Make4)) { ?><div class="numbutton1">4</div><div class="makemodel"><?php echo $strVehicle_Year4 ?> - <?php echo $strVehicle_Make4 ?> - <?php echo $strVehicle_Model4 ?> - $<?php echo $auto_price4 ?></div><div style="clear:both"></div><?php } ?>
                			<? if (!empty($strVehicle_Make5)) { ?><div class="numbutton1">5</div><div class="makemodel"><?php echo $strVehicle_Year5 ?> - <?php echo $strVehicle_Make5 ?> - <?php echo $strVehicle_Model5 ?> - $<?php echo $auto_price5 ?></div><div style="clear:both"></div><?php } ?>
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
            <div class="colm colm12">
                <strong>Pickup From</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Contact Name:
                        <label class="field append-icon"> 
                            <input type="text" name="strPickup_Contact" id="strPickup_Contact" size="40">
                            <label for="strPickup_Contact" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Company:<br>
                        <input type="text" name="strPickup_Company" id="strPickup_Company" size="40">
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Address:
                        <label class="field append-icon">
                            <input type="text" name="strPickup_Address1" id="strPickup_Address1" size="40">
                            <label for="strPickup_Address1" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                        <input type="text" name="strPickup_Address2" id="strPickup_Address2" size="40" style="margin-top:5px;">
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        City: <?php echo $strQuote_shippingfromcity  ?>
                        <input type="hidden" name="strPickup_City" id="strPickup_City" value="<?php echo $strQuote_shippingfromcity  ?>" >

                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        State: <?php echo $strQuote_shippingfromstate  ?>
                        <input type="hidden" name="strPickup_State" id="strPickup_State" value="<?php echo $strQuote_shippingfromstateabbr  ?>">
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Zip:
                        <label class="field append-icon">
                            <input type="text" name="strPickup_Zip" id="strPickup_Zip" size="10" value="<?php echo $strQuote_shippingfromzip  ?>" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>>
                            <label for="strPickup_City" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                
                    
                <div class="frm-row">
                    <div class="colm colm12">
                        Pickup&nbsp;Location&nbsp;Is:&nbsp;<br>
                        <label class="option" style="display:inline;">
                    	    <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_res" value="Residential" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');"><span class="radio"></span> Residential
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    	    <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_bus" value="Business" onclick="$('#Pickup_Location_Hours').show();"><span class="radio"></span> Business
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    	    <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_port" value="Port" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');"><span class="radio"></span> Port
                    	</label>
                    </div>
                </div>
                
                
                <div id="Pickup_Location_Hours" style="display:none;">
                	<div class="frm-row">
                        <div class="colm colm12">
                            Business Hours:<br>
                            <input type="text" name="strPickup_Location_Hours" id="strPickup_Location_Hours" size="40" maxlength="99">
                        </div>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Home Phone:<br>
                        <input type="text" name="strPickup_HomePhone" id="strPickup_HomePhone" size="25">
                    </div>
                </div>
                    
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Work Phone:<br>
                        <input type="text" name="strPickup_WorkPhone" id="strPickup_WorkPhone" size="25">
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Cell Phone:<br>
                        <input type="text" name="strPickup_CellPhone" id="strPickup_CellPhone" size="25">
                    </div>
                </div>
                
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <i class="fa fa-asterisk" style="color:#DB3232;"></i> At least one phone number is required
                    </div>
                </div>
                
                
                
                
                <?php if(session('admin')!="") { ?>
                <div class="frm-row">
                    <div class="colm colm12">
                                
                        Extra Instructions:<br>
                        <input type="text" name="strPickup_ExtraInst" id="strPickup_ExtraInst" size="40" maxlength="200"><br>
                        <br>
                        <input type="checkbox" name="strPickup_ExtraInst_Send" id="strPickup_ExtraInst_Send" value="yes" style="width: 25px;" /> Put Extra Instructions on B.O.L.<br>
                        <?php
                        $cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$strQuote_shippingfromcity&pickupState=$strQuote_shippingfromstateabbr&pickupZip=$strQuote_shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$ strQuote_shippingtocity&deliveryState=$strQuote_shippingtostateabbr&deliveryZip=$strQuote_shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";
                        $cd50 = urlencode($cd50);
                        $cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$strQuote_shippingfromcity&pickupState=$strQuote_shippingfromstateabbr&pickupZip=$strQuote_shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$ strQuote_shippingtocity&deliveryState=$strQuote_shippingtostateabbr&deliveryZip=$strQuote_shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";
                        $cd100 = urlencode($cd100);
                        
                        ?>
                        
                        <a href="/admin2k7/redir.asp?url=<?php echo $cd50  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
                        &nbsp;&nbsp;
                        <a href="/admin2k7/redir.asp?url=<?php echo $cd100  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>
                    </div>
                </div>
                <?php } ?>
                
                
            </div>
            <div class="colm colm5" style="margin-top: 20px;">
<!--
                <div class="imagebox">
                	<?php $stateimage = "//d36b03yirdy1u9.cloudfront.net/images/states-home/$strQuote_shippingfromstateabbr.jpg" ?>
                	<img src="<?php echo $stateimage ?>" style="width:275px" />
                	<div>Please do not ship a vehicle from yourself to yourself. Take the stress out of it and have alternate contacts that can meet the driver in case you cannot. Fill out vehicle condition upon pickup.</div>
                </div>
-->
				<div class="videocta" style="margin: 0;">
                    <a class="wpex-lightbox" href="https://www.youtube.com/embed/gGPow8qsdUM?rel=0&amp;autoplay=1" data-type="iframe" data-options="width:1920,height:1080" onclick="_gaq.push(['_trackEvent', 'YouTube', 'Why We Need Your Contact Information - Step 5', '']);" ><img class="alignnone size-full wp-image-22464" src="/images/youtube/videothumb-11-whycontact.jpg" width="255" /></a>
                </div>


            </div>
        </div>
    </div>
    

    <div class="section fieldentry">
        
        <div class="frm-row">
            <div class="colm colm12">
                <strong>Deliver To</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
                <div class="frm-row">
                    <div class="colm colm12">
                        Contact Name:
                        <label class="field append-icon"> 
                            <input type="text" name="strDeliver_Contact" id="strDeliver_Contact" size="40">
                            <label for="strDeliver_Contact" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">        
                        Company:<br>
                        <input type="text" name="strDeliver_Company" id="strDeliver_Company" size="40">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        Address:<br>
                        <label class="field append-icon">
                            <input type="text" name="strDeliver_Address1" id="strDeliver_Address1" size="40">
                            <label for="strDeliver_Address1" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                        <input type="text" name="strDeliver_Address2" id="strDeliver_Address2" size="40" style="margin-top:5px;">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">     
                        City: <?php echo $strQuote_shippingtocity  ?>
                        <input type="hidden" name="strDeliver_City" id="strDeliver_City" value="<?php echo $strQuote_shippingtocity  ?>">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">             
                        State: <?php echo $strQuote_shippingtostate  ?>
                        <input type="hidden" name="strDeliver_State" id="strDeliver_State" value="<?php echo $strQuote_shippingtostateabbr  ?>">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        Zip:<br>
                        <label class="field append-icon">
                            <input type="text" name="strDeliver_Zip" id="strDeliver_Zip" size="10" value="<?php echo $strQuote_shippingtozip  ?>" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>>
                            <label for="strDeliver_City" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">             
                        Deliver&nbsp;Location&nbsp;Is:&nbsp;<br>
                        <label class="option" style="display:inline;">
                    	    <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_res" value="Residential" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');"><span class="radio"></span> Residential
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    	    <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_bus" value="Business" onclick="$('#Deliver_Location_Hours').show();"><span class="radio"></span> Business
                    	</label>
                    	
                    	<label class="option" style="display:inline;">
                    	    <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_port" value="Port" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');"><span class="radio"></span> Port
                    	</label>
                    </div>
                </div>

                       
                <div id="Deliver_Location_Hours" style="display:none;">
                    <div class="frm-row">
                        <div class="colm colm12">  
                        	Business Hours:<br>
                        	<input type="text" name="strDeliver_Location_Hours" id="strDeliver_Location_Hours" size="40" maxlength="99">
                        </div>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        Home Phone:<br>
                        <input type="text" name="strDeliver_HomePhone" id="strDeliver_HomePhone" size="25">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        Work Phone:<br>
                        <input type="text" name="strDeliver_WorkPhone" id="strDeliver_WorkPhone" size="25">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        Cell Phone:<br>
                        <input type="text" name="strDeliver_CellPhone" id="strDeliver_CellPhone" size="25">
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">         
                        <i class="fa fa-asterisk" style="color:#DB3232;"></i>At least one phone number is required
                    </div>
                </div>

                         
                <?php if(session('admin')!="") { ?>
                    <div class="frm-row">
                        <div class="colm colm12">
                            Extra Instructions:<br>
                            <input type="text" name="strDeliver_ExtraInst" id="strDeliver_ExtraInst" size="40" maxlength="200"><br><br>
                            <input type="checkbox" name="strDeliver_ExtraInst_Send" id="strDeliver_ExtraInst_Send" value="yes"  style="width: 25px;"/> Put Extra Instructions on B.O.L.<br>
                            
                            <?php
                            $cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$strQuote_shippingtocity&pickupState=$strQuote_shippingtostateabbr&pickupZip=$strQuote_shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$ strQuote_shippingfromcity&deliveryState=$strQuote_shippingfromstateabbr&deliveryZip=$strQuote_shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";
                            $cd50 = urlencode($cd50);
                            $cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$strQuote_shippingtocity&pickupState=$strQuote_shippingtostateabbr&pickupZip=$strQuote_shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$ strQuote_shippingfromcity&deliveryState=$strQuote_shippingfromstateabbr&deliveryZip=$strQuote_shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";
                            $cd100 = urlencode($cd100);
                            
                            ?>
                            <a href="/admin2k7/redir.asp?url=<?php echo $cd50  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
                            &nbsp;&nbsp;
                            <a href="/admin2k7/redir.asp?url=<?php echo $cd100  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>
                        </div>
                    </div>               
                <?php } ?>

            </div>
            

            <div class="colm colm5" style="margin-top: 20px;">
                <div class="imagebox">
                	<?php $stateimage = "//d36b03yirdy1u9.cloudfront.net/images/states-home/$strQuote_shippingtostateabbr.jpg" ?>
                	<img src="<?php echo $stateimage ?>" style="width:275px" />
                	<div>The driver will have a vehicle condition report for you to sign. Please go over it carefully and pay the carrier the balance owed with a money order or cash upon delivery.</div>
                </div>
            </div>
            
         </div>
    </div>

    <div class="section fieldentry">

        
        <div class="frm-row">
            <div class="colm colm12">
                <strong>Terms & Conditions</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
                
                <div class="frm-row">
                    <div class="colm colm12">

                        <textarea cols="70" rows="10" name="termsconditions" id="termsconditions" readonly class="bodytext" style="font-size: 12px;">
Shipper and Direct Express Auto Transport Agree To The Following:

1. Pick up and delivery is from your door to your door unless residential area restrictions apply. If your vehicle is inoperable or oversize (dual or oversize wheels, extra-large, racks, lifted, limo, etc.), please inquire as to extra charges. If carrier is not advised of inoperable or oversized vehicles prior to pick-up, all extra charges must be paid in cash or money order made payable to delivery company upon delivery.

2. The carrier and driver jointly and separately are authorized to operate and transport his/her or their motor vehicle between its pick up location and the destination set forth on this shipping order-bill of lading.

3. Direct Express agrees to provide a carrier to transport your vehicle as promptly as possible in accordance with your instructions but cannot guarantee pick-up or delivery on a specified date or time. If the customer cancels an order his deposit will be refunded in full. Direct Express reserves the right to reject any order and will refund the deposit in full.

4. If a shipping rate was chosen greater than the Standard Rate, it cannot be changed once a carrier has been assigned, regardless of estimated shipping dates or date of assignment. All changes to the shipping price, whether greater or lesser in amount, must occur prior to vehicle assignment and acknowledged by Direct Express via email. The carrier accepted your vehicle for shipping and reserved space for it based upon the amount offered and is not responsible for how long it took to have it assigned, picked up or delivered.

5. Shipper shall remove all non-permanent outside mounted luggage and other racks prior to shipment. Vehicles must be tendered to carrier in good running condition (unless otherwise noted) with no more than a half tank of fuel (prefer 1/4 tank).

6. Luggage and personal property must be confined to trunk, with no heavy articles, and not to exceed 100 lbs.. Carrier is not liable for personal items left in vehicle, nor for damage caused to vehicle from excessive or improper loading of personal items. Direct Express does not agree to pay for your rental of a vehicle, nor shall it be liable for failure of mechanical or operating parts of your vehicle.

7. Trucking damage claims are covered by a minimum of 3/4 of a million dollars public liability and property damage. All claims must be noted and signed for at time of delivery, and submitted in writing within 15 days of delivery. Direct Express will share the carrier insurance policy upon request.

8. No electronic equipment, valuables, plants, live pets, alcohol, drugs or firearms, may be left in the vehicle.

9. International orders,the car must be empty except for factory installed equipment. Indicate serial #, and give car's approximate value in U.S. dollars. Shipper is responsible for the proper customs paperwork. (ask the assigned carrier for help with these documents)

10. Shipper warrants that he will pay the price quoted due Direct Express Auto Transport, Inc. for delivered vehicles, and will not seek to charge back a credit card or stop a check to offset any dispute for damage claims. Department of Transportation regulations require that all claims be filed in writing and all tariffs be paid in full before claim can be processed.

This agreement and any shipment here under is subject to all terms and conditions of the carrier's tariff and the uniform straight bill of lading, copies of which are available at the office of the carrier.

This supersedes all prior written or oral representation of Direct Express and constitutes the entire agreement between shipper and Direct Express and may not be changed except in writing signed by an officer of Direct Express.

Direct Express' U.S. Department of Transportation Broker's license number is 479342.
                
                        </textarea>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <label class="option">
                            <input type="checkbox" name="agreetoterms" id="agreetoterms" value="1">
                            <span class="checkbox"></span> Click here to agree to terms and conditions.
                        </label>
                        <div class="errormsg"></div>
                    </div>
                </div>
            </div>
            <div class="colm colm5">            
                <div class="imagebox">
                	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-6.jpg" style="width:275px"  />
                	<div>Go On ... just one more step and you're done!</div>
                </div>
            </div>
        </div>


        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm4">
                <button type="submit" class="goonbutton">
                    Go On&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                </button>
                <div style="font-size: 13px; text-align: center;">Step 2 of 3&nbsp;&nbsp;&nbsp;</div>
            </div>
        </div>
        

</form>

</div>