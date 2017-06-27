<?php
function sendMail($template, $contacts, $subject, $admin_template, $admin_contacts, $admin_subject) {

  include($_SERVER['DOCUMENT_ROOT']."/includes/site-settings.php");
  global $id;
  global $user_email;
  date_default_timezone_set('Etc/UTC');
  require 'PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->Debugoutput = 'html';
  $mail->Host = "mail.smtp.com";
  $mail->Port = 80;
  $mail->SMTPAuth = true;
  $mail->Username = $smtp_username;
  $mail->Password = $smtp_password;
  $mail->setFrom($company_email, $company_name);

  for ($i=0; $i < count($contacts); $i++) {
    $mail->Subject = $subject;
    $mail->msgHTML(file_get_contents('http://www.'.$live_url.'/mail/templates/'.$template.'?id='.$id), dirname(__FILE__));
    if(!isset($contacts[$i]['email'])) {
      $mail->addAddress($contacts[$i]);
    } else {
      $mail->addAddress($contacts[$i]['email'], $contacts[$i]['name']);
    }
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    $mail->clearAddresses();
  }

  if(count($admin_contacts) != 0) {
    for ($i=0; $i < count($admin_contacts); $i++) {
      $mail->addReplyTo($user_email);
      $mail->Subject = $admin_subject;
      $mail->msgHTML(file_get_contents('http://www.'.$live_url.'/mail/templates/'.$admin_template.'?id='.$id), dirname(__FILE__));
      $mail->addAddress($admin_contacts[$i]);
      //send the message, check for errors
      if (!$mail->send()) {
          echo "Admin Mailer Error: " . $mail->ErrorInfo;
      }
      $mail->clearAddresses();
    }
  }

}
