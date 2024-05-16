<?php 
session_start(); 
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$id = $_GET['id'];

$match = DB::queryFirstRow("SELECT *  FROM `matchmaking_availability` WHERE matchmaking_availability.id = %i", $id);

$user = DB::queryFirstRow("SELECT *  FROM `users` WHERE id = %i", $match['requestor_id']);

if($match['requestor_id'] == $_SESSION['session_usr_id']) {
  $user = DB::queryFirstRow("SELECT *  FROM `users` WHERE id = %i", $match['approver_id']);
}

$user_profile_images = 'user_pp_files/default_user_pp.jpg';

    if (!empty($user['user_pp_file'])) {
      $user_pp_file_path = 'user_pp_files/' . $user['user_pp_file'];
      
      if (file_exists($user_pp_file_path)) {
          $user_profile_images = $user_pp_file_path;
      }
    }

// print_r($allow_review);

  
$date = date("Y-m-d",strtotime($match['date_time']));
$time = date("H:i",strtotime($match['date_time']));
$day = date("w",strtotime($match['date_time']));

function getDayName($dayOfWeek) {

  switch ($dayOfWeek){
      case 0:
          return 'Sunday';
      case 1:
          return 'Monday';
      case 2:
          return 'Tuesday';
      case 3:
          return 'Wednesday';
      case 4:
          return 'Thursday';
      case 5:
          return 'Friday';
      case 6:
          return 'Saturday';
  }

}

$review = DB::queryFirstRow("SELECT * FROM `matchmaking_review` WHERE matchmaking_id = %i", $match['id']);

$allow_review = false;

if($match['request_status'] == 'Review' && !$review ){
  $allow_review = true;
}

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
    <title>Review Play</title>
  </head>

  <body>
    <section>
      <div class="px-4">
        <div class="py-3">
          <a href="myorder.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Review Play</span>
          </a>
        </div>

        <!-- Play With Start -->
        <form method="POST" action="play-review-process.php">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="review_allow" value="<?php echo $match['request_status']; ?>">
          <div class="p-3 bg-dark rounded-3">
            <h5>Play With</h5>
            <div class="d-flex flex-row align-items-center gap-2 my-4">
            <a href="profile.php?user_id_profile=<?php echo $match['requestor_id']  ?>">
              <img
                src="<?php echo $user_profile_images ?>"
                width="48"
                height="48"
                class="object-fit-cover rounded-circle"
              />
            </a>
              <div><?php echo $user['name'] ?></div>
            </div>
            <div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Games.</span>
                <span class="text-light fs-5"><?php echo $array_games[$match['game_name_id']] ?></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Session of Play</span>
                <span class="text-light fs-5"><?php echo $match['num_of_hours'] ?> session</span>
              </div>
            </div>
          </div>
          <!-- Play With End -->

          <!-- Schedule Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Schedule</h5>
            <div class="mt-3">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Date</span>
                <span class="text-light fs-5"><?php echo $date ?></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Day</span>
                <span class="text-light fs-5"><?php echo getDayName($day) ?></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Time</span>
                <span class="text-light fs-5"><?php echo $time ?></span>
              </div>
            </div>
          </div>
          <!-- Schedule End -->

          <!-- Review Start -->
          <?php if($match['request_status'] == 'Review' && !$review && $match['request_status'] != 'Rejected') { ?>
          <div class="bg-dark rounded-3 p-3 mt-3">
            <h5>Review</h5>
            <div
              class="d-flex flex-row align-items-center justify-content-around gap-3 my-4"
            >
              <i data-value="1" class="bi bi-star fs-1"></i>
              <i data-value="2" class="bi bi-star fs-1"></i>
              <i data-value="3" class="bi bi-star fs-1"></i>
              <i data-value="4" class="bi bi-star fs-1"></i>
              <i data-value="5" class="bi bi-star fs-1"></i>
              <input type="text" name="rating" id="rating" hidden />
            </div>

            <label>Tell us more about your experience</label>
            <textarea
              placeholder="Share details of your own experience from the play"
              class="w-100 mt-2 bg-transparent border border-secondary rounded-4 text-white p-4"
              name="message"
              id="message"
              cols="30"
              rows="5"
            ></textarea>
          </div>
          <?php } elseif($review) { ?>
            <div class="bg-dark rounded-3 p-3 mt-3">
            <h5>Review</h5>
            <div
              class="d-flex flex-row align-items-center justify-content-around gap-3 my-4"
            >
              <i class="bi <?php echo ($review['point'] >= 1) ? 'bi-star-fill' : 'bi-star'  ?> fs-1"></i>
              <i class="bi <?php echo ($review['point'] >= 2) ? 'bi-star-fill' : 'bi-star'  ?> fs-1"></i>
              <i class="bi <?php echo ($review['point'] >= 3) ? 'bi-star-fill' : 'bi-star'  ?> fs-1"></i>
              <i class="bi <?php echo ($review['point'] >= 4) ? 'bi-star-fill' : 'bi-star'  ?> fs-1"></i>
              <i class="bi <?php echo ($review['point'] >= 5) ? 'bi-star-fill' : 'bi-star'  ?> fs-1"></i>
              <input type="text" name="rating" id="rating" hidden />
            </div>

            <label>Tell us more about your experience</label>
            <textarea
              placeholder="Share details of your own experience from the play"
              class="w-100 mt-2 bg-transparent border border-secondary rounded-4 text-white p-4"
              name="message"
              id="message"
              disabled
              cols="30"
              rows="5"
            ><?php echo $review['review_message'] ?></textarea>
          </div>
          <?php } ?>
          <!-- Review End -->

          <!-- Report Start -->
          <div class="bg-dark rounded-3 p-3 mt-3">
            <h5>Report</h5>
            <div class="lh-sm text-secondary">
              Please tell us if you have any problem with the experience by
              clicking
              <a href="" class="text-primary text-decoration-underline"
                >this link</a
              >
            </div>
          </div>
          <!-- Report End -->
          <?php if($_GET['view'] != 1 || $allow_review ){ ?>
          <button
            type="submit"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirm
          </button>
          <?php } ?>
        </form>
      </div>
    </section>

    <script>
      $(document).ready(function () {
        var stars = $(".bi-star");
        stars.click(function () {
          stars.removeClass("bi-star-fill");
          stars.addClass("bi-star");
          var value = $(this).data("value");
          $(this)
            .prevAll()
            .addBack()
            .removeClass("bi-star")
            .addClass("bi-star-fill");
          $("#rating").val(value);
        });
      });
    </script>
  </body>
</html>
