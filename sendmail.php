<?php

// Da Vinci network EDUROAM does not work.
// ICT Academy network ICTA-WLAB works.

echo "<h1>Installation</h1>";
echo "Before running this page, install phpmailer";
echo "<pre>composer require phpmailer/phpmailer</pre>";

echo "trying to send email...";

flush();
ob_flush();

//require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "ictambw@gmail.com";  // GMAIL username
$mail->Password   = "Studentje1";            // GMAIL password

$mail->SetFrom('psnoek@davinci.nl', 'Peter Snoek');
$mail->AddReplyTo("psnoek@davinci.nl","Peter Snoek");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "snp@davinci.nl";
$mail->AddAddress($address, "Peter Snoek (SNP)");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
    