<?php
require "vendor/autoload.php";
//require_once 'constants/AuthorizeConstants.php';
require_once "constants/SandboxConstants.php";
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

function validateCustomerPaymentProfile(
  $customerProfileId = "1672675817",
  $customerPaymentProfileId = "1682155341"
) {
  /* Create a merchantAuthenticationType object with authentication details
   retrieved from the constants file */
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
  $merchantAuthentication->setTransactionKey(
    \AuthorizeConstants::MERCHANT_TRANSACTION_KEY
  );

  // Set the transaction's refId
  $refId = "ref" . time();

  // Use an existing payment profile ID for this Merchant name and Transaction key
  //validationmode tests , does not send an email receipt
  $validationmode = "liveMode";

  $request = new AnetAPI\ValidateCustomerPaymentProfileRequest();

  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setCustomerProfileId($customerProfileId);
  $request->setCustomerPaymentProfileId($customerPaymentProfileId);
  $request->setValidationMode($validationmode);

  $controller = new AnetController\ValidateCustomerPaymentProfileController(
    $request
  );
  $response = $controller->executeWithApiResponse(
    \net\authorize\api\constants\ANetEnvironment::PRODUCTION
  );
  echo "<pre>";
  var_dump($response);
  echo "</pre>";

  if ($response != null && $response->getMessages()->getResultCode() == "Ok") {
    $validationMessages = $response->getMessages()->getMessage();
    echo "Response : " .
      $validationMessages[0]->getCode() .
      "  " .
      $validationMessages[0]->getText() .
      "<br>";
  } else {
    echo "ERROR :  Validate Customer Payment Profile: Invalid response\n";
    $errorMessages = $response->getMessages()->getMessage();
    echo "Response : " .
      $errorMessages[0]->getCode() .
      "  " .
      $errorMessages[0]->getText() .
      "<br>";
  }
  return $response;
}

validateCustomerPaymentProfile();
?>
