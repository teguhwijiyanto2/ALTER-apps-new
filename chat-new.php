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
    <title>New Chat - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="chat-list.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>New Chat</span>
          </a>
        </div>

        <!-- New Group Start -->
        <div id="chat-group" class="p-3 rounded-3 bg-dark">
          <div class="d-flex flex-row align-items-center gap-3">
            <img
              src="assets/icon/ic__user-groups.png"
              height="40"
              width="40"
              alt=""
            />
            <span class="fs-6">New Group</span>
          </div>
        </div>
        <!-- New Group End -->

        <!-- Search Start -->
        <div class="pt-3 border-secondary border-opacity-50">
          <label for="" class="fs-6">Search by username</label>
          <div class="form__group-input mt-2">
            <input id="search" type="text" name="" placeholder="Alter Team" />
            <i class="bi bi-x-lg text-dark cursor__pointer"></i>
          </div>
        </div>
        <!-- Search End -->

        <!-- People Followed Start -->
        <div class="mt-3">
          <h6 id="title-list">People Followed</h6>
          <div class="bg-dark rounded-3 mt-2">
		  
		  <?php	  	
		  $results_1 = DB::query("select * from users where id<>%i", $_SESSION["session_usr_id"]);
		  foreach ($results_1 as $row_1) {

        //validasi user picture tersedia atau tidak
        $user_images = 'https://placehold.co/150x150.png';

        if (!empty($row_1['user_pp_file'])) {
          $user_pp_file_path = 'user_pp_files/' . $row_1['user_pp_file'];
          
          if (file_exists($user_pp_file_path)) {
              $user_images = $user_pp_file_path;
          }
        }

			echo "
            <a href='#' onclick=\"document.getElementById('formChatOpener_".$row_1['id']."').submit();\">
              <div
                class='d-flex flex-row align-items-center gap-3 p-3 border-bottom border-secondary border-opacity-50'
              >
                <img
                  src='".$user_images."'
                  alt=''
                  class='rounded-2 object-fit-cover ratio-1x1'
                  height='50'
                  width='50'
                />
                <div>
                  <div class='fs-6'>
                    <span>".$row_1['name']."</span>
                    <img
                      src='assets/icon/ic__star-gold.png'
                      alt=''
                      class='object-fit-contain'
                      height='24'
                      width='24'
                    />
                  </div>
                  <div class='text-secondary'>
                    <small>Valorant, Genshin Impact</small>
                  </div>
                </div>
              </div>
            </a>
			";
			echo "<div style='display:none;'>
			<form action='chat-opener.php' method='POST' id='formChatOpener_".$row_1['id']."'>
				<input type='hidden' name='chat_type' value='DM'>
				<input type='hidden' name='user_1' value='".$_SESSION['session_usr_id']."'>
				<input type='hidden' name='user_2' value='".$row_1['id']."'>
			</form>
			</div>";
		  } // foreach ($results_1 as $row_1) {
		  ?>
			
          </div>
        </div>
        <!-- People Followed Emd -->
      </div>
    </section>

    <script>
      $(document).ready(function () {
        $('#search').on('focus', function () {
          $('#chat-group').slideUp();
          $('#title-list').text('Result');
        });
        $('#search').on('blur', function () {
          $('#chat-group').slideDown();
          $('#title-list').text('People Followed');
        });
      });
    </script>
  </body>
</html>
