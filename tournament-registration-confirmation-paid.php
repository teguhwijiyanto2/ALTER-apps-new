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
$results_team = DB::queryFirstRow("SELECT * FROM tournament_teams where team_code=%s", $_POST['team_codex']);

$tournamen_thumbnail = 'https://placehold.co/400x300.png';

if (!empty($results_tournament['thumbnail'])) {
  $tournamen_thumbnail_path = 'tournament_thumbnail/' . $results_tournament['thumbnail'];
  
  if (file_exists($tournamen_thumbnail_path)) {
      $tournamen_thumbnail = $tournamen_thumbnail_path;
  }
}

$team_logo = 'https://placehold.co/300x150.png';

if (!empty($results_team['team_logo'])) {
  $team_logo_path = 'team_logo/' . $results_team['team_logo'];
  
  if (file_exists($team_logo_path)) {
      $team_logo = $team_logo_path;
  }
}

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
    <title>Register Overfiew Paid - Alter</title>
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
                src="<?php echo $tournamen_thumbnail; ?>"
                class="rounded-2 ratio-1x1"
                height="56"
                width="56"
              />
              <div class="flex-fill">
                <h5 class="lh-1"><?php echo $results_tournament['name']; ?></h5>
                <span class="text-secondary"><?php echo $results_tournament['game_name_id']; ?></span>
              </div>
            </div>
            <div class="py-3 d-flex flex-column gap-2">
              <div class="d-flex flex-row align-items-center gap-2">
                <img
                  src="assets/img/home__tournament-trophy.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light">IDR <?php echo number_format($results_tournament['reward_1st']); ?></span>
              </div>
              <div class="d-flex flex-row align-items-center gap-2">
                <img
                  src="assets/img/home__tournament-calendar-date.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"><?php echo $results_tournament['date_from']; ?> - <?php echo $results_tournament['date_to']; ?></span>
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
                src="<?php echo $team_logo; ?>"
                class="rounded-2 ratio-1x1"
                height="56"
                width="56"
              />
              <div class="flex-fill">
                <h5 class="lh-1"> <?php echo $results_team['team_name']; ?></h5>
              </div>
			  <!--
              <i
                class="bi bi-pencil-fill text-dark fs-$ bg-light text-center pt-2 rounded-circle"
                style="width: 40px; height: 40px"
              ></i>
			  -->
            </div>
            <div class="p-3">
              <h6>Team Member:</h6>
			  <?php
			  $results_players = DB::query("SELECT * FROM tournament_team_players where team_code=%s order by team_player_number asc", $_POST['team_codex']);
				foreach ($results_players as $row_players) {
					echo "<div class='text-secondary'>".$row_players['team_player_username']." (".$row_players['team_player_id'].")</div>";
				} // foreach ($results_9 as $row_9) {
			  ?>
            </div>
          </div>
        </div>
        <!-- Team End -->

        <!-- Payment Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h5>Payment</h5>
          <p class="text-secondary">
            This is a paid tournament, the amount that you paid are subject to
            tax, and will contribute to the final rewards at the end of the
            tournament
          </p>
          <div class="mt-3">
            <div
              class="d-flex flex-row align-items-center justify-content-between text-secondary"
            >
              <span>Join Fee</span>
              <span>IDR <?php echo number_format($results_tournament['participant_fee']); ?></span>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between text-light border-top mt-2 pt-2 border-secondary"
            >
              <span>Total</span>
              <span class="fs-5">IDR <?php echo number_format($results_tournament['participant_fee']); ?></span>
            </div>
          </div>
        </div>
        <!-- Payment End -->
        <a href="#" class="btn btn-primary rounded-pill my-4 w-100" onclick="document.getElementById('formTournamentRegistrationPay').submit();">
          Confirm
        </a>
				  <?php
				  echo "
				  <form action='tournament-registration-pay.php' method='POST' enctype='multipart/form-data' id='formTournamentRegistrationPay'>
				  <input type='hidden' name='tournament_idx' value='".$_POST['tournament_idx']."'>
				  <input type='hidden' name='tournament_codex' value='".$_POST['tournament_codex']."'>
				  <input type='hidden' name='team_codex' value='".$_POST['team_codex']."'>
				  <input type='hidden' name='xplayers_per_team' value='".$_POST['xplayers_per_team']."'>
				  <input type='hidden' name='xregistration_type' value='".$_POST['xregistration_type']."'>
				  <input type='hidden' name='xparticipant_fee' value='".$_POST['xparticipant_fee']."'>
				  </form>
				  ";
				  ?>
      </div>
    </section>
  </body>
</html>
