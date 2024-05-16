<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

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


$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

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
    <title>Add Liverstream - Alter</title>
  </head>

  <body>
    <section
      class="min-vh-100 d-flex flex-column align-items-start justify-content-start"
    >
      <div class="py-3 w-full p-3">
        <a href="payment.php">
          <i class="bi bi-x-lg fs-5 me-2"></i>
          <span>Payment Confirmed</span>
        </a>
      </div>
      <div
        class="p-3 flex-fill d-flex flex-column align-items-center justify-content-center"
      >
        <div
          class="d-flex flex-column align-items-center justify-content-center"
        >
          <img
            src="assets/ilustration/ilus__cam-livestream.png"
            alt=""
            class="w-50"
          />

          <h5 class="text__purple mt-5 mb-0">Ready to Livestream?</h5>
          <span class="text-light mt-2 text-center"
            >Simply log in with your Twitch account to seamlessly upload and
            share your own broadcasts</span
          >
        </div>
      </div>
      <div class="p-3 w-100">
        <div class="text-secondary text-center mb-2">
          Start your own Livestream with your Twitch Account
        </div>
        <a
          href="https://twitch.com"
          class="btn btn-outline-light w-100 rounded-pill"
        >
          Broadcast
        </a>
      </div>
    </section>
  </body>
</html>
