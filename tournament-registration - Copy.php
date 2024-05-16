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

$results_B = DB::queryFirstRow("SELECT * FROM tournament where id=%i", $_POST['tournament_idx']);

/*
	<form action='tournament-registration.php' method='POST' id='formRegTournament'>
		<input type='hidden' name='tournament_idx' value='<?php echo $results_B['id']; ?>'>
		<input type='hidden' name='tournament_codex' value='<?php echo $results_B['tournament_code']; ?>'>
		<input type='hidden' name='xplayers_per_team' value='<?php echo $results_B['players_per_team']; ?>'>
	</form>

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
    <title>Register Your Team - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="tournament.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Register Your Team</span>
          </a>
        </div>

        <!-- Add Friend Teams Start -->
		<!--
        <div class="bg-dark rounded-3 mt-3">
          <h4 class="p-3">Add Formed Teams</h4>
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
                <h5 class="lh-1">Rockin Team</h5>
                <span class="text-secondary">last match 10/11/23</span>
              </div>
              <i class="bi bi-plus-circle-fill fs-1"></i>
            </div>
            <div class="p-3">
              <h6>Team Member:</h6>
              <div class="text-secondary">@username1</div>
              <div class="text-secondary">@username2</div>
              <div class="text-secondary">@username3</div>
            </div>
          </div>
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
                <h5 class="lh-1">Rockin Team</h5>
                <span class="text-secondary">last match 10/11/23</span>
              </div>
              <i class="bi bi-plus-circle-fill fs-1"></i>
            </div>
            <div class="p-3">
              <h6>Team Member:</h6>
              <div class="text-secondary">@username1</div>
              <div class="text-secondary">@username2</div>
              <div class="text-secondary">@username3</div>
            </div>
          </div>
        </div>
		-->
        <!-- Add Friend Teams End -->

        <!-- Divider Start -->
		<!--
        <div class="d-flex flex-row align-items-center w-100 my-4 gap-3">
          <div class="w-100 bg-white" style="height: 1px"></div>
          <div class="text-white"><small>or</small></div>
          <div class="w-100 bg-white" style="height: 1px"></div>
        </div>
		-->
        <!-- Divider End -->

        <!-- Add New Team Start -->
        <form action="tournament-registration-process.php" method="POST" enctype="multipart/form-data">
		
		<input type='hidden' name='tournament_idx' value='<?php echo $_POST['tournament_idx']; ?>'>
		<input type='hidden' name='tournament_codex' value='<?php echo $_POST['tournament_codex']; ?>'>
		<input type='hidden' name='xplayers_per_team' value='<?php echo $_POST['xplayers_per_team']; ?>'>		
		
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h4>Add New Team</h4>
            <div class="d-flex flex-row align-items-center gap-2 mt-4">
              <input type="file" id="team_logo" name="team_logo" aria-label="Team Logo" hidden />
              <label
                for="logo"
                class="d-flex flex-row align-items-center gap-2"
              >
                <span
                  class="bg-secondary d-inline-block text-center d-flex flex-row align-items-center justify-content-center rounded-2"
                  style="height: 48px; width: 48px"
                  ><i class="bi bi-plus-lg fs-3"></i
                ></span>
                <span class="text-secondary">Add team logo</span>
              </label>
            </div>
            <div
              class="border-top border-bottom pt-3 pb-4 my-4 border-secondary border-opacity-50"
            >
              <label for="" class="fs-5">Team Name</label>
              <div class="form__group-input mt-2">
                <input type="text" name="team_name" id="team_name" placeholder="Alter Team" onkeyup="checkTeamName(this.value)" />
				<!--<i class="bi bi-check-circle-fill fs-3 text-success"></i>-->
                <div id="span_response">&nbsp;</div>
				
				<script>
				function checkTeamName(str) {
				  var xhttp;
				  if (str.length == 0) { 
					document.getElementById("txtHint").innerHTML = "";
					return;
				  }
				  xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("span_response").innerHTML = this.responseText;
						/*
					  if(this.responseText=="NO") {
						 document.getElementById("span_submit").innerHTML = "<input type='submit' class='btn btn-outline-light rounded-pill my-4 w-100' value='Submit' disabled>"; 
						 document.getElementById("span_response").innerHTML = "&nbsp;";
					  }
					  else {
						 document.getElementById("span_submit").innerHTML = "<input type='submit' class='btn btn-outline-light rounded-pill my-4 w-100' value='Submit'>";
						 document.getElementById("span_response").innerHTML = "<i class='bi bi-check-circle-fill fs-3 text-success'></i>";
					  }
					  */
					}
				  };
				  xhttp.open("GET", "checkTeamName.php?q="+str, true);
				  xhttp.send();   
				}
				</script>

              </div>
            </div>
            <div class="mt-1">
              <h5>Add Member</h5>
			  
			  <?php
			  for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {
			  echo "<br>
              <div class='mt-2'>
                <div
                  class='d-flex flex-row align-items-center justify-content-between'
                >
                  <label for='' class='text-secondary'>Member $x :</label>
                  <!--<i class='bi bi-x-lg fs-4'></i>-->
                </div>
                <div class='form__group-input mt-2'>
                  <input type='text' name='players_username[$x]' placeholder='Username #".$x."' />
                </div>
                <div class='form__group-input mt-2'>
                  <input type='text' name='players_email[$x]' placeholder='Player ID #".$x."' />
                </div>
              </div>
			  ";
			  } // for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {
			  ?>

            </div>
			<!--
            <div class="d-flex flex-row align-items-center gap-2 mt-3">
              <i class="bi bi-plus-circle-fill fs-3 text-secondary"></i>
              <span class="text-secondary">Add more</span>
            </div>
			-->
          </div>

          <div id="span_submit"><input type='submit' class='btn btn-outline-light rounded-pill my-4 w-100' value='Submit'></div>
		  
        </form>
        <!-- Add New Team End -->
      </div>
    </section>
  </body>
</html>
