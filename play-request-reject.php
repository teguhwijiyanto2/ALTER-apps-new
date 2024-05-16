<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


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






$results_1 = DB::query("UPDATE matchmaking_availability set request_status='Rejected' where id=%i", $_GET["pid"]);

$results_2 = DB::queryFirstRow("SELECT * from matchmaking_availability where id=%i", $_GET["pid"]);


DB::insert('notifications', [
    'category' => 'cancel-order',
    'notif_for' => $results_2["requestor_id"],
    'notif_from' => $_SESSION["session_usr_id"],
    'title' => $_SESSION["session_usr_name"]. " Reject your order.",
    'data' => $_GET["pid"]
  ]);


/*
CREATE TABLE IF NOT EXISTS `matchmaking_availability` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requestor_id` bigint(20) DEFAULT NULL,
  `game_name_id` varchar(100) DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `num_of_hours` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approver_id` bigint(20) DEFAULT NULL,
  `is_read` varchar(1) DEFAULT '0',
  `request_status` varchar(20) NOT NULL,
  `approval_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
*/


/*
	echo "
	<form action='play-request.php' method='POST' id='formX'>
	</form>
    <body onload=\"document.getElementById('formX').submit();\">
	";
*/



/*

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
    $mail->addAddress("".$array_users_email[$results_2['requestor_id']]."", '');     //email tujuan
    //$mail->addReplyTo('teguh@alterspace.gg', 'ALTER Mail'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addCC('teguh@alterspace.gg'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addBCC('teguh@alterspace.gg'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
	
	$to = "".$array_users_email[$results_2['requestor_id']].""; 
	$from = "teguh@alterspace.gg"; 
	$fromName = 'A.L.T.E.R'; 
	 
	$subject = "[ALTER] Request to play REJECTED"; 
	 
	$htmlContent = " 
    <html> 
    <head> 
        <title>Request to play REJECTED</title> 
    </head> 
    <body> 
        <h1>Request to play has been REJECTED</h1> 
        <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
            <tr> 
                <th>Players:</th><td>".$array_users_name[$results_2['requestor_id']]." x ".$array_users_name[$results_2['approver_id']]."</td> 
            </tr>
            <tr> 
                <th>Game:</th><td>".$results_2['game_name_id']."</td> 
            </tr> 			
            <tr> 
                <th>Playing Time:</th><td>".$results_2['date_time']."</td> 
            </tr> 
            <tr> 
                <th>Duration:</th><td>".$results_2['num_of_hours']." hours</td> 
            </tr> 
            <tr> 
                <th>Notes:</th><td>".$results_2['notes']."</td> 
            </tr> 			
            <tr> 
                <th>Request Status:</th><td>".$results_2['request_status']."</td> 
            </tr> 			
			
        </table> 
    </body> 
    </html>"; 


    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = '[ALTER] Request to play REJECTED';
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';





    //Server settings
    $mail2->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail2->isSMTP();                                            //Send using SMTP
    $mail2->Host       = 'smtp.titan.email';                     //hostname/domain yang dipergunakan untuk setting smtp
    $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail2->Username   = 'teguh@alterspace.gg';                  //SMTP username
    $mail2->Password   = 'sys.admin3';                           //SMTP password
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail2->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail2->setFrom('teguh@alterspace.gg', 'ALTER');
    $mail2->addAddress("".$array_users_email[$results_2['approver_id']]."", '');     //email tujuan
    //$mail2->addReplyTo('teguh@alterspace.gg', 'ALTER Mail'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
    //$mail2->addCC('teguh@alterspace.gg'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
    //$mail2->addBCC('teguh@alterspace.gg'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

    //Attachments
    #$mail2->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail2->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
	
	$to = "".$array_users_email[$results_2['approver_id']].""; 
	$from = "teguh@alterspace.gg"; 
	$fromName = 'A.L.T.E.R'; 
	 
	$subject = "[ALTER] Request to play REJECTED"; 
	 
	$htmlContent = " 
    <html> 
    <head> 
        <title>Request to play REJECTED</title> 
    </head> 
    <body> 
        <h1>Request to play has been REJECTED</h1> 
        <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
            <tr> 
                <th>Players:</th><td>".$results_2['requestor_id']." x ".$results_2['approver_id']."</td> 
            </tr>
            <tr> 
                <th>Game:</th><td>".$results_2['game_name_id']."</td> 
            </tr> 			
            <tr> 
                <th>Playing Time:</th><td>".$results_2['date_time']."</td> 
            </tr> 
            <tr> 
                <th>Duration:</th><td>".$results_2['num_of_hours']." hours</td> 
            </tr> 
            <tr> 
                <th>Notes:</th><td>".$results_2['notes']."</td> 
            </tr> 			
            <tr> 
                <th>Request Status:</th><td>".$results_2['request_status']."</td> 
            </tr> 			
			
        </table> 
    </body> 
    </html>"; 


    $mail2->isHTML(true); //Set email format to HTML
    $mail2->Subject = '[ALTER] Request to play REJECTED';
    $mail2->Body    = $htmlContent;
    $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail2->send();
    //echo 'Message has been sent';









} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

*/

	echo "<script>window.location.href='myorder.php'</script>";
	
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

echo $htmlContent;



?>