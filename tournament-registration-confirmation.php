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

$results_tournament = DB::queryFirstRow("SELECT * FROM tournament where tournament_code=%s", $_POST['tournament_codex']);
$results_team = DB::queryFirstRow("SELECT * FROM tournament_teams where team_code=%s", $_POST['team_codex']);

/*
	echo "
	<form action='tournament-registration-confirmation.php' method='POST' id='formTournamentRegistrationConfirmation'>
		<input type='text' name='tournament_codex' value='".$_POST['tournament_codex']."'>
		<input type='text' name='team_codex' value='".$team_code."'>
	</form>
	<body onload=\"document.getElementById('formTournamentRegistrationConfirmation').submit();\">
	";

CREATE TABLE IF NOT EXISTS `tournament` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tournament_code` varchar(100) NOT NULL,
  `creator_user_id` bigint(20) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `city_id` bigint(20) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `game_name_id` varchar(100) DEFAULT NULL,
  `stage_type` varchar(100) DEFAULT NULL,
  `format_type` varchar(100) DEFAULT NULL,
  `participant_type` varchar(100) DEFAULT NULL,
  `participant_number` int(11) DEFAULT NULL,
  `reward_1st` int(11) DEFAULT NULL,
  `reward_2nd` int(11) DEFAULT NULL,
  `reward_3rd` int(11) DEFAULT NULL,
  `tournament_type` varchar(100) DEFAULT NULL,
  `registration_type` varchar(100) DEFAULT NULL,
  `participant_fee` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `tournament_teams` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tournament_code` varchar(100) DEFAULT NULL,
  `players_per_team` int(11) DEFAULT '1',
  `team_code` varchar(100) DEFAULT NULL,
  `team_logo` varchar(255) DEFAULT NULL,
  `team_name` varchar(100) DEFAULT NULL,
  `single_player_id` bigint(20) DEFAULT NULL,
  `single_player_email` varchar(100) DEFAULT NULL,  
  `single_player_username` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `tournament_team_players` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tournament_code` varchar(100) DEFAULT NULL,
  `team_code` varchar(100) DEFAULT NULL, 
  `team_player_number` int(11) DEFAULT NULL,
  `team_player_id` bigint(20) DEFAULT NULL,
  `team_player_email` varchar(100) DEFAULT NULL,  
  `team_player_username` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

	echo "
	<form action='tournament-registration-confirmation.php' method='POST' id='formTournamentRegistrationConfirmation'>
		<input type='text' name='tournament_codex' value='".$_POST['tournament_codex']."'>
		<input type='text' name='team_codex' value='".$team_code."'>
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
    <title>Register Overfiew Free - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="tournament.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Registration Summary</span>
          </a>
        </div>

        <!-- Tournament Overview Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Tournament Overview</h4>
          <div aria-label="Tournamnet Card" class="">
            <div
              class="d-flex flex-row align-items-center gap-3 py-3 border-bottom border-secondary border-opacity-50 bg-opacity-50"
            >
              <img
                src="https://placehold.co/400x300.png"
                class="rounded-2 ratio-1x1"
                height="56"
                width="56"
              />
              <div class="flex-fill">
                <h5 class="lh-1"><?php echo $results_tournament['name']; ?></h5>
                <span class="text-secondary"><?php echo $array_games[$results_tournament['game_name_id']]; ?></span>
              </div>
            </div>
            <div class="py-3 d-flex flex-column gap-2">
              <div class="d-flex flex-row align-items-center gap-2">
                <img
                  src="assets/img/home__tournament-trophy.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"><?php echo number_format($results_tournament['reward_1st']); ?></span>
              </div>
              <div class="d-flex flex-row align-items-center gap-2">
                <img
                  src="assets/img/home__tournament-calendar-date.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"><?php echo $results_tournament['date_from']; ?> to <?php echo $results_tournament['date_to']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <!-- Tournament Overview End -->

        <!-- Team Start -->
        <div class="bg-dark rounded-3 mt-3">
          <h5 class="p-3">Team</h5>
          <p class="text-secondary px-3 pb-3">
            Invitation will be sent after you confirm the registration. You can
            also add and remove team member after the confirmation
          </p>
          <div aria-label="Teams" class="">
            <div
              class="d-flex flex-row align-items-center gap-3 p-3 bg-secondary bg-opacity-50"
            >
              <img
                src="https://placehold.co/400x300.png"
                class="rounded-2 ratio-1x1"
                height="56"
                width="56"
              />		  
              <div class="flex-fill">
                <h5 class="lh-1"><?php echo $results_team['team_name']; ?></h5>
              </div>
              <i
                class="bi bi-pencil-fill text-dark fs-$ bg-light text-center pt-2 rounded-circle"
                style="width: 40px; height: 40px"
              ></i>
            </div>
            <div class="p-3">
              <h6>Team Member:</h6>
				<?php
				$x=1;			  
				$results_1 = DB::query("SELECT * FROM tournament_team_players where team_code=%s order by team_player_number asc", $_POST['team_codex']);
				foreach ($results_1 as $row_1) {
					echo "<div class='text-secondary'>$x. ".$row_1['team_player_username']." (".$row_1['team_player_email'].")</div>";
					$x++;
				} // foreach ($results_1 as $row_1) {
				//echo $array_users_username[$row_1['id']];			  
				?>	  
            </div>
          </div>
        </div>
        <!-- Team End -->

        <!-- Payment Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h5>Payment</h5>
          <p class="text-secondary">
            This is a free tournament, you wont be charged anything.
          </p>
        </div>
        <!-- Payment End -->
		<!--
        <a href="payment.php" class="btn btn-primary rounded-pill my-4 w-100">
          Confirm
        </a>
		-->
		<a href="tournament.php" class="btn btn-primary rounded-pill my-4 w-100">
          Confirm
        </a>
      </div>
    </section>
  </body>
</html>
