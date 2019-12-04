<?php

$to = 'steph.sakai@gmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $name = trim(stripslashes($_POST['name']));
   $surname = trim(stripslashes($_POST['surname']));
   $email = trim(stripslashes($_POST['email']));
   $phone = trim(stripslashes($_POST['phone']));
   $contact_message = trim(stripslashes($_POST['message']));
   $mailinglist = trim(stripslashes($_POST['mailinglist']));
   $workshop1 = trim(stripslashes($_POST['workshop1']));     
   $workshop2 = trim(stripslashes($_POST['workshop2']));
   $subject = trim(stripslashes($_POST['subject']));
   
	if ($subject == '') { $subject = "TFT Training Contact"; }

   // Set Message
   $message .= "<b>Email from:</b> " . $name . "&nbsp;" . $surname . "<br />";
   $message .= "<b>Email address:</b> " . $email . "<br />";
   $message .= "<b>Phone:</b> " . $phone . "<br />";
   $message .= "<b>Mailing List:</b> " . $mailinglist . "<br />";
   $message .= "<b>Workshop 1:</b> " . $workshop1 . "<br />";
   $message .= "<b>Workshop 2:</b> " . $workshop2 . "<br />";
   $message .= "<b>Message:</b> ";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> This email was sent from the TFT Center Workshop Form. <br />";

   // Set From: header
   $from =  $subject . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); // for windows server
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { // message that will be displayed when everything is OK
   $url='http://nikiko.space/final/contact_confirm.html';
   echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';}
   else { $url='http://nikiko.space/final/contact_error.html'; }

}

?>
