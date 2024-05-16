<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

//purchase-item-success.php?sid=".$_POST['session_usr_id']."&idx".$your_orderid."

$_SESSION["session_usr_id"] = $_GET['sid'];
 
 
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
	DB::insert('purchase_items', [
	  'user_id' => $_SESSION["session_usr_id"],
	  'str_rand' => $str_rand,
	  'order_id' => $your_orderid,
	  'mpsvcode' => $mpsvcode,
	  'payee_code' => $_POST['payeeCode_1'],
	  'product_code' => $_POST['productCode_1'],
	  'name' => $_POST['name_1'],
	  'description' => $_POST['name_1'],
	  'type' => $_POST['name_1'],
	  'nominal' => $_POST['nominal_1'],
	  'client_price' => $_POST['clientPrice_1'],
	  'payment_method' => $_POST['xpayment_method'],
	  'currency' => $_POST['currency'],
	  'total_amount' => $_POST['total_amount'],
	  'payment_status' => 'Success',
	  'purchase_status' => '-',
	  'status' => 'Active',
	]);
*/

$results_purchased_item = DB::queryFirstRow("SELECT * FROM purchase_items where order_id=%s", $_GET['idx']);


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
          <a href="shophub.php">
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
            <h5 class="text__purple mb-0">Payment Succesful!</h5>
            <span class="text-secondary">Enjoy your purchased item</span>
          </div>
          <!-- Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-5">
            <h5>Summary</h5>
            <div class="mt-3 d-flex flex-column gap-1">
			             
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Item Name</span>
                <span class="text-light fs-5"><?php echo $results_purchased_item['name']; ?></span>
              </div>

			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Description</span>
                <span class="text-light fs-5"><?php echo $results_purchased_item['description']; ?></span>
              </div>

              <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Total Paid</span>
                <span class="text-light fs-5">IDR <?php echo number_format($results_purchased_item['total_amount']); ?></span>
              </div>
              
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Payment Method</span>
                <span class="text-light fs-5"><?php echo $results_purchased_item['payment_method']; ?></span>
              </div>			  
              
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Payment Time</span>
                <span class="text-light fs-5"><?php echo $results_purchased_item['payment_time']; ?></span>
              </div>
			  
            </div>
          </div>
          <!-- Summary End -->
          <a
            href="shophub.php"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirmed
          </a>
        </form>
      </div>
    </section>
  </body>
</html>
