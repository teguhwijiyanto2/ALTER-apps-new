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

/*
$result_B = DB::queryFirstRow("select * from chat_room where chat_room_uuid=%s", $_POST['chat_room_uuidx']);
if($result_B['user_id_1'] == $_SESSION["session_usr_id"]) {
	$top_chat_title = "".$array_users_name[$result_B['user_id_2']]."";
}
else {
	$top_chat_title = "".$array_users_name[$result_B['user_id_1']]."";
}
	*/

	
function getHourMinute($timestamp) {
	$result = substr($timestamp,12,5);
	return $result;
}

function timeAgo($time_ago){

  $time_string = "";

  $cur_time 	= time();
  $time_elapsed 	= $cur_time - $time_ago;
  $seconds 	= $time_elapsed ;
  $minutes 	= round($time_elapsed / 60 );
  $hours 		= round($time_elapsed / 3600);
  $days 		= round($time_elapsed / 86400 );
  $weeks 		= round($time_elapsed / 604800);
  $months 	= round($time_elapsed / 2600640 );
  $years 		= round($time_elapsed / 31207680 );
  // Seconds
  if($seconds <= 60){
    $time_string = "$seconds seconds ago";
  }
  //Minutes
  else if($minutes <=60){
    if($minutes==1){
      $time_string = "one minute ago";
    }
    else{
      $time_string = "$minutes minutes ago";
    }
  }
  //Hours
  else if($hours <=24){
    if($hours==1){
      $time_string = "an hour ago";
    }else{
      $time_string = "$hours hours ago";
    }
  }
  //Days
  else if($days <= 7){
    if($days==1){
      $time_string = "yesterday";
    }else{
      $time_string = "$days days ago";
    }
  }
  //Weeks
  else if($weeks <= 4.3){
    if($weeks==1){
      $time_string = "a week ago";
    }else{
      $time_string = "$weeks weeks ago";
    }
  }
  //Months
  else if($months <=12){
    if($months==1){
      $time_string = "a month ago";
    }else{
      $time_string = "$months months ago";
    }
  }
  //Years
  else{
    if($years==1){
      $time_string = "one year ago";
    }else{
      $time_string = "$years years ago";
    }
  }

  return $time_string;
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
    <title>Chat - Alter</title>
  </head>

  <body>
    <section>
      <!-- Header Chat Start -->
      <div class="container px-4 pt-2 pb-3 bg-primary sticky-top">
        <div class="position-relative d-flex flex-row align-items-center gap-2">
          <a href="user_profile.php" class="flex-fill">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Chat Room</span>
          </a>
          <button
            aria-label="toggle popup more"
            onclick="showMore()"
            class="btn"
          >
            <!--<i class="bi bi-three-dots-vertical text-light"></i>-->
			&nbsp;
          </button>
          <!-- Popup More Start -->
          <!-- 
		  <div
            id="popup-more"
            class="position-absolute end-0 p-2 bg-dark rounded-3"
            style="top: 40px; display: none"
          >
            <button
              class="d-block btn btn-dark btn-sm py-1 px-2 w-100 text-start"
            >
              New Group
            </button>
            <button
              class="d-block btn btn-dark btn-sm py-1 px-2 w-100 text-start"
            >
              Select Messages
            </button>
            <button
              class="d-block btn btn-dark btn-sm py-1 px-2 w-100 text-start"
            >
              Delete Messages
            </button>
          </div>
		  -->
          <!-- Popup More End -->
        </div>
		<form action="chat-list.php" method="POST" id="formSearch">
        <div
          class="d-flex flex-fill flex-row align-items-center bg-light rounded-pill px-3 py-1 gap-3"
        > 
          <i class="bi bi-search fs-4 text-secondary" onclick="document.getElementById('formSearch').submit();" style='cursor:pointer;'></i>
          <input
            placeholder="Search for Chat Room"
            class="bg-transparent border-0 w-100 text-light"
			style = "color:black !important;"
			name='q'
          />	  
        </div>
		</form>
      </div>
      <!-- Header Chat End -->

      <!-- List Chat Start -->
      <div aria-label="List Chat">
	  
	  <?php
	  
		/*
		CREATE TABLE IF NOT EXISTS `chat_room` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_room_uuid` varchar(255) DEFAULT NULL,
  `chat_type` varchar(10) DEFAULT NULL,
  `user_id_1` bigint(20) DEFAULT NULL,
  `user_id_2` bigint(20) DEFAULT NULL,
  `group_chat_name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
*/
	  
	  
	  
	  
	  	$results_1 = DB::query("select * from chat_room where chat_type='DM' AND (user_id_1=%i OR user_id_2=%i)", $_SESSION["session_usr_id"], $_SESSION["session_usr_id"]);
		
		
		
		
		
		foreach ($results_1 as $row_1) {
			
		if($row_1['user_id_1']==$_SESSION["session_usr_id"]) {
			$name_list = $array_users_name[$row_1['user_id_2']];
			$user_id_pp_file = $row_1['user_id_2'];
		}
		else {
			$name_list = $array_users_name[$row_1['user_id_1']];
			$user_id_pp_file = $row_1['user_id_1'];
		}
		
		$user_pp_file_name = DB::queryFirstField("select user_pp_file from users where id=%i", $user_id_pp_file);

        //validasi user picture tersedia atau tidak
    $user_picture = 'user_pp_files/default_user_pp.jpg';

    if (!empty($user_pp_file_name)) {
      $user_pp_file_path = 'user_pp_files/' . $user_pp_file_name;
      
      if (file_exists($user_pp_file_path)) {
          $user_picture = $user_pp_file_path;
      }
    }

		echo "
        <a aria-label='Chat Item' href='#' onclick=\"document.getElementById('formChatOpener_".$row_1['chat_room_uuid']."').submit();\">
          <div
            id='chat-group'
            class='d-flex flex-row align-items-center gap-3 px-4 py-3 border-bottom border-secondary border-opacity-50'
          >
            <img
              src='".$user_picture."'
              height='50'
              width='50'
              class='rounded-circle object-fit-cover'
              alt=''
            />
            <div class='flex-fill'>
              <h6 class='mb-0'>".$name_list."</h6>
              <span class='lh-1 text-secondary'
                ><small>".$row_1['last_message']."</small>
              </span>
            </div>
            <div
              class='d-flex flex-column align-items-center justify-content-center gap-1'
            >
              <div class='text-secondary fs__7 text-decoration-none'>
                <small>".timeAgo(strtotime($row_1['last_message_created_on']))."</small>
              </div>
			  ";
// 

				$unread_msg = DB::queryFirstField("SELECT count(*) FROM `chat` where chat_room_uuid=%s AND receiver_id=%i AND is_read=0", $row_1['chat_room_uuid'], $_SESSION["session_usr_id"]);
				if($unread_msg > 0) {
					echo "
					<span class='bg__green text-light chat__bandage'> $unread_msg </span>
					";
				}


			echo " 
            </div>
          </div>
        </a>
		";
		echo "<div style='display:none;'>
		<form action='chat.php' method='POST' id='formChatOpener_".$row_1['chat_room_uuid']."'>
			<input type='hidden' name='chat_type' value='DM'>
			<input type='hidden' name='chat_room_uuidx' value='".$row_1['chat_room_uuid']."'>
		</form>
		</div>";
		} // foreach ($results_1 as $row_1) {
	  ?>
		
      </div>
      <!-- List Chat End -->

      <!-- Floating Bottom Plus Button Start  -->

      <div class="button__bottom max-w-sm" style="bottom: 2rem">
        <a
          href="chat-new.php"
          class="btn btn-primary float-end rounded-circle d-flex align-items-center justify-content-center p-0 overflow-hidden me-3"
          style="height: 58px; width: 58px"
        >
          <i class="bi bi-plus text-dark fw-bold" style="font-size: 3rem"></i>
        </a>
      </div>

      <!-- Floating Boottom Plus Button End  -->
    </section>

    <script>
      function showMore() {
        $('#popup-more').fadeToggle();
      }
    </script>
  </body>
</html>
