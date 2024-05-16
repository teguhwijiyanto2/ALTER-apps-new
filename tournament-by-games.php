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
    <title>Tournament By Games - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="tournament.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Tournament by Games</span>
          </a>
        </div>

        <!-- All Games Box Start -->
        <div class="row g-3 pt-2">
        <?php
		    $results_1 = DB::query("select * from games order by id asc");
            //$results_1 = DB::query("select distinct game_name_id from tournament order by game_name_id desc");
            foreach ($results_1 as $row_1) {
				
				$filename = "assets/img/temp/".$row_1['game_name_id'].".png";

				//if($row_1['game_name_id']=="apex_legends" || $row_1['game_name_id']=="call_of_duty" || $row_1['game_name_id']=="fifa" || $row_1['game_name_id']=="nba" || $row_1['game_name_id']=="magic_chess") {	
					// these images are not exist, don't display!
				//}
				//else {
									  echo "
									  <div class='col-4' onclick=\"window.location.href='tournament-by-game-list.php?gid=".$row_1['game_name_id']."';\" style='cursor:pointer;'>
										<img
										src='".$filename."'
										class='game__item w-100 ratio-1x1 object-fit-cover rounded-3'
										/>
									  </div>
									  ";		
				//}

            } // foreach ($results_1 as $row_1) {
            //echo $array_users_username[$row_1['id']];
          ?>
        </div>
        <!-- All Games Box End -->
      </div>
    </section>

    <script>
	 /*
      $(document).ready(function () {
        $('.game__item').click(function () {
          if ($(this).hasClass('border')) {
            $(this).removeClass('border border-5 border-success');
          } else {
            $(this).addClass('border border-5 border-success');
          }
        });
      });
	 */
    </script>
  </body>
</html>
