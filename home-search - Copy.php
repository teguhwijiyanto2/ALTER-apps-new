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
            <input name="keyword" value="<?php echo $_POST['keyword']; ?>"
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
				<?php
				$unread_msg = DB::queryFirstField("SELECT count(*) FROM `chat` where receiver_id=%i AND is_read=0", $_SESSION["session_usr_id"]);
				if($unread_msg > 0) {
					echo "
					<span
					  class='position-absolute translate-middle badge rounded-pill bg-primary'
					  style='top: 4px; left: 30px'
					>
					  $unread_msg
					  <span class='visually-hidden'>unread messages</span>
					</span>
					";
				}
				?>			
          </a>
		  
          <a href="notification.php" class="position-relative">
            <img src="assets//icon/ic__bell.svg" height="36" width="36" />
				<?php
				$unread_notif = DB::queryFirstField("SELECT count(*) FROM notifications where notif_for=%i AND subtitle IS NULL", $_SESSION["session_usr_id"]);
				if($unread_notif > 0) {
					echo "
					<span
					  class='position-absolute translate-middle badge rounded-pill bg-primary'
					  style='top: 4px; left: 30px'
					>
						$unread_notif
					  <span class='visually-hidden'>unread notif</span>
					</span>
					";
				}
				?>
          </a>
		  
        </div>
		</form>
        <!-- Top Bar End -->

           
        <!-- Tournament Start -->
        <section id="quick-match__section" class="mt-5">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4>Tournament</h4>
            <a href="tournament.php" class="text-decoration-none">
              <!-- <i class="bi bi-chevron-right fs-4"></i> -->
            </a>
          </div>

		  <?php
			$results_2 = DB::query("select * from tournament where name like '%".$_POST['keyword']."%' order by date_from asc");
			foreach ($results_2 as $row_2) {
				
				$num_of_participant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s AND payment_status='Paid'", $row_2['tournament_code']);

        $tournament_thumbnail = 'https://placehold.co/400x300.png';

        if (!empty($row_2['thumbnail'])) {
          $user_pp_file_path = 'tournament_thumbnail/' . $row_2['thumbnail'];
          
          if (file_exists($user_pp_file_path)) {
              $tournament_thumbnail = $user_pp_file_path;
          }
        }

			echo "
				<div class='d-flex flex-col gap-2 mt-3' onclick=\"window.location.href='tournament-detail.php?tid=".$row_2['id']."';\" style='cursor:pointer;'>
							<div class='bg-dark rounded-3 overflow-hidden w-100'>
							  <div
								class='position-relative p-3 pt-5 bg-secondary bg-opacity-50'
								style=\"
								  background-image: url('assets/img/home__tournement-bg-header.png');
								  background-size: cover;
								\"
							  >

			";				  
							  
			
				if($row_2['date_from'] <= date('Y-m-d')) { 
				
					echo "
								<div
								  class='position-absolute top-0 end-0 px-3 py-1 bg__green'
								  style='border-bottom-left-radius: 8px; background-color: red;'
								>
								  <span><small>Closed</small></span>
								</div>
					";					
					
				}
				else {
					
					echo "
								<div
								  class='position-absolute top-0 end-0 px-3 py-1 bg__green'
								  style='border-bottom-left-radius: 8px'
								>
								  <span><small>Open</small></span>
								</div>
					";				
				}						
								
			echo "		
								<div class='d-flex flex-row align-items-center gap-3 mt-4'>
								  <img
									src='".$tournament_thumbnail."'
									class='rounded-2 ratio-1x1'
									height='56'
									width='56'
								  />
								  <div>
									<h5 class='lh-1'>".$row_2['name']."</h5>
									<span>".$array_games[$row_2['game_name_id']]."</span>
								  </div>
								</div>
							  </div>

							  <div class='p-3 d-flex flex-column gap-2'>
								<div class='d-flex flex-row align-items-center gap-2'>
								  <!--
								  <img
									src='assets/img/home__tournament-fee.png'
									height='24'
									width='24'
								  />
								  -->
								  <span class='fw-light'>&nbsp;<b>Fee</b> IDR ".number_format($row_2['participant_fee'])."</span>
								</div>							  
								<div class='d-flex flex-row align-items-center gap-2'>
								  <img
									src='assets/img/home__tournament-trophy.png'
									height='24'
									width='24'
								  />
								  <span class='fw-light'>IDR ".number_format($row_2['reward_1st'])."</span>
								</div>
								<div class='d-flex flex-row align-items-center gap-2'>
								  <img
									src='assets/img/home__tournament-users.png'
									height='24'
									width='24'
								  />
								  <span class='fw-light'>".$num_of_participant."/".$row_2['participant_number']." Team</span>
								</div>
								<div class='d-flex flex-row align-items-center gap-2'>
								  <img
									src='assets/img/home__tournament-calendar-date.png'
									height='24'
									width='24'
								  />
								  <span class='fw-light'>".$row_2['date_from']." - ".$row_2['date_to']."</span>
								</div>
							  </div>
							</div>
						  </div>		  
		  		 ";
			} // foreach ($results_2 as $row_2) {
		  ?>
          
        </section>
        <!-- Tournament End -->



        <!-- Connect Start -->
        <section id="connect__section" class="mt-5">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4>Connect</h4>
            <a href="#" class="text-decoration-none">
              <!-- <i class="bi bi-chevron-right fs-4"></i> -->
            </a>
          </div>

          <div class="pt-2">
            <div class="bg-dark rounded-3">

<?php
$results_1 = DB::query("SELECT * FROM users where name like '%".$_POST['keyword']."%' order by name asc");
foreach ($results_1 as $row_1) {
	
	$array_users_name[$row_1['id']] = "".$row_1['name']."";
	$array_users_email[$row_1['id']] = "".$row_1['email']."";
	$array_users_username[$row_1['id']] = "".$row_1['username']."";

  //validasi user picture tersedia atau tidak
  $user_images = 'user_pp_files/default_user_pp.jpg';

  if (!empty($row_1['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $row_1['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_images = $user_pp_file_path;
    }
  }
	
	echo "
              <div style='cursor:pointer;' onclick=\"window.location.href='profile.php?user_id_profile=".$row_1['id']."';\"
                class='d-flex flex-row align-items-center gap-3 p-3 border-bottom border-secondary border-opacity-50'
              >
                <img
                  src='".$user_images."'
                  alt=''
                  class='rounded-2 object-fit-cover ratio-1x1'
                  height='64'
                  width='64'
                />
                <div>
                  <div class='fs-6'>
                    <span> ".$row_1['name']." </span>
                    <img
                      src='assets/icon/ic__star-gold.png'
                      alt=''
                      class='object-fit-contain'
                      height='24'
                      width='24'
                    />
                  </div>
                  <div class='text-secondary'>
                    <!--<small>Valorant, Genshin Impact</small>-->
                  </div>
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
  </body>
</html>
