<?php
require "vendor/autoload.php";
//require_once 'constants/AuthorizeConstants.php';
require_once "constants/SandboxConstants.php";
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

function getCustomerPaymentProfile(
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

  //request requires customerProfileId and customerPaymentProfileId
  $request = new AnetAPI\GetCustomerPaymentProfileRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId($refId);
  $request->setCustomerProfileId($customerProfileId);
  $request->setCustomerPaymentProfileId($customerPaymentProfileId);

  $controller = new AnetController\GetCustomerPaymentProfileController(
    $request
  );
  $response = $controller->executeWithApiResponse(
    \net\authorize\api\constants\ANetEnvironment::PRODUCTION
  );

  echo "<pre>";
  //var_dump($response);
  echo "</pre>";

  if ($response != null) {
    if ($response->getMessages()->getResultCode() == "Ok") {
      echo "GetCustomerPaymentProfile SUCCESS: " . "<br>";
      echo "Customer Payment Profile Id: " .
        $response->getPaymentProfile()->getCustomerPaymentProfileId() .
        "<br>";
      echo "Customer Payment Profile Billing Address: " .
        $response
          ->getPaymentProfile()
          ->getbillTo()
          ->getAddress() .
        "<br>";
      echo "Customer Payment Profile Card Last 4 " .
        $response
          ->getPaymentProfile()
          ->getPayment()
          ->getCreditCard()
          ->getCardNumber() .
        "<br>";

      if ($response->getPaymentProfile()->getSubscriptionIds() != null) {
        if ($response->getPaymentProfile()->getSubscriptionIds() != null) {
          echo "List of subscriptions:";
          foreach (
            $response->getPaymentProfile()->getSubscriptionIds()
            as $subscriptionid
          ) {
            echo $subscriptionid . "<br>";
          }
        }
      }
    } else {
      echo "GetCustomerPaymentProfile ERROR :  Invalid response<br>";
      $errorMessages = $response->getMessages()->getMessage();
      echo "Response : " .
        $errorMessages[0]->getCode() .
        "  " .
        $errorMessages[0]->getText() .
        "<br>";
    }
  } else {
    echo "NULL Response Error";
  }
  return $response;
}
if (!defined("DONT_RUN_SAMPLES")) {
  getCustomerPaymentProfile();
}
?>
