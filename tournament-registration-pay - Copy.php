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

$results_tournament = DB::queryFirstRow("SELECT * FROM tournament where id=%i", $_POST['tournament_idx']);
$results_team = DB::queryFirstRow("SELECT * FROM tournament_teams where team_code=%i", $_POST['team_codex']);

/*
			echo "
				  <input type='text' name='tournament_idx' value='".$_POST['tournament_idx']."'>
				  <input type='text' name='tournament_codex' value='".$_POST['tournament_codex']."'>
				  <input type='text' name='team_codex' value='".$team_code."'>
				  <input type='text' name='xplayers_per_team' value='".$_POST['xplayers_per_team']."'>
				  <input type='text' name='xregistration_type' value='".$_POST['xregistration_type']."'>
				  <input type='text' name='xparticipant_fee' value='".$_POST['xparticipant_fee']."'>
				  </form>
				  <body onload=\"document.getElementById('formTournamentRegistrationConfirmation').submit();\">
				 ";
*/

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
    <title>Payment - Alter</title>
	
	<script 
	src="https://pg-uat.e2pay.co.id/RMS/API/seamless/3.28/js/MOLPay_seamless.deco.js"></script>
	<script>
	$(document).ready( function(){		
		$('#selector').change(function(){
			var cur = $(this).val();
			$(".cur_span").text(cur);
			$("#currency").val(cur);
			$("input[name='total_amount']").val("10000");
			$("span.price_span").text(" 10000");
			
			$(".idr").show();
			
		});
		
		$('input[name=payment_options]').on('click', function(){
			var $myForm = $(this).closest('form');
			if ($myForm[0].checkValidity()) {
				$myForm.trigger("submit");
			}
			else
			{
				alert("Please fill in required field.");
				$(":input[required]").each(function () {
					if($(this).val().length == 0)
					{
						$(this).focus();
						return false;
					}
				});
			}
		});
	});
	</script>
	
  </head>

  <body>
  <form method="POST" action="process_order.php" role="molpayseamless">
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="registration-overview__paid.html">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Payment Page</span>
          </a>
        </div>
        <form action="payment-confirmation.html">
          <!-- Payment Method Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <h4>Payment Method</h4>
              <span id="open_popup" class="text-primary cursor__pointer"
                >See all</span
              >
            </div>
            <div aria-label="Payment Method Card" class="">
              <label
                aria-label="alter-wallet"
                class="position-relative text-start d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="option1"
              >
                <img
                  src="assets/icon/ic__wallet.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
                <div class="flex-fill">
                  <h5 class="mb-0">Alter Wallet</h5>
                  <span class="text-secondary">Rp. 500.000</span>
                </div>
                <input
                  type="radio"
                  class="me-4"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  checked
                />
              </label>
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="option2"
              >
                <img
                  src="assets/icon/ic__pay-gopay.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
                <div class="flex-fill">
                  <h5 class="mb-0">DANA</h5>
                </div>
                <input
                  type="radio"
                  class="me-4"
                  name="payment_options"
                  id="payment_options"
                  autocomplete="off"
				  value="e2Pay_DANA" required
                />
				
              </label>
            </div>
          </div>
          <!-- Payment Method End -->

          <!-- Promo Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Promo</h5>
            <p class="text-secondary">You can add your promo code below</p>

            <div class="form__group-input mt-4">
              <input type="text" name="" placeholder="PromoCodeAlter" />
              <i class="bi bi-check-circle-fill fs-3 text-success"></i>
            </div>
          </div>
          <!-- Promo End -->

          <!-- Payment Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Payment Summary</h5>

            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Total in Cart</span>
                <span>IDR <?php echo number_format($results_tournament['participant_fee']); ?></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-light border-top mt-2 pt-2 border-secondary"
              >
                <span>Total Payment</span>
                <span class="fs-5">IDR <?php echo number_format($results_tournament['participant_fee']); ?></span>
              </div>
            </div>
          </div>
          <!-- Payment End -->
          <button type="submit" class="btn btn-primary rounded-pill my-4 w-100">
            Pay
          </button>
        </form>
      </div>
    </section>

    <!-- MODAL PAYMENT METHOD -->

    <div
      id="popup"
      class="position-absolute top-0 start-0 w-100 bg-dark z-3"
      style="display: none"
    >
      <div class="container px-4">
        <!-- Header Start -->
        <div
          class="sticky-top d-flex flex-row align-items-center justify-content-between py-3 border-bottom border-secondary border-opacity-50"
        >
          <h5>Choose Payment Method</h5>
          <i id="close_popup" class="bi bi-x-lg fs-5 cursor__pointer"></i>
        </div>
        <!-- Header End -->

        <!-- List Wallet Start -->
        <section>
          <div class="wallet-group mt-4">
            <h6>Ater Wallet</h6>
            <div class="list-wrapper">
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__wallet.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Alter Wallet</span>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
          <div class="wallet-group mt-4">
            <h6>QRIS</h6>
            <div class="list-wrapper">
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-qris.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">QRIS</span>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
          <div class="wallet-group mt-4">
            <h6>E-Wallet</h6>
            <div class="list-wrapper">
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-gopay.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Gopay</span>
                <i class="bi bi-chevron-right"></i>
              </div>
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-dana.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Dana</span>
                <i class="bi bi-chevron-right"></i>
              </div>
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-ovo.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Ovo</span>
                <i class="bi bi-chevron-right"></i>
              </div>
              <div
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
            <h6>Credit/Debit Card</h6>
            <div class="list-wrapper">
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-debit.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Credit/Debit Card</span>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
        </section>
        <!-- List Wallet End -->
      </div>
    </div>

    <script>
      $(document).ready(function () {
        $('#open_popup').click(function () {
          $('#popup').fadeIn();
        });
        $('#close_popup').click(function () {
          $('#popup').fadeOut();
        });
      });
    </script>
	
	</form>
  </body>
</html>
