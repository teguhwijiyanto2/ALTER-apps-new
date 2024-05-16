<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::query("
	UPDATE wallet_withdraw 	
	set is_withdraw_transferred='Y', transfer_id_1=%s, transfer_id_2=%s, transfer_id_3=%s, withdraw_transfer_time=now(),
	withdraw_transfer_status=%s, notes=%s	
	where id=%i	
", $_POST['transfer_id_1'], $_POST['transfer_id_2'], $_POST['transfer_id_3'], $_POST['withdraw_transfer_status'], $_POST['notes'], $_POST['idx']);

$result_2 = DB::query("update users set user_wallet = user_wallet - ".$_POST['total_amount1']." where id=%i", $_POST['user_id1']);


if($_POST['withdraw_transfer_status']=="Success") {
	echo "<script>window.location.href='withdraw-success.php';</script>";
} // if($_POST['withdraw_transfer_status']=="Success") {
	
if($_POST['withdraw_transfer_status']=="Pending") {
	echo "<script>window.location.href='withdraw-pending.php';</script>";
} // if($_POST['withdraw_transfer_status']=="Success") {	
	
if($_POST['withdraw_transfer_status']=="Fail") {
	echo "<script>window.location.href='withdraw-fail.php';</script>";
} // if($_POST['withdraw_transfer_status']=="Success") {	
?>