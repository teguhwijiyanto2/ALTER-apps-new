<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

/*
CREATE TABLE IF NOT EXISTS `tournament` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tournament_code` VARCHAR( 100 ) NOT NULL 
  `creator_user_id` bigint(20) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,  
  `banner` varchar(255) DEFAULT NULL,    
  `name` varchar(100) DEFAULT NULL, 
  `description` text,  
  `city_id` bigint(20) DEFAULT NULL, 
  date_from datetime DEFAULT NULL,
  date_to datetime DEFAULT NULL,
  `game_id` bigint(20) DEFAULT NULL, 
  stage_type varchar(100) DEFAULT NULL, 
  format_type varchar(100) DEFAULT NULL, 
  participant_type varchar(100) DEFAULT NULL, 
  participant_number int(11) default NULL,

reward_1st int(11) default NULL,
reward_2nd int(11) default NULL,
reward_3rd int(11) default NULL,

  tournament_type varchar(100) DEFAULT NULL, 
  registration_type varchar(100) DEFAULT NULL, 
participant_fee int(11) default NULL,
`status` VARCHAR( 20 ) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

*/



$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

$array_cities = array();
$results_A = DB::query("SELECT * FROM cities order by name asc");
foreach ($results_A as $row_A) {
	$array_cities[$row_A['id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];





	$str_rand = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $tournament_code = $_SESSION["session_usr_id"] . substr(str_shuffle($str_rand), 0, 9);


    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['thumbnail']['name'];
    $fileSize_1 = $_FILES['thumbnail']['size'];
    $fileTmpName_1  = $_FILES['thumbnail']['tmp_name'];
    $fileType_1 = $_FILES['thumbnail']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	$fileNameFix_1 = $tournament_code . "." . $fileNameCleaned_1;
if(strlen($fileNameCleaned_1) > 3) {	
    $uploadPath_1 = "tournament_thumbnail/" . $fileNameFix_1; 
      if (empty($errors_1)) {
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "The file " . basename($fileName_1) . " has been uploaded";
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(strlen($fileNameCleaned_1) > 3) {


    $errors_2 = []; // Store errors here
    $fileName_2 = $_FILES['banner']['name'];
    $fileSize_2 = $_FILES['banner']['size'];
    $fileTmpName_2  = $_FILES['banner']['tmp_name'];
    $fileType_2 = $_FILES['banner']['type'];
	$fileNameCleaned_2 = str_ireplace(" ","_",basename($fileName_2));
	$fileNameFix_2 = $tournament_code . "." . $fileNameCleaned_2;
if(strlen($fileNameCleaned_2) > 3) {	
    $uploadPath_2 = "tournament_banner/" . $fileNameFix_2; 
      if (empty($errors_2)) {
        $didUpload_2 = move_uploaded_file($fileTmpName_2, $uploadPath_2);
        if ($didUpload_2) {
          //echo "The file " . basename($fileName_2) . " has been uploaded";
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_2 as $error_2) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(strlen($fileNameCleaned_2) > 3) {


$reward_1st_clean2 = str_ireplace(",","",$_POST['reward_1st']);
$reward_1st_clean = str_ireplace(".","",$reward_1st_clean2);
$reward_2nd_clean2 = str_ireplace(",","",$_POST['reward_2nd']);
$reward_2nd_clean = str_ireplace(".","",$reward_2nd_clean2);
$reward_3rd_clean2 = str_ireplace(",","",$_POST['reward_3rd']);
$reward_3rd_clean = str_ireplace(".","",$reward_3rd_clean2);

$participant_fee_clean2 = str_ireplace(",","",$_POST['participant_fee']);
$participant_fee_clean = str_ireplace(".","",$participant_fee_clean2);


	DB::insert('tournament', [
	  'tournament_code' => $tournament_code,
	  'creator_user_id' => $_SESSION["session_usr_id"],
	  'thumbnail' => $fileNameFix_1,
	  'banner' => $fileNameFix_2,
	  'name' => $_POST['name'],
	  'description' => $_POST['description'],
	  'city_id' => $_POST['selCity'],
	  'date_from' => $_POST['date_from'],
	  'date_to' => $_POST['date_to'],
	  'game_name_id' => $_POST['selGameNameId'],
	  'stage_type' => $_POST['stage_type'],
	  'format_type' => $_POST['format_type'],
	  'participant_type' => $_POST['participant_type'],	 
	  'players_per_team' => $_POST['players_per_team'],	  	  	  
	  'participant_number' => $_POST['participant_number'],		  
	  'reward_1st' => $reward_1st_clean,		  
	  'reward_2nd' => $reward_2nd_clean,		  
	  'reward_3rd' => $reward_3rd_clean,		  
	  'tournament_type' => $_POST['tournament_type'],		  
	  'registration_type' => $_POST['registration_type'],		  
	  'participant_fee' => $participant_fee_clean	  
	]);
	


	/*
	echo "
	<form action='chat.php' method='POST' id='formChatOpener'>
		<input type='text' name='chat_type' value='DM'>
		<input type='text' name='chat_room_uuidx' value='".$_POST['chat_room_uuidx']."'>
	</form>
	<body onload=\"document.getElementById('formChatOpener').submit();\">
	";
    */




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
    //$mail->addAddress("".$_POST['email']."", '');     //email tujuan
	$mail->addAddress("teguh.wijiyanto@gmail.com", '');     //email tujuan
	
    //$mail->addReplyTo('teguh@alterspace.gg', 'ALTER Mail'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addCC('teguh@alterspace.gg'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
    //$mail->addBCC('teguh@alterspace.gg'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content

	$otp = mt_rand(100000, 999999);

	$default_pswd = 'user123';
	
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
				<h4 style='font-size:18px;color: black;'>Your tournament has been successfully created</h4>
	";			
	
	$htmlContent .= "
    <section>
      <div class='container px-4'>
        <form action=''>
          <div
            class='d-flex flex-column align-items-center justify-content-center'
          >
            <img
              src='assets/ilustration/ilus__check-success.png'
              alt=''
              class='w-50'
            />	
          </div>
          <!-- Summary Start -->
          <div class='p-3 bg-dark rounded-3 mt-5'>
            <h5>Your tournament details :
			</h5>
            <div class='mt-3 d-flex flex-column gap-1' style='text-align:left; color: black;'>
			             
	  Tournament Code :<br><b>".$tournament_code."</b><br><br>
	  Tournament Name :<br><b>".$_POST["name"]."</b><br><br>   
	  Description :<br><b>".$_POST["description"]."</b><br><br>   
	  City :<br><b>".$_POST["selCity"]."</b><br><br>   
	  Date From :<br><b>".$_POST["date_from"]."</b><br><br>   
	  Date To :<br><b>".$_POST["date_to"]."</b><br><br>   
	  Game :<br><b>".$array_games[$_POST['selGameNameId']]."</b><br><br>   
	  Stage Type :<br><b>".$_POST['stage_type']."</b><br><br>
	  Format Type :<br><b>".$_POST['format_type']."</b><br><br>
	  Participant Type :<br><b>".$_POST["participant_type"]."</b><br><br>
	  Players per Team :<br><b>".$_POST['players_per_team']."</b><br><br>
	  Participant Number :<br><b>".$_POST["participant_number"]."</b><br><br>
	  1st Reward :<br><b>IDR ".$_POST['reward_1st']."</b><br><br>	  
	  2nd Reward :<br><b>IDR ".$_POST['reward_2nd']."</b><br><br>	  
	  3rd Reward :<br><b>IDR ".$_POST['reward_3rd']."</b><br><br>	  
	  Tournament Type :<br><b>".$_POST['tournament_type']."</b><br><br>	 
	  Registration Type :<br>".$_POST['registration_type']."</b><br><br>	
	  Participant Fee :<br>".$_POST['participant_fee']."</b><br><br>
	  
            </div>
          </div>
          <!-- Summary End -->
        </form>
      </div>
    </section>	  
	";

	$htmlContent .= "	
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
    $mail->Subject = "[ALTER] Your tournament (".$_POST['name'].") has been successfully created";
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




/*
	echo "
	<script>
		window.location.href='tournament.php';
	</script>
	";
*/

?>