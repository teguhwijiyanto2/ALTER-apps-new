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
              src="https://placehold.co/50x50.png"
              height="32"
              width="32"
              alt="Profile Picture"
              class="rounded-circle"
            />
            <span onclick="window.location.href='profile.php?user_id_profile=<?php echo $chat_with_id; ?>';"><?php echo $top_chat_title; ?></span>
          </div>
		  <!--
          <button aria-label="videocall" class="btn btn-primary p-0 px-1">
            <i class="bi bi-camera-video-fill fs-5"></i>
          </button>
          <button aria-label="telephone" class="btn btn-primary p-0 px-1">
            <i class="bi bi-telephone-fill"></i>
          </button>
          <button aria-label="menu" class="btn btn-primary p-0 px-1">
            <i class="bi bi-three-dots-vertical text-light"></i>
          </button>
		  -->
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
            >Today</span
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

			if($row_1['sender_id']==$_SESSION["session_usr_id"]) {
				echo "
				    <!-- POV Chat Right Start (User Logged In) -->
					<div class='bubble__wrapper user'>
					  <div class='bubble__chat user'>
						<span>".$row_1['message']."</span>
						<div class='time'>
						  <span>".getHourMinute($row_1['created_on'])."</span>
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
						<span>".$row_1['message']."</span>
						<div class='time'>
						  <span>".getHourMinute($row_1['created_on'])."</span>
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
	  <form action="chat-send-message.php" method="POST" id="formSendChatMessage">
	  <input type="hidden" name="chat_room_uuidx" value="<?php echo $_POST['chat_room_uuidx']; ?>">
	  <input type="hidden" name="receiver_idx" value="<?php echo $chat_with_id; ?>">
      <div
        class="fixed-bottom max-w-sm bg-dark d-flex flex-row align-items-center gap-2 p-3"
      >
        <div
          class="d-flex flex-fill flex-row align-items-center bg-light rounded-pill px-3 py-1 gap-3"
        >
			  <input
				placeholder="Type your message here..."
				class="bg-transparent border-0 w-100"
				name="chat_message"
			  />
			  <i
				class="bi bi-paperclip fs-4 text-secondary"
				style="rotate: 45deg"
			  ></i>
			  <i class="bi bi-camera fs-4 text-secondary"></i>
		  
        </div>
        <a href="#" onclick="document.getElementById('formSendChatMessage').submit();"
          class="btn btn-primary rounded-circle d-flex flex-row align-items-center justify-content-center"
          style="width: 48px; height: 48px; rotate: 45deg"
        >
          <i class="bi bi-send-fill fs-5"></i>
        </a>
      </div>
	  </form>
      <!-- Bottom Input End -->
    </section>
	
<?php
$update = DB::queryFirstField("UPDATE chat set is_read=1 where chat_room_uuid=%s AND receiver_id=%i AND is_read=0", $row_1['chat_room_uuid'], $_SESSION["session_usr_id"]);
?> 
	
	
  </body>
</html>
