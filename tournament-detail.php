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

$results_B = DB::queryFirstRow("SELECT * FROM tournament where id=%i", $_GET['tid']);

if($results_B['registration_type']=="Paid") {
	$num_of_participant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s AND payment_status='Paid' order by rand()", $results_B['tournament_code']);
}
else {
	$num_of_participant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s order by rand()", $results_B['tournament_code']);
}


$tournamen_thumbnail = 'https://placehold.co/400x300.png';

    if (!empty($results_B['thumbnail'])) {
      $tournamen_thumbnail_path = 'tournament_thumbnail/' . $results_B['thumbnail'];
      
      if (file_exists($tournamen_thumbnail_path)) {
          $tournamen_thumbnail = $tournamen_thumbnail_path;
      }
    }

$tournamen_banner = 'assets/img/home__tournement-bg-header.png';

      if (!empty($results_B['banner'])) {
        $tournamen_banner_path = 'tournament_banner/' . $results_B['banner'];
        
        if (file_exists($tournamen_banner_path)) {
            $tournamen_banner = $tournamen_banner_path;
        }
      }

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
    <title>Detail Tournament - Alter</title>
  </head>

  <body>
    <!-- Header Top Start -->

    <div
      class="bg__tour-detail"
      style="background-image: url('<?php echo $tournamen_banner; ?>'); background-size: contain;"
    >
    <div 
      class="py-3"
      style="background: rgba(0, 0, 0, 0.5);
             background-size: cover;">
      <div class="container">
        <!-- Title Navigation Start -->
        <a href="tournament.php" class="z-3">
          <div class="d-flex flex-row align-items-center gap-3 mt-4 z-3">
            <i class="bi bi-chevron-left fs-5 me-2 z-3"></i>
            <img
              src="<?php echo $tournamen_thumbnail; ?>"
              class="rounded-2 ratio-1x1 z-3"
              height="56"
              width="56"
            />
            <div class="z-3">
              <h5 class="lh-1"><?php echo $results_B['name']; ?></h5>
			  <span><?php echo $array_games[$results_B['game_name_id']]; ?></span>
              <!--<div><i>By <?php //echo $array_users_name[$results_B['creator_user_id']]; ?></i></div>-->
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
		    <?php 			
				if($results_B['date_from'] < date('Y-m-d')) { 
					echo "
						<div class='bg__dark-red px-3 py-1 rounded-3 text-center z-3'>
						  <span class='fs__7'>Registration Closed</span>
						</div>					
					";
				}
				else {
					echo "
						<div class='bg__red px-3 py-1 rounded-3 text-center z-3' style='background-color:green;'>
						  <span class='fs__7'>Registration Open</span>
						</div>
					";				
				}			
			?>
			
            <div class="bg-dark px-3 py-1 rounded-3 text-center z-3">
              <span class="fs__7"><?php echo $results_B['registration_type']; ?> Tournament </span>
            </div>
          </div>
          <div
            aria-label="Tournament Event"
            class="d-flex flex-column gap-2 mt-4"
          >
		  
								<div class='d-flex flex-row align-items-center gap-2'>
								  <img
									src='assets/img/home__tournament-fee.png'
									height='24'
									width='24'
								  />
								  <span class='fw-light'>IDR <?php echo number_format($results_B['participant_fee']); ?></span>
								</div>				  
            <div class="d-flex flex-row align-items-center gap-2 z-3">
              <img
                src="assets/img/home__tournament-trophy.png"
                height="24"
                width="24"
              />
              <span class="fw-light">IDR <?php echo number_format($results_B['reward_1st']); ?></span>
            </div>
            <div class="d-flex flex-row align-items-center gap-2 z-3">
              <img
                src="assets/img/home__tournament-users.png"
                height="24"
                width="24"
              />
              <span class="fw-light"> <?php echo $num_of_participant; ?>/<?php echo $results_B['participant_number']; ?> Team</span>
            </div>
            <div class="d-flex flex-row align-items-center gap-2 z-3">
              <img
                src="assets/img/home__tournament-calendar-date.png"
                height="24"
                width="24"
              />
              <span class="fw-light"><?php echo $results_B['date_from']; ?> - <?php echo $results_B['date_to']; ?></span>
            </div>

			<?php 			
				if($results_B['date_from'] <= date('Y-m-d')) { 
				
					if($results_B['date_to'] < date('Y-m-d')) { 					
						echo "
							<button class='btn btn-dark disabled w-100 rounded-pill mt-4 z-3'>
							  <i>Tournament has been ended</i>
							</button>				
						";
					}
					else {
						echo "
							<button class='btn btn-dark disabled w-100 rounded-pill mt-4 z-3'>
							  <i>Tournament already started</i>
							</button>				
						";						
					}					
					
				}
				else {
					echo "
						<a
						  href='#'
						  class='btn btn-primary w-100 rounded-pill mt-4 z-3'
						  onclick=\"document.getElementById('formRegTournament').submit();\"
						>
						  Join Tournament
						</a>
					";				
				}			
			?>	
			
          </div>
        </div>
        <!-- Tournament Info End -->
      </div>
      </div>
    </div>
	<form action='tournament-registration.php' method='POST' id='formRegTournament'>
		<input type='hidden' name='tournament_idx' value='<?php echo $results_B['id']; ?>'>
		<input type='hidden' name='tournament_codex' value='<?php echo $results_B['tournament_code']; ?>'>
		<input type='hidden' name='xplayers_per_team' value='<?php echo $results_B['players_per_team']; ?>'>
	</form>
    <!-- Header Top Start -->

    <!-- Overview Start -->
    <section>
      <div class="container">
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Overview</h4>
          <div class="row mt-3">
            <div class="col-8">
              <span class="text-secondary fs-small">Time Zone</span>
              <h6>Jakarta (UTC +7)</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Platform</span>
              <h6>Mobile</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Description</h6>
            <p class="text-secondary">
              <?php echo $results_B['description']; ?>
            </p>
          </div>
		  
