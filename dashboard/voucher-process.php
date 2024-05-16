<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 10; $i++) {
	$randomString .= $characters[random_int(0, $charactersLength - 1)];
}

if(isset($_POST['idx'])) {
	DB::query("UPDATE voucher set 
		name='".$_POST['name']."', 
		description='".$_POST['description']."',
		date_from='".$_POST['date_from']."',
		date_to='".$_POST['date_to']."',
		value='".$_POST['value']."',
		minimun_purchase='".$_POST['minimun_purchase']."',
		type='".$_POST['type']."',
		category='".$_POST['category']."'
		where id=".$_POST['idx']
		);
}else {
	DB::insert('voucher', [
		'name' => $_POST['name'],
		'creator_id' => $_SESSION["session_usr_id"],
		'description' => $_POST['name'],
		'date_from' => $_POST['date_from'],
		'date_to' => $_POST['date_to'],
		'value' => $_POST['value'],
		'minimun_purchase' => $_POST['minimun_purchase'],
		'type' => $_POST['type'],
		'category' => $_POST['category'],
		'code' => $randomString
	  ]);
}

echo("
        <script language='javascript'>
        window.location.href='voucher.php';
        </script>
      ");

?>