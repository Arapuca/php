<?php
require 'PHPMailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'matheus.olopes@gmail.com';
$mail->Password = 'cctcollege';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
 
$mail->From = 'matheus.olopes@gmail.com';
$mail->FromName = 'Matheus';
$mail->addAddress('raj.amalw@learn2crack.com', 'Raj Amal W');
 
$mail->addReplyTo('raj.amalw@gmail.com', 'Raj Amal W');
 
$mail->WordWrap = 50;
$mail->isHTML(true);
 
$mail->Subject = 'Using PHPMailer';
$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';
 
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent';
?>