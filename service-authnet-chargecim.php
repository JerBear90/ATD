<?php
require 'vendor/autoload.php';
require_once 'constants/AuthorizeConstants.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");


$profileid_temp = $_POST['profileid'];
$paymentprofileid_temp = $_POST['paymentprofileid'];
$amount_temp = $_POST['amount'];


if (!empty($profileid_temp) && !empty($paymentprofileid_temp) && !empty($amount_temp)) {
	if (is_numeric($profileid_temp) && is_numeric($profileid_temp) && is_numeric($amount_temp)) {
		chargeCustomerProfile($profileid_temp,$paymentprofileid_temp,$amount_temp);
	} else {
		echo "FAILED||Issue with profileid, paymentprofileid or amount not being numeric";	
	}
} else {	
	echo "FAILED||Issue with profileid, paymentprofileid or amount not being present";		
}


function chargeCustomerProfile($profileid, $paymentprofileid, $amount) {
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\AuthorizeConstants::MERCHANT_TRANSACTION_KEY);
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
    $profileToCharge->setCustomerProfileId($profileid);
    $paymentProfile = new AnetAPI\PaymentProfileType();
    $paymentProfile->setPaymentProfileId($paymentprofileid);
    $profileToCharge->setPaymentProfile($paymentProfile);

    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setProfile($profileToCharge);

    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId( $refId);
    $request->setTransactionRequest( $transactionRequestType);
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);

	

    if ($response != null) {
      if($response->getMessages()->getResultCode() == "Ok") {
        $tresponse = $response->getTransactionResponse();
        
	    if ($tresponse != null && $tresponse->getMessages() != null) {
		  // GOOD TRANSACTION
		  // RETURN INFO:
		  /*
          echo "Transaction Response code : " . $tresponse->getResponseCode() . "<br>";
          echo "Charge Customer Profile APPROVED  :" . "<br>";
          echo "Charge Customer Profile AUTH CODE : " . $tresponse->getAuthCode() . "<br>";
          echo "Charge Customer Profile TRANS ID  : " . $tresponse->getTransId() . "<br>";
          echo "Code : " . $tresponse->getMessages()[0]->getCode() . "<br>"; 
	      echo "Description : " . $tresponse->getMessages()[0]->getDescription() . "<br>";
		  */
	      
	      // RESPONSE - APPROVED||Response Code||Auth Code||Transaction ID||Code||Description
	      
	      $atdresponse = 'APPROVED||' . $tresponse->getResponseCode() . '||' . $tresponse->getAuthCode() . '||' . $tresponse->getTransId() . '||' . $tresponse->getMessages()[0]->getCode() . '||' . $tresponse->getMessages()[0]->getDescription();
	      
        } else {
	      // FAILED TRANSACTION
          //echo "Transaction Failed \n";
          $atdresponse = 'FAILED';
          if($tresponse->getErrors() != null) {
            //echo "Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "<br>";
            //echo "Error message : " . $tresponse->getErrors()[0]->getErrorText() . "<br>";            
            $atdresponse.='||'.$tresponse->getErrors()[0]->getErrorCode().'||'.$tresponse->getErrors()[0]->getErrorText();
          }
        }
      } else {
        //echo "Transaction Failed \n";
        $atdresponse = 'FAILED';
        $tresponse = $response->getTransactionResponse();
        if($tresponse != null && $tresponse->getErrors() != null) {
          echo "Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "<br>";
          echo "Error message : " . $tresponse->getErrors()[0]->getErrorText() . "<br>";    
          $atdresponse.='||'.$tresponse->getErrors()[0]->getErrorCode().'||'.$tresponse->getErrors()[0]->getErrorText();                  
        } else {
          echo "Error code  : " . $response->getMessages()->getMessage()[0]->getCode() . "<br>";
          echo "Error message : " . $response->getMessages()->getMessage()[0]->getText() . "<br>";
          $atdresponse.='||'.$tresponse->getErrors()[0]->getErrorCode().'||'.$response->getMessages()->getMessage()[0]->getText();
        }
      }
    } else {
      echo  "No response returned";
    }

    //return $response;
    return $atdresponse;
}


  
