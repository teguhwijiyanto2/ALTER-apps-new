<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


	//$_SESSION["session_usr_id"]

	$unix_timestamp = date_create()->format('Uv');
	$rand = mt_rand(100000, 999999);
	$str_rand = "".$rand."".$unix_timestamp."".$_SESSION["session_usr_id"]."";
	


if(isset($_FILES['input_banner']['name']) && strlen($_FILES['input_banner']['name']) > 3) {
	
	$uploadDirectory = "user_banner_files/";

    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['input_banner']['name'];
    $fileSize_1 = $_FILES['input_banner']['size'];
    $fileTmpName_1  = $_FILES['input_banner']['tmp_name'];
    $fileType_1 = $_FILES['input_banner']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	$fileNameCleaned_1 = $str_rand . $fileNameCleaned_1;
	
    $uploadPath_1 = $uploadDirectory . $fileNameCleaned_1; 
      if (empty($errors_1)) {
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "The file " . basename($fileName_1) . " has been uploaded";
		  //echo "UPDATE users set user_banner_file='".$fileNameCleaned_1."' where id=".$_SESSION["session_usr_id"]."";
		    DB::query("UPDATE users set user_banner_file=%s where id=%i", $fileNameCleaned_1, $_SESSION["session_usr_id"]);
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(isset($_FILES['input_banner']['name']) && strlen($_FILES['input_banner']['name']) > 3) {




		echo("
		<script language='javascript'>
		window.location.href='user_profile.php';
		</script>
		");



?>