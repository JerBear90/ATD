<?php
require 'vendor/autoload.php';
require_once 'constants/SandboxConstants.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");


$cc_val=0;
$x_card_num = "4111111111111111";
$x_exp_date = "2025-03";
$x_card_code = "334";
$x_invoice_num = "123457" . time();
$x_first_name = "Clay";
$x_last_name = "Johnston";
$x_address = "8825 Wood Cliff Rd.";
$x_city = "Bloomington";
$x_state = "MN";
$x_zip = "55438";
$x_phone = "612-616-4455";
$x_email = "clay@madebysprung.com";
$x_customer_ip = "75.73.108.245";


/* Create a merchantAuthenticationType object with authentication details
retrieved from the constants file */
$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
$merchantAuthentication->setTransactionKey(\AuthorizeConstants::MERCHANT_TRANSACTION_KEY);

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
$paymentProfile->setCustomerType('individual');
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
$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

$customerProfileId = $response->getCustomerProfileId();
$paymentProfiles = $response->getCustomerPaymentProfileIdList();
$customerPaymentProfileId = $paymentProfiles[0];


//successfully added customer profile
if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {

	echo "Succesfully created customer profile : " . $customerProfileId . "<br>";
	echo "SUCCESS: PAYMENT PROFILE ID : " . $customerPaymentProfileId . "<hr>";


	$request2 = new AnetAPI\ValidateCustomerPaymentProfileRequest();
	$request2->setMerchantAuthentication($merchantAuthentication);
	$request2->setCustomerProfileId($customerProfileId);
	$request2->setCustomerPaymentProfileId($customerPaymentProfileId);
	$request2->setValidationMode("liveMode");
	$controller2 = new AnetController\ValidateCustomerPaymentProfileController($request2);
	$response2 = $controller2->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

	//successfully validated card for $0.00
	if (($response2 != null) && ($response2->getMessages()->getResultCode() == "Ok") ) {
		$cc_val=1;
	}
	
//failed adding customer profile
} else {
	$errorMessages = $response->getMessages()->getMessage();
	echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "<br>";
}



if ($cc_val=1) {
	echo "success!";
} else {
	echo "something screwed up";
}