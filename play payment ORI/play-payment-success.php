<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';

 
//$_SESSION["session_usr_id"] = $_GET['sid'];


	$results_check = DB::queryFirstRow("SELECT * FROM users where id=%i", $_GET['sid']);
	
	$_SESSION["session_usr_id"]=$results_check['id'];
	$_SESSION["session_usr_email"]=$results_check['email'];
	$_SESSION["session_usr_phone"]=$results_check['phone'];
	$_SESSION["session_usr_name"]=$results_check['name'];
	$_SESSION["session_usr_username"]=$results_check['username'];
	$_SESSION["session_usr_gender"]=$results_check['gender'];
	$_SESSION["session_usr_birthdate"]=$results_check['birthdate'];
	



$array_users_name = array();
$array_users_email = array();
$array_users_username = array();
$results_A = DB::query("SELECT * FROM users");
foreach ($results_A as $row_A) {
	$array_users_name[$row_A['id']] = "".$row_A['name']."";
	$array_users_email[$row_A['id']] = "".$row_A['email']."";
	$array_users_username[$row_A['id']] = "".$row_A['username']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

$array_cities = array();
$results_A = DB::query("SELECT * FROM cities order by name asc");
foreach ($results_A as $row_A) {
	$array_cities[$row_A['id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];


/*
			'mpsreturnurl'    => "https://beta.alterspace.gg/purchase-item-payment-success.php?sid=".$_POST['session_usr_id']."&id1=".$str_rand."&id2=".$your_orderid."&id3=".$_POST['cust_id_parameter']."&id4=".$_POST['type_1']."", 
			// id1 --> str_rand ; id2 --> order_id ; id3 --> cust_id_parameter (Phone Number / Game Account ID), untuk parameter custID di API purchase
*/


DB::query("UPDATE matchmaking_availability SET request_status='PAYMENT_SUCCESS' WHERE play_code=%s", $_GET["id1"]);

$play_data =  DB::queryFirstRow("SELECT * FROM `matchmaking_availability` WHERE play_code=%s", $_GET["id1"]);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/theme.css" />
    <script src="js/script.js"></script>
    <title>Payment Confirmation - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="home.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Payment Confirmed</span>
          </a>
        </div>
        <form action="">
          <div
            class="d-flex flex-column align-items-center justify-content-center"
          >
            <img
              src="assets/ilustration/ilus__check-success.png"
              alt=""
              class="w-50"
            />
			

					<h5 class='text__purple mb-0'>Payment Succesful</h5>
					<span class='text-secondary'>Enjoy your play</span>
				
			
          </div>
          
          <a
            href="home.php"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirmed
          </a>
        </form>
      </div>
	  	  
		<!-- Checker -->
		<!--
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo json_encode(json_decode($encodedData), JSON_PRETTY_PRINT); ?>  
		</div>
		
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo $StringToSign; ?>  
		</div>

		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo $signature; ?>  
		</div>
		
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo json_encode(json_decode($result_prepaidProduct), JSON_PRETTY_PRINT); ?>
		</div>
		-->
		
    </section>
	

  </body>
</html>
