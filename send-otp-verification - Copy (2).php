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


	$to = "".$_POST['email'].""; 
	$from = "teguh@alterspace.gg"; 
	$fromName = 'A.L.T.E.R'; 
	 
	$subject = "[ALTER] E-mail Registration & OTP"; 
	 
	$htmlContent = " 
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
	
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = '[ALTER] Welcome to A.L.T.E.R.space';
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
	echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



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