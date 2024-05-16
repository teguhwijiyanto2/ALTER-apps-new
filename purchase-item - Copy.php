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



/*
			  <form action='purchase-item.php' method='POST' id='formPurchase_".$item_no."'>
				<input type='hidden' name='payeeCode_1' value='".$data_response['payeeCode']."'>
				<input type='hidden' name='productCode_1' value='".$data_response['productCode']."'>
				<input type='hidden' name='name_1' value='".$data_response['name']."'>
				<input type='hidden' name='description_1' value='".$data_response['description']."'>
				<input type='hidden' name='type_1' value='".$data_response['type']."'>
				<input type='hidden' name='nominal_1' value='".$data_response['nominal']."'>
				<input type='hidden' name='clientPrice_1' value='".$data_response['clientPrice']."'>
			  </form>
*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <title>Purchase Item - Alter</title>
	
	<!--
	<script 
	src="https://pg-uat.e2pay.co.id/RMS/API/seamless/3.28/js/MOLPay_seamless.deco.js"></script>
	-->

	<script 
	src="https://pg.e2pay.co.id/RMS/API/seamless/3.28/js/MOLPay_seamless.deco.js"></script>
		
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
				//$myForm.trigger("submit");
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
<form method="POST" action="process_order_purchase_item.php" role="molpayseamless">
<input type='hidden' name='session_usr_id' value='<?php echo $_SESSION["session_usr_id"]; ?>'>


<div style="display:none;">
<span class="cur_span">IDR</span><span class="price_span"> <?php echo $_POST['clientPrice_1']; ?> </span>
<input type="fname" class="form-control" name="billingFirstName" id="billingFirstName" value="Razer" required>
<input type="lname" class="form-control" name="billingLastName" id="billingLastName" value="Demo" required>
<input type="mobile" class="form-control" name="billingMobile" id="billingMobile" value="55218438" required>
<input type="email" class="form-control" name="billingEmail" id="billingEmail" value="demo@razer.com" required>
<input type="address" class="form-control" name="billingAddress" id="billingAddress" value="J-39-1, Block J, Jalan Multimedia, I-City" required>
<input type="city" class="form-control" name="billingCity" id="billingCity" value="Selangor" required>
<input type="state" class="form-control" name="billingState" id="billingState" value="Shah Alam" required>
<input type="poscode" class="form-control" name="billingPostcode" id="billingPostcode" value="40000" required>

<input type='hidden' name='payeeCode_1' value='<?php echo $_POST['payeeCode_1']; ?>'>
<input type='hidden' name='productCode_1' value='<?php echo $_POST['productCode_1']; ?>'>
<input type='hidden' name='name_1' value='<?php echo $_POST['name_1']; ?>'>
<input type='hidden' name='description_1' value='<?php echo $_POST['description_1']; ?>'>
<input type='hidden' name='type_1' value='<?php echo $_POST['type_1']; ?>'>
<input type='hidden' name='nominal_1' value='<?php echo $_POST['nominal_1']; ?>'>
<input type='hidden' name='clientPrice_1' value='<?php echo $_POST['clientPrice_1']; ?>'>

<input type="hidden" name="xpayment_method" id="xpayment_method" value="" />
<input type="hidden" name="currency" id="currency" value="IDR" />
<input type="hidden" name="total_amount" value="<?php echo $_POST['clientPrice_1']; ?>" />
<!--<input type="hidden" name="total_amount" value="10000" />-->
</div>

					
					
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="shophub.php">
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
			  <!--
              <span id="open_popup" class="text-primary cursor__pointer"
                >See all</span
              >
			  -->
            </div>
            <div aria-label="Payment Method Card" class="">
			

              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_PERMATA_VA"
              >
                <img
                  src="assets/icon/ic__pay-permata.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">PERMATA (VA)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_PERMATA_VA" value="e2Pay_PERMATA_VA" class="me-4" required/>			  
			  </label>
<!--
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_ALFAMART"
              >
                <img
                  src="assets/icon/ic__pay-alfamart.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">ALFAMART</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_ALFAMART" value="payment_options_e2Pay_ALFAMART" class="me-4" required/>			  
			  </label>
-->
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_BNI_VA"
              >
                <img
                  src="assets/icon/ic__pay-bni.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">BNI (VA)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_BNI_VA" value="e2Pay_BNI_VA" class="me-4" required/>			  
			  </label>
			  
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options"
              >
                <img
                  src="assets/icon/ic__pay-dana.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
                <div class="flex-fill">
                  <h5 class="mb-0">DANA</h5>
                </div>
				<input type="radio" name="payment_options" id="payment_options1" value="e2Pay_DANA" class="me-4" autocomplete="off" required 
					onclick="document.getElementById('xpayment_method').value = this.value;">
              </label>			  	  
			  		
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_CIMB_VA"
              >
                <img
                  src="assets/icon/ic__pay-niaga.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">CIMB NIAGA (VA)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_CIMB_VA" value="e2Pay_CIMB_VA" class="me-4" required/>			  
			  </label>	
<!--
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_BRI_VA"
              >
                <img
                  src="assets/icon/ic__pay-bri.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">BRI (VA)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_BRI_VA" value="e2Pay_BRI_VA" class="me-4" required/>			  
			  </label>
-->			  
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_MANDIRI_VA"
              >
                <img
                  src="assets/icon/ic__pay-mandiri.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">MANDIRI (VA)</h5>
				</div>
				<span class="idr">
				<input type="radio" name="payment_options" id="payment_options_e2Pay_MANDIRI_VA" value="e2Pay_MANDIRI_VA" class="me-4" required/>			  
				</span>
			  </label>				  
			  
			  			  
			  
			  <!--					
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options"
              >
                <img
                  src="assets/icon/ic__pay-ovo.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
                <div class="flex-fill">
                  <h5 class="mb-0">OVO</h5>
                </div>
				<input type="radio" name="payment_options" id="payment_options2" value="e2Pay_OVO" class="me-4" autocomplete="off" required 
					onclick="document.getElementById('xpayment_method').value = this.value;">
              </label>	
			  					
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_BCA_VA"
              >
                <img
                  src="assets/icon/ic__pay-bca.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">BCA (VA)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_BCA_VA" value="e2Pay_BCA_VA" class="me-4" required/>			  
			  </label>			
              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options_e2Pay_SHOPEEPAY_JUMPAPP"
              >
                <img
                  src="assets/icon/ic__pay-bca.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
				<div class="flex-fill">
					<h5 class="mb-0">SHOPEEPAY (JUMPAPP)</h5>
				</div>
				<input type="radio" name="payment_options" id="payment_options_e2Pay_SHOPEEPAY_JUMPAPP" value="e2Pay_SHOPEEPAY_JUMPAPP" class="me-4" required/>			  
			  </label>				  

              <label
                aria-label="other-pay"
                class="position-relative d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
                for="payment_options"
              >
                <img
                  src="assets/icon/ic__pay-linkaja.png"
                  class="rounded-2 ratio-1x1"
                  height="56"
                  width="56"
                />
                <div class="flex-fill">
                  <h5 class="mb-0">LinkAja</h5>
                </div>
				<input type="radio" name="payment_options" id="payment_options" value="e2Pay_LINKAJA_WCO" class="me-4" autocomplete="off" required 
					onclick="document.getElementById('xpayment_method').value = this.value;">
              </label>			  
			  -->
			  
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
                <span>IDR <?php echo number_format($_POST['clientPrice_1']); ?></span>
              </div>
			  <!--
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Other</span>
                <span>Rp 150.000</span>
              </div>
			  -->
              <div
                class="d-flex flex-row align-items-center justify-content-between text-light border-top mt-2 pt-2 border-secondary"
              >
                <span>Total Payment</span>
                <span class="fs-5">IDR <?php echo number_format($_POST['clientPrice_1']); ?></span>
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