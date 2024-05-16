<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

if(md5($_POST['chk_password']) == $user_profile['password']) {
	
		/*
		CREATE TABLE IF NOT EXISTS `wallet_withdraw` (
		  `id` bigint(20) NOT NULL,
		  `user_id` bigint(20) DEFAULT NULL,
		  `amount` int(11) DEFAULT NULL,
		  `fee` int(11) DEFAULT NULL,
		  `total_amount` int(11) DEFAULT NULL,
		  `withdraw_request_time` datetime DEFAULT NULL,
		  `withdraw_id_1` varchar(100) DEFAULT NULL,
		  `withdraw_id_2` varchar(100) DEFAULT NULL,
		  `withdraw_id_3` varchar(100) DEFAULT NULL,
		  `is_withdraw_transferred` varchar(3) DEFAULT NULL,
		  `withdraw_transfer_time` datetime DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		*/


		DB::insert('wallet_withdraw', [
		  'user_id' => $_SESSION["session_usr_id"],
		  'amount' => str_ireplace(",","",$_POST['amount']),
		  'fee' => 0,
		  'total_amount' => str_ireplace(",","",$_POST['amount']),
		  'withdraw_request_time' => date('Y-m-d H:i:s'),
		  'withdraw_id_1' => $_POST['withdraw_id_1'],
		  'withdraw_id_2' => $_POST['withdraw_id_2'],
		  'withdraw_id_3' => $_POST['withdraw_id_3']	  
		]);
		
			echo "
			<script>
				window.location.href='wallet.php';
			</script>
			";
		
} // if(md5($_POST['chk_password']) == md5($user_profile['password'])) {

else {

			echo "
			<script>
				alert('Your password is invalid !');
				window.location.href='wallet.php';
			</script>
			";	
		
} // else {

?>