<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';
	
	DB::insert('post_comments', [
	  'post_id' => $_POST['id_post'],
	  'comment' => $_POST['comment_post'],
	  'reply_comment_id' => $_POST['reply'] ? $_POST['reply'] : null,
	  'posted_by' => $_SESSION["session_usr_id"],
	  'posted_at' => date("Y-m-d H:i:s"),
	]);

	$post =  DB::queryFirstRow("SELECT * FROM posts WHERE id=%s ", $_POST['id_post']);

	if($post['posted_by'] != $_SESSION["session_usr_id"]) {

		$comment = explode(" ", $_POST['comment_post']);

		DB::insert('notifications', [
			'category' => 'post-comment',
			'notif_for' => $post['posted_by'],
			'notif_from' => $_SESSION["session_usr_id"],
			'title' => 'Commented: '.$comment[0]. "....",
			'data' => $post['id']
			]);
	}

    return true;
	
	
	
	
$array_users_name = array();
$array_users_email = array();
$array_users_username = array();
$results_A = DB::query("SELECT * FROM users");
foreach ($results_A as $row_A) {
	$array_users_name[$row_A['id']] = "".$row_A['name']."";
	$array_users_email[$row_A['id']] = "".$row_A['email']."";
	$array_users_username[$row_A['id']] = "".$row_A['username']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

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
    $mail->addAddress("".$array_users_email[$post['posted_by']]."", '');     //email tujuan
    //$mail->addReplyTo('teguh@alterspace.gg', 'ALTER Mail'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addCC('teguh@alterspace.gg'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addBCC('teguh@alterspace.gg'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
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
                <img src='https://beta.alterspace.gg/assets/icon/logo-alter.png' width='150' />
				<h4 style='font-size:18px;'>ALTER Review</h4>
				<p>Hi ".$array_users_name[$post['posted_by']]."</p>

				<p>Your post got a comment from ".$_SESSION["session_usr_name"]." (".$_SESSION["session_usr_username"].") </p>

				<p><a href='https://beta.alterspace.gg/' target='_blank'>Click here</a> and see your post to see this comment.</p>

				<p>Thank you.</p>
								
            </div>
            <div class='container-2'>
                <p>If you have any questions, contact us on <a href='mailto:help@alter.com'>help@alter.com</a></p>
                
            </div>
            <img src='https://beta.alterspace.gg/assets/icon/socmed.png' width='170' />

            <div class='unsubscribe'>
                Prefer not to receive emails? Unsubscribe
            </div>
    </body> 
    </html>"; 
		
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "[ALTER] Your post got a comment from ".$_SESSION["session_usr_name"]." (".$_SESSION["session_usr_username"].")";
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
	//echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>