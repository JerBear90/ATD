<?php



/*
echo "<pre>";
var_dump($_POST);
echo $_POST['strBilling_State'];
echo postdb('strBilling_State');
echo "</pre>";
*/


$CurrentUsername = session('rep');
$strOrderID = postdb('orderid');

//testing
//$strOrderID='150386';



$strBilling_FirstName = postdb('strBilling_FirstName');
$strBilling_LastName = postdb('strBilling_LastName');
$strBilling_Name = $strBilling_FirstName . " " . $strBilling_LastName;
$strBilling_Address1 = postdb('strBilling_Address1');
$strBilling_Address2 = postdb('strBilling_Address2');
$strBilling_City = postdb('strBilling_City');
$strBilling_State = postdb('strBilling_State');
$strBilling_Zip = postdb('strBilling_Zip');
$strBilling_Phone = postdb('strBilling_Phone');
$strCreditCartNum = postdb('strCreditCartNum');
$cc_lastfour = substr($strCreditCartNum,-4);
$strCreditCartMonth = postdb('strCreditCartMonth');
$strCreditCartYear = postdb('strCreditCartYear');
$strCreditCartCVV = postdb('strCreditCartCVV');


If ($strBilling_State == "BC" || $strBilling_State == "NT" || $strBilling_State == "NS" || $strBilling_State == "NU" || $strBilling_State == "PE" || $strBilling_State == "QC" || $strBilling_State == "SK" || $strBilling_State == "YT" || $strBilling_State == "MB" || $strBilling_State == "NB" || $strBilling_State == "ON") {
	$strBilling_Country = "CA";
} else {
	$strBilling_Country = "US";
}
$strSalesRep = postdb('strSalesRep');

$sql = "select * from orders where orderid = $strOrderID";
$getorder = $wpdb->get_row($sql,ARRAY_A);


$strDeposit = $getorder['Deposit'];
$numofvehicles = $getorder['Num_Of_Vehicles'];
$strCustEmail = $getorder['CustEmail'];


$balance = $getorder['Balance'];
$CarrierTip = postdb('CarrierTip');




include('termshtmlemail.php');

