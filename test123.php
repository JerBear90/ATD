<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require_once('./postmark/vendor/autoload.php');
use Postmark\PostmarkClient;


function atdmail($type,$fromname,$fromemail,$toemail,$subject,$message) {
    // Import the Postmark Client Class:
	
	$client = new PostmarkClient("827d9758-5794-407c-84f1-4b8130ffc29e");
	
	// Send an email:
	$sendResult = $client->sendEmail(
	  $fromname . '<' . $fromemail . '>',
	  $toemail,
	  $subject,
	  $message
	);

    return true;
    
}

atdmail('',"Direct Express Auto Transport","info@autotransportdirect.com","clay@madebysprung.com","Test Email from Postmark","<strong>This is a <em>test</em></strong> again!!!");


?>