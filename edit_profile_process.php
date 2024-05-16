<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require_once 'db.class.php';
    
    try {
        DB::query("UPDATE `users` SET `name` = %s WHERE `users`.`id` = %i;", $_POST["name"], $_SESSION["session_usr_id"]);
    } catch (\Throwable $th) {
        
    } finally {
        echo("
		<script language='javascript'>
        alert('Success Updated Profile..')
		window.location.href='account.php';
		</script>
		");
    }
?>