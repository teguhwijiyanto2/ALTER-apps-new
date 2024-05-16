<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';

$count = DB::queryFirstField("SELECT COUNT(*) FROM users where email=%s limit 0,1", $_POST['email']);
if($count > 0) {
	
	if(isset($_POST['reg_by_phone']) && $_POST['reg_by_phone']=="Y") {
		echo "
			<form action='email-verification.php?x=1' method='POST' id='formEmailVerification'>
				<input type='hidden' name='phone' value='".$_POST['phone']."'>
				<input type='hidden' name='password' value='".$_POST['password']."'>
			</form>
			<body onload=\"document.getElementById('formEmailVerification').submit();\">	
		";
	}
	else {
		echo "<script>window.location.href='signup.php?s=email&x=1&e=".$_POST['email']."'</script>";
	}
	
	exit();
} // if($count > 0) {

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'librarysmtp/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //hostname/domain yang dipergunakan untuk setting smtp
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'teguh@alterspace.gg';                  //SMTP username
    $mail->Password   = 'sys.admin3';                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('teguh@alterspace.gg', 'ALTER');
    $mail->addAddress("".$_POST['email']."", '');     //email tujuan
    //$mail->addReplyTo('teguh@alterspace.gg', 'ALTER Mail'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addCC('teguh@alterspace.gg'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addBCC('teguh@alterspace.gg'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content

	$otp = mt_rand(100000, 999999);

	$default_pswd = 'user123';
	
	DB::insert('users', [
	  'email' => $_POST['email'],
	  'phone' => $_POST['phone'],
	  'password' => md5($_POST['password']),
      'username' => '',
      'review_value' => 1,
	  'otp' => $otp,
	  'registration_time' => date("Y-m-d H:i:s"),
	  'last_login' => date("Y-m-d H:i:s"),
	  'activation_time' => date("Y-m-d H:i:s"),
	  'last_logout' => date("Y-m-d H:i:s")
	]);
	
	$htmlContent = " 
    <html> 
    <head> 
    <style>
        body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #9270F2;
        }
        .container {
        max-width: 400px;
        margin: 0 auto;
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 16px;
        background-color: #fff;
        }
        .container-2 {
        max-width: 400px;
        margin: 0 auto;
        margin-bottom: 20px;
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 16px;
        background-color: #fff;
        }
        .button {
        display: inline-block;
        padding: 10px 60px;
        margin: 10px 0px;
        border-radius: 24px;
        background-color: #6338DB;
        color: #fff;
        text-decoration: none;
        }
        .unsubscribe {
        text-align: center;
        margin-top: 20px;
        font-size: 12px;
        color: #fff;
        }
        body p {
            font-size: 14px;
        }
        span { 
        color: #fff;
        }
    </style>
    </head> 
    <body style='text-align:center; background-color: #9270F2; padding:30px;'> 
        <div class='container'>
                <img src='https://dev.alterspace.gg/assets/icon/logo-alter.png' width='150' />
				<h4 style='font-size:18px;'>Your ALTER Verification Code</h4>
				<p>This is an automated message from ALTER.<br>Please do not reply to this email.</p>

				<p>Please enter your Verification Code below<br>into the application to confirm your identity.</p>

				<table width='100%' align='center' border='0'><tr><td width='50%'>&nbsp;</td><td style='border: 1px solid black;border-radius: 20px; font-size:32px; padding: 5px;'>&nbsp;<b>".$otp."</b>&nbsp;</td><td width='50%'>&nbsp;</td></tr></table>

				<p>This code will expire in 10 minutes.</p>

				<p>If you didn't request this,<br>you can ignore this email and let us know!.</p>

				<p>Thank you.</p>
								
            </div>
            <div class='container-2'>
                <p>If you have any questions, contact us on <a href='mailto:help@alter.com'>help@alter.com</a></p>
                
            </div>
            <img src='https://dev.alterspace.gg/assets/icon/socmed.png' width='170' />

            <div class='unsubscribe'>
                Prefer not to receive emails? Unsubscribe
            </div>
    </body> 
    </html>"; 
	
/*
	$htmlContent = "
	<html>
		<body style='text-align:center; background-color: #9270F2; padding:30px;'>	
			<div class='container' style='background-color: #ffffff;'>
                <img src='https://dev.alterspace.gg/assets/icon/logo-alter.png' width='150' />
                <h4>Your ALTER Verification Code</h4>	
	
<p style='text-align: center;'>This is an automated message from ALTER.<br>Please do not reply to this email.</p>

<p style='text-align: center;'>Please enter your Verification Code below<br>into the application to confirm your identity.</p>

<table width='100%' align='center' border='0'><tr><td width='50%'>&nbsp;</td><td style='border: 1px solid black;border-radius: 20px; font-size:32px; padding: 5px;'>&nbsp;<b>".$otp."</b>&nbsp;</td><td width='50%'>&nbsp;</td></tr></table>

<p style='text-align: center;'>This code will expire in 10 minutes.</p>

<p style='text-align: center;'>If you didn't request this,<br>you can ignore this email and let us know!.</p>

<p style='text-align: center;'>Thank you.</p>

            </div>
            <div class='container-2' style='background-color: #ffffff;'>
                <p>If you have any questions, contact us on <a href='mailto:help@alter.com'>help@alter.com</a></p>
                
            </div>
            <img src='https://dev.alterspace.gg/assets/icon/socmed.png' width='170' />

            <div class='unsubscribe' style='background-color: #ffffff;'>
                Prefer not to receive emails? Unsubscribe
            </div>
		</body> 
    </html>";
*/

	
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "Welcome to ALTER, Let's Play !!";
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
	echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



/*
<html> 
    <head> 
        <title>Welcome to A.L.T.E.R</title> 
    </head> 
    <body> 
        <h1>Thank you for joining with us!</h1> 
        <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
            <tr> 
                <th>Your Email:</th><td>".$_POST['email']."</td> 
            </tr>
            <tr> 
                <th>Your Phone Number:</th><td>".$_POST['phone']."</td> 
            </tr> 			
            <tr> 
                <th>Your Password:</th><td>".$_POST['password']."</td> 
            </tr> 

            <tr> 
                <th>OTP Verification Code:</th><td><b>".$otp."</b></td> 
            </tr> 
        </table> 
    </body> 
    </html>"; 
*/


/*
$otp = mt_rand(100000, 999999);

	$default_pswd = 'user123';
	
	DB::insert('users', [
	  'email' => $_POST['email'],
	  'phone' => $_POST['phone'],
	  'password' => md5($_POST['password']),
	  'username' => '',
      'review_value' => 1,
	  'otp' => $otp,
	  'registration_time' => date("Y-m-d H:i:s"),
	  'last_login' => date("Y-m-d H:i:s"),
	  'activation_time' => date("Y-m-d H:i:s"),
	  'last_logout' => date("Y-m-d H:i:s")
	]);
	
echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";
*/



/*
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
//$headers .= 'Cc: welcome@example.com' . "\r\n"; 
//$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 

/*
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
    echo 'Email has sent successfully.'; 
}else{ 
   echo 'Email sending failed.'; 
}
*/

//echo $htmlContent;




?>