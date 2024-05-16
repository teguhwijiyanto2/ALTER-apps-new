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


				<div style="display:none;">
				<span class="cur_span">IDR</span><span class="price_span"> <?php echo $results_tournament['participant_fee']; ?> </span>
				<input type="fname" class="form-control" name="billingFirstName" id="billingFirstName" value="Razer" required>
				<input type="lname" class="form-control" name="billingLastName" id="billingLastName" value="Demo" required>
				<input type="mobile" class="form-control" name="billingMobile" id="billingMobile" value="55218438" required>
				<input type="email" class="form-control" name="billingEmail" id="billingEmail" value="demo@razer.com" required>
				<input type="address" class="form-control" name="billingAddress" id="billingAddress" value="J-39-1, Block J, Jalan Multimedia, I-City" required>
				<input type="city" class="form-control" name="billingCity" id="billingCity" value="Selangor" required>
				<input type="state" class="form-control" name="billingState" id="billingState" value="Shah Alam" required>
				<input type="poscode" class="form-control" name="billingPostcode" id="billingPostcode" value="40000" required>
				</div>
				
					DANA<input type="radio" name="payment_options" id="payment_options" value="e2Pay_DANA" required 
					onclick="document.getElementById('xpayment_method').value = this.value;">

		<input type="hidden" name="tournament_idx" id="tournament_idx" value="<?php echo $_POST['tournament_idx']; ?>" />
		<input type="hidden" name="team_codex" id="team_codex" value="<?php echo $_POST['team_codex']; ?>" />
		<input type="hidden" name="tournament_codex" value="<?php echo $_POST['tournament_codex']; ?>" />
		<input type="hidden" name="xpayment_method" id="xpayment_method" value="" />
		<input type="hidden" name="currency" id="currency" value="IDR" />
		<!--<input type="hidden" name="total_amount" value="<?php //echo $results_tournament['participant_fee']; ?>" />-->
		<input type="hidden" name="total_amount" value="10000" />

		<input type="hidden" name="session_usr_id" value="<?php echo $_SESSION["session_usr_id"]; ?>" />
		
		
	</form>
 
</body>
</html>