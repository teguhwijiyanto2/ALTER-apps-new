<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
// print_r($_POST);
// exit;

$check = DB::queryFirstRow("SELECT * FROM subscription_setting WHERE user_id = %i AND type = %s",$_SESSION["session_usr_id"],$_POST['type']);

if($check) {
	DB::query("UPDATE subscription_setting SET  name_account='".$_POST['nama_akun']."', number='".$_POST['number']."' WHERE id = '".$check['id']."'");

}else {
    DB::insert('subscription_setting', [
        'user_id' =>  $_SESSION["session_usr_id"],	  
        'name_account' => $_POST["nama_akun"],
        'number' => $_POST["number"],
        'type' => $_POST["type"],
    ]);
}

echo "
<script>
    alert('Success Update Subscription Setting.');
    window.location.href='subscriptions__payment-information.php';
</script>
";

// CREATE TABLE `alter_apps_db`.`subscription_setting` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `user_id` BIGINT(20) NOT NULL , `name_account` VARCHAR(255) NOT NULL , `number` VARCHAR(255) NOT NULL , `type` VARCHAR(50) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

?>




<!-- CREATE TABLE `alter_apps_db`.`subscription_billing` ( `id` BIGINT(20) NOT NULL , `user_id` BIGINT(20) NOT NULL , `address` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB; -->