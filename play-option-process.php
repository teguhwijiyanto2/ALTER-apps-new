<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
// print_r($_POST);
// exit;
$availableDate = explode(",", $_POST['tanggal-input']);

$check = DB::queryFirstRow("SELECT * FROM matchmaking_option WHERE user_id = %i",$_SESSION["session_usr_id"]);

if($check) {
	
	$fee = $_POST["fee"];
	$fee = str_ireplace('.','',$fee);
	$fee = str_ireplace(',','',$fee);
	
	DB::query("UPDATE matchmaking_option SET game='".json_encode($_POST['game'])."', fee='".$fee."', time='".$_POST['time']."', available_date='".json_encode($availableDate)."', available = '".$_POST['available']."' WHERE id = '".$check['id']."'");

}else {
	
	$fee = $_POST["fee"];
	$fee = str_ireplace('.','',$fee);
	$fee = str_ireplace(',','',$fee);
	
    DB::insert('matchmaking_option', [
        'user_id' =>  $_SESSION["session_usr_id"],	  
        'game' => json_encode($_POST['game']),
        'fee' => $fee,
        'time' => $_POST["time"],
        'available' => $_POST['available'],
        'available_date' => json_encode($availableDate),
    ]);
}

echo "
<script>
    alert('Success Update Play Option.');
    window.location.href='setting__play-options.php';
</script>
";


?>




<!-- CREATE TABLE `alter_apps_db`.`matchmaking_option` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `user_id` BIGINT(20) NOT NULL , `game` TEXT NOT NULL , `fee` VARCHAR(50) NOT NULL , `time` VARCHAR(50) NOT NULL , `available` VARCHAR(50) NULL , `available_date` TEXT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->