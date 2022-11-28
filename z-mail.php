<?php
echo date("m-d-Y g:i a");
exit;

ini_set('display_errors', 1); 
error_reporting(E_ALL);

function atdmail ($message,$subject,$toemail,$fromemail,$fromname) {
    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70, "\r\n");
    // Additional headers
    $headers = 'From: ' . $fromname. ' <' . $fromemail . '>' . '\r\n';

    // Send
    if (mail($toemail, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

function atdhtmlmail ($message,$subject,$toemail,$fromemail,$fromname) {
    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70, "\r\n");
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Additional headers
    $headers .= 'From: ' . $fromname. ' <' . $fromemail . '>' . '\r\n';

    // Send
    if (mail($toemail, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

/*

$message = "Line 1\r\nLine 2\r\nLine 3";
$subject = "Yo!";
$toemail = "clay@madebysprung.com";
$fromemail = "info@autotransportdirect.com";
$fromname = "Direct Express Auto Transport";

if (atdmail($message,$subject,$toemail,$fromemail,$fromname)) {
    echo "sent!";
} else {
    echo "something went wrong";
}
*/
$ip = GetIP();

$message = "<strong>Yo!  What's up!</strong><br><br>You know this shit is <font color='red'>red!!!</font><br>$ip";
$subject = "Yo!";
$toemail = "clay@madebysprung.com";
$fromemail = "info@autotransportdirect.com";
$fromname = "Direct Express Auto Transport";

if (atdhtmlmail($message,$subject,$toemail,$fromemail,$fromname)) {
    echo "sent!";
} else {
    echo "something went wrong";
}

?>