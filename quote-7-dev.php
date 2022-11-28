<?php
require "vendor/autoload.php";
require_once "constants/AuthorizeConstants.php";
//require_once 'constants/SandboxConstants.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

$CurrentUsername = $_COOKIE["rep"];
$strOrderID = postdb("orderid");
// $strOrderID = 191205;

$howmany = postdb("howmany");
$pricetier = postdb("pricetier");
$pricetiername = postdb("pricetiername");

$pricetype = postdb("pricetype");

$strBilling_FirstName = postdb("strBilling_FirstName");
$strBilling_LastName = postdb("strBilling_LastName");
$strBilling_Name = $strBilling_FirstName . " " . $strBilling_LastName;
$strBilling_Address1 = postdb("strBilling_Address1");
$strBilling_Address2 = postdb("strBilling_Address2");
$strBilling_City = postdb("strBilling_City");
$strBilling_State = postdb("strBilling_State");
$strBilling_Zip = postdb("strBilling_Zip");
$strBilling_Phone = postdb("strBilling_Phone");
$strCreditCartNum = postdb("strCreditCartNum");
$cc_lastfour = substr($strCreditCartNum, -4);
$strCreditCartMonth = postdb("strCreditCartMonth");
$strCreditCartYear = postdb("strCreditCartYear");
$strCreditCartCVV = postdb("strCreditCartCVV");

$strVehicle_Make = postdb("strVehicle_Make");
$strVehicle_Make1 = postdb("strVehicle_Make1");
$strVehicle_Make2 = postdb("strVehicle_Make2");
$strVehicle_Make3 = postdb("strVehicle_Make3");
$strVehicle_Make4 = postdb("strVehicle_Make4");
$strVehicle_Make5 = postdb("strVehicle_Make5");

$strdeposit1_std = postdb("strdeposit1_std");
$strdeposit1_exp = postdb("strdeposit1_exp");
$strdeposit1_rush = postdb("strdeposit1_rush");

$strdeposit2_std = postdb("strdeposit2_std");
$strdeposit2_exp = postdb("strdeposit2_exp");
$strdeposit2_rush = postdb("strdeposit2_rush");

$strdeposit3_std = postdb("strdeposit3_std");
$strdeposit3_exp = postdb("strdeposit3_exp");
$strdeposit3_rush = postdb("strdeposit3_rush");

$strdeposit4_std = postdb("strdeposit4_std");
$strdeposit4_exp = postdb("strdeposit4_exp");
$strdeposit4_rush = postdb("strdeposit4_rush");

$strdeposit5_std = postdb("strdeposit5_std");
$strdeposit5_exp = postdb("strdeposit5_exp");
$strdeposit5_rush = postdb("strdeposit5_rush");

if ($pricetier == 1) {
  $strDeposit1 = $strdeposit1_std;
  $strDeposit2 = $strdeposit2_std;
  $strDeposit3 = $strdeposit3_std;
  $strDeposit4 = $strdeposit4_std;
  $strDeposit5 = $strdeposit5_std;
} elseif ($pricetier == 2) {
  $strDeposit1 = $strdeposit1_exp;
  $strDeposit2 = $strdeposit2_exp;
  $strDeposit3 = $strdeposit3_exp;
  $strDeposit4 = $strdeposit4_exp;
  $strDeposit5 = $strdeposit5_exp;
} else {
  $strDeposit1 = $strdeposit1_rush;
  $strDeposit2 = $strdeposit2_rush;
  $strDeposit3 = $strdeposit3_rush;
  $strDeposit4 = $strdeposit4_rush;
  $strDeposit5 = $strdeposit5_rush;
}

if (
  $strBilling_State == "BC" ||
  $strBilling_State == "NT" ||
  $strBilling_State == "NS" ||
  $strBilling_State == "NU" ||
  $strBilling_State == "PE" ||
  $strBilling_State == "QC" ||
  $strBilling_State == "SK" ||
  $strBilling_State == "YT" ||
  $strBilling_State == "MB" ||
  $strBilling_State == "NB" ||
  $strBilling_State == "ON"
) {
  $strBilling_Country = "CA";
} else {
  $strBilling_Country = "US";
}
$strSalesRep = postdb("strSalesRep");

$sql = "select * from orders where orderid = $strOrderID";
$getorder = $wpdb->get_row($sql, ARRAY_A);

$strDeposit = $getorder["Deposit"];
$numofvehicles = $getorder["Num_Of_Vehicles"];
$strCustEmail = $getorder["CustEmail"];

$balance = $getorder["Balance"];
$CarrierTip = postdb("CarrierTip");

include "termshtmlemail.php";

