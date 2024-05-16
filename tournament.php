<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';



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
    <title>Tournament - Alter</title>
  </head>

  <body>
    <div class="position-relative container">
      <div class="w-100 pt-4">
        <!-- Top Bar Start -->
		<form action="tournament-search.php" method="POST" id="formSearch">
        <div class="d-flex flex-row align-items-center w-100 gap-1">
          <div
            class="d-flex flex-fill flex-row align-items-center border border-secondary rounded-pill px-3 py-1 gap-3"
          >
            <i class="bi bi-search fs-4 text-secondary" onclick="document.getElementById('formSearch').submit();"></i>
            <input name='keyword'
              placeholder="Search for tournaments"
              class="bg-transparent border-0 w-100 text-light"
            />
          </div>

          <a href="chat-list.php" class="position-relative">
            <img src='assets//icon/ic__bubble-chat.svg' height='36' width='36' />
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
            <img src='assets//icon/ic__bell.svg' height='36' width='36' />
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

        <!-- Banner Carousel Start -->
		  <?php
		  /*
		    $x=1;
			$results_0 = DB::query("select * from tournament order by id desc limit 0,3");
			foreach ($results_0 as $row_0) {

			  $tournamen_banner = 'https://placehold.co/600x400.png';

			  if (!empty($row_0['banner'])) {
				$tournamen_banner_path = 'tournament_banner/' . $row_0['banner'];
				
				if (file_exists($tournamen_banner_path)) {
					$tournamen_banner = $tournamen_banner_path;
				}
			  }
						
					if($x==1) { $active="active"; } else { $active=""; } 
						
						echo "
							<div class='carousel-item $active'>
							  <img
								src='".$tournamen_banner."'
								class='d-block w-100 rounded-4 p-1'
								alt='...'
							  />
							</div>
						";				
				$x++;
			} // foreach ($results_1 as $row_1) {
		  */
		  ?>	
        <!-- Banner Carousel End -->


        <!-- Banner Carousel Start -->
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-indicators" style="bottom: -40px">
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
          </div>
          <div class="carousel-inner mt-4">
            <div class="carousel-item active">
              <img
                src="banner_files/tournament/Banner-App-06.jpg"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="banner_files/tournament/Banner-App-06.jpg"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="banner_files/tournament/Banner-App-06.jpg"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!-- Banner Carousel End -->


        <!-- Create Tournament Start -->
        <section id="create-tournament__section">
          <div
            class="py-5 mt-5 px-4"
            style="
              background-image: url('assets/img/tour__bg-create.png');
              background-size: cover;
              background-repeat: no-repeat;
            "
          >
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="assets/img/tour__planet.png"
                alt=""
                height="50"
                width="50"
              />
              <span class="fs-2 fw-semibold lh-1"
                >Design Your Ultimate Tournament!</span
              >
            </div>
            <p class="my-5">
              Take control! Build and lead your own gaming tournament. Set the
              rules, shape the competition, and be the ultimate champion-maker.
            </p>
            <a
              href="tournament-create.php"
              class="btn btn-primary rounded-pill w-100 mt-3"
            >
              Create Tournament
            </a>
          </div>
        </section>
        <!-- Create Tournament End -->

        <!-- Tournament By Games Start -->
        <section id="tournament-by-games__section" class="mt-5">
          <div onclick=\"window.location.href='tournament-by-games.php';\" style='cursor:pointer; border:0px solid red;'
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4 onclick="window.location.href='tournament-by-games.php';" style='cursor:pointer;'>Tournaments by Games</h4>
            <a href="tournament-by-games.php" class="text-decoration-none">
              <i class="bi bi-chevron-right fs-4"></i>
            </a>
          </div>
          <div class="row g-3 pt-2">
		  <?php
		    //$results_1 = DB::query("select distinct game_name_id from tournament order by game_name_id desc limit 0,3");
			$results_1 = DB::query("select * from games order by id asc limit 0,3");
			foreach ($results_1 as $row_1) {
				echo "
				<div class='col-4' onclick=\"window.location.href='tournament-by-game-list.php?gid=".$row_1['game_name_id']."';\" style='cursor:pointer; border:0px solid red;'>
				  <img onclick=\"window.location.href='tournament-by-game-list.php?gid=".$row_1['game_name_id']."';\" style='cursor:pointer; border:0px solid red;'
					src='assets/img/temp/".$row_1['game_name_id'].".png'
					alt=''
					class='w-100 h-100 ratio-1x1 object-fit-cover rounded-3'
				  />
				</div>
				";				
			} // foreach ($results_1 as $row_1) {
			//echo $array_users_username[$row_1['id']];
		  ?>
          </div>
        </section>
        <!-- Tournament By Games Games End -->

        <!-- Trending Tournament Start -->
		<?php
		$results_2 = DB::query("select * from tournament where date_from > CURDATE() order by id desc limit 0,1");
		foreach ($results_2 as $row_2) {
			
    $num_of_patricipant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s AND payment_status='Paid'", $row_2['tournament_code']);

    $tournamen_thumbnail = 'https://placehold.co/400x300.png';

    if (!empty($row_2['thumbnail'])) {
      $tournamen_thumbnail_path = 'tournament_thumbnail/' . $row_2['thumbnail'];
      
      if (file_exists($tournamen_thumbnail_path)) {
          $tournamen_thumbnail = $tournamen_thumbnail_path;
      }
    }

    $tournamen_banner = 'assets/img/home__tournement-bg-header.png';

      if (!empty($row_2['banner'])) {
        $tournamen_banner_path = 'tournament_banner/' . $row_2['banner'];
        
        if (file_exists($tournamen_banner_path)) {
            $tournamen_banner = $tournamen_banner_path;
        }
      }
			
		echo "
        <section id='quick-match__section' class='mt-5'>
          <div onclick=\"window.location.href='tournament-trending.php';\" style='cursor:pointer; border:0px solid red;'
            class='d-flex flex-row align-items-center justify-content-between'
          >
            <h4 onclick=\"window.location.href='tournament-trending.php';\" style='cursor:pointer; border:0px solid red;'>Trending Tournament</h4>
            <a href='tournament-trending.php' class='text-decoration-none'>
              <i class='bi bi-chevron-right fs-4'></i>
            </a>
          </div>

          <div class='d-flex flex-column gap-2 mt-3' onclick=\"window.location.href='tournament-detail.php?tid=".$row_2['id']."';\" style='cursor:pointer;'>
            <div class='bg-dark rounded-3 overflow-hidden w-100'>
              <div
                class='position-relative bg-secondary bg-opacity-50'
                style=\"
                  background-image: url('".$tournamen_banner."');
                  background-size: cover;
                \"
              >
              <div
                class='w-100 overflow-hidden p-3 pt-5'
                style=\"
                background: rgba(0, 0, 0, 0.5);
                background-size: cover;
                \">
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
                      src='".$tournamen_thumbnail."'
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
                  <span class='fw-light'>".$num_of_patricipant."/".$row_2['participant_number']." Team</span>
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
        </section>
		";
		} // foreach ($results_2 as $row_2) {
		?>
        <!-- Trending Tournament End -->

        <!-- Leaderboard Start -->
        <section id="leaderboard__section" class="mt-5">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4>Leaderboard</h4>
            <a href="leaderboard.php" class="text-decoration-none">
              <i class="bi bi-chevron-right fs-4"></i>
            </a>
          </div>

          <div class="pt-2">
            <div class="bg-dark rounded-3">
			
<?php
$x2=0;

$results_9 = DB::query("SELECT team_name, SUM(team_score) as team_score FROM tournament_teams WHERE payment_status='Paid'
GROUP BY team_name order by team_score desc, team_name asc");
foreach ($results_9 as $row_9) {
$x2++;


if($x2 <= 5) {
	

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
		
} // if($x2 <= 5) {		
?>					  
			  
            </div>
          </div>
        </section>
        <!-- Connect End -->
      </div>
    </div>

    <!-- Floating Bottom Plus Button Start  -->
    <div class="button__bottom max-w-sm">
      <a
        href="tournament-create.php"
        class="btn btn-primary float-end rounded-circle d-flex align-items-center justify-content-center p-0 overflow-hidden me-3"
        style="height: 56px; width: 56px"
      >
        <i class="bi bi-plus text-dark fw-old" style="font-size: 3rem"></i>
      </a>
    </div>
    <!-- Floating Boottom Plus Button End  -->

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
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="home.php"
              >
                <img src="assets/icon/ic__nav-home.svg" class="mb-1" />
                <div>Home</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary active"
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
