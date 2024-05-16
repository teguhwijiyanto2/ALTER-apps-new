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
    <title>Leaderboard - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="tournament.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Tournament Leaderboard</span>
          </a>
        </div>

        <!-- Your Lever Start -->
        <div class="bg-dark rounded-4 p-3">
          <div class="row">
            <div class="col-7">
              <div
                class="d-flex flex-row align-items-center justify-content-center gap-2"
              >
                <img
                  src="assets/icon/ic__star-gold.png"
                  alt=""
                  height="56"
                  width="56"
                />
                <div>
                  <small class="text-secondary">Your Level</small>
                  <div class="fs-5 fw-bold">Golden Square</div>
                </div>
              </div>
            </div>
            <div class="col-5">
              <div class="border-start border-secondary ps-3">
                <small class="text-secondary">Your Points</small>
                <div class="fs-5 fw-bold">120 pts</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Your Lever End -->

        <!-- Filter List Start -->
		<!--
        <div class="mt-4">
          <h6>Filter by</h6>
          <div class="d-flex flex-row align-items-center gap-2">
            <div class="dropdown" data-bs-theme="dark">
              <button
                class="btn btn-dark py-2 dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Games
              </button>
              <ul
                class="dropdown-menu bg-dark"
                style="max-height: calc(100vh - 450px)"
              >
                <li>
                  <button class="dropdown-item">
                    <img
                      src="assets/img/temp/game-1.png"
                      width="35"
                      height="35"
                      class="rounded-2"
                    />
                    <span class="ms-2">Valorant</span>
                  </button>
                </li>
                <li>
                  <button class="dropdown-item">
                    <img
                      src="assets/img/temp/game-2.png"
                      width="35"
                      height="35"
                      class="rounded-2"
                    />
                    <span class="ms-2">Mobile Legend</span>
                  </button>
                </li>
              </ul>
            </div>
            <div class="dropdown" data-bs-theme="dark">
              <button
                class="btn btn-dark py-2 dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Region
              </button>
              <ul
                class="dropdown-menu bg-dark overflow-auto"
                style="max-height: calc(100vh - 300px)"
              >
                <li><button class="dropdown-item">Australia</button></li>
                <li><button class="dropdown-item">Indonesia</button></li>
              </ul>
            </div>
          </div>
        </div>
		-->
        <!-- Filter List End -->

        <!-- List Leaderboard Start -->
        <div class="mt-4">
          <div class="bg-dark rounded-3">
		  
		  
<?php
$x2=0;

$results_9 = DB::query("SELECT team_name, SUM(team_score) as team_score FROM tournament_teams WHERE payment_status='Paid'
GROUP BY team_name order by team_score desc, team_name asc");
foreach ($results_9 as $row_9) {
$x2++;

$team_logo = 'team_logo/default_team_logo.jpg';


  if (!empty($row_9['team_logo']) && strlen($row_9['team_logo']) > 3) {
    $team_logo_path = 'team_logo/' . $row_9['team_logo'];
    
    if (file_exists($team_logo_path)) {
        $team_logo = $team_logo_path;
    }
  }

echo "
            <!--<a href='profile-other.php'>-->
              <div
                class='d-flex flex-row align-items-center gap-2 p-3 border-bottom border-secondary border-opacity-50'
              >
                <div
                  class='bg__yellow rounded-circle d-flex align-items-center justify-content-center'
                  style='height: 40px; width: 40px'
                >
                  $x2
                </div>
                <img
                  src='".$team_logo."'
                  alt=''
                  class='rounded-2 object-fit-cover ratio-1x1'
                  height='36'
                  width='36'
                />
                <div class='fs-6 flex-fill'>
                  <span> ".$row_9['team_name']." </span>
                  <img
                    src='assets/icon/ic__star-gold.png'
                    alt=''
                    class='object-fit-contain'
                    height='24'
                    width='24'
                  />
                </div>
                <span>".$row_9['team_score']." pts</span>
              </div>
            <!--</a>-->
";

} // foreach ($results_A as $row_A) {		  
		  
?>				  

			
			
          </div>
        </div>
      </div>
      <!-- List Leaderboard End -->

      <!-- Pagination Start -->
	  <!--
      <div
        class="d-flex align-items-center justify-content-center mt-5"
        aria-label="Pagination Leaderborad"
      >
        <ul class="pagination">
	  -->
          <!-- <li class="page-item mx-2">
            <a
              class="page-link bg-dark text-white rounded-pill py-0 px-3"
              href="#"
              >Previous</a
            >
          </li> -->
	  <!--
          <li class="page-item mx-2">
            <a
              class="page-link bg-dark text-white rounded-pill py-0 px-3 active"
              href="#"
              >1</a
            >
          </li>
          <li class="page-item mx-2">
            <a
              class="page-link bg-dark text-white rounded-pill py-0 px-3"
              href="#"
              >2</a
            >
          </li>
          <li class="page-item mx-2">
            <a
              class="page-link bg-dark text-white rounded-pill py-0 px-3"
              href="#"
              >3</a
            >
          </li>
          <li class="page-item mx-2">
            <a
              class="page-link bg-dark text-white rounded-pill py-0 px-3"
              href="#"
              >Next</a
            >
          </li>
        </ul>
      </div>
	  -->
      <!-- Pagination End -->
    </section>
  </body>
</html>
