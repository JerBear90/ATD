<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require "vendor/autoload.php";
//require_once 'constants/AuthorizeConstants.php';
require_once "constants/SandboxConstants.php";
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

function chargeCustomerProfile($profileid, $paymentprofileid, $amount)
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

  $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
  $profileToCharge->setCustomerProfileId($profileid);
  $paymentProfile = new AnetAPI\PaymentProfileType();
  $paymentProfile->setPaymentProfileId($paymentprofileid);
  $profileToCharge->setPaymentProfile($paymentProfile);

  $orderRequestType = new AnetAPI\OrderType();
  $orderRequestType->setInvoiceNumber("1234567890");

  $transactionRequestType = new AnetAPI\TransactionRequestType();
  $transactionRequestType->setTransactionType("authCaptureTransaction");
  $transactionRequestType->setAmount($amount);
  $transactionRequestType->setProfile($profileToCharge);
  $transactionRequestType->setOrder($orderRequestType);

  $request = new AnetAPI\CreateTransactionRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId($refId);
  //$request->setinvoiceNumber("1234567890");
  $request->setTransactionRequest($transactionRequestType);
  $controller = new AnetController\CreateTransactionController($request);
  $response = $controller->executeWithApiResponse(
    \net\authorize\api\constants\ANetEnvironment::SANDBOX
  );

  if ($response != null) {
    if ($response->getMessages()->getResultCode() == "Ok") {
      $tresponse = $response->getTransactionResponse();

      if ($tresponse != null && $tresponse->getMessages() != null) {
        echo " Transaction Response code : " .
          $tresponse->getResponseCode() .
          "<br>";
        echo "Charge Customer Profile APPROVED  :" . "<br>";
        echo " Charge Customer Profile AUTH CODE : " .
          $tresponse->getAuthCode() .
          "<br>";
        echo " Charge Customer Profile TRANS ID  : " .
          $tresponse->getTransId() .
          "<br>";
        echo " Code : " . $tresponse->getMessages()[0]->getCode() . "<br>";
        echo " Description : " .
          $tresponse->getMessages()[0]->getDescription() .
          "<br>";
      } else {
        echo "Transaction Failed \n";
        if ($tresponse->getErrors() != null) {
          echo " Error code  : " .
            $tresponse->getErrors()[0]->getErrorCode() .
            "<br>";
          echo " Error message : " .
            $tresponse->getErrors()[0]->getErrorText() .
            "<br>";
        }
      }
    } else {
      echo "Transaction Failed \n";
      $tresponse = $response->getTransactionResponse();
      if ($tresponse != null && $tresponse->getErrors() != null) {
        echo " Error code  : " .
          $tresponse->getErrors()[0]->getErrorCode() .
          "<br>";
        echo " Error message : " .
          $tresponse->getErrors()[0]->getErrorText() .
          "<br>";
      } else {
        echo " Error code  : " .
          $response
            ->getMessages()
            ->getMessage()[0]
            ->getCode() .
          "<br>";
        echo " Error message : " .
          $response
            ->getMessages()
            ->getMessage()[0]
            ->getText() .
          "<br>";
      }
    }
  } else {
    echo "No response returned \n";
  }

  return $response;
}

chargeCustomerProfile("1516495311", "1514696518", 2.0);
?>
