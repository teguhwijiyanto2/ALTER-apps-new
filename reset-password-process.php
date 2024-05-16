<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$count = DB::queryFirstField("SELECT COUNT(*) FROM users where id=%s and otp=%s ", $_POST['id'], $_POST['token']);

if(strlen($_POST['password']) < 8) {
	echo "<script>window.location.href='reset-password.php?token=".$_POST['token']."&id=".$_POST['id']."&e=1'</script>";
}

if($_POST['password'] != $_POST['confirm-password']){
	echo "<script>window.location.href='reset-password.php?token=".$_POST['token']."&id=".$_POST['id']."&e=2'</script>";
}


// print_r($_POST);
// echo $count;
// exit;
if($count == 0) {
    echo "<script>alert('Reset password expired !'); window.location.href='auth.php';</script>";
	exit();
} 
	
	DB::query("UPDATE users SET `password`='".md5($_POST['confirm-password'])."' WHERE id = '".$_POST['id']."' and `otp` = '".$_POST['token']."'");

    //echo 'Message has been sent';
	echo "<script>alert('Reset password success !'); window.location.href='login.php?s=email'</script>";
	exit();



?>