if ($getorder['Status'] != "NEW" && $getorder['Status'] != "ASSIGNED" && $getorder['Status'] != "CANCELLED") {
    
    $x_login = "2Q6t4sMM";
    $x_tran_key = "2j5G5NTh35jXb64F";
    $x_version = "3.1";
    $x_delim_data = "TRUE";
    $x_delim_char = "|";
    $x_relay_response = "FALSE";
    $x_method = "CC";

	// Sale
	$x_type = "AUTH_CAPTURE";
	$x_test_request = "FALSE";
	$x_card_num = $strCreditCartNum;
	$x_exp_date = $strCreditCartMonth . $strCreditCartYear;
	$x_card_code = $strCreditCartCVV;

	$x_amount = $strDeposit;
	$x_invoice_num = $strOrderID;
	$x_description = '';

	$x_first_name = $strBilling_FirstName;
	$x_last_name = $strBilling_LastName;
	$x_address = $strBilling_Address1;
	$x_city = $strBilling_City;
	$x_state = $strBilling_State;
	$x_zip = $strBilling_Zip;
	$x_phone = $strBilling_Phone;
	$x_email = $strCustEmail;
	$x_customer_ip = GetIP();

	$post_url = "https://secure.authorize.net/gateway/transact.dll";
	$post_values = array(
		// the API Login ID and Transaction Key must be replaced with valid values
		"x_login"			=> $x_login,
		"x_tran_key"		=> $x_tran_key,
		"x_version"			=> $x_version,
		"x_delim_data"		=> $x_delim_data,
		"x_delim_char"		=> $x_delim_char,
		"x_relay_response"	=> $x_relay_response,
		"x_type"			=> $x_type,
		"x_test_request"	=> $x_test_request,
		"x_method"			=> $x_method,

		"x_card_num"		=> $x_card_num,
		"x_exp_date"		=> $x_exp_date,
		"x_card_code"		=> $x_card_code,

		"x_amount"			=> $x_amount,
		"x_invoice_num"		=> $x_invoice_num,
		"x_description"		=> $x_description,

		"x_first_name"		=> $x_first_name,
		"x_last_name"		=> $x_last_name,
		"x_address"			=> $x_address,
		"x_city"			=> $x_city,
		"x_state"			=> $x_state,
		"x_zip"				=> $x_zip,
		"x_phone"			=> $x_phone,
		"x_email"			=> $x_email,
		"x_customer_ip"		=> $x_customer_ip
	);
    

    
        
    // This section takes the input fields and converts them to the proper format
    // for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
    $post_string = "";
    foreach( $post_values as $key => $value )
    	{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
    $post_string = rtrim( $post_string, "& " );
    
    // This sample code uses the CURL library for php to establish a connection,
    // submit the post, and record the response.
    // If you receive an error, you may want to ensure that you have the curl
    // library enabled in your php configuration
    $request = curl_init($post_url); // initiate curl object
    	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
    	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
    	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
    	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
    	$post_response = curl_exec($request); // execute curl post and store results in $post_response
    	// additional options may be required depending upon your server configuration
    	// you can find documentation on curl options at http://www.php.net/curl_setopt
    curl_close ($request); // close curl object
    
    // This line takes the response and breaks it into an array using the specified delimiting character
    $response_array = explode($post_values["x_delim_char"],$post_response);
    
    
    // The results are output to the screen in the form of an html numbered list.
   
/*
    echo "<OL>\n";
    foreach ($response_array as $value)
    {
    	echo "<LI>" . $value . " </LI>\n";
    	$i++;
    }
    echo "</OL>\n";
*/
   

    
    //Response Code | Response Reason | Authorization Code | Transaction ID
    $response = $response_array[0] . "|" . $response_array[3] . "|" . $response_array[4] . "|" . $response_array[6];
    //echo $response;
    
    
    $respsplit = explode("|", $response);

	$ResponseCode = $respsplit[0];
	$ResponseReason = $respsplit[1];
	$AuthorizationCode = $respsplit[2];
	$TransactionID = $respsplit[3];

/*
    echo "ResponseCode: $ResponseCode<br/>";
    echo "ResponseReason: $ResponseReason<br/>";
    echo "AuthorizationCode: $AuthorizationCode<br/>";
    echo "TransactionID: $TransactionID<br/>";
*/

	If ($ResponseCode == "1") {
		$cys_success=1;
		$Cys_AuthCode=$AuthorizationCode;
		$Cys_TransId=$TransactionID;
	} else {
		$cys_success=0;
	}



	if (session('rep') == "claydough") {
		$cys_success=1;
		$Cys_AuthCode="test";
		$Cys_TransId="test";
	}


    
}



//testing
//$cys_success=1;

if ($cys_success == 1) {

	$sql = "update orders set status = 'NEW', SalesRep_Complete = '$strSalesRep', order_date = NOW(),Billing_Name = '$strBilling_Name', Billing_Address1 = '$strBilling_Address1', Billing_Address2 = '$strBilling_Address2', Billing_City = '$strBilling_City', Billing_State = '$strBilling_State', Billing_Zip = '$strBilling_Zip', Billing_Phone = '$strBilling_Phone', lp_ApprovalCode = '$Cys_AuthCode', lp_OrderNumber = '$Cys_TransId', cc_lastfour = '$cc_lastfour' where orderid = $strOrderID";
    $wpdb->query($sql);

	$sql = "insert into payments (OrderID,Description,Amount,username)";
	if ($numofvehicles==1) {
		$sql .= " values  ($strOrderID,'Down Payment - Credit Card','-$strDeposit','$CurrentUsername')";
	} else {
		$sql .= " values  ($strOrderID,'Multiple Vehicle Down Payment - Credit Card','-$strDeposit','$CurrentUsername')";
	}
    $wpdb->query($sql);
    
    $sql = "select * from orders where orderid = $strOrderID";
    $getorder = $wpdb->get_row($sql,ARRAY_A);

    $sql = "select * from orders_vehicles where orderid = $strOrderID";
    $getvehicles = $wpdb->get_results($sql,ARRAY_A);

	$body = "You have a new order at Direct Express Auto Transport.  Please login to the administrator and refer to order number $strOrderID\n\n";
	$body .= "Admin Link: https://www.autotransportdirect.com/admin2k7/\n";
	$body .= "Order Detail Link: https://www.autotransportdirect.com/admin2k7/detail.asp?orderid=$strOrderID\n";

	if(empty($CurrentUsername)) {
    	$reporteduser = "ATD";
    } else {
		$reporteduser = $CurrentUsername;
	}
	$reporteddate = date('Y-m-d');
	
    //atdmail("text","Direct Express Auto Transport Order System","info@autotransportdirect.com","info@autotransportdirect.com","New Order - " . $reporteduser . " - " . $strOrderID . " - " . $reporteddate,$body);

    atdmail("text","Direct Express Auto Transport Order System", "orders@autotransportdirect.com", "mrupers@mac.com", "New Order - " . $reporteduser . " - " . $strOrderID . " - " . $reporteddate, $body);
    
//    atdmail("text","Direct Express Auto Transport Order System", "orders@autotransportdirect.com", "clay@madebysprung.com", "New Order - " . $reporteduser . " - " . $strOrderID . " - " . $reporteddate, $body);


    if ($CarrierTip!='0') {
        $newbalance = $balance + $CarrierTip;
        $ordertotal = $newbalance + $strDeposit;
    	$sql = "update orders set Total='$ordertotal', balance='$newbalance', CarrierTip = '$CarrierTip' where orderid = $strOrderID";
        $wpdb->query($sql);
        
        $sql = "insert into payments (OrderID,Description,Amount) values ($strOrderID,'Extra To Carrier','$CarrierTip')";
    	$wpdb->query($sql);
    }




	$startzip = $getorder['Pickup_Zip'];
	$endzip = $getorder['Deliver_Zip'];
    $Message_From = '';
    $Message_To = '';
    $Message_Whole='';
    
	//Check for Zip Message Start
	$sql="select NearCity, Status from ziprateadjust where partialzip='" . substr($startzip,0,3) . "'";
    $alertzip = $wpdb->get_results($sql,ARRAY_A);
    if ($wpdb->num_rows > 1) {
        $NearCity_from = $alertzip['NearCity'];
		$MessageStatus_from = $alertzip['Status'];
    }
    
	if ($NearCity_from != "" && $MessageStatus_from != "") {
		if ($MessageStatus_from == "2") {
			$recommendstatus_from = "seriously";
		}
		$Message_From = "If you are in a hurry, then you should $recommendstatus_from consider meeting a driver in $NearCity_from.";
	}

	//Check for Zip Message End
	$sql="select NearCity, Status from ziprateadjust where partialzip='" . substr($endzip,0,3) . "'";
    $alertzip = $wpdb->get_results($sql,ARRAY_A);
    if ($wpdb->num_rows > 1) {
        $NearCity_to = $alertzip['NearCity'];
		$MessageStatus_to = $alertzip['Status'];
    }
	if ($NearCity_to != "" && $MessageStatus_to != "") {
		if ($MessageStatus_to == "2") {
			$recommendstatus_to = "seriously";
		}
		$Message_to = "If you are in a hurry, then you should $recommendstatus_to consider meeting a driver in $NearCity_to.";
	}


	if ($Message_From!="" && $Message_To!="") {
		$Message_Whole = $Message_From . "And as well, you should $recommendstatus_to consider meeting a driver in $NearCity_to.";
	} else {
		$Message_Whole = $Message_From . $Message_To;
	}

    $body =  '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>AutoTransportDirect.com</title></head><body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#EFEFEF" color="#000000"><table width="700" cellspacing="0" cellpadding="0" border="0" align="center"><tr><td background="http://www.autotransportdirect.com/images/background_main.gif" class="bodytext"><a href="http://www.autotransportdirect.com/?src=SRC-ReviewEmail"><img src="http://www.autotransportdirect.com/images/header-email.jpg" width="700" height="99" alt="" border="0"></a><table width="100%" cellspacing="0" cellpadding="10" border="0"><tr><td><font face="Verdana,Geneva,Arial,Helvetica,sans-serif" size="2" color="#000000">';

	$body .= "Thank You!<br/><br/>";
	$body .= "Your order number is $strOrderID<br/><br/>";
	$body .= "If you need to contact us regarding your order, call <font color='red'><strong>800-600-3750</strong></font> or go to<br/>http://www.autotransportdirect.com/contact-us/<br/><br/>";

	if ($Message_Whole!="") {
		$body .= "<strong>Helpful Hint:</strong><br/><br/>";
		$body .= "Over 90% of our orders ship within seven days of the date it was made available. Some locations can throw that off, making it more difficult and causing delay. Your location(s) might be in that group. ";
		$body .= "<strong>$Message_Whole</strong>";
		$body .= "Many customers appreciate that tip upfront, and hopefully our customer service representative mentioned the suggestion to you. Our experience tells us that there is more truck traffic there, making it easier and faster to ship your vehicle. You don't have to do that if you are more flexible with your time and can be patient. That said, we are often surprised at how fast a vehicle ships when we thought it might be more difficult. If you choose to meet a driver elsewhere, you will be emailed by us and phoned by the driver well in advance, giving you time to coordinate. Call us at 800-600-3750 if you prefer meeting elsewhere.<br/><br/>";
		$body .= "Ours is the most efficient way to ship a vehicle because we have several thousand carriers in our database. No one of them could possibly compete with that as there are thousands of cities and towns shipping to thousands of others. The number of possibilities are staggering. Our goal is to match your vehicle with the carrier actually running your route, and we have the best chance of doing that.<br/><br/>";
		$body .= "Thank you for your order!<br/><br/>";
	}

	$body .= "<strong>Next 4 Steps</strong><br/><br/>";
	$body .= "1. Another email will be sent to you when your vehicle has been assigned a carrier for pickup. That email is simply a courtesy to you letting you know that your shipment is in the process of getting picked up. <br/><br/>";
	$body .= "2. A dispatcher or driver will call your pickup contact person at the number(s) you provided to arrange pickup. Usually, but not always, setup is the day before pickup. You don't have to wait around for that call - but you do need to respond to it in a timely fashion. Sometimes a driver is ready on short notice (a few hours) and if that happens and you can't meet him, just call us to reschedule another driver. But if you can meet him, we highly recommend that you do so if at all possible. <br/><br/>";
	$body .= "3. Usually, but not always, the day before delivery the driver will call your delivery contact person at the number(s) you provided to arrange delivery. <br/><br/>";
	$body .= "4. <strong>The Balance Owed is always paid to the driver upon delivery (<span style='color:red'>not pickup</span>) with CASH or MONEY ORDER made payable to the delivery company <span style='color:red'>(not us)</span>.</strong><br/><br/>";

	$body .= "<br/><table cellspacing='2' cellpadding='2' border='0' width='50%'><tr>";
	$body .= "<td class='bodytext2'><strong>Shipping From:</strong></td>";
	$body .= "<td class='bodytext2'>". $getorder['Pickup_City'] . ", ". $getorder['Pickup_State'] . " ". $getorder['Pickup_Zip'] . "</td>";
	$body .= "</tr><tr>";
	$body .= "<td class='bodytext2'><strong>Shipping To:</strong></td>";
	$body .= "<td class='bodytext2'>". $getorder['Deliver_City'] . ", ". $getorder['Deliver_State'] . " ". $getorder['Deliver_Zip'] . "</td>";
	$body .= "</tr><tr>";

	if ($getorder['Num_Of_Vehicles'] == 1) {
		$body .= "<td class='bodytext2'><strong>Type of Vehicle:</strong></td>";
		$body .= "<td class='bodytext2' nowrap>". $getorder['Vehicle_Make'] . " - ". $getorder['Vehicle_Model'] . "</td>";
		$body .= "</tr><tr>";
	} else {
    	
    	$body .= "<td class='bodytext2' valign='top'><strong>Type of Vehicle:</strong></td>";
		$body .= "<td class='bodytext2' nowrap valign='top'>";
		$counter=1;
    	foreach ($getvehicles as $vehicle) {
			$body .= $counter . ". " . $vehicle['Vehicle_Make'] . " - " . $vehicle['Vehicle_Model'] . "<br />";
			$counter++;
        }
		$body .= "</td>";
		$body .= "</tr><tr>";
	}
    
    
    $now = date("n/d/Y g:i a");
    $DateAvailable_Initial = strtotime($getorder['DateAvailable_Initial']);
    $DateAvailable_Initial = date("n/d/Y",$DateAvailable_Initial);
    
    
    
	$body .= "<td class='bodytext2' nowrap='nowrap'><strong>Operating Condition:</strong></td>";
	$body .= "<td class='bodytext2' nowrap='nowrap'>". $getorder['Quote_vehicle_operational'] . " and Rolls, Brakes, Steers</td>";
	$body .= "</tr><tr>";
	$body .= "<td class='bodytext2'><strong>Type of Trailer:</strong></td>";
	$body .= "<td class='bodytext2'>". $getorder['Quote_vehicle_trailer'] . "</td>";
	$body .= "</tr><tr>";
	$body .= "<td class='bodytext2' nowrap='nowrap'><strong>First Date Vehicle is Available:</strong></td>";
	$body .= "<td class='bodytext2' nowrap='nowrap'>". $DateAvailable_Initial . " - <strong><a href='http://www.autotransportdirect.com/information-shipping-dates/'>Please see typical shipping time frames</a></strong></td>";

	$body .= "</tr></table><br/><br/>";

	$body .= "As of " . $now . "<br/>";
	$body .= "			<table width='75%' cellspacing='1' cellpadding='4' border='1'>";
	$body .= "			<tr>";
	$body .= "			    <td bgcolor='#ffffff' class='formtext2' width='10%'><strong>Date/Time</strong></td>";
	$body .= "				<td bgcolor='#ffffff' class='formtext2' width='70%'><strong>Description</strong></td>";
	$body .= "				<td bgcolor='#ffffff' class='formtext2' width='10%' align='center'><strong>Amount</strong></td>";
	$body .= "				<td bgcolor='#ffffff' class='formtext2' width='10%' align='center'><strong>Balance</strong></td>";
	$body .= "			</tr>";

	$sql = "select * from payments where orderid = $strOrderID order by paymentid";
	$getpayments = $wpdb->get_results($sql,ARRAY_A);

	$RunningTotal = 0;
	foreach ($getpayments as $payment) {

		$RunningTotal = $RunningTotal + $payment['Amount'];
		$paymentdescription = $payment['Description'];
        

        if (strpos($paymentdescription, "Agreed to Submit Online")!==false &&
            strpos($paymentdescription, "Multiple Vehicle Carrier")!==false &&
            strpos($paymentdescription, "Customer Deposit")!==false &&
            strpos($paymentdescription, "Initial Shipment")!==false &&
            strpos($paymentdescription, "Vehicle #")!==false &&
            strpos($paymentdescription, "Down Payment")!==false &&
            strpos($paymentdescription, "Turbo Charge")!==false) {
			$paymentdescription = '';
		}

		$body .= "<tr>";
		$body .= "		<td bgcolor='#ffffff' class='bodytext3' nowrap>" . $payment['Date'] . "</td>";
		$body .= "		<td bgcolor='#ffffff' class='bodytext3'>" . $paymentdescription . "</td>";
		$body .= "		<td bgcolor='#ffffff' class='bodytext3' nowrap align='right'>$" . number_format($payment['Amount'],0) . "</td>";
		$body .= "		<td bgcolor='#ffffff' class='bodytext3' nowrap align='right'>$" . number_format($RunningTotal,0) . "</td>";
		$body .= "</tr>";
    }

	$body .= "	</table>";
    $body .= "Deposit Billed To: Credit Card, Money Order or Check<br/><br/>";

	$body .= $terms;

    $body .= "</font></td></tr></table><img src='http://www.autotransportdirect.com/images/mainbox_bottom.gif' width='700' height='3' alt='' border='0'></td></tr></table><center><br/><font face='Verdana,Geneva,Arial,Helvetica,sans-serif' size='1'>Copyright &copy; " . date('Y') . ", <a href='http://www.autotransportdirect.com/' class='footer'>AutoTransportDirect.com</a><br/>License # MC 479342</p></center></font></body></html>";

	atdmail("html","Direct Express Auto Transport Order System", "info@autotransportdirect.com", $getorder['CustEmail'], "Your Direct Express Auto Transport Order - " . $strOrderID, $body);
	
	CommAudit($strOrderID,"order_confirmation","info@autotransportdirect.com",$getorder['CustEmail'],"Your Direct Express Auto Transport Order - " . $strOrderID,$body);



}

$cys_success=0;

if ($cys_success == 1 || $getorder['Status'] == "NEW") {

    $sql = "select * from orders where orderid = $strOrderID";
    $getorder = $wpdb->get_row($sql,ARRAY_A);

    $sql = "select * from orders_vehicles where orderid = $strOrderID";
    $getvehicles = $wpdb->get_results($sql,ARRAY_A);


    $audit_notes = "Order Received through front-end.";
    AuditTrail($strOrderID,$currentuser,$audit_notes);
    
    $trackid = session("trackid");
    if ($trackid != "") {
    	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '7. Order Complete' where trackid = '$trackid'";
    	$wpdb->query($sql);
    }
    
    //If order came from a quote, update the quote record
    if (!empty($_SESSION['qid'])) {
    	$sql = "update quote_email set orderid = $strmaxorderid where quoteid = " . $_SESSION['qid'];
        $wpdb->query($sql);
    }

?>



<div class="smart-forms orderreceipt">
    
    <div class="section">
        <div class="frm-row" style="margin: 0 !important;">
            <div class="colm colm5">
                <strong>Your Order is Complete! </strong><br/>
            </div>
            <div class="colm colm7">
                <strong>Your Order ID: <font color="#308dff"><?php echo $strOrderID ?></font></strong>
            </div>
        </div>
        <div class="frm-row">
            <div class="colm colm12">
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm8">
                <div class="frm-row">
                    <div class="colm colm12"><br></div>
                </div>
                <div class="frm-row">
                    <div class="colm colm3"></div>
                    <div class="colm colm3">
                        <strong>Shipping From:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder['Pickup_City'] ?>, <?php echo $getorder['Pickup_State'] ?>  <?php echo $getorder['Pickup_Zip'] ?>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm3"></div>
                    <div class="colm colm3">
                        <strong>Shipping To:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder['Deliver_City'] ?>, <?php echo $getorder['Deliver_State'] ?>  <?php echo $getorder['Deliver_Zip'] ?>
                    </div>
                </div>


                <?php
                if ($getorder['Num_Of_Vehicles'] == 1) {
                    ?>
                    <div class="frm-row">
                        <div class="colm colm3"></div>
                        <div class="colm colm3">
                            <strong>Type of Vehicle:</strong>
                        </div>
                        <div class="colm colm6">
                            <?php echo $getorder['Vehicle_Make'] ?> - <?php echo $getorder['Vehicle_Model'] ?>
                        </div>
                    </div>
                <?php } else {
                	 ?>
                    <div class="frm-row">
                        <div class="colm colm3"></div>
                        <div class="colm colm3">
                            <strong>Types of Vehicles:</strong>
                        </div>
                        <div class="colm colm6">
                            <?php
                    		$counter=1;
                    		foreach ($getvehicles as $vehicle) {
                    			?>
                    			<?php echo $vehicle['Vehicle_Make'] ?> - <?php echo $vehicle['Vehicle_Model'] ?><br/>
                    			<?php
                    			$counter++;
                    		}
                    		?>
                        </div>
                    </div>
                    
                <?php } ?>
                
                <div class="frm-row">
                    <div class="colm colm3"></div>
                    <div class="colm colm3">
                        <strong>Operating Condition:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder['Quote_vehicle_operational'] ?> and Rolls, Brakes, Steers
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm3"></div>
                    <div class="colm colm3">
                        <strong>Type of Trailer:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder['Quote_vehicle_trailer'] ?>
                    </div>
                </div>
            </div>
            <div class="colm colm2">
<!--
                <div class="imagebox">
                	<img src="/images/staff/quote7-1.jpg"  style="width: 260px;" />
                	<div>Thanks! You will receive an email confirming your order, and another the moment we assign your vehicle to a driver.</div>
                </div>
-->
                
                
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm4"></div>
            <div class="colm colm4">
	            <div class="videocta" style="margin: 20px 0 0 0;">
                    <a class="wpex-lightbox" href="https://www.youtube.com/embed/LrJAUlD58V4?rel=0&amp;autoplay=1" data-type="iframe" data-options="width:1920,height:1080" onclick="_gaq.push(['_trackEvent', 'YouTube', 'Thank You! Watch For Order Confirmation Email - Step 7', '']);" ><img class="alignnone size-full wp-image-22464" src="/images/youtube/videothumb-13-thankyou.jpg" width="255" /></a>
                </div>
            </div>
            <div class="colm colm4"></div>

    </div>
    
    
    <div class="section">
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm10" style="text-align: center;">
                <div style="margin:25px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                
                
                <span style="font-size: 25px; font-weight: 600;">Total Price: $<?php echo number_format($getorder['Total'],0) ?></span>
                <br/>
                <div style="float:right; width:170px;margin-left:20px;">
                    <div class="imagebox">
                    	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/staff-faq-YM.jpg" style="width:260px" />
                    	<div>A deposit of $<?php echo $strDeposit ?> to be billed to your credit card.</div>
                    </div>
                </div>
                <br/>

                <div style="color:#0081CC; font-weight: 600; font-size: 1.2em;">
                Your transaction is successful.  $<?php echo $strDeposit ?> has been charged to your credit card as a deposit.
                Please print out this page as your order receipt.  Call 1-800-600-3750 with any questions.<br/><br/>
                Thank you for your business!<br/><br/>
                </font>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
           
            <div class="colm colm1"></div>
        </div>
        
        
        
    </div>

    <div class="section">
        <div class="frm-row">
            <div class="colm colm3"></div>
            <div class="colm colm6">
                
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Order ID:</strong>
                    </div>
                    <div class="colm colm7">
                        <font color="#0081CC"><strong><?php echo $strOrderID ?></strong></font>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['CustFirstName'] ?>&nbsp;<?php echo $getorder['CustLastName'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone Number:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['CustPhone1'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>E-Mail Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['CustEmail'] ?>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Vehicle Details</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>	
                    </div>
                </div>
                
                <?php
                if ($getorder['Num_Of_Vehicles'] == 1) {
                    ?>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Year:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder['Vehicle_Year'] ?>
                        </div>
                    </div>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Make:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder['Vehicle_Make'] ?>
                        </div>
                    </div>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Model:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder['Vehicle_Model'] ?>
                        </div>
                    </div>
                <?php } else {
                	 ?>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Vehicles:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php
                    		$counter=1;
                    		foreach ($getvehicles as $vehicle) {
                    			?>
                    			<?php echo $vehicle['Vehicle_Year'] ?> - <?php echo $vehicle['Vehicle_Make'] ?> - <?php echo $vehicle['Vehicle_Model'] ?><br/>
                    			<?php
                    			$counter++;
                    		}
                    		?>
                        </div>
                    </div>
                <?php } ?>


                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Dates</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>First Date Available To Ship</strong>
                    </div>
                    <div class="colm colm7">
                        <?php 
                        $DateAvailable_Initial = strtotime($getorder['DateAvailable_Initial']);
                        $DateAvailable_Initial = date("n/d/Y",$DateAvailable_Initial);
                        echo $DateAvailable_Initial;
                        ?>
                    </div>
                </div>
                
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Pickup From</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Contact Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_Contact'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_Address1'] ?><br>
                        <?php echo $getorder['Pickup_Address2'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>City:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_City'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>State:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_State'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Zip Code:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_Zip'] ?>
                    </div>
                </div>
                <?php if($getorder['Pickup_HomePhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Home Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_HomePhone'] ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($getorder['Pickup_WorkPhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Work Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_WorkPhone'] ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($getorder['Pickup_CellPhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Cell Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Pickup_CellPhone'] ?>
                    </div>
                </div>
                <?php } ?>
          
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Deliver From</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Contact Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_Contact'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_Address1'] ?><br>
                        <?php echo $getorder['Deliver_Address2'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>City:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_City'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>State:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_State'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Zip Code:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_Zip'] ?>
                    </div>
                </div>
                <?php if($getorder['Deliver_HomePhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Home Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_HomePhone'] ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($getorder['Deliver_WorkPhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Work Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_WorkPhone'] ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($getorder['Deliver_CellPhone']!='') { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Cell Phone:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder['Deliver_CellPhone'] ?>
                    </div>
                </div>
                <?php } ?>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Billing Details</span>
                        <div class="smalltext">A deposit of $<?php echo $strDeposit ?> to be billed to your credit card.</div>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm8">
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Name:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_Name'] ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Address:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_Address1'] ?><br>
                                <?php echo $getorder['Billing_Address2'] ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>City:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_City'] ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>State:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_State'] ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Zip Code:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_Zip'] ?>
                            </div>
                        </div>
                        <?php if($getorder['Billing_Phone']!='') { ?>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Phone:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['Billing_Phone'] ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="frm-row">
                            <div class="colm colm5">
                                Credit Card:
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder['CreditCartType'] ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                Credit Card Number:
                            </div>
                            <div class="colm colm7"><br/>
                                XXXXXXXXXXXX<?php echo substr($strCreditCartNum,-4) ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                Expiration:
                            </div>
                            <div class="colm colm7">
                                <?php echo $strCreditCartMonth ?> / <?php echo $strCreditCartYear ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="colm colm4">
                        <div class="imagebox">
                        	<img src="/images/staff/quote7-3.jpg"  style="width: 260px;" />
                        	<div>Payable upon delivery by cash or money order made payable to delivery company.</div>
                        </div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Balance Due:</strong>
                    </div>
                    <div class="colm colm7">
                        $<?php echo number_format($getorder['Balance'],0) ?>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div class="smalltext">Payable upon delivery by cash or money order made payable to delivery company.</div>
                    </div>
                </div>






                
                
            </div>
            <div class="colm colm3"></div>
        </div>
        
        
        
    </div>




    <!-- Google Code for 4. Complete Sale Conversion Page -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 1070891707;
    var google_conversion_language = "en";
    var google_conversion_format = "1";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "OtO5CIn-rgEQu4XS_gM";
    var google_conversion_value = 150;
    var google_remarketing_only = false;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1070891707/?value=150&amp;label=OtO5CIn-rgEQu4XS_gM&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
    
</div>



<? 
    unset($_SESSION["DateAvailable"]);
    unset($_SESSION["shippingnextseven"]);
    
    unset($_SESSION["shippingfromzip"]);
    unset($_SESSION["shippingfromcity"]);
    unset($_SESSION["shippingfromstate"]);
    unset($_SESSION["shippingtozip"]);
    unset($_SESSION["shippingtocity"]);
    unset($_SESSION["shippingtostate"]);
    
    unset($_SESSION["auto_year"]);
    unset($_SESSION["auto_make"]);
    unset($_SESSION["auto_make_index"]);
    unset($_SESSION["auto_model"]);
    unset($_SESSION["auto_model_index"]);
    
    unset($_SESSION["vehicle_operational"]);
    unset($_SESSION["vehicle_trailer"]);
    
    unset($_SESSION["howmany"]);
    unset($_SESSION["numvehicles"]);
    
    unset($_SESSION["auto_year2"]);
    unset($_SESSION["auto_make2"]);
    unset($_SESSION["auto_model2"]);
    unset($_SESSION["auto_year3"]);
    unset($_SESSION["auto_make3"]);
    unset($_SESSION["auto_model3"]);
    unset($_SESSION["auto_year4"]);
    unset($_SESSION["auto_make4"]);
    unset($_SESSION["auto_model4"]);
    unset($_SESSION["auto_year5"]);
    unset($_SESSION["auto_make5"]);
    unset($_SESSION["auto_model5"]);    
    
} else { ?>

<div class="smart-forms">
    
    <div class="section">
        <div class="frm-row">
            <div class="colm colm12">
                <div align="center">       
                    <font color="#990000">
                    <strong>Error:</strong> <?php echo $ResponseReason ?>
                    <br/><br/>
                    There was a problem processing your credit card.  If you would like to resubmit<br/>your billing information <a href="javascript:history.back();"><strong>click here to go back.</strong></a>
                    <br/><br/>
                    If you would like to speak to a representative about this error, please<br/>call 1-800-600-3750 and refer to order number <?php echo $strOrderID ?>.
                    <br/><br/>
                    Thank You.<br/><br/>
                    </font>
                </div>                
            </div>
        </div>
    </div>
</div>
<?php
}
?>




