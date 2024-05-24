<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$result = DB::query("UPDATE commission_fee set value = %i where id=%i", $_POST['value'], $_POST['idx']);

	echo "<script>window.location.href='commission-fee.php';</script>";
	
?>