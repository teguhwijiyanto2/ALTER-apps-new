<?php 
session_start(); 
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$categ = $_POST['categ'];
$id = $_SESSION["session_usr_id"];

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

$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];


$query = "SELECT * FROM `matchmaking_availability` WHERE requestor_id ='".$id."' OR approver_id = '".$id."' ORDER BY date_time DESC;";

if($categ != 'Upcoming') {
    $query = "SELECT * FROM `matchmaking_availability` WHERE (requestor_id ='".$id."' OR approver_id = '".$id."') AND (request_status = '".$categ."' OR request_status = 'Review') ORDER BY date_time DESC";
}

$results = DB::query($query);

foreach ($results as $play) {

    $user_profile = DB::queryFirstRow("SELECT * FROM users where id=%i", $play['approver_id']);

    $status = 'host';

    if($play['approver_id'] == $id) {
        $status = 'participant';
        $user_profile = DB::queryFirstRow("SELECT * FROM users where id=%i", $play['requestor_id']);

    }

    if($play['date_time'] < date("Y-m-d H:i:s") ){
	    DB::query("UPDATE matchmaking_availability SET request_status='Review' WHERE id = '".$play['id']."'");
        $play['request_status'] = 'Review';
      }

    $user_profile_images = 'user_pp_files/default_user_pp.jpg';

    if (!empty($user_profile['user_pp_file'])) {
      $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
      
      if (file_exists($user_pp_file_path)) {
          $user_profile_images = $user_pp_file_path;
      }
    }

    $allow_review = false;

    if($play['date_time'] < date("Y-m-d H:i:s") ){
        $allow_review = true;
    }

    // $reply_comments = DB::query("SELECT post_comments.*, users.name, users.id as user_id, users.user_pp_file FROM post_comments JOIN users ON post_comments.posted_by = users.id WHERE reply_comment_id = %i", $comment['id']);




$date = date("Y-m-d",strtotime($play['date_time']));
$time = date("H:i",strtotime($play['date_time']));
$day = date("w",strtotime($play['date_time']));



?>

<div class="list-play__item bg-dark rounded-3 overflow-hidden">
    <div class=" <?php echo ($play['request_status'] == 'Finished' || $play['request_status'] == 'Review') ? 'opacity-25' : 'opacity-100' ?> ">
    <div
        class="float-end  <?php echo ($status == 'host') ? 'bg__violet' : 'bg-secondary' ?> py-1 px-3 fs-8"
        style="border-bottom-left-radius: 10px"
    >
        <?php echo ucfirst($status); ?>
    </div>
    <div class="d-flex flex-row align-items-center gap-2 p-3">
        <a href="profile.php?user_id_profile=<?php echo ($status == 'host') ? $play['approver_id'] : $play['requestor_id']  ?>">
            <img
            src="<?php echo $user_profile_images ?>"
            width="48"
            height="48"
            class="rounded-2 object-fit-cover"
            />
        </a>
        <div class="text-secondary">
        <?php echo ($status == 'host') ? 'With' : 'From' ?><span class="text-light"> <?php echo $user_profile['name'] ?></span>
        </div>
    </div>
    <div class="px-3">
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Games</span>
        <span class="text-light fs-5"><?php echo $array_games[$play['game_name_id']] ?></span>
        </div>
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Session of Play</span>
        <span class="text-light fs-5"><?php echo $play['num_of_hours'] ?> session</span>
        </div>
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Schedule</span>
        <!--<span class="text-light fs-5"><?php //echo $play['date_time'] ?></span>-->
        </div>
		
			<div
			class="d-flex flex-row align-items-center justify-content-between text-secondary"
			>
			<span style='margin-left:20px;'>Date</span>
			<span class="text-light fs-5"><?php echo $date ?></span>
			</div>		
			<div
			class="d-flex flex-row align-items-center justify-content-between text-secondary"
			>
			<span style='margin-left:20px;'>Day</span>
			<span class="text-light fs-5"><?php echo getDayName($day) ?></span>
			</div>		
			<div
			class="d-flex flex-row align-items-center justify-content-between text-secondary"
			>
			<span style='margin-left:20px;'>Time</span>
			<span class="text-light fs-5"><?php echo $time ?></span>
			</div>		

    </div>
    </div>
    <?php if($play['request_status'] == '-' && $status != 'host') { ?>
    <div class="p-3 d-flex flex-row align-items-center gap-3 mt-2">
        <a
            href="play-request-reject.php?pid=<?php echo $play['id'] ?>"
            class="btn btn-outline-light btn-sm rounded-pill w-100 py-2"
        >
            Decline
        </a>
        <a
            href="myorder-play-review.php?id=<?php echo $play['id'] ?>&view=0"
            class="btn btn-primary btn-sm rounded-pill w-100 py-2"
        >
            Confirm
        </a>
    </div>
    <?php } if($play['request_status'] != '-' || $status == 'host') { ?>
    <div class="p-3 d-flex flex-row align-items-center gap-3 mt-2">
        <a
            href="myorder-play-review.php?id=<?php echo $play['id'] ?>&view=1"
            class="btn btn-outline-light btn-sm rounded-pill w-100 py-2"
        >
            See Details
        </a>
    </div>
    <?php } if($play['request_status'] == 'Review' && $allow_review && $status != 'host') { ?>
    <div class="px-3 pb-3 d-flex flex-row align-items-center gap-3">
        <a
            href="myorder-play-review.php?id=<?php echo $play['id'] ?>&view=0"
            class="btn btn-primary btn-sm rounded-pill w-100 py-2"
        >
            Review
        </a>
    </div>
    <?php } if($play['request_status'] == 'Rejected') { ?>
    <div class="p-3 d-flex flex-row align-items-center gap-3 mt-2">
        <div
            class="btn btn-outline-light btn-sm rounded-pill w-100 py-2 disabled"
        >
            Rejected
    </div>
    </div>
    <?php } ?>
</div>

<?php } ?>