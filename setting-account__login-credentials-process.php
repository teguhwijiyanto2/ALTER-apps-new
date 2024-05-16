<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require_once 'db.class.php';

    $user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $email_exist = DB::query("SELECT * FROM users WHERE users.id != %i AND users.email = %s", $user_profile["id"], $email);
    $phone_exist = DB::query("SELECT * FROM users WHERE users.id != %i AND users.phone = %s", $user_profile["id"], $phone);

    if(sizeof($email_exist)) {
        echo("
		<script language='javascript'>
        alert('Email sudah digunakan')
		window.location.href='setting-account__login-credentials.php';
		</script>
		");
    } 

    if(sizeof($phone_exist) && $phone) {
        echo("
		<script language='javascript'>
        alert('No. Hp sudah digunakan')
		window.location.href='setting-account__login-credentials.php';
		</script>
		");
    } 


    if($phone && $email) {
        DB::query("UPDATE users SET email=%s, phone=%s WHERE id=%i", $email, $phone, $user_profile["id"]);
        echo("
		<script language='javascript'>
        alert('Success Updated Login Credentials..')
		window.location.href='account_setting.php';
		</script>
		");
    } else if($email) {
        DB::query("UPDATE users SET email=%s WHERE id=%i", $email, $user_profile["id"]);
        echo("
		<script language='javascript'>
        alert('Success Updated Login Credentials..')
		window.location.href='account_setting.php';
		</script>
		");
    } else if($phone) {
        DB::query("UPDATE users SET phone=%s WHERE id=%i", $phone, $user_profile["id"]);
        echo("
		<script language='javascript'>
        alert('Success Updated Login Credentials..')
		window.location.href='account_setting.php';
		</script>
		");
    } else {
        echo("
		<script language='javascript'>
        alert('Email dan No. Hp tidak boleh dikosongkan jika sudah terisi.')
		window.location.href='setting-account__login-credentials.php';
		</script>
		");
    }
?>