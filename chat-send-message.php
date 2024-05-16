<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

/*
CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_room_uuid` varchar(255) DEFAULT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  `message` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
*/


/*
 <form action="chat-send-message.php" method="POST" id="formSendChatMessage">
	  <input type="hidden" name="chat_room_uuidx" value="<?php echo $_POST['chat_room_uuidx']; ?>">
	  <input type="hidden" name="receiver_idx" value="<?php echo $chat_with_id; ?>">

<input
              placeholder="Enter Message"
              class="bg-transparent border-0 w-100"
			  name="chat_message"
            />
			
<input type="file" id="fileInput" name="fileInput" hidden />			
			
              <input
                type="file"
                accept="image/*"
                id="imageInput"
                name="imageInput"
                hidden
              />			
			
<input
            placeholder="Enter Message (Optional)"
            class="bg-transparent border-0 w-100 py-1 text-white"
			name="post_text_caption"
          />
*/

	  
		  
		  
		  
		  
		  
if(isset($_POST['post_text_caption']) && strlen($_POST['post_text_caption']) > 0)  {
	$text_message = $_POST['post_text_caption'];
}	
else {
	$text_message = $_POST['chat_message'];
}	
		  


$fileName = "";
$uploadDirectory = "chat_files/";


if(isset($_FILES['fileInput']['name']) && strlen($_FILES['fileInput']['name']) > 3) {
	

    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['fileInput']['name'];
    $fileSize_1 = $_FILES['fileInput']['size'];
    $fileTmpName_1  = $_FILES['fileInput']['tmp_name'];
    $fileType_1 = $_FILES['fileInput']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	
    $uploadPath_1 = $uploadDirectory . $fileNameCleaned_1; 
      if (empty($errors_1)) {
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "1 The file " . basename($fileName_1) . " has been uploaded";
		  	//DB::query("UPDATE chat set chat_file=%s where chat_room_uuid=%s", $fileNameCleaned_1, $_POST['chat_room_uuidx']);
		      $fileName = $fileNameCleaned_1;
        } else {
          //echo "2 An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(isset($_FILES['fileInput']['name']) && strlen($_FILES['fileInput']['name']) > 3) {




if(isset($_FILES['imageInput']['name']) && strlen($_FILES['imageInput']['name']) > 3) {
	


    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['imageInput']['name'];
    $fileSize_1 = $_FILES['imageInput']['size'];
    $fileTmpName_1  = $_FILES['imageInput']['tmp_name'];
    $fileType_1 = $_FILES['imageInput']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	
    $uploadPath_1 = $uploadDirectory . $fileNameCleaned_1; 
      if (empty($errors_1)) {
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "3 The file " . basename($fileName_1) . " has been uploaded";
		  	//DB::query("UPDATE chat set chat_file=%s where chat_room_uuid=%s", $fileNameCleaned_1, $_POST['chat_room_uuidx']);
		    $fileName = $fileNameCleaned_1;
        } else {
          //echo "4 An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(isset($_FILES['imageInput']['name']) && strlen($_FILES['imageInput']['name']) > 3) {
	
	



	DB::insert('chat', [
	  'chat_room_uuid' => $_POST['chat_room_uuidx'],
	  'sender_id' => $_SESSION["session_usr_id"],
	  'message' => $text_message,
	  'receiver_id' => $_POST['receiver_idx'],
	  'is_read' => 0,
	  'chat_file' => $fileName	  
	]);
	
	$user_profile = DB::query("UPDATE chat_room set last_message_sender_id=%i, last_message=%s, last_message_created_on=now() where chat_room_uuid=%s", $_SESSION["session_usr_id"], $_POST['chat_message'], $_POST['chat_room_uuidx']);




	
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
    $mail->addAddress("".$array_users_email[$_POST['receiver_idx']]."", '');     //email tujuan
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
				<p>Hi ".$array_users_name[$_POST['receiver_idx']]."</p>

				<p>You got a chat message from ".$_SESSION["session_usr_name"]." (".$_SESSION["session_usr_username"].") </p>

				<p><a href='https://beta.alterspace.gg/' target='_blank'>Login here</a> and check your chat to see this message.</p>

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
    $mail->Subject = "[ALTER] You got a chat message from ".$_SESSION["session_usr_name"]." (".$_SESSION["session_usr_username"].")";
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
	//echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}	
	
	
	


	echo "
	<form action='chat.php' method='POST' id='formChatOpener'>
		<input type='hidden' name='chat_type' value='DM'>
		<input type='hidden' name='chat_room_uuidx' value='".$_POST['chat_room_uuidx']."'>
	</form>
	<body onload=\"document.getElementById('formChatOpener').submit();\">
	";


?>