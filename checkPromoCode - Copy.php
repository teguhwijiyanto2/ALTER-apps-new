<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

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



$count = DB::queryFirstField("
SELECT COUNT(*) FROM promo WHERE promo_code='".$_GET['q']."' AND (item_category=0 OR item_category=".$_GET['item_type'].") AND date_from<=CURDATE() AND date_to>=CURDATE() AND min_purchase<=".$_GET['amount_purchase']." AND num_available>0 AND STATUS='Active'");

//echo $count;


if($count > 0) {
	//echo "<i class='bi bi-check-circle-fill fs-3 text-success'></i>";
	//echo $count;
	
	$result = DB::queryFirstRow("
	SELECT * FROM promo WHERE promo_code='".$_GET['q']."' AND (item_category=0 OR item_category=".$_GET['item_type'].") AND date_from<=CURDATE() AND date_to>=CURDATE() AND min_purchase<=".$_GET['amount_purchase']." AND num_available>0 AND STATUS='Active'");

	$potongan = $result['promo_value'];
	if($result['discount_cashback_type']=="%") {
		$potongan = $result['promo_value'] / 100 * $_GET['amount_purchase'];
	}

	$total_amount_discounted = $_GET['amount_purchase'] - $potongan;

	// echo "<i class='bi bi-check-circle-fill fs-3 text-success'></i>|".ceil($potongan)."|".ceil($total_amount_discounted)."|".$_GET['amount_purchase']."|IDR ".number_format(ceil($potongan))."|IDR ".number_format(ceil($total_amount_discounted))."|IDR ".number_format($_GET['amount_purchase'])."|".$_GET['q']."";
	// CEKLIST|1234|2345|3456|IDR 1.234|IDR 2.345|IDR 3.456
	
} // if($count > 0) {
else {
	//echo "-|0|".$_GET['amount_purchase']."|".$_GET['amount_purchase']."|0|IDR ".number_format($_GET['amount_purchase'])."|-|-";	
}


echo $count;

//echo "<i class='bi bi-check-circle-fill fs-3 text-success'></i>";
//echo $_GET['q'];
//echo $_GET['amount_purchase'];
//echo $_GET['item_type'];

?>