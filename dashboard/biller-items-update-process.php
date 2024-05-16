<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::query("
	UPDATE billing_items_excel 	
	set client_price = %i
	where id=%i	
", $_POST['new_client_price'], $_POST['idx']);


	echo "<script>alert('Data successfully updated'); window.location.href='biller-items.php';</script>";
	
?>