<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


/*** Start Processing Submitted Form Above ***/
if( isset($_POST['payment_options']) && $_POST['payment_options'] != "" ) {

	$merchantid = "EP000514";	// Change to your merchant ID
	$vkey = "c26fbcf925f4d4102908c742f4d0dbe0";	// Change to your verify key

	
 // Put your own code/process HERE. (Eg: Insert data to DB)
 //$your_orderid = "T".$_POST['tournament_codex'].$_POST['team_codex'];
 //$your_orderid = "".rand()."TNM".$_POST['tournament_codex'].$_POST['team_codex'];
 //$your_orderid = "T".rand()."-".$_POST['tournament_idx']."-".$_POST['team_codex']."-".$_POST['payment_options'][0]."";
 //$your_orderid = "".$_POST['team_codex']."-".$_POST['xpayment_method']."-".rand()."";
 //orderID ori :: 7jyiMZNRIq-e2Pay_DANA-11964604977jyiMZNRIq-18sN2DiLlcd-1633137452
 $your_orderid = "TEST_".rand();
 
echo  "your_orderid" . $your_orderid;
 
 $your_process_status = true;
 
	if( $your_process_status === true ) {
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
			'mpscancelurl'	  => "http://localhost:8001/cancel_order.php",
			//'mpsreturnurl'    => "http://localhost:8001/razer_return.php",
			'mpsreturnurl'    => "http://localhost:8001/tournament-registration-pay-success.php",
			'mpsapiversion'   => "3.28"
		);
	} elseif( $your_process_status === false ) {
		$params = array(
			'status'          => false,      // Set False to show an error message.
			'error_code'	  => "Your Error Code (Eg: 500)",
			'error_desc'      => "Your Error Description (Eg: Internal Server Error)",
			'failureurl'      => "home.php"
		);
	}
}
else
{
	$params = array(
		'status'          => false,      // Set False to show an error message.
		'error_code'	  => "500",
		'error_desc'      => "Internal Server Error",
		'failureurl'      => "home.php"
	);
}
echo json_encode( $params );
exit();
?>