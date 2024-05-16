<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::query("UPDATE admin_fee set value = %i where id=%i", $_POST['value'], 1);

	echo "<script>window.location.href='admin-fee.php';</script>";
	
?>