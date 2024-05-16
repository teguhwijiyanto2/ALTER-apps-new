<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

	$update = DB::query("UPDATE users set name=%s, username=%s, gender=%s, birthdate=%s where id=%s", $_POST['name'], $_POST['username'], $_POST['selGender'], $_POST['birthdate'], $_SESSION["session_usr_id"]);

	$_SESSION["session_usr_name"]=$_POST['name'];
	$_SESSION["session_usr_username"]=$_POST['username'];
	$_SESSION["session_usr_gender"]=$_POST['selGender'];
	$_SESSION["session_usr_birthdate"]=$_POST['birthdate'];

	echo("
	<script language='javascript'>
	window.location.href='preferences.php';
	</script>
	");
	

?>