<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

session_destroy();

	echo("
	<script language='javascript'>
	alert('Bye... see you again in ALTER');
	window.location.href='auth.php';
	</script>
	");

?>