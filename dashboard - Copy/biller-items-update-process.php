<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::query("
	UPDATE biller_items 	
	set mark_up = %i, alter_price = e2pay_price + (e2pay_price * %i / 100)
	where id=%i	
", $_POST['mark_up'], $_POST['mark_up'], $_POST['idx']);


	echo "<script>window.location.href='biller-items.php';</script>";
	
?>