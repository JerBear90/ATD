<?php
require "vendor/autoload.php";
//require_once 'constants/AuthorizeConstants.php';
require_once "constants/SandboxConstants.php";
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

function createCustomerProfile($email)
{
  /* Create a merchantAuthenticationType object with authentication details
   retrieved from the constants file */
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
  $merchantAuthentication->setTransactionKey(
    \AuthorizeConstants::MERCHANT_TRANSACTION_KEY
  );

  // Set the transaction's refId
  $refId = "ref" . time();

  // Create a Customer Profile Request
  //  1. (Optionally) create a Payment Profile
  //  2. (Optionally) create a Shipping Profile
  //  3. Create a Customer Profile (or specify an existing profile)
  //  4. Submit a CreateCustomerProfile Request
  //  5. Validate Profile ID returned

  // Set credit card information for payment profile
  $creditCard = new AnetAPI\CreditCardType();
  $creditCard->setCardNumber("4111111111111111");
  $creditCard->setExpirationDate("2025-03");
  $creditCard->setCardCode("111");
  $paymentCreditCard = new AnetAPI\PaymentType();
  $paymentCreditCard->setCreditCard($creditCard);

  // Create the Bill To info for new payment type
  $billTo = new AnetAPI\CustomerAddressType();
  $billTo->setFirstName("Clay");
  $billTo->setLastName("Johnston");
  $billTo->setCompany("Sprung");
  $billTo->setAddress("8825 Wood Cliff Rd.");
  $billTo->setCity("Bloomington");
  $billTo->setState("MN");
  $billTo->setZip("55438");
  $billTo->setCountry("USA");
  $billTo->setPhoneNumber("612-616-4455");

  // Create a new CustomerPaymentProfile object
  $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
  $paymentProfile->setCustomerType("individual");
  $paymentProfile->setBillTo($billTo);
  $paymentProfile->setPayment($paymentCreditCard);
  $paymentProfiles[] = $paymentProfile;

  // Create a new CustomerProfileType and add the payment profile object
  $customerProfile = new AnetAPI\CustomerProfileType();
  $customerProfile->setDescription("");
  $customerProfile->setMerchantCustomerId("ATD_" . time());
  $customerProfile->setEmail($email);
  $customerProfile->setpaymentProfiles($paymentProfiles);

  // Assemble the complete transaction request
  $request = new AnetAPI\CreateCustomerProfileRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId($refId);
  $request->setProfile($customerProfile);

  // Create the controller and get the response
  $controller = new AnetController\CreateCustomerProfileController($request);
  $response = $controller->executeWithApiResponse(
    \net\authorize\api\constants\ANetEnvironment::PRODUCTION
  );

  if ($response != null && $response->getMessages()->getResultCode() == "Ok") {
    echo "Succesfully created customer profile : " .
      $response->getCustomerProfileId() .
      "<br>";
    $paymentProfiles = $response->getCustomerPaymentProfileIdList();
    echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "<br>";
  } else {
    echo "ERROR :  Invalid response\n";
    $errorMessages = $response->getMessages()->getMessage();
    echo "Response : " .
      $errorMessages[0]->getCode() .
      "  " .
      $errorMessages[0]->getText() .
      "<br>";
  }
  return $response;
}

createCustomerProfile("clay@madebysprung.com");
