<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';



/*** Start Processing Submitted Form Above ***/
if( isset($_POST['payment_options']) && $_POST['payment_options'] != "" ) {

		
			$merchantid = "EP000514";	// Change to your merchant ID
			$vkey = "c26fbcf925f4d4102908c742f4d0dbe0";	// Change to your verify key
	
/*
			$merchantid = "EP000270";	// PROD
			$vkey = "b3a34cb9f6d51812fba0112b282df01a";	// PROD
*/	
	
 // Put your own code/process HERE. (Eg: Insert data to DB)
 /*
 $your_orderid = "TEST".rand();
 $your_process_status = true;
 */
 
 
  // Put your own code/process HERE. (Eg: Insert data to DB)
 //$your_orderid = "T".$_POST['tournament_codex'].$_POST['team_codex'];
 //$your_orderid = "".rand()."TNM".$_POST['tournament_codex'].$_POST['team_codex'];
 //$your_orderid = "T".rand()."-".$_POST['tournament_idx']."-".$_POST['team_codex']."-".$_POST['payment_options'][0]."";
 //$your_orderid = "".$_POST['team_codex']."-".$_POST['xpayment_method']."-".rand()."-".$_POST['session_usr_id']."";   
 $your_orderid = "".$_POST['team_codex']."-".$_POST['xpayment_method']."-".rand()."";   
 //orderID ori :: 7jyiMZNRIq-e2Pay_DANA-11964604977jyiMZNRIq-18sN2DiLlcd-1633137452
 //$your_orderid = "TEST_".rand();
 $your_process_status = true;

	if( $your_process_status === true ) {
		
/*
  CREATE TABLE IF NOT EXISTS `tournament_teams` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tournament_code` varchar(100) DEFAULT NULL,
  `players_per_team` int(11) DEFAULT '1',
  `team_code` varchar(100) DEFAULT NULL,
  `team_logo` varchar(255) DEFAULT NULL,
  `team_name` varchar(100) DEFAULT NULL,
  `single_player_id` bigint(20) DEFAULT NULL,
  `single_player_email` varchar(100) DEFAULT NULL,
  `single_player_username` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `registration_type` varchar(100) DEFAULT NULL,
  `participant_fee` int(11) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_detail` text,
  `payment_description` text,
  `payment_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
*/


$results_UPDATE = DB::query("UPDATE tournament_teams set 
payment_method=%s, 
payment_amount=%i,
payment_detail='',
payment_description='',
payment_timestamp=now()
where team_code=%s", 
$_POST['xpayment_method'],
$_POST['total_amount'],
$_POST['team_codex']
);


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
						
			'mpscancelurl'	  => "https://beta.alterspace.gg/cancel_order.php",
			//'mpsreturnurl'    => "https://beta.alterspace.gg/razer_return.php",
			'mpsreturnurl'    => "https://beta.alterspace.gg/tournament-registration-pay-success.php?sid=".$_POST['session_usr_id']."&tmcode=".$_POST['team_codex']."&trncode=".$_POST['tournament_codex']."",
			
			/*
			'mpscancelurl'	  => "http://localhost:8001/cancel_order.php",
			//'mpsreturnurl'    => "http://localhost:8001/razer_return.php",
			'mpsreturnurl'    => "http://localhost:8001/tournament-registration-pay-success.php?sid=".$_POST['session_usr_id']."",			
			*/
			
			'mpsapiversion'   => "3.28"				
			
		);
	} elseif( $your_process_status === false ) {
		$params = array(
			'status'          => false,      // Set False to show an error message.
			'error_code'	  => "Your Error Code (Eg: 500)",
			'error_desc'      => "Your Error Description (Eg: Internal Server Error)",
			'failureurl'      => "index.html"
		);
	}
}
else
{
	$params = array(
		'status'          => false,      // Set False to show an error message.
		'error_code'	  => "500",
		'error_desc'      => "Internal Server Error",
		'failureurl'      => "index.html"
	);
}
echo json_encode( $params );
exit();
?>