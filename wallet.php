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

/*
SELECT 
tournament_teams.tournament_code,
tournament_teams.team_code,
tournament_teams.participant_fee,
tournament_teams.payment_status,
tournament.creator_user_id
 FROM tournament_teams
 LEFT JOIN tournament ON tournament.tournament_code=tournament_teams.tournament_code
 WHERE tournament_teams.payment_status='Paid'
 AND tournament.creator_user_id=18
 */

$potential_income = DB::queryFirstField("
 SELECT SUM(tournament_teams.participant_fee)
 FROM tournament_teams
 LEFT JOIN tournament ON tournament.tournament_code=tournament_teams.tournament_code
 WHERE tournament_teams.payment_status='Paid'
 AND tournament.creator_user_id=%i
", $_SESSION["session_usr_id"]);

//$commission_fee = 10 / 100 * $potential_income;
$commission_fee = 45 / 100 * $potential_income;

$potential_income = $potential_income - $commission_fee;



$income = DB::queryFirstField("select sum(total_amount) from wallet_withdraw where user_id=%i AND is_withdraw_transferred='Y' AND withdraw_transfer_status='Success'", $_SESSION["session_usr_id"]);
if($income < 1 ) { $income = 0; }

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
    <title>Wallet</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Wallet</span>
          </a>
        </div>

        <!-- Balance Start -->
        <div class="bg__gradient-violet p-3 rounded-3">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <div>
              <div class="text-white-50 lh-1 fs-5">Total Balance</div>
              <div class="fs-4 text-light">IDR <?php echo number_format($user_profile['user_wallet']); ?></div>
            </div>
			<!--
            <a href="#" class="btn btn-light rounded-pill py-2"
              >+ Top Up</a
            >
			-->
          </div>

          <div
            aria-atomic="Divider"
            class="w-100 bg-white bg-opacity-50 my-4"
            style="height: 1px"
          ></div>
          <div class="d-flex flex-row align-items-center">
            <div class="flex-grow-1">
              <div class="text-white-50 lh-1 fs-6">Income</div>
              <div class="fs-5 text-light">IDR <?php echo number_format($income); ?></div>
            </div>
            <div class="flex-grow-1">
              <div class="text-white-50 lh-1 fs-6">Potential Income</div>
              <div class="fs-5 text-light">IDR <?php echo number_format($potential_income); ?></div>
            </div>
          </div>
        </div>
        <!-- Balance End -->

        <!-- Withdraw Balance Start -->
        <a href="wallet-withdraw.php">
          <div
            class="p-3 bg-dark rounded-3 mt-3 d-flex flex-row align-items-center justify-content-between gap-3"
          >
            <div>
              <h5>Withdraw Balance</h5>
              <div class="text-secondary lh-sm">
                Transfer your funds to the bank account of your choice.
              </div>
            </div>
            <i class="bi bi-chevron-right fs-5"></i>
          </div>
        </a>
        <!-- Withdraw Balance End -->

        <!-- Recent Transaction Start -->
        <div class="mt-4">
          <h5>Recent Transaction</h5>
          <div class="trasaction__wrapper">
		  
<?php		  

$results_1 = DB::query("
	SELECT 
	name, description, total_amount, payment_method, transaction_time
	FROM `purchase_items`
	where user_id=%i AND purchase_status='Success'
	order by transaction_time desc
", $_SESSION["session_usr_id"]);
foreach ($results_1 as $row_1) {
	echo "
				<div class='transaction__item py-3 border-bottom border-dark'>
				  <h6>".$row_1['name']."</h6>
				  <div
					class='d-flex flex-row align-items-center justify-content-between text-secondary'
				  >
					<div class=''>".str_ireplace("e2pay_","",$row_1['payment_method'])."</div>
					<div class=''>- IDR ".number_format($row_1['total_amount'])."</div>
				  </div>
				</div>
	";
} // foreach ($results_1 as $row_1) {

$results_2 = DB::query("
	select * from wallet_withdraw 			 			 
	where user_id=%i AND is_withdraw_transferred='Y'	
", $_SESSION["session_usr_id"]);
foreach ($results_2 as $row_2) {
	echo "
				<div class='transaction__item py-3 border-bottom border-dark'>
				  <h6>Refund</h6>
				  <div
					class='d-flex flex-row align-items-center justify-content-between text-secondary'
				  >
					<div class=''>".$row_2['withdraw_id_1']."</div>
					<div class=''>+ IDR ".number_format($row_2['total_amount'])."</div>
				  </div>
				</div>
	";
} // foreach ($results_2 as $row_2) {
	
?>	  
		  
		  
		  
<!--
			 Success Purchase
SELECT 
name, description, total_amount, transaction_time
FROM `purchase_items`
where user_id=18 AND purchase_status='Success'
order by transaction_time desc

			 
			 Request Withdraw
			 
select total_amount from wallet_withdraw 			 
			 
where user_id=18 AND is_withdraw_transferred<>'Y'
			 
CREATE TABLE IF NOT EXISTS `wallet_withdraw` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `withdraw_request_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `withdraw_id_1` varchar(100) DEFAULT NULL,
  `withdraw_id_2` varchar(100) DEFAULT NULL,
  `withdraw_id_3` varchar(100) DEFAULT NULL,
  `is_withdraw_transferred` varchar(3) DEFAULT NULL,
  `withdraw_transfer_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;			 
			 
Potential Income
select sum(total_amount) as potential_income from wallet_withdraw where user_id=18 AND is_withdraw_transferred<>'Y'		 
				 
			 
Income
select sum(total_amount) as total_income from wallet_withdraw where user_id=18 AND is_withdraw_transferred='Y'		 
			 
			 Withdraw transferred
select total_amount from wallet_withdraw 			 
			 
where user_id=18 AND is_withdraw_transferred='Y'		  
-->

		    <!--
            <div class="transaction__item py-3 border-bottom border-dark">
              <h6>Mobile Legends Diamonds</h6>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <div class="">Wallet</div>
                <div class="">-Rp100.000</div>
              </div>
            </div>
			
            <div class="transaction__item py-3 border-bottom border-dark">
              <h6>Top Up Balance</h6>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <div class="">BCA</div>
                <div class="text__purple">Rp600.000</div>
              </div>
            </div>
			-->
			
          </div>
        </div>
        <!-- Recent Transaction End -->
      </div>
    </section>
  </body>
</html>
