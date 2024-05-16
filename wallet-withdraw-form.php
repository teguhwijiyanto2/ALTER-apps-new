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
	
	<script type="text/JavaScript">
	function noAlpha(obj){
		reg = /[^0-9.]/g;
		obj.value =  obj.value.replace(reg,"");
	}
	 
	function formatNum(obj){
		var current=obj.value;
		var after=current;

		current=current.replace(/,/g,"");
		var decimalpoint=current.lastIndexOf(".");

		var n;
		var d;
		if(decimalpoint>=0){
		var f=current.split(".");
		d=f[1];
		n=f[0];
		}
		else{
		n=current;
		}

		var index=parseInt((n.length-1)/3);
		if(index!=0){
		var prefixIndex=n.length-index*3;
		after=n.substr(0,prefixIndex)+","+n.substr(prefixIndex,3);
		for(var i=2;i<=index;i++){
		after+=","+n.substr(prefixIndex+3*(i-1),3);
		}

		if(decimalpoint>=0){
		after+="."+d;
		}
		}
		obj.value=after;
	}
	
	
	function countTotalPayment() {	

	var total_payment = document.getElementById("spanTotalPayment").value; 
	var total_payment2 = total_payment.replace(",", "");
	
	var fee = 2500;
	
		var total_payment3 = Math(total_payment2 + fee);		
		document.getElementById("spanTotalPayment").innerHTML=total_payment3;
		
	}
		
	</script>	
	
    <title>Withdraw</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="wallet.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Withdraw</span>
          </a>
        </div>
		
<script>

function validate_1() {
	
	var is_error_exist = "N";

	if(document.getElementById("amount").value == "") {
		document.getElementById("amountError").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("amountError").style.display = "none";
	}


	if(document.getElementById("ch").value == "Bank") {
		if(document.getElementById("withdraw_id_1").value == "") {
			document.getElementById("withdraw_id_1Error").style.display = "block";
			is_error_exist = "Y";
		}
		else {
			document.getElementById("withdraw_id_1Error").style.display = "none";
		}
	}


	if(document.getElementById("withdraw_id_2").value == "") {
		document.getElementById("withdraw_id_2Error").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("withdraw_id_2Error").style.display = "none";
	}
	
	if(document.getElementById("withdraw_id_3").value == "") {
		document.getElementById("withdraw_id_3Error").style.display = "block";
		is_error_exist = "Y";
	}
	else {
		document.getElementById("withdraw_id_3Error").style.display = "none";
	}	

	if(is_error_exist == "N") {
		document.getElementById('form').submit();
	}
	
} // function validate_1() {

</script>		
		
		
        <form action="wallet-withdraw-confirm.php" method="POST" id="form" class="w-100 needs-validation" novalidate>
		<input type="hidden" name="current_user_balance" value="<?php echo $user_profile['user_wallet']; ?>"> 
		<input type="hidden" name="ch" id="ch" value="<?php echo $_GET['ch']; ?>">
		
		<?php		
		if($_GET['ch']=="GoPay") {
			$icon_channel = "ic__pay-gopay.png"; 
			$placeholder_withdraw_id_2 = "Phone Number";
		}
		elseif($_GET['ch']=="DANA") {
			$icon_channel = "ic__pay-dana.png";
			$placeholder_withdraw_id_2 = "Phone Number";		
		}
		elseif($_GET['ch']=="OVO") {
			$icon_channel = "ic__pay-ovo.png";
			$placeholder_withdraw_id_2 = "Phone Number";
		}		
		elseif($_GET['ch']=="ShoopePay") {
			$icon_channel = "ic__pay-shoope.png";
			$placeholder_withdraw_id_2 = "Phone Number";	
		}	
		elseif($_GET['ch']=="Bank") {
			$icon_channel = "ic__pay-debit.png"; 
			$placeholder_withdraw_id_2 = "Account Number";
		}		
		?>
		
		
          <!-- Amount Start -->
          <div class="p-3 bg-dark rounded-3">
            <h5>Amount</h5>
            <div class="text-secondary">
              Write the amount you want to withdraw with the minimum amount of
              IDR 10.000
            </div>
            <input
			  name="amount"
              type="text"
              class="form-control py-2 mt-4"
              id="amount"
              placeholder="0"
              required
              value=""
			  onkeyup="noAlpha(this); formatNum(this); document.getElementById('spanAmount').innerHTML=this.value; document.getElementById('spanTotalPayment').innerHTML=this.value;" onKeyPress='noAlpha(this);'
            />
			<div class="text-error" id="amountError" style="display: none; color: red;">Amount is required!</div>
          </div>
          <!-- Amount End -->

          <!-- Withdraw to Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Withdraw to</h5>
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
                <div><?php echo $_GET['ch']; ?></div>
				
				<?php
				if($_GET['ch']=="Bank") {
					echo "
					<input
					  name='withdraw_id_1'
					  id='withdraw_id_1'
					  type='text'
					  class='form-control py-2 mt-4'
					  placeholder='Bank Name'
					  required
					  value=''
					/>
					<div class='text-error' id='withdraw_id_1Error' style='display: none; color: red;'>Bank Name is required!</div>
					";
				}
				else {
					echo "<input type='hidden' name='withdraw_id_1' value='".$_GET['ch']."'>";
				}
				?>
				
				<input
				  name="withdraw_id_2"
				  id="withdraw_id_2"
				  type="text"
				  class="form-control py-2 mt-4"
				  placeholder="<?php echo $placeholder_withdraw_id_2; ?>"
				  required
				  value=""
				/>				
				<div class="text-error" id="withdraw_id_2Error" style="display: none; color: red;"><?php echo $placeholder_withdraw_id_2; ?> is required!</div>
				
					<input
					  name="withdraw_id_3"
					  id="withdraw_id_3"
					  type="text"
					  class="form-control py-2 mt-4"
					  placeholder="Account Holder Name"
					  required
					  value=""
					/>
					<div class="text-error" id="withdraw_id_3Error" style="display: none; color: red;">Account Holder Name is required!</div>
					
              </div>
            </div>
          </div>
          <!-- Withdraw to End -->

          <!-- Payment Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Summary</h5>
            <p class="text-secondary">
              <!--You will be charged for this withdraw method-->
            </p>

            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Withdraw Amount</span>
                <span>IDR <span id="spanAmount">0</span></span>
              </div>
			  <!--
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Fee</span>
                <span>IDR 2500</span>
              </div>
			  -->
              <div
                class="d-flex flex-row align-items-center justify-content-between text-light border-top mt-2 pt-2 border-secondary"
              >
                <span>Total Payment</span>
                <span class="fs-5">IDR <span id="spanTotalPayment">0</span></span>
              </div>
            </div>
          </div>
          <!-- Payment Summary end -->

          <!-- Button Submit Pay Start -->

          <button
            onclick="validate_1();"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirm
          </button>		  
		  
		  <!--
          <input value="Confirm"
            type="submit"
            class="btn btn-outline-light rounded-pill w-100 my-3"
          >
		  -->
          <!-- Button Submit Pay End -->
        </form>
      </div>
    </section>
    <script>
	/*
      $(document).ready(function () {
	  
        $("#submitButton").on("click", function () {
          var amount = $("#amount").val();
          if (amount < 10000) {
            $("#errorMessageAmount").text("minimum withdraw Rp 10.000");
          } else {
            window.location.href = "wallet-withdraw__confirm.php";
          }
        });
	  
      });
	  */
    </script>
  </body>
</html>
