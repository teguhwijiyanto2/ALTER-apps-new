<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

/*
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_uuid` varchar(100) DEFAULT NULL,
  `post_type` varchar(100) DEFAULT NULL,
  `post_text` text,
  `post_image` varchar(255) DEFAULT NULL,
  `post_video` varchar(255) DEFAULT NULL,
  `post_audio` varchar(255) DEFAULT NULL,
  `post_file_ext` varchar(10) DEFAULT NULL,
  `posted_by` bigint(20) DEFAULT NULL,
  `posted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/

	//$_SESSION["session_usr_id"]

	$unix_timestamp = date_create()->format('Uv');
	$rand = mt_rand(100000, 999999);
	$post_uuid = "".$rand."".$unix_timestamp."".$_SESSION["session_usr_id"]."";
	
	DB::insert('posts', [
	  'post_uuid' => $post_uuid,
	  'post_type' => $_POST['post_type'],
	  'post_text' => $_POST['post_text'],
	  'posted_by' => $_SESSION["session_usr_id"],
	  'posted_at' => date("Y-m-d H:i:s"),
	  'posted_to' => $_POST['xposted_to'],
	]);


if(isset($_FILES['file_1']['name']) && strlen($_FILES['file_1']['name']) > 3) {
	
	$uploadDirectory = "post_files/";

    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['file_1']['name'];
    $fileSize_1 = $_FILES['file_1']['size'];
    $fileTmpName_1  = $_FILES['file_1']['tmp_name'];
    $fileType_1 = $_FILES['file_1']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	
    $uploadPath_1 = $uploadDirectory . $_SESSION["session_usr_id"] . "." . $fileNameCleaned_1; 
      if (empty($errors_1)) {
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "The file " . basename($fileName_1) . " has been uploaded";
		  	DB::query("UPDATE posts set post_type='image', post_image=%s where post_uuid=%s", $_SESSION["session_usr_id"] . "." . $fileNameCleaned_1, $post_uuid);
		  
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(isset($_FILES['file_1']['name']) && strlen($_FILES['file_1']['name']) > 3) {

	if($_POST['xposted_to']==0) {
		echo("
		<script language='javascript'>
		window.location.href='user_profile.php';
		</script>
		");
	}
	else {
		echo("
		<script language='javascript'>
		window.location.href='profile.php?user_id_profile=".$_POST['xposted_to']."';
		</script>
		");	
	}


?>