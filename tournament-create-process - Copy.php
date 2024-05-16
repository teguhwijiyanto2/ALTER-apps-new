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


	echo "
	<script>
		window.location.href='tournament.php';
	</script>
	";


?>