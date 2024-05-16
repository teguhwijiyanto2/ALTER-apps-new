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
    <title>Home - Alter</title>
  </head>

  <body>
    <div class="container">
      <div class="w-100 pt-4">
        <!-- Top Bar Start -->
		<form action="home-search.php" method="POST">
        <div class="d-flex flex-row align-items-center w-100 gap-1">
          <div
            class="d-flex flex-fill flex-row align-items-center border border-secondary rounded-pill px-3 py-1 gap-3"
          >
            <i class="bi bi-search fs-4 text-secondary"></i>
            <input
              placeholder="Search for games or friends"
              class="bg-transparent border-0 w-100 text-light"
            />
          </div>
          <a href="chat-list.php" class="position-relative">
            <img
              src="assets//icon/ic__bubble-chat.svg"
              height="36"
              width="36"
            />
            <span
              class="position-absolute translate-middle badge rounded-pill bg-primary"
              style="top: 4px; left: 30px"
            >
              3
              <span class="visually-hidden">unread messages</span>
            </span>
          </a>
		  
          <a href="notification.php" class="position-relative">
            <img src="assets//icon/ic__bell.svg" height="36" width="36" />
            <span
              class="position-absolute translate-middle badge rounded-pill bg-primary"
              style="top: 4px; left: 30px"
            >
				<?php
				/*
				$unread_notif = DB::queryFirstField("SELECT count(*) FROM matchmaking_availability where approver_id=%i AND is_read=0", $_SESSION["session_usr_id"]);
				echo $unread_notif;
				*/
				?>
				0
              <span class="visually-hidden">unread notif</span>
            </span>
          </a>
        </div>
		</form>
        <!-- Top Bar End -->

        <!-- Connect Start -->
        <section id="connect__section" class="mt-5">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4>Request to Play</h4>
            <a href="#" class="text-decoration-none">
              <i class="bi bi-chevron-right fs-4"></i>
            </a>
          </div>

          <div class="pt-2">
            <div class="bg-dark rounded-3">

<?php
//$results_1 = DB::query("SELECT * FROM matchmaking_availability where approver_id=%i AND is_read=0", $_SESSION["session_usr_id"]);
//$results_1 = DB::query("SELECT * FROM matchmaking_availability where approver_id=%i AND request_status='-'", $_SESSION["session_usr_id"]);
$results_1 = DB::query("SELECT * FROM matchmaking_availability where approver_id=%i order by date_time desc", $_SESSION["session_usr_id"]);

foreach ($results_1 as $row_1) {

$user_pp_file_name = DB::queryFirstField("select user_pp_file from users where id=%i", $row_1['requestor_id']);

	echo "
              <div style='cursor:pointer;' onclick=\"window.location.href='profile.php?user_id_profile=".$row_1['requestor_id']."';\"
                class='d-flex flex-row align-items-center gap-3 p-3 border-bottom border-secondary border-opacity-50'
              >
                <img
                  src='user_pp_files/".$user_pp_file_name."'
                  alt=''
                  class='rounded-2 object-fit-cover ratio-1x1'
                  height='64'
                  width='64'
                />
                <div>
                  <div class='fs-6'>
                    <span>".$array_users_name[$row_1['requestor_id']]." </span>
                    <img
                      src='assets/icon/ic__star-gold.png'
                      alt=''
                      class='object-fit-contain'
                      height='24'
                      width='24'
                    />
                  </div>
                  <div class='text-secondary'>
                    <small>Game : ".$row_1['game_name_id']."</small>
                  </div>
                  <div class='text-secondary'>
                    <small>Time : ".$row_1['date_time']."</small>
                  </div>
                  <div class='text-secondary'>
                    <small>Play for : ".$row_1['num_of_hours']." hours</small>
                  </div>
				  ";
				  
				if($row_1['request_status']=="-") {
				  echo "
                  <div class='text-secondary'>
                    <small><a class='button' href='play-request-accept.php?pid=".$row_1['id']."'>[Accept]</a></small>
					&nbsp;&nbsp;
					<small><a class='button' href='play-request-reject.php?pid=".$row_1['id']."'>[Reject]</a></small>
                  </div>
				  ";
				} // if($row_1['request_status']=="-") {
				else {
				  echo "
                  <div class='text-secondary'>
                    <small><b><i>- - ".$row_1['request_status']." - -</i></b></small>
                  </div>
				  ";					
				}
	
	
	echo "
                </div>
              </div>	
	";
	
	
} // foreach ($results_1 as $row_1) {
//echo $array_users_username[$row_1['id']];
?>

            </div>
          </div>
        </section>
        <!-- Connect End -->
      </div>
    </div>

    <!-- Navbar Start -->
    <div style="height: 120px"></div>
    <nav
      class="navbar fixed-bottom max-w-sm navbar-expand-lg bg-dark shadow p-0"
    >
      <div class="container">
        <div class="flex-grow-1" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto d-flex flex-row">
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary active"
                aria-current="page"
                href="home.php"
              >
                <img src="assets/icon/ic__nav-home.svg" class="mb-1" />
                <div>Home</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="tournament.php"
              >
                <img src="assets/icon/ic__nav-tournament.svg" class="mb-1" />
                <div>Tournament</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="timeline.php"
              >
                <img src="assets/icon/ic__nav-timeline.svg" class="mb-1" />
                <div>Timeline</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="shophub.php"
              >
                <img src="assets/icon/ic__nav-shophub.svg" class="mb-1" />
                <div>ShopHub</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="account.php"
              >
                <img src="assets/icon/ic__nav-profile.svg" class="mb-1" />
                <div>Account</div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->
	
	
	<?php
	$update = DB::query("update matchmaking_availability set is_read=1, approval_time=now() where approver_id=%i AND is_read=0", $_SESSION["session_usr_id"]);
	?>

  </body>
</html>
