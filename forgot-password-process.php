<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';

$count = DB::queryFirstField("SELECT COUNT(*) FROM users where email=%s limit 0,1", $_POST['email']);
if($count == 0) {
    echo "<script>window.location.href='forgot-password.php?x=1&e=".$_POST['email']."'</script>";
	exit();
} 

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
	
	DB::query("UPDATE users SET otp='$otp' WHERE email = '".$_POST['email']."'");

    $results_check = DB::queryFirstRow("SELECT * FROM users where email=%s limit 0,1", $_POST['email']);



	$to = "".$_POST['email'].""; 
	$from = "teguh@alterspace.gg"; 
	$fromName = 'A.L.T.E.R'; 
	 
	$subject = "[ALTER] E-mail Forgot Password"; 
	 
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
                <h4 style='color: #9270F2;'>Hi ".$results_check['name'].",</h4>
                <p>A request has been made to reset your password. If you made this request, please click the button below.</p>
                <a class='button' style={ color: '#fffff !important' } href='https://dev.alterspace.gg/reset-password.php?token=".$results_check['otp']."&id=".$results_check['id']."'><span>Reset password</span></a>
                <p>This link will expire in 30<b> minutes.</b></p>
                <p>If you didn't request this, you can ignore this email and let us know.</p>
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
	
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = '[ALTER] Welcome to A.L.T.E.R.space';
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
	echo "<script>window.location.href='forgot-password__success.php'</script>";

} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




?>