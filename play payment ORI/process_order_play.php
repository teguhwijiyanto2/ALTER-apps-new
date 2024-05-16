<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';


/*** Start Processing Submitted Form Above ***/
if( isset($_POST['payment_options']) && $_POST['payment_options'] != "" ) {


/*		
			$merchantid = "EP000514";	// Change to your merchant ID
			$vkey = "c26fbcf925f4d4102908c742f4d0dbe0";	// Change to your verify key
*/

			$merchantid = "EP000270";	// PROD
			$vkey = "b3a34cb9f6d51812fba0112b282df01a";	// PROD


		$rand = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$str_rand = substr(str_shuffle($rand), 0, 9);

		$your_orderid = "".$_POST['play_code']."";
 
		$mpsvcode = md5($_POST['total_amount'].$merchantid.$your_orderid.$vkey);
		
		/*
		DB::insert('purchase_items', [
		  'user_id' => $_SESSION["session_usr_id"],
		  'str_rand' => $str_rand,
		  'order_id' => $your_orderid,
		  'mpsvcode' => $mpsvcode,
		  'payee_code' => $_POST['payeeCode_1'],
		  'product_code' => $_POST['productCode_1'],
		  'name' => $_POST['name_1'],
		  'description' => "".$_POST['type_1']." |  ".$_POST['sub_category_1']." | ".$_POST['cust_id_parameter']."",
		  'type' => $_POST['type_1'],
		  'nominal' => $_POST['nominal_1'],
		  'client_price' => $_POST['clientPrice_1'],
		  'payment_method' => $_POST['xpayment_method'],
		  'currency' => $_POST['currency'],
		  'total_amount' => $_POST['total_amount'],
		  'status' => 'Active',
		  'transaction_time' => ''.date('Y-m-d H:i:s').'',
		]);
		*/
		
		
		$params = array(
			'status'          => true,	// Set True to proceed with Razer
			'mpsmerchantid'   => $merchantid,
			'mpschannel'      => $_POST['payment_options'],
			'mpsamount'       => $_POST['total_amount'],
			'mpsorderid'      => $your_orderid,
			'mpsbill_name'    => $_POST['billingFirstName']." ".$_POST['billingLastName'],
			'mpsbill_email'   => $_POST['billingEmail'],
			'mpsbill_mobile'  => $_POST['billingMobile'],
			'mpsbill_desc'    => $_POST['billingAddress'],
			'mpscountry'      => "MY",
			'mpsvcode'        => md5($_POST['total_amount'].$merchantid.$your_orderid.$vkey),
			'mpscurrency'     => $_POST['currency'],
			'mpslangcode'     => "en",
			//'mpsextra'     	  => base64_encode("1#mpd_tonton:10.00"),
			'mpstimer'	      => isset($_POST['razertimer']) ?(int)$_POST['razertimer'] : '',
			'mpstimerbox'	  => "#counter",
					
			'mpscancelurl'	  => "https://beta.alterspace.gg/purchase-item-payment-fail.php?sid=".$_POST['session_usr_id']."&id1=".$str_rand."&id2=".$your_orderid."&id3=".$_POST['cust_id_parameter']."&id4=".$_POST['type_1']."",
			//'mpsreturnurl'    => "https://beta.alterspace.gg/razer_return.php",
			'mpsreturnurl'    => "https://beta.alterspace.gg/play-payment-success.php?sid=".$_POST['session_usr_id']."&id1=".$your_orderid."",  
			
			/*
			'mpscancelurl'	  => "http://localhost:8001/cancel_order.php",
			//'mpsreturnurl'    => "http://localhost:8001/razer_return.php",
			'mpsreturnurl'    => "http://localhost:8001/tournament-registration-pay-success.php?sid=".$_POST['session_usr_id']."",			
			*/
			
			'mpsapiversion'   => "3.28"		
		);			
			
	echo json_encode( $params );
	exit();

} // if( isset($_POST['payment_options']) && $_POST['payment_options'] != "" ) {
?>