if (
  $getorder["Status"] != "NEW" &&
  $getorder["Status"] != "ASSIGNED" &&
  $getorder["Status"] != "CANCELLED"
) {
  $timecode = date("-His");

  $x_card_num = $strCreditCartNum;
  $x_exp_date = $strCreditCartYear . "-" . $strCreditCartMonth;
  $x_card_code = $strCreditCartCVV;

  $x_amount = $strDeposit;
  $x_invoice_num = $strOrderID . $timecode;
  $x_description = "";

  $x_first_name = $strBilling_FirstName;
  $x_last_name = $strBilling_LastName;
  $x_address = $strBilling_Address1;
  $x_city = $strBilling_City;
  $x_state = $strBilling_State;
  $x_zip = $strBilling_Zip;
  $x_phone = $strBilling_Phone;
  $x_email = $strCustEmail;
  $x_customer_ip = GetIP();

  $cys_success = 0;
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
  $merchantAuthentication->setTransactionKey(
    \AuthorizeConstants::MERCHANT_TRANSACTION_KEY
  );

  // Set credit card information for payment profile
  $creditCard = new AnetAPI\CreditCardType();
  $creditCard->setCardNumber($x_card_num);
  $creditCard->setExpirationDate($x_exp_date);
  $creditCard->setCardCode($x_card_code);
  $paymentCreditCard = new AnetAPI\PaymentType();
  $paymentCreditCard->setCreditCard($creditCard);

  // Create the Bill To info for new payment type
  $billTo = new AnetAPI\CustomerAddressType();
  $billTo->setFirstName($x_first_name);
  $billTo->setLastName($x_last_name);
  $billTo->setAddress($x_address);
  $billTo->setCity($x_city);
  $billTo->setState($x_state);
  $billTo->setZip($x_zip);
  $billTo->setCountry("USA");
  $billTo->setPhoneNumber($x_phone);

  // Create a new CustomerPaymentProfile object
  $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
  $paymentProfile->setCustomerType("individual");
  $paymentProfile->setBillTo($billTo);
  $paymentProfile->setPayment($paymentCreditCard);
  $paymentProfiles[] = $paymentProfile;

  // Create a new CustomerProfileType and add the payment profile object
  $customerProfile = new AnetAPI\CustomerProfileType();
  $customerProfile->setMerchantCustomerId($x_invoice_num);
  $customerProfile->setEmail($x_email);
  $customerProfile->setpaymentProfiles($paymentProfiles);

  // Assemble the complete transaction request
  $request = new AnetAPI\CreateCustomerProfileRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setProfile($customerProfile);

  // Create the controller and get the response
  $controller = new AnetController\CreateCustomerProfileController($request);
  $response = $controller->executeWithApiResponse(
    \net\authorize\api\constants\ANetEnvironment::PRODUCTION
  );
  //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

  $customerProfileId = $response->getCustomerProfileId();
  $paymentProfiles = $response->getCustomerPaymentProfileIdList();
  $customerPaymentProfileId = $paymentProfiles[0];

  //successfully added customer profile
  if ($response != null && $response->getMessages()->getResultCode() == "Ok") {
    //echo "Succesfully created customer profile : " . $customerProfileId . "<br>";
    //echo "SUCCESS: PAYMENT PROFILE ID : " . $customerPaymentProfileId . "<hr>";

    $request2 = new AnetAPI\ValidateCustomerPaymentProfileRequest();
    $request2->setMerchantAuthentication($merchantAuthentication);
    $request2->setCustomerProfileId($customerProfileId);
    $request2->setCustomerPaymentProfileId($customerPaymentProfileId);
    $request2->setValidationMode("liveMode");
    $controller2 = new AnetController\ValidateCustomerPaymentProfileController(
      $request2
    );
    $response2 = $controller2->executeWithApiResponse(
      \net\authorize\api\constants\ANetEnvironment::PRODUCTION
    );
    //$response2 = $controller2->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
    //successfully validated card for $0.00
    if (
      $response2 != null &&
      $response2->getMessages()->getResultCode() == "Ok"
    ) {
      $cys_success = 1;
    }

    //failed adding customer profile
  } else {
    $errorMessages = $response->getMessages()->getMessage();
    echo "Response : " .
      $errorMessages[0]->getCode() .
      "  " .
      $errorMessages[0]->getText() .
      "<br>";
  }
}

//testing
/*
$cys_success=1;
$Cys_AuthCode="test";
$Cys_TransId="test";
*/

