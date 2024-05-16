<?php
	if(!$_SESSION["session_usr_id"] || $_SESSION["session_usr_id"]=="" || $_SESSION["session_usr_id"]==NULL || is_null($_SESSION["session_usr_id"])) {
		
		session_destroy();

		echo("
		<script language='javascript'>
		window.location.href='login.php?s=email';
		</script>
		");
		
	}
?>