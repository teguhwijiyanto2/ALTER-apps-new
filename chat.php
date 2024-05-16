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


$result_B = DB::queryFirstRow("select * from chat_room where chat_room_uuid=%s", $_POST['chat_room_uuidx']);
if($result_B['user_id_1'] == $_SESSION["session_usr_id"]) {
	$top_chat_title = "".$array_users_name[$result_B['user_id_2']]."";
	$chat_with_id = $result_B['user_id_2'];	
}
else {
	$top_chat_title = "".$array_users_name[$result_B['user_id_1']]."";
	$chat_with_id = $result_B['user_id_1'];
}
	
$user_pp_file_name = DB::queryFirstField("select user_pp_file from users where id=%i", $chat_with_id);

        //validasi user picture tersedia atau tidak
$user_images = 'user_pp_files/default_user_pp.jpg';

if (!empty($user_pp_file_name)) {
  $user_pp_file_path = 'user_pp_files/' . $user_pp_file_name;
  
  if (file_exists($user_pp_file_path)) {
      $user_images = $user_pp_file_path;
  }
}
	
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
      <div class="container px-4 py-3 bg-primary sticky-top">
        <div class="d-flex flex-row align-items-center gap-2">
          <a href="chat-list.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
          </a>
          <div
            id="headbar"
            class="flex-fill d-flex flex-row align-items-center gap-2"
          >
            <img onclick="window.location.href='profile.php?user_id_profile=<?php echo $chat_with_id; ?>';"
              src="<?php echo $user_images; ?>"
              height="32"
              width="32"
              alt="Profile Picture"
              class="rounded-circle"
            />
            <span onclick="window.location.href='profile.php?user_id_profile=<?php echo $chat_with_id; ?>';"><?php echo $top_chat_title; ?></span>
          </div>
          <button aria-label="videocall" class="btn btn-primary p-0 px-1">
            <i class="bi bi-camera-video-fill fs-5"></i>
          </button>
          <button aria-label="telephone" class="btn btn-primary p-0 px-1">
            <i class="bi bi-telephone-fill"></i>
          </button>
          <button aria-label="menu" class="btn btn-primary p-0 px-1">
            <i class="bi bi-three-dots-vertical text-light"></i>
          </button>
        </div>
      </div>
      <!-- Header Chat End -->

      <!-- Chat Conversation Start -->
      <div class="chat-conversation-wrapper">
        <!-- Info Chat Date Start -->
        <div
          class="d-flex flex-row align-items-center justify-content-center my-2"
        >
          <span class="bg-dark rounded-pill px-3 py-1" style="font-size: 10pt"
            >Yesterday</span
          >
        </div>
        <!-- Info Chat Date End -->

		<?php
		/*		
		CREATE TABLE IF NOT EXISTS `chat` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `chat_room_uuid` varchar(255) DEFAULT NULL,
		  `sender_id` bigint(20) DEFAULT NULL,
		  `message` text,
		  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
		*/
		
		
		$results_1 = DB::query("SELECT * FROM chat where chat_room_uuid='".$_POST['chat_room_uuidx']."' order by created_on asc");
		foreach ($results_1 as $row_1) {

			if(strlen($row_1['chat_file']) > 4) {
				$str_image_chat = "<img
						  id='image-chat'
						  src='chat_files/".$row_1['chat_file']."'
						  alt=''
						  class='object-fit-contain rounded-4 cursor__pointer w-100'
						/>";
			}
			else {
				$str_image_chat = "";
			}

			if($row_1['sender_id']==$_SESSION["session_usr_id"]) {
				echo "
				    <!-- POV Chat Right Start (User Logged In) -->
					<div class='bubble__wrapper user'>
					  <div class='bubble__chat user'>
					    $str_image_chat
						<span>".$row_1['message']."</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <div class='time'>&nbsp;</div>
						<div class='time'>
              <span >".timeAgo(strtotime($row_1['created_on']))."</span>
						  <i
							class='bi bi-check2-all fs-6 d-inline-flex'
							style='font-size: 10pt; transform: translateY(4px)'
						  ></i>
						</div>
					  </div>
					</div>
					<!-- POV Chat Right End (User Logged In) -->
				";
			} // if($row_1['sender_id']==$_SESSION["session_usr_id"]) {
			else {
				echo "
				    <!-- POV Chat Left Start -->
					<div class='bubble__wrapper'>
					  <div class='bubble__chat'>
					    $str_image_chat
						<span>".$row_1['message']."</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <div class='time'>&nbsp;</div>
						<div class='time'>
						  <span>".timeAgo(strtotime($row_1['created_on']))."</span>
						</div>
					  </div>
					</div>
					<!-- POV Chat Left End -->
				";
			} // else {			
			
		} // foreach ($results_1 as $row_1) {			
		?>

      </div>
      <!-- Chat Conversation End -->

      <!-- Spacer Bottom  -->
      <div style="height: 90px"></div>

      <!-- Bottom Input Start -->
	  <form action="chat-send-message.php" method="POST" id="formSendChatMessage" enctype='multipart/form-data'>
	  <input type="hidden" name="chat_room_uuidx" value="<?php echo $_POST['chat_room_uuidx']; ?>">
	  <input type="hidden" name="receiver_idx" value="<?php echo $chat_with_id; ?>">
      <div class="fixed-bottom max-w-sm bg-dark d-flex flex-column">
        <div
          id="filename-wrapper"
          class="bg-primary-light px-3 py-2 flex-row align-items-center shadow gap-2"
          style="display: none"
        >
          <i class="bi bi-paperclip fs-4"></i>
          <span id="fileNameDisplay" class="flex-fill"></span>
          <i id="filename-clear" class="bi bi-x-lg cursor__pointer"></i>
        </div>

        <div class="d-flex flex-row align-items-center gap-2 p-3">
          <div
            class="d-flex flex-fill flex-row align-items-center bg-light rounded-pill px-3 py-1 gap-3"
          >
            <input
              placeholder="Enter Message"
              class="bg-transparent border-0 w-100"
			  name="chat_message"
            />

            <label for="fileInput">
              <i
                class="bi bi-paperclip fs-4 text-secondary cursor__pointer"
                style="rotate: 45deg"
              ></i>
              <input type="file" id="fileInput" name="fileInput" hidden />
            </label>

            <label for="imageInput">
              <i class="bi bi-camera fs-4 text-secondary cursor__pointer"></i>
              <input
                type="file"
                accept="image/*"
                id="imageInput"
                name="imageInput"
                hidden
              />
            </label>
          </div>

        <a href="#" onclick="document.getElementById('formSendChatMessage').submit();"
          class="btn btn-primary rounded-circle d-flex flex-row align-items-center justify-content-center"
          style="width: 48px; height: 48px; rotate: 45deg"
        >
          <i class="bi bi-send-fill fs-5"></i>
        </a>
        </div>
      </div>
      <!-- Bottom Input End -->
    </section>

    <!-- Modal Preview Attachment File Start -->
    <div
      id="imagePreview"
      class="max-w-sm fixed-top top-0 left-0 w-100 h-100 bg-black flex-column align-items-center justify-content-between"
      style="display: none"
    >
      <div class="d-flex align-items-end justify-content-end w-100 p-4">
        <i
          id="close-imagePreview"
          class="bi bi-x-lg text-white fs-4 cursor__pointer"
        ></i>
      </div>
      <div class="flex-fill d-flex align-items-center justify-content-center">
        <img
          id="previewImage"
          alt="Preview"
          style="max-width: 100%; max-height: 300px"
        />
      </div>

      <!-- Text Input Start -->
      <div class="bg-dark d-flex flex-row align-items-center gap-2 w-100 p-3">
        <div class="flex-fill">
          <input
            placeholder="Enter Message (Optional)"
            class="bg-transparent border-0 w-100 py-1 text-white"
			name="post_text_caption"
          />
        </div>
        <a href="#" onclick="document.getElementById('formSendChatMessage').submit();"
          class="btn btn-primary rounded-circle d-flex flex-row align-items-center justify-content-center"
          style="width: 48px; height: 48px; rotate: 45deg"
        >
          <i class="bi bi-send-fill fs-5"></i>
        </a>
      </div>
      <!-- Text Input End -->
    </div>
    <!-- Modal Preview Attachment File End -->

    <!-- Modal Show Image On Chat Start -->
    <div
      id="imageView"
      class="max-w-sm fixed-top top-0 left-0 w-100 h-100 bg-black flex-column align-items-center justify-content-between"
      style="display: none"
    >
      <div class="d-flex align-items-end justify-content-end w-100 p-4">
        <i
          id="close-imageView"
          class="bi bi-x-lg text-white fs-4 cursor__pointer"
        ></i>
      </div>
      <div class="flex-fill d-flex align-items-center justify-content-center">
        <img id="viewImage" alt="View" style="max-width: 100%" />
      </div>
    </div>
	</form>
    <!-- Modal Show Image On Chat End -->

    <script>
      // // Scroll Bottom When Have a New Chat
      // // Uncomment to test auto scroll to bottom
      // $(document).ready(function () {
      //   function addChatMessage() {
      //     var newDiv = `<div class="bubble__wrapper">
      //     <div class="bubble__chat">
      //       <span>Message Here</span>
      //       <div class="time">
      //         <span>2:00pm</span>
      //       </div>
      //     </div>
      //   </div>`;

      //     $(`.chat-conversation-wrapper`).append(newDiv);
      //     scrollToBottom();
      //   }

      //   setInterval(function () {
      //     console.log('ce');
      //     addChatMessage();
      //   }, 5000);
      // });
      function scrollToBottom() {
        window.scrollTo(0, document.body.scrollHeight);
      }
    </script>

    <!-- Preview Image  -->
    <script>
      $(document).ready(function () {
        $('#imageInput').on('change', function () {
          var imageInput = this;
          var imagePreview = $('#imagePreview');
          var previewImage = $('#previewImage');

          if (imageInput.files && imageInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              var fileContent = e.target.result;

              // Display the image preview
              imagePreview.addClass('d-flex');
              previewImage.attr('src', fileContent);

              console.log('File Content:', fileContent);
            };

            reader.readAsDataURL(imageInput.files[0]);
          } else {
            console.log('No file selected');
          }
        });

        $('#close-imagePreview').click(function () {
          $('#imagePreview').removeClass('d-flex');
          $('#imageInput').val('');
        });
      });
    </script>

    <!-- View Image Sent Start -->
    <script>
      $(document).ready(function () {
        $(document).on('click', '#image-chat', function () {
          const src = $(this).attr('src');
          $('#imageView').addClass('d-flex');
          $('#viewImage').attr('src', src);
        });
        $('#close-imageView').click(function () {
          $('#imageView').removeClass('d-flex');
        });
      });
    </script>

    <!-- Show Filename Attachment -->
    <script>
      $(document).ready(function () {
        $('#fileInput').on('change', function () {
          var fileName = $(this).val().split('\\').pop();
          $('#fileNameDisplay').text(fileName);
          $('#filename-wrapper').addClass('d-flex');
        });
        $('#filename-clear').click(function () {
          $('#filename-wrapper').removeClass('d-flex');
          $('#fileInput').val('');
        });
      });
    </script>
	
<?php
$count = DB::queryFirstField("SELECT COUNT(*) FROM chat where chat_room_uuid=%s AND receiver_id=%i AND is_read=0", $_POST['chat_room_uuidx'], $_SESSION["session_usr_id"]);
if($count > 0) {
	$update = DB::queryFirstField("UPDATE chat set is_read=1 where chat_room_uuid=%s AND receiver_id=%i AND is_read=0", $_POST['chat_room_uuidx'], $_SESSION["session_usr_id"]);
} // if($count > 0) {
?> 

  </body>
</html>