if ($cys_success == 1) {
    

  if ($howmany == "onevehicle") {
    $wpdb->insert("payments", [
      "OrderID" => $strOrderID,
      "Description" => "Initial Deposit",
      "Amount" => "-" . $strDeposit,
      "username" => $CurrentUsername,
      "paymentcat" => "deposit",
    ]);
  } else {
    $wpdb->insert("payments", [
      "OrderID" => $strOrderID,
      "Description" => "Initial Deposit Vehicle #1 " . $pricetiername,
      "Amount" => "-" . $strDeposit1,
      "username" => $CurrentUsername,
      "paymentcat" => "deposit",
    ]);

    if ($strVehicle_Make2 != "") {
      $wpdb->insert("payments", [
        "OrderID" => $strOrderID,
        "Description" => "Initial Deposit Vehicle #2 " . $pricetiername,
        "Amount" => "-" . $strDeposit2,
        "username" => $CurrentUsername,
        "paymentcat" => "deposit",
      ]);
    }

    if ($strVehicle_Make3 != "") {
      $wpdb->insert("payments", [
        "OrderID" => $strOrderID,
        "Description" => "Initial Deposit Vehicle #3 " . $pricetiername,
        "Amount" => "-" . $strDeposit3,
        "username" => $CurrentUsername,
        "paymentcat" => "deposit",
      ]);
    }

    if ($strVehicle_Make4 != "") {
      $wpdb->insert("payments", [
        "OrderID" => $strOrderID,
        "Description" => "Initial Deposit Vehicle #4 " . $pricetiername,
        "Amount" => "-" . $strDeposit4,
        "username" => $CurrentUsername,
        "paymentcat" => "deposit",
      ]);
    }

    if ($strVehicle_Make5 != "") {
      $wpdb->insert("payments", [
        "OrderID" => $strOrderID,
        "Description" => "Initial Deposit Vehicle #5 " . $pricetiername,
        "Amount" => "-" . $strDeposit5,
        "username" => $CurrentUsername,
        "paymentcat" => "deposit",
      ]);
    }
  }
  
    
  //atdmail("text","DEAT", "orders@autotransportdirect.com", "clay@madebysprung.com", "DEAT Order - " . $strOrderID, $sql);

  if ($wpdb->last_error) {
    $currerror = $wpdb->last_error;
    atdmail(
      "text",
      "Direct Express Auto Transport Order System",
      "orders@autotransportdirect.com",
      "clay@madebysprung.com",
      "DEAT SQL Error - " . $strOrderID,
      $currerror
    );
  }

  //$wpdb->query($sql);

  //clay!
  // 	$sql = "update orders set status = 'NEW', SalesRep_Complete = '$strSalesRep', order_date = NOW(),Billing_Name = '$strBilling_Name', Billing_Address1 = '$strBilling_Address1', Billing_Address2 = '$strBilling_Address2', Billing_City = '$strBilling_City', Billing_State = '$strBilling_State', Billing_Zip = '$strBilling_Zip', Billing_Phone = '$strBilling_Phone', lp_ApprovalCode = '$Cys_AuthCode', lp_OrderNumber = '$Cys_TransId', cc_lastfour = '$cc_lastfour', cc_capturestatus = 'captured' where orderid = $strOrderID";

  $sql = "update orders set status = 'NEW', pricetype='$pricetype', amount_due_driver='$balance', SalesRep_Complete = '$strSalesRep', order_date = NOW(),Billing_Name = '$strBilling_Name', Billing_Address1 = '$strBilling_Address1', Billing_Address2 = '$strBilling_Address2', Billing_City = '$strBilling_City', Billing_State = '$strBilling_State', Billing_Zip = '$strBilling_Zip', Billing_Phone = '$strBilling_Phone', cc_profileid='$customerProfileId', cc_paymentprofileid='$customerPaymentProfileId', cc_lastfour = '$cc_lastfour', cc_capturestatus = 'authorized' where orderid = $strOrderID";

  $wpdb->query($sql);

  $sql = "select * from orders where orderid = $strOrderID";
  $getorder = $wpdb->get_row($sql, ARRAY_A);

  $sql = "select * from orders_vehicles where orderid = $strOrderID";
  $getvehicles = $wpdb->get_results($sql, ARRAY_A);

  $body = "You have a new order at Direct Express Auto Transport.  Please login to the administrator and refer to order number $strOrderID\n\n";
  $body .= "Admin Link: https://admin.autotransportdirect.com/admin2k7/\n";
  $body .= "Order Detail Link: https://admin.autotransportdirect.com/admin2k7/detail.asp?orderid=$strOrderID\n";

  if (empty($CurrentUsername)) {
    $reporteduser = "ATD";
  } else {
    $reporteduser = $CurrentUsername;
  }
  $reporteddate = date("Y-m-d");

  //atdmail("text","Direct Express Auto Transport Order System","info@autotransportdirect.com","info@autotransportdirect.com","New Order - " . $reporteduser . " - " . $strOrderID . " - " . $reporteddate,$body);

  atdmail(
    "text",
    "Direct Express Auto Transport Order System",
    "orders@autotransportdirect.com",
    "mrupers@mac.com",
    "New Order - " .
      $reporteduser .
      " - " .
      $strOrderID .
      " - " .
      $reporteddate,
    $body
  );

  //    atdmail("text","Direct Express Auto Transport Order System", "orders@autotransportdirect.com", "clay@madebysprung.com", "New Order - " . $reporteduser . " - " . $strOrderID . " - " . $reporteddate, $body);

  if ($CarrierTip != "0") {
    $newbalance = $balance + $CarrierTip;
    $ordertotal = $newbalance + $strDeposit;
    $sql = "update orders set Total='$ordertotal', balance='$newbalance', amount_due_driver='$newbalance', CarrierTip = '$CarrierTip' where orderid = $strOrderID";
    $wpdb->query($sql);

    $sql = "insert into payments (OrderID,Description,Amount) values ($strOrderID,'Extra To Carrier','$CarrierTip')";
    $wpdb->query($sql);
  }

  $startzip = $getorder["Pickup_Zip"];
  $endzip = $getorder["Deliver_Zip"];
  $Message_From = "";
  $Message_To = "";
  $Message_Whole = "";

  //Check for Zip Message Start
  $sql =
    "select NearCity, Status from ziprateadjust where partialzip='" .
    substr($startzip, 0, 3) .
    "'";
  $alertzip = $wpdb->get_results($sql, ARRAY_A);
  if ($wpdb->num_rows > 1) {
    $NearCity_from = $alertzip["NearCity"];
    $MessageStatus_from = $alertzip["Status"];
  }

  if ($NearCity_from != "" && $MessageStatus_from != "") {
    if ($MessageStatus_from == "2") {
      $recommendstatus_from = "seriously";
    }
    $Message_From = "If you are in a hurry, then you should $recommendstatus_from consider meeting a driver in $NearCity_from.";
  }

  //Check for Zip Message End
  $sql =
    "select NearCity, Status from ziprateadjust where partialzip='" .
    substr($endzip, 0, 3) .
    "'";
  $alertzip = $wpdb->get_results($sql, ARRAY_A);
  if ($wpdb->num_rows > 1) {
    $NearCity_to = $alertzip["NearCity"];
    $MessageStatus_to = $alertzip["Status"];
  }
  if ($NearCity_to != "" && $MessageStatus_to != "") {
    if ($MessageStatus_to == "2") {
      $recommendstatus_to = "seriously";
    }
    $Message_to = "If you are in a hurry, then you should $recommendstatus_to consider meeting a driver in $NearCity_to.";
  }

  if ($Message_From != "" && $Message_To != "") {
    $Message_Whole =
      $Message_From .
      "And as well, you should $recommendstatus_to consider meeting a driver in $NearCity_to.";
  } else {
    $Message_Whole = $Message_From . $Message_To;
  }

  $body =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>AutoTransportDirect.com</title></head><body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><table width="700" cellspacing="0" cellpadding="0" border="0" align="center"><tr><td class="bodytext"><a href="https://www.autotransportdirect.com/?src=SRC-ReviewEmail"><img src="https://www.autotransportdirect.com/images/header-email.jpg" width="700" height="99" alt="" border="0"></a><table width="100%" cellspacing="0" cellpadding="10" border="0"><tr><td><font face="Arial,Helvetica,sans-serif" size="2">';

  $body .= "Thank You!<br/><br/>";
  $body .= "<b>Order Confirmation $strOrderID</b><br/><br/>";
  $body .=
    "If you need to contact us regarding your order, we are available during normal business hours Monday thru Friday by calling <font color='red'><strong>800-600-3750</strong></font> or go to https://www.autotransportdirect.com/contact-us/ or email us at info@autotransportdirect.com. We monitor emails on the weekends.<br/><br/>";

  if ($Message_Whole != "") {
    $body .= "<strong>Helpful Hint:</strong><br/><br/>";
    $body .=
      "Over 90% of our orders ship within seven days of the date it was made available. Some locations can throw that off, making it more difficult and causing delay. Your location(s) might be in that group. ";
    $body .= "<strong>$Message_Whole</strong>";
    $body .=
      "Many customers appreciate that tip upfront, and hopefully our customer service representative mentioned the suggestion to you. Our experience tells us that there is more truck traffic there, making it easier and faster to ship your vehicle. You don't have to do that if you are more flexible with your time and can be patient. That said, we are often surprised at how fast a vehicle ships when we thought it might be more difficult. If you choose to meet a driver elsewhere, you will be emailed by us and phoned by the driver well in advance, giving you time to coordinate. Call us at 800-600-3750 if you prefer meeting elsewhere.<br/><br/>";
    $body .=
      "Ours is the most efficient way to ship a vehicle because we have several thousand carriers in our database. No one of them could possibly compete with that as there are thousands of cities and towns shipping to thousands of others. The number of possibilities are staggering. Our goal is to match your vehicle with the carrier actually running your route, and we have the best chance of doing that.<br/><br/>";
    $body .= "Thank you for your order!<br/><br/>";
  }

  $body .= "<strong>Next 5 Steps</strong><br/><br/>";
  $body .=
    "1. <strong>You have selected the first date your vehicle is available for pickup</strong>, which of course is the starting date and not necessarily an exact date. We estimate how long it typically takes to Assign your vehicle to a carrier. We most often beat the estimate, but it also can take longer than expected on less travelled routes, especially rural, or during seasonal fluctuations. The more money that is added to the carrier fee really helps get your vehicle assigned faster. You can call or email us anytime to add more to hasten the process. That is also why we have three tiers of pricing. <br/><br/>";
  $body .=
    "2. <strong>Another email will be sent to you when your vehicle has been Assigned a carrier for pickup.</strong> That email is simply a courtesy letting you know that your shipment is in the process of getting picked up. <strong>At that time, your credit card deposit will be processed.</strong> Please don't confuse a \"pending transaction\" on your credit card activity with an actual transaction. Your card will not be processed until the moment your vehicle is actually assigned a carrier.<br/><br/>";
  $body .=
    "3. <strong>A dispatcher or driver will call your pickup contact person at the number(s) you provided to arrange pickup.</strong> Usually, but not always, the carrier coordination is the day before pickup. You don't have to wait around for that call - but you do need to respond to it in a timely fashion. Sometimes a driver is ready on short notice (a few hours) and if that happens and you can't meet him, just call us to reschedule another driver. But if you can meet him, we highly recommend that you do so if at all possible.<br/><br/>";
  $body .=
    "4. <strong>Usually, but not always, the day before delivery the driver will call your delivery contact person at the number(s) you provided to arrange delivery.</strong> <br/><br/>";
  $body .=
    "5. <strong>The Balance Owed is always paid to the driver upon delivery (<span style='color:red'>not pickup</span>) with CASH or MONEY ORDER made payable to the delivery company <span style='color:red'>(not us)</span>.</strong><br/><br/>";

  $body .=
    "<br/><table cellspacing='2' cellpadding='2' border='0' width='50%'><tr>";
  $body .= "<td class='bodytext2'><strong>Customer Name:</strong></td>";
  $body .=
    "<td class='bodytext2'>" .
    $getorder["CustFirstName"] .
    " " .
    $getorder["CustLastName"] .
    "</td>";
  $body .= "</tr><tr>";
  $body .= "<td class='bodytext2'><strong>Shipping From:</strong></td>";
  $body .=
    "<td class='bodytext2'>" .
    $getorder["Pickup_City"] .
    ", " .
    $getorder["Pickup_State"] .
    " " .
    $getorder["Pickup_Zip"] .
    "</td>";
  $body .= "</tr><tr>";
  $body .= "<td class='bodytext2'><strong>Shipping To:</strong></td>";
  $body .=
    "<td class='bodytext2'>" .
    $getorder["Deliver_City"] .
    ", " .
    $getorder["Deliver_State"] .
    " " .
    $getorder["Deliver_Zip"] .
    "</td>";
  $body .= "</tr><tr>";

  if ($getorder["Num_Of_Vehicles"] == 1) {
    $body .= "<td class='bodytext2'><strong>Type of Vehicle:</strong></td>";
    $body .=
      "<td class='bodytext2' nowrap>" .
      $getorder["Vehicle_Make"] .
      " - " .
      $getorder["Vehicle_Model"] .
      "</td>";
    $body .= "</tr><tr>";
  } else {
    $body .=
      "<td class='bodytext2' valign='top'><strong>Type of Vehicle:</strong></td>";
    $body .= "<td class='bodytext2' nowrap valign='top'>";
    $counter = 1;
    foreach ($getvehicles as $vehicle) {
      $body .=
        $counter .
        ". " .
        $vehicle["Vehicle_Make"] .
        " - " .
        $vehicle["Vehicle_Model"] .
        "<br />";
      $counter++;
    }
    $body .= "</td>";
    $body .= "</tr><tr>";
  }

  $now = date("n/d/Y g:i a");
  $DateAvailable_Initial = strtotime($getorder["DateAvailable_Initial"]);
  $DateAvailable_Initial = date("n/d/Y", $DateAvailable_Initial);

  $body .=
    "<td class='bodytext2' nowrap='nowrap'><strong>Operating Condition:</strong></td>";
  $body .=
    "<td class='bodytext2' nowrap='nowrap'>" .
    $getorder["Quote_vehicle_operational"] .
    " and Rolls, Brakes, Steers</td>";
  $body .= "</tr><tr>";
  $body .= "<td class='bodytext2'><strong>Type of Trailer:</strong></td>";
  $body .=
    "<td class='bodytext2'>" . $getorder["Quote_vehicle_trailer"] . "</td>";
  $body .= "</tr><tr>";
  $body .=
    "<td class='bodytext2' nowrap='nowrap'><strong>First Date Vehicle is Available:</strong></td>";
  $body .=
    "<td class='bodytext2' nowrap='nowrap'>" .
    $DateAvailable_Initial .
    " - <strong><a href='https://www.autotransportdirect.com/information-shipping-dates/'>Please see typical shipping time frames</a></strong></td>";

  $body .= "</tr></table><br/><br/>";

  $body .= "As of " . $now . "<br/>";
  $body .= "			<table width='75%' cellspacing='1' cellpadding='4' border='1'>";
  $body .= "			<tr>";
  $body .=
    "			    <td bgcolor='#ffffff' class='formtext2' width='10%'><strong>Date/Time</strong></td>";
  $body .=
    "				<td bgcolor='#ffffff' class='formtext2' width='70%'><strong>Description</strong></td>";
  $body .=
    "				<td bgcolor='#ffffff' class='formtext2' width='10%' align='center'><strong>Amount</strong></td>";
  $body .=
    "				<td bgcolor='#ffffff' class='formtext2' width='10%' align='center'><strong>Balance</strong></td>";
  $body .= "			</tr>";

  $sql = "select * from payments where orderid = $strOrderID and (paymentcat <> 'deposit' or isnull(paymentcat)) order by paymentid";
  $getpayments = $wpdb->get_results($sql, ARRAY_A);

  $RunningTotal = 0;
  foreach ($getpayments as $payment) {
    $RunningTotal = $RunningTotal + $payment["Amount"];
    $paymentdescription = $payment["Description"];

    if (
      strpos($paymentdescription, "Agreed to Submit Online") !== false &&
      strpos($paymentdescription, "Multiple Vehicle Carrier") !== false &&
      strpos($paymentdescription, "Customer Deposit") !== false &&
      strpos($paymentdescription, "Customer Agreed") !== false &&
      strpos($paymentdescription, "Initial Shipment") !== false &&
      strpos($paymentdescription, "Vehicle #") !== false &&
      strpos($paymentdescription, "Down Payment") !== false &&
      strpos($paymentdescription, "Authorized") !== false &&
      strpos($paymentdescription, "Turbo Charge") !== false
    ) {
      $paymentdescription = "";
    }

    $body .= "<tr>";
    $body .=
      "		<td bgcolor='#ffffff' class='bodytext3' nowrap>" .
      $payment["Date"] .
      "</td>";
    $body .=
      "		<td bgcolor='#ffffff' class='bodytext3'>" .
      $paymentdescription .
      "</td>";
    $body .=
      "		<td bgcolor='#ffffff' class='bodytext3' nowrap align='right'>$" .
      number_format($payment["Amount"], 0) .
      "</td>";
    $body .=
      "		<td bgcolor='#ffffff' class='bodytext3' nowrap align='right'>$" .
      number_format($RunningTotal, 0) .
      "</td>";
    $body .= "</tr>";
  }

  $body .= "	</table>";
  //$body .= "Deposit Billed To: Credit Card, Money Order or Check<br/><br/>";

  $body .= $terms;

  $body .=
    "</font></td></tr></table><img src='https://www.autotransportdirect.com/images/mainbox_bottom.gif' width='700' height='3' alt='' border='0'></td></tr></table><center><br/><font face='Verdana,Geneva,Arial,Helvetica,sans-serif' size='1'>Copyright &copy; " .
    date("Y") .
    ", <a href='https://www.autotransportdirect.com/' class='footer'>AutoTransportDirect.com</a><br/>License # MC 479342</p><br><br>All the best!<br><br>Direct Express Auto Transport<br><br><img src='https://www.autotransportdirect.com/images/email-girl.jpg' /><br><br>Direct Express Auto Transport<br>321 San Anselmo Avenue<br>San Anselmo, CA 94960<br>Toll-Free Phone: 800-600-3750<br><br><br>Our Website Domain: <a href='http://www.AutoTransportDirect.com'>http://www.AutoTransportDirect.com</a></center></font></body></html>";

  atdmail(
    "html",
    "Direct Express Auto Transport Order System",
    "info@autotransportdirect.com",
    $getorder["CustEmail"],
    "Your Direct Express Auto Transport Order - " . $strOrderID,
    $body
  );

  CommAudit(
    $strOrderID,
    "order_confirmation",
    "info@autotransportdirect.com",
    $getorder["CustEmail"],
    "Your Direct Express Auto Transport Order - " . $strOrderID,
    $body
  );
}

