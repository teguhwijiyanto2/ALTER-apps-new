<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$id = $_SESSION["session_usr_id"];


$tournament = DB::queryFirstRow("SELECT tournament.*, games.name AS game_name_text FROM tournament INNER JOIN games ON tournament.game_name_id = games.game_name_id WHERE tournament.id = %i", $_GET['id']);

$num_of_patricipant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s", $tournament['tournament_code']);			 

$tournament_thumbnail = 'https://placehold.co/400x300.png';

if (!empty($tournament['thumbnail'])) {
  $user_pp_file_path = 'tournament_thumbnail/' . $tournament['thumbnail'];
  
  if (file_exists($user_pp_file_path)) {
      $tournament_thumbnail = $user_pp_file_path;
  }
}

$tournamen_banner = 'assets/img/home__tournement-bg-header.png';

if (!empty($tournament['banner'])) {
  $tournamen_banner_path = 'tournament_banner/' . $tournament['banner'];
  
  if (file_exists($tournamen_banner_path)) {
      $tournamen_banner = $tournamen_banner_path;
  }
}

$teams = DB::query("SELECT * FROM tournament_teams where tournament_code=%s", $tournament['tournament_code']);


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
    <title>Manage Tournament - Alter</title>
  </head>

  <body>
    <form>
      <!-- Header Top Start -->
      <div
        class="bg__tour-detail py-3"
        style="
          background-image: url('<?php echo $tournamen_banner; ?>');
        "
      >
        <div class="container">
          <!-- Title Navigation Start -->
          <a href="myorder.php" class="z-3">
            <div class="d-flex flex-row align-items-center gap-3 mt-1 z-3">
              <i class="bi bi-chevron-left fs-5 me-2 z-3"></i>
              <img
              src="<?= $tournament_thumbnail ?>"
                class="rounded-2 ratio-1x1 z-3"
                height="56"
                width="56"
              />
              <div class="z-3">
                <h5 class="lh-1"><?= $tournament['name'] ?></h5>
                <span>By <?= ucfirst($_SESSION['session_usr_name']) ?></span>
              </div>
            </div>
          </a>
          <!-- Title Navigtion End -->

          <!-- Tournament Info Start -->
          <div class="mt-5">
            <div
              aria-label="Tournament Type"
              class="d-flex flex-row align-items-center gap-2"
            >
              <div class="bg__green px-3 py-1 rounded-3 text-center z-3">
                <span class="fs__7">Registration Open</span>
              </div>
              <div class="bg-dark px-3 py-1 rounded-3 text-center z-3">
                <span class="fs__7">Paid Tournament</span>
              </div>
            </div>
            <div
              aria-label="Tournament Event"
              class="d-flex flex-column gap-2 mt-4"
            >
              <div class="d-flex flex-row align-items-center gap-2 z-3">
                <img
                  src="assets/img/home__tournament-trophy.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"><?= number_format($tournament['reward_1st']) ?></span>
              </div>
              <div class="d-flex flex-row align-items-center gap-2 z-3">
                <img
                  src="assets/img/home__tournament-users.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"> <?= $num_of_patricipant."/".$tournament['participant_number'] ?> Team</span>
              </div>
              <div class="d-flex flex-row align-items-center gap-2 z-3">
                <img
                  src="assets/img/home__tournament-calendar-date.png"
                  height="24"
                  width="24"
                />
                <span class="fw-light"><?= $tournament['date_from']." - ".$tournament['date_to'] ?></span>
              </div>
            </div>
          </div>
          <!-- Tournament Info End -->
        </div>
      </div>
      <!-- Header Top End -->

      <!-- Tournament Form Start -->
      <section class="p-3">
        <div class="bg-dark rounded-3 p-3">
          <div class="form__group">
            <label>Tournament Name</label>
            <div class="form__group-input">
              <input
                type="text"
                name=""
                value="<?= $tournament['name'] ?>"
                placeholder="Enter your tournament name"
              />
            </div>
          </div>
          <div class="mt-4">
            <h6>Time Period</h6>
            <div class="form__group">
              <label class="text-secondary">From</label>
              <div class="form__group-input">
                <input type="date" name="" value="<?= $tournament['date_from'] ?>" />
              </div>
            </div>
            <div class="form__group mt-3">
              <label class="text-secondary">To</label>
              <div class="form__group-input">
                <input type="date" name="" value="<?= $tournament['date_to'] ?>"/>
              </div>
            </div>
          </div>
          <p class="mt-3">Reward are prohibited to change</p>
        </div>
      </section>
      <!-- Tournament Form End -->
      <!-- Add Friend Teams Start -->
      <section class="px-3">
        <div class="bg-dark rounded-3 mt-3">
          <h5 class="p-3">Formed Teams</h5>
          <?php 
            
            foreach($teams as $team){
              $players = DB::query("SELECT * FROM tournament_team_players where team_code=%s", $team['team_code']);
            
			  $team_logo = 'team_logo/default_team_logo.jpg';

			  if (!empty($team['team_logo'])) {
				$team_logo_path = 'team_logo/' . $team['team_logo'];
				
				if (file_exists($team_logo_path)) {
					$team_logo = $team_logo_path;
				}
			  }
			
			?>
          <div aria-label="Teams" class="">
            <div
              class="d-flex flex-row align-items-center gap-3 p-3 bg-secondary bg-opacity-50"
            >
			
			  <?php
			  echo "
              <img
                src=".$team_logo."
                class='rounded-2 object-fit-cover ratio-1x1'
                height='36'
                width='36'
              />
			 ";
			 ?>			 
			  
              <div class="flex-fill">
                <h5 class="lh-1"><?= $team['team_name'] ?></h5>
                <span class="text-secondary">last match <?= $team['created_at'] ?></span>
              </div>

              <i
                class="btn__delete bi bi-x-circle-fill text-danger fs-3 cursor__pointer"
              ></i>
            </div>
            <div class="p-3">
              <h6>Team Member:</h6>
              <?php 
                  foreach($players as $player) {
                    echo "<div class='text-secondary'>".$player['team_player_username']."</div>";
                  }
                ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </section>
      <!-- Add Friend Teams End -->

      <!-- Close or cancel tournament Start -->
      <section class="p-3">
        <a href="setting_tournament-setting.php" class="nav-link">
          <div
            style="background-color: #731912"
            class="rounded-3 p-3 d-flex flex-row align-items-center justify-content-between gap-3"
          >
            <div>
              <h5>Close or cancel tournament</h5>
              <p class="text-secondary">
                This would cancel the tournament before the event started, all
                fees will be refunded to each player or team.
              </p>
            </div>
            <i class="bi bi-chevron-right fs-5"></i>
          </div>
        </a>
      </section>
      <!-- Close or cancel tournament End -->

      <!-- Confirm Change Button Start -->
      <div class="p-3">
        <button type="submit" class="btn btn-primary mt-3 rounded-pill w-100">
          Confirm Changes
        </button>
      </div>
      <!-- Confirm Change Button End -->
    </form>
    <script>
      $(document).ready(function () {
        var btnDeleteTeam = $(".btn__delete");
        btnDeleteTeam.click(function () {
          //set delete ajax here
          console.log($(this));
          alert("Delete Function");
        });
      });
    </script>
  </body>
</html>
