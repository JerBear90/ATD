<?php
/* Template Name: Test Page */
$toemail = 'clay@madebysprung.com';
$subject = 'this is a test from WP - part - html';
$message = 'test <strong>message</strong>';
$fromname='Direct Express Auto Transport';
$fromemail='info@autotransportdirect.com';
//wp_mail( $to, $subject, $message, $headers, $attachments );


atdmail2('',$fromname,$fromemail,$toemail,$subject,$message);
?>
sent...