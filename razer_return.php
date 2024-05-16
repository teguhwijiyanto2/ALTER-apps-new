<?php
$vkey ="c26fbcf925f4d4102908c742f4d0dbe0"; //Replace with your Razer Verify Key

/*

header("Location: index2.html");
exit;
*/


echo "tranID :: " . $_POST['tranID'];
echo "<br>";
echo "orderid :: " . $_POST['orderid'];
echo "<br>";
echo "status :: " . $_POST['status'];
echo "<br>";
echo "domain :: " . $_POST['domain'];
echo "<br>";
echo "amount :: " . $_POST['amount'];
echo "<br>";
echo "currency :: " . $_POST['currency'];
echo "<br>";
echo "appcode :: " . $_POST['appcode'];
echo "<br>";
echo "paydate :: " . $_POST['paydate'];
echo "<br>";
echo "skey :: " . $_POST['skey'];


/********************************
*Don't change below parameters
********************************/
$tranID     =    $_POST['tranID'];
$orderid     =    $_POST['orderid'];
$status     =    $_POST['status'];
$domain     =    $_POST['domain'];
$amount     =    $_POST['amount'];
$currency     =    $_POST['currency'];
$appcode     =    $_POST['appcode'];
$paydate     =    $_POST['paydate'];
$skey        =    $_POST['skey'];
//$team_code        =    $_POST['team_code'];



/***********************************************************
* To verify the data integrity sending by Razer
************************************************************/
$key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
$key1 = md5( $paydate.$domain.$key0.$appcode.$vkey );

if( $skey != $key1 ) $status= -1; // Invalid transaction. 
// Merchant might issue a requery to Razer to double check payment status with Razer.

if ( $status == "00" ) {
  if ( check_cart_amt($orderid, $amount) ) {
  /*** NOTE : this is a user-defined function which should be prepared by merchant ***/
  // action to change cart status or to accept order
  // you can also do further checking on the paydate as well
  // write your script here .....
  }
} else {
  // failure action. Write your script here .....
  // Merchant might send query to Razer using Merchant requery
  // to double check payment status for that particular order.
}

// Merchant is recommended to implement IPN once received the payment status
// regardless the status to acknowledge Razer system

/*
header("Location: index.html");
exit;
*/

function check_cart_amt( $orderid, $amount )
{
  /*** NOTE : this is a user-defined function which should be prepared by merchant ***/
	return true;
}
?>