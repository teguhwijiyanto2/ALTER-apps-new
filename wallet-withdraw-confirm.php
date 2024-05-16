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


if(str_ireplace(",","",$_POST['amount']) < 10000) {
	echo "
	<script>
		alert('Amount may not be less than IDR 10,000 !');
		window.location.href='wallet.php';
	</script>
	";
	exit();
}


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
    <title>Withdraw Confirmation</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="wallet.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Confirmation</span>
          </a>
        </div>
		
<script>

function validate_1() {
	
	var is_error_exist = "N";

	if(document.getElementById("chk_password").value == "") {
		document.getElementById("chk_passwordError").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("chk_passwordError").style.display = "none";
	}

	if(is_error_exist == "N") {
		document.getElementById('form').submit();
	}
	
} // function validate_1() {

</script>		
		
        <form action="wallet-withdraw-process.php" method="post" id="form">	
		<input type="hidden" name="ch" value="<?php echo $_POST['ch']; ?>">
		<input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
		<input type="hidden" name="withdraw_id_1" value="<?php echo $_POST['withdraw_id_1']; ?>">
		<input type="hidden" name="withdraw_id_2" value="<?php echo $_POST['withdraw_id_2']; ?>">
		<input type="hidden" name="withdraw_id_3" value="<?php echo $_POST['withdraw_id_3']; ?>">
		
          <!-- Payment Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Withdraw to</h5>
			
			<?php		
			if($_POST['ch']=="GoPay") {
				$icon_channel = "ic__pay-gopay.png"; 
			}
			elseif($_POST['ch']=="DANA") {
				$icon_channel = "ic__pay-dana.png"; 
			}
			elseif($_POST['ch']=="OVO") {
				$icon_channel = "ic__pay-ovo.png"; 
			}		
			elseif($_POST['ch']=="ShoopePay") {
				$icon_channel = "ic__pay-shoope.png"; 
			}	
			elseif($_POST['ch']=="Bank") {
				$icon_channel = "ic__pay-debit.png"; 
			}		
			?>
		
            <div class="d-flex flex-row align-items-center gap-3 py-3">
			  <?php
			  echo "
              <img
                src='assets/icon/".$icon_channel."'
                alt=''
                width='44'
                height='44'
              />
			  ";
			  ?>
              <div>
                <div><?php echo $_POST['ch']; ?></div>
                <div class="text-secondary fs-7"><?php echo $_POST['withdraw_id_1']; ?></div>
				<div class="text-secondary fs-7"><?php echo $_POST['withdraw_id_2']; ?></div>
				<div class="text-secondary fs-7"><?php echo $_POST['withdraw_id_3']; ?></div>
              </div>
            </div>

            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Withdraw Amount</span>
                <span>IDR <?php echo $_POST['amount']; ?></span>
              </div>
			  <!--
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Fee</span>
                <span>Rp 2.500</span>
              </div>
			  -->
              <div
                class="d-flex flex-row align-items-center justify-content-between text-light border-top mt-2 pt-2 border-secondary"
              >
                <span>Total Payment</span>
                <span class="fs-5">IDR <?php echo $_POST['amount']; ?></span>
              </div>
            </div>
          </div>
          <!-- Payment Summary end -->

          <!-- Password Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Password</h5>
            <div class="text-secondary lh-sm">
              Input your password below to confirm the transaction
            </div>
            <input
              type="password"
			  name="chk_password"
              id="chk_password"
              value=""
              class="form-control py-2 mt-4"
              placeholder="Enter your password"
              required
            />
            <div class="text-error" id="chk_passwordError" style="display: none; color: red;">Password is required!</div>
          </div>
          <!-- Password End -->

          <!-- Button Submit Pay Start -->
		  <button
            onclick="validate_1();"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Withdraw
          </button>	
          <!-- <input type="submit" class="btn btn-primary rounded-pill w-100 my-3" value="Withdraw"> -->
          <!-- Button Submit Pay End -->
        </form>
      </div>
    </section>
  </body>
</html>