<?php
// Program to display URL of current page.
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
	$link = "http";
     
// Here append the common URL characters.
$link .= "://";
     
// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];
     
// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];
     
// Print the link
//echo $link;
?>			  
		  
          <div>
            <h6>Share this tournament</h6>
            <div class="row row-cols-auto g-2">
              <div class="col">
                <a target='_blank'
                  href="https://www.instagram.com/sharer.php?u=<?php echo $link; ?>"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-instagram fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a target='_blank'
                  href="https://twitter.com/intent/tweet?text=<?php echo urlencode($results_B['name']); ?>&url=<?php echo $link; ?>"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitter-x fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a target='_blank'
                  href="https://www.facebook.com/sharer.php?u=<?php echo $link; ?>;"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-facebook fs-5"></i>
                </a>
              </div>
			  <!--
			  <div class="col">
                <a target='_blank'
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitch fs-5"></i>
                </a>
              </div>
			  -->
              <div class="col">
                <a target='_blank'
                  href="https://api.whatsapp.com/send?text=<?php echo $link; ?>"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-whatsapp fs-5"></i>
                </a>
              </div>
            </div>
          </div>
        
		</div>
      </div>
    </section>
    <!-- Overview End -->

    <!-- Teams Start -->
    <section>
      <div class="container">
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Teams</h4>

<?php
$x=1;

if($results_B['registration_type']=="Paid") {
	$results_9 = DB::query("SELECT * FROM tournament_teams where tournament_code=%s AND payment_status='Paid' order by id asc", $results_B['tournament_code']);
}
else {
	$results_9 = DB::query("SELECT * FROM tournament_teams where tournament_code=%s order by id asc", $results_B['tournament_code']);
}

foreach ($results_9 as $row_9) {

  $team_logo = 'team_logo/default_team_logo.jpg';

  if (!empty($row_9['team_logo'])) {
    $team_logo_path = 'team_logo/' . $row_9['team_logo'];
    
    if (file_exists($team_logo_path)) {
        $team_logo = $team_logo_path;
    }
  }
echo "
         <a href='#'>
            <div
              class='d-flex flex-row align-items-center gap-2 p-3 border-bottom border-secondary border-opacity-50'
            >
              <div
                class='rounded-circle d-flex align-items-center justify-content-center'
                style='height: 40px; width: 40px'
              >
                $x
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
            </div>
          </a>
";
$x++;
} // foreach ($results_A as $row_A) {		  
		  
?>		  
		  
		  
 
		  
		  
		  
		  
		  
          <div class="py-3 text-secondary">
            <span>Waiting for other Team...</span>
          </div>
        </div>
      </div>
    </section>
    <!-- Teams End -->

    <!-- Watch Tournament Start -->
    <section>
      <div class="container">
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Watch Tournament</h4>
          <div class="text-center mt-5">
            <img
              src="assets/ilustration/iilus__watch.png"
              alt=""
              class="object-fit-contain w-50"
            />
          </div>
          <p href="#" class="text-secondary text-center">
            Video Link Coming Soon...
          </p>
        </div>
      </div>
    </section>
    <!-- Watch Tournament End -->
  </body>
</html>
