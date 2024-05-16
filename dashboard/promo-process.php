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
	DB::query("UPDATE promo set 
		name='".$_POST['name']."', 
		description='".$_POST['description']."',		
		promo_code='".$_POST['promo_code']."',
		item_category='".$_POST['item_category']."',
		discount_cashback_type='".$_POST['discount_cashback_type']."',		
		promo_value='".$_POST['promo_value']."',		
		date_from='".$_POST['date_from']."',
		date_to='".$_POST['date_to']."',
		min_purchase='".$_POST['min_purchase']."',
		quota='".$_POST['quota']."'
		where id=".$_POST['idx']
		);
}else {
	DB::insert('promo', [
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'promo_code' => $_POST['promo_code'],		
		'item_category' => $_POST['item_category'],
		'discount_cashback_type' => $_POST['discount_cashback_type'],
		'promo_value' => $_POST['promo_value'],
		'date_from' => $_POST['date_from'],
		'date_to' => $_POST['date_to'],
		'min_purchase' => $_POST['min_purchase'],
		'quota' => $_POST['quota'],
		'num_used' => 0,		
		'num_available' => $_POST['quota']
	  ]);
	  
	  /*
	  CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `promo_code` varchar(50) DEFAULT NULL,
  `promo_type` varchar(50) DEFAULT NULL,
  `single_user_id` bigint(20) DEFAULT NULL,
  `item_category` int(11) DEFAULT 0,
  `discount_cashback_type` varchar(50) DEFAULT NULL,
  `promo_value` int(11) DEFAULT 0,
  `date_from` date DEFAULT current_timestamp(),
  `date_to` date DEFAULT current_timestamp(),
  `min_purchase` int(11) DEFAULT 0,
  `quota` int(11) DEFAULT 0,
  `num_used` int(11) DEFAULT 0,
  `num_available` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
	*/
	
}


echo "
        <script language='javascript'>
        window.location.href='promo.php';
        </script>
      ";


?>