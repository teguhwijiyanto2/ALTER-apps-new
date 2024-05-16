<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';


$results_check = DB::queryFirstRow("SELECT * FROM users where email=%s order by id desc limit 0,1", $_POST['xmail']);

$submitted_otp = "".$_POST['otp_1']."".$_POST['otp_2']."".$_POST['otp_3']."".$_POST['otp_4']."".$_POST['otp_5']."".$_POST['otp_6']."";

if($submitted_otp == $results_check['otp']) {

	$_SESSION["session_usr_id"]=$results_check['id'];
	$_SESSION["session_usr_email"]=$results_check['email'];
	$_SESSION["session_usr_phone"]=$results_check['phone'];
	$_SESSION["session_usr_name"]=$results_check['name'];
	$_SESSION["session_usr_username"]=$results_check['username'];
	$_SESSION["session_usr_gender"]=$results_check['gender'];
	$_SESSION["session_usr_birthdate"]=$results_check['birthdate'];
	
	echo("
	<script language='javascript'>
	alert('Welcome to ALTER');
	window.location.href='profile-setup.php';
	</script>
	");
	// window.location.href='home.php';
	
} // if($submitted_otp == $results_check['otp']) {

else {
	echo("
	<script language='javascript'>
	alert('Invalid OTP number !!');
	window.location.href='otp-verification.php?mail=".$_POST['xmail']."';
	</script>
	");
}


?>