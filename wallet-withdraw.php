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
    <title>Withdraw Balance</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="wallet.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Withdraw Balance</span>
          </a>
        </div>

        <!-- Total Balance Start -->
        <section class="bg__gradient-violet rounded-3 p-3">
          <div class="text-white-50 text-center">Total Balance</div>
          <div class="fs-4 text-center">IDR <?php echo number_format($user_profile['user_wallet']); ?></div>
        </section>
        <!-- Total Balance End -->

        <!-- List Wallet Start -->
        <section class="mt-3">
          <div class="wallet-group mt-4">
            <h6>E-Wallet</h6>
            <div class="list-wrapper">
              <a
                data-wallet="gopay"
                href="#"
                class="list__item"
              >
                <div onclick="window.location.href='wallet-withdraw-form.php?ch=GoPay';" style="cursor:pointer;"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-gopay.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">GoPay</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
              </a>
			  
              <div onclick="window.location.href='wallet-withdraw-form.php?ch=DANA';" style="cursor:pointer;"
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-dana.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">DANA</span>
                <i class="bi bi-chevron-right"></i>
              </div>
			  
              <div onclick="window.location.href='wallet-withdraw-form.php?ch=OVO';" style="cursor:pointer;"
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-ovo.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">OVO</span>
                <i class="bi bi-chevron-right"></i>
              </div>
              
			  <div onclick="window.location.href='wallet-withdraw-form.php?ch=ShoopePay';" style="cursor:pointer;"
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-shoope.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">ShoopePay</span>
                <i class="bi bi-chevron-right"></i>
              </div>
			  
            </div>
          </div>
          <div class="wallet-group mt-4">
            <h6>Bank</h6>
            <div class="list-wrapper">
              <div onclick="window.location.href='wallet-withdraw-form.php?ch=Bank';" style="cursor:pointer;"
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-debit.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Bank Account</span>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
        </section>
        <!-- List Wallet End -->
      </div>
    </section>

    <script>
      $(document).ready(function () {
        // Get Wallet Value
        $(".list__item").on("click", function () {
          var wallet = $(this).data("wallet");
          console.log(wallet);
        });
      });
    </script>
  </body>
</html>