$cys_success = 0;

if ($cys_success == 1 || $getorder["Status"] == "NEW") {

  $sql = "select * from orders where orderid = $strOrderID";
  $getorder = $wpdb->get_row($sql, ARRAY_A);

  $sql = "select * from orders_vehicles where orderid = $strOrderID";
  $getvehicles = $wpdb->get_results($sql, ARRAY_A);

  $audit_notes = "Order Received through front-end.";
  AuditTrail($strOrderID, $CurrentUsername, $audit_notes);

  $trackid = $_COOKIE["trackid"];
  if ($trackid != "") {
    $sql = "update sale_conversion set dateupdated=NOW(),sale_status = '7. Order Complete' where trackid = '$trackid'";
    $wpdb->query($sql);
  }

  //If order came from a quote, update the quote record
  if (!empty($_COOKIE["qid"])) {
    $sql =
      "update quote_email set orderid = $strmaxorderid where quoteid = " .
      $_COOKIE["qid"];
    $wpdb->query($sql);
  }
  ?>



<div class="smart-forms orderreceipt">
    
    <div class="section">
        <div class="frm-row">
            <div class="colm colm12 ordersteps" style="text-align: center;margin:20px 0 40px;">
                <img src="/wp-content/themes/atdv2/images/checkout-prog-4.png" alt="Step 4 - Complete" />
            </div>
        </div>
        
        <div class="frm-row" style="margin: 0 !important;">
            <div class="colm colm5">
                <strong>Your Order is Booked!</strong><br/>
            </div>
            <div class="colm colm7" style="text-align: right;">
                <strong>Your Order ID: <font color="#308dff"><?php echo $strOrderID; ?></font></strong>
            </div>
        </div>
        <div class="frm-row">
            <div class="colm colm12">
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm6">
                <div class="frm-row">
                    <div class="colm colm12"><br></div>
                </div>
                <div class="frm-row">
                    <div class="colm colm1"></div>
                    <div class="colm colm4">
                        <strong>Shipping From:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder[
                          "Pickup_City"
                        ]; ?>, <?php echo $getorder[
  "Pickup_State"
]; ?>  <?php echo $getorder["Pickup_Zip"]; ?>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm1"></div>
                    <div class="colm colm4">
                        <strong>Shipping To:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder[
                          "Deliver_City"
                        ]; ?>, <?php echo $getorder["Deliver_State"]; ?>  <?php echo $getorder["Deliver_Zip"]; ?>
                    </div>
                </div>


                <?php if ($getorder["Num_Of_Vehicles"] == 1) { ?>
                    <div class="frm-row">
                        <div class="colm colm1"></div>
                        <div class="colm colm4">
                            <strong>Type of Vehicle:</strong>
                        </div>
                        <div class="colm colm6">
                            <?php echo $getorder[
                              "Vehicle_Make"
                            ]; ?> - <?php echo $getorder["Vehicle_Model"]; ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="frm-row">
                        <div class="colm colm1"></div>
                        <div class="colm colm4">
                            <strong>Types of Vehicles:</strong>
                        </div>
                        <div class="colm colm6">
                            <?php
                            $counter = 1;
                            foreach ($getvehicles as $vehicle) { ?>
                                <?php echo $vehicle[
                         "Vehicle_Make"
                       ]; ?> - <?php echo $vehicle["Vehicle_Model"]; ?><br/>
                                <?php $counter++;}
                            ?>
                        </div>
                    </div>
                    
                <?php } ?>
                
                <div class="frm-row">
                    <div class="colm colm1"></div>
                    <div class="colm colm4">
                        <strong>Operating Condition:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder[
                          "Quote_vehicle_operational"
                        ]; ?> and Rolls, Brakes, Steers
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm1"></div>
                    <div class="colm colm4">
                        <strong>Type of Trailer:</strong>
                    </div>
                    <div class="colm colm6">
                        <?php echo $getorder["Quote_vehicle_trailer"]; ?>
                    </div>
                </div>
            </div>
            <div class="colm colm1"></div>
            <div class="colm colm4">
                <div style="margin-bottom: 15px;"></div>
                <style>.embed-container { border:1px solid #ccc; position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/460362012' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
            </div>
            

        </div>
        

    </div>
    
    
    <div class="section" style="margin-bottom: 40px;">
        <div class="frm-row">
            <div class="colm colm12" style="text-align: center;">
                <div style="margin:25px 0 20px 0;width:100%;border-top:#999999 solid thin;"></div>
                
                
                <span style="font-size: 25px; font-weight: 600;">Total Price: $<?php echo number_format(
                  $getorder["Total"],
                  0
                ); ?></span>
                <br/>
<!--
                <div style="float:right; width:170px;margin-left:20px;">
                    <div class="imagebox">
                        <img src="//d36b03yirdy1u9.cloudfront.net/images/staff/staff-faq-YM.jpg" style="width:260px" />
                        <div>A deposit of $<?php echo $strDeposit; ?> to be billed to your credit card.</div>
                    </div>
                </div>
                <br/>
-->

                <div style="color:#0081CC; font-weight: 600; font-size: 1.2em;">
                Your Order Is Booked! Upon carrier assignment, you will receive an email notification.  Please print out this page as your order receipt. Call 1-800-600-3750 with any questions.
                <br/><br/>
                Thank you for your business!<br/><br/>
                </font>
                <div style="margin:5px 0 25px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
           
        </div>

    </div>

    <div class="section">
        <div class="frm-row">
<!-- 		            <div class="colm colm3"></div> -->
            <div class="colm colm6">
                
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Order ID:</strong>
                    </div>
                    <div class="colm colm7">
                        <font color="#0081CC"><strong><?php echo $strOrderID; ?></strong></font>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder[
                          "CustFirstName"
                        ]; ?>&nbsp;<?php echo $getorder["CustLastName"]; ?>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>E-Mail Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["CustEmail"]; ?>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Vehicle Details</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>	
                    </div>
                </div>
                
                <?php if ($getorder["Num_Of_Vehicles"] == 1) { ?>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Year:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder["Vehicle_Year"]; ?>
                        </div>
                    </div>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Make:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder["Vehicle_Make"]; ?>
                        </div>
                    </div>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Model:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php echo $getorder["Vehicle_Model"]; ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="frm-row">
                        <div class="colm colm5">
                            <strong>Vehicles:</strong>
                        </div>
                        <div class="colm colm7">
                            <?php
                            $counter = 1;
                            foreach ($getvehicles as $vehicle) { ?>
                                <?php echo $vehicle[
                         "Vehicle_Year"
                       ]; ?> - <?php echo $vehicle[
   "Vehicle_Make"
 ]; ?> - <?php echo $vehicle["Vehicle_Model"]; ?><br/>
                                <?php $counter++;}
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
                        $DateAvailable_Initial = strtotime(
                          $getorder["DateAvailable_Initial"]
                        );
                        $DateAvailable_Initial = date(
                          "n/d/Y",
                          $DateAvailable_Initial
                        );
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
                        <?php echo $getorder["Pickup_Contact"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_Address1"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>City:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_City"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>State:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_State"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Zip Code:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_Zip"]; ?>
                    </div>
                </div>
                <?php if ($getorder["Pickup_Phone1"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 1 (<?php echo $getorder[
                          "Pickup_Phone1Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_Phone1"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Pickup_Phone2"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 2 (<?php echo $getorder[
                          "Pickup_Phone2Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_Phone2"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Pickup_Phone3"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 3 (<?php echo $getorder[
                          "Pickup_Phone3Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_Phone3"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Pickup_BackupName"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Backup Contact Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_BackupName"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Pickup_BackupPhone"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Backup Contact Phone (<?php echo $getorder[
                          "Pickup_BackupPhoneType"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Pickup_BackupPhone"]; ?>
                    </div>
                </div>
                <?php } ?>
          
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Deliver To</span><br/>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Contact Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Contact"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Address:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Address1"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>City:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_City"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>State:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_State"]; ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Zip Code:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Zip"]; ?>
                    </div>
                </div>
                 <?php if ($getorder["Deliver_Phone1"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 1 (<?php echo $getorder[
                          "Deliver_Phone1Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Phone1"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Deliver_Phone2"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 2 (<?php echo $getorder[
                          "Deliver_Phone2Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Phone2"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Deliver_Phone3"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Phone 3 (<?php echo $getorder[
                          "Deliver_Phone3Type"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_Phone3"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Deliver_BackupName"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Backup Contact Name:</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_BackupName"]; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($getorder["Deliver_BackupPhone"] != "") { ?>
                <div class="frm-row">
                    <div class="colm colm5">
                        <strong>Backup Contact Phone (<?php echo $getorder[
                          "Deliver_BackupPhoneType"
                        ]; ?>):</strong>
                    </div>
                    <div class="colm colm7">
                        <?php echo $getorder["Deliver_BackupPhone"]; ?>
                    </div>
                </div>
                <?php } ?>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin-bottom: 15px;"></div>
                        <span style="font-weight: 700;font-size: 1.2em;">Billing Details</span>
                        <div class="smalltext">Upon carrier assignment, a partial payment will be processed to your card.</div>
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Name:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_Name"]; ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Address:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_Address1"]; ?><br>
                                <?php echo $getorder["Billing_Address2"]; ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>City:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_City"]; ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>State:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_State"]; ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Zip Code:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_Zip"]; ?>
                            </div>
                        </div>
                        <?php if ($getorder["Billing_Phone"] != "") { ?>
                        <div class="frm-row">
                            <div class="colm colm5">
                                <strong>Phone:</strong>
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["Billing_Phone"]; ?>
                            </div>
                        </div>
                        <?php } ?>
<!--
                        <div class="frm-row">
                            <div class="colm colm5">
                                Credit Card:
                            </div>
                            <div class="colm colm7">
                                <?php echo $getorder["CreditCartType"]; ?>
                            </div>
                        </div>
-->
                        <div class="frm-row">
                            <div class="colm colm5">
                                Credit Card Number:
                            </div>
                            <div class="colm colm7"><br/>
                                XXXXXXXXXXXX<?php echo substr(
                                  $strCreditCartNum,
                                  -4
                                ); ?>
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="colm colm5">
                                Expiration:
                            </div>
                            <div class="colm colm7">
                                <?php echo $strCreditCartMonth; ?> / <?php echo $strCreditCartYear; ?>
                            </div>
                        </div>
                        
                    </div>
<!--
                    <div class="colm colm4">
                        <div class="imagebox">
                            <img src="/images/staff/quote7-3.jpg"  style="width: 260px;" />
                            <div>Payable upon delivery by cash or money order made payable to delivery company.</div>
                        </div>
                    </div>
-->
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
                    </div>
                </div>
               
                <div class="frm-row">
                    <div class="colm colm12" style="text-align: center;">
                        <img src="/images/staff/order-checkout.jpg" style="border-radius: 5px; margin-top: 24px;"/>
                        <br><br>
                        Thank you for honoring us with your business!
                        <br><br>
                        Please look in your inbox for an order confirmation email.
                    </div>
                </div>
                

        
        


        
        
    </div>
                        
            <div class="colm colm6">
            <div style="color:#0081CC; font-weight: 600; font-size: 1.2em;">
            What Happens Next & When?
            </div>
            <style>
            ol.orderconf {
                margin: 20px 0 20px 20px;
            }
            ol.orderconf li {
                margin-bottom: 20px;	
            }
            </style>
            <ol class="orderconf">
                <li><strong>Within seconds you should receive an emailed Order Confirmation with your order number and other pertinent information.</strong> Please read and save for future reference. If you need to contact us by phone at 800-600-3750 or email <a href="mailto:info@autotransportdirect.com">info@autotransportdirect.com</a>, you may reference that order number. Anyone on our staff may assist you, not just the representative who helped set up your order.</li>
                
                <li><strong>You will hear again from Direct Express Auto Transport via email when we have selected a carrier to transport your vehicle(s).</strong> The subject title of that email will read, "Your Vehicle Has Been Assigned A Carrier". We will alert you via email the very second we assign your order. So that's how you'll know we have a driver arranged. In the body of that email, we will reconfirm the amount due the carrier in money order or cash, the name of the carrier, their phone number, the date the carrier told us they expected to pick up your vehicle and the estimated delivery date. All good information to know. Note: If you opted to pay in Full on your credit card, there will be nothing due the carrier at time of delivery because you already paid. </li>
                
                <li><strong>At the same time your vehicle is assigned a carrier, your credit card will be processed.</strong> We wait until we are successful to charge your card. In the assignment email, we remind you once again the partial payment charged to your card, and the balance due the carrier (unless you paid in Full) upon delivery in Cash or Money Order. </li>
                
                <li><strong>The carrier should call you in advance of your pick up date and time.</strong> They should not just show up unannounced. It is also in their best interest to call ahead of time, usually the day before, and as well the day of pick up. Just so you know, the carriers sometimes miss the appointed hour to meet. It is hard to schedule exactly because yours is probably one of several appointments that day. If even one person causes a delay, then everybody else gets backed up. In advance we apologize for that and ask for your patience and understanding. If you haven't heard from the carrier in advance of your pick up, we at Direct Express want to know about it. We don't like dropped balls ... at all.</li>
                
                <li><strong>From the road, the carrier should call you in advance of your delivery date and time.</strong> Here again they should not just show up unannounced. It's also in their best interest to call ahead of time from the road, usually the day before, and as well the day of delivery. Once again, the carriers may miss the appointed hour to meet for the same reasons as stated above. They want to be punctual, but circumstances beyond their control often derail them. It's hard work, folks, and we appreciate their effort. Any tip you may give your driver is very cool.</li>
                
                <li><strong>Don't forget to inspect your vehicle upon pickup and especially upon delivery.</strong> Note any damages while in the presence of the carrier. That's your opportunity to raise any issue. Complaints are very rare. It's why you see new cars being delivered to dealerships this way. There is a complaint in only 1 out of every 200 shipments. And that's usually innocuous or minor. Rarely is there anything significant. Your vehicle is insured up to $100,000 by the way. It is a good idea to maintain your own insurance too.</li>
                
                <li><strong>All shipping and assignment dates are estimated.</strong> We are very good at predicting, but never-the-less cannot state with absolute certainty.</li>
            </ol>
            
            Once again ... Thank You for honoring us with your business!
            <br><br>
            <strong>Direct Express Auto Transport</strong>

            </div>
            <!-- <div class="colm colm3"></div> -->
        </div>

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



<?php
setcookie("OrderInfo", "", time() - 3600);
setcookie("trackid", "", time() - 3600);
setcookie("qid", "", time() - 3600);

} else {
   ?>

<div class="smart-forms">
    
    <div class="section">
        <div class="frm-row">
            <div class="colm colm12">
                <div align="center">       
                    <font color="#990000">
                    <strong>Error:</strong> <?php echo $ResponseReason; ?>
                    <br/><br/>
                    There was a problem processing your credit card.  If you would like to resubmit<br/>your billing information <a href="javascript:history.back();"><strong>click here to go back.</strong></a>
                    <br/><br/>
                    If you would like to speak to a representative about this error, please<br/>call 1-800-600-3750 and refer to order number <?php echo $strOrderID; ?>.
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




 ?>