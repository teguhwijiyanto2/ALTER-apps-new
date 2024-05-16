<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

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
    <title>Tournament By Game - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="tournament.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Tournaments > <?php echo $array_games[$_GET['gid']]; ?></span>
          </a>
        </div>

        <!-- Card Trending Tournaments Start -->
        <div class="d-flex flex-column gap-2 mt-3">
		
		  <?php
		  $results_1 = DB::query("SELECT * from tournament WHERE game_name_id=%s order by date_from desc", $_GET['gid']);
		  foreach ($results_1 as $row_1) {
			  
			 $num_of_patricipant = DB::queryFirstField("SELECT count(*) FROM tournament_teams where tournament_code=%s AND payment_status='Paid'", $row_1['tournament_code']);			 
       
    $tournamen_thumbnail = 'https://placehold.co/400x300.png';

    if (!empty($row_1['thumbnail'])) {
      $tournamen_thumbnail_path = 'tournament_thumbnail/' . $row_1['thumbnail'];
      
      if (file_exists($tournamen_thumbnail_path)) {
          $tournamen_thumbnail = $tournamen_thumbnail_path;
      }
    }

    $tournamen_banner = 'assets/img/home__tournement-bg-header.png';

      if (!empty($row_1['banner'])) {
        $tournamen_banner_path = 'tournament_banner/' . $row_1['banner'];
        
        if (file_exists($tournamen_banner_path)) {
            $tournamen_banner = $tournamen_banner_path;
        }
      }
			  
		  echo "		
          <a href='tournament-detail.php?tid=".$row_1['id']."'>
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
                <div
 			";				  
							  			
				if($row_1['date_from'] <= date('Y-m-d')) { 
				
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
                      <h5 class='lh-1'>".$row_1['name']."</h5>
                      <span>".$array_games[$row_1['game_name_id']]."</span>
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
								  <span class='fw-light'>&nbsp;<b>Fee</b> IDR ".number_format($row_1['participant_fee'])."</span>
								</div>					  
                <div class='d-flex flex-row align-items-center gap-2'>
                  <img
                    src='assets/img/home__tournament-trophy.png'
                    height='24'
                    width='24'
                  />
                  <span class='fw-light'>IDR ".number_format($row_1['reward_1st'])."</span>
                </div>
                <div class='d-flex flex-row align-items-center gap-2'>
                  <img
                    src='assets/img/home__tournament-users.png'
                    height='24'
                    width='24'
                  />
                  <span class='fw-light'>".$num_of_patricipant."/".$row_1['participant_number']." Team</span>
                </div>
                <div class='d-flex flex-row align-items-center gap-2'>
                  <img
                    src='assets/img/home__tournament-calendar-date.png'
                    height='24'
                    width='24'
                  />
                  <span class='fw-light'>".$row_1['date_from']." - ".$row_1['date_to']."</span>
                </div>
              </div>
            </div>
          </a>
		  ";
		  } // foreach ($results_1 as $row_1) {
		  ?>
		  
        </div>
        <!-- Card Trending Tournaments End -->
      </div>
    </section>
  </body>
</html>
