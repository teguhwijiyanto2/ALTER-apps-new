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

$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];



if(isset($_POST['user_id_profile'])) {
	$user_id_profile = $_POST['user_id_profile']; // INI CERITANYA SI USER INI LAGI NGELIAT PROFILE ORANG LAIN (YAITU SI ID 1 ini)
}
elseif(isset($_GET['user_id_profile'])) {
	$user_id_profile = $_GET['user_id_profile']; // INI CERITANYA SI USER INI LAGI NGELIAT PROFILE ORANG LAIN (YAITU SI ID 1 ini)
}
else {
	$user_id_profile = 1; // INI CERITANYA SI USER INI LAGI NGELIAT PROFILE ORANG LAIN (YAITU SI ID 1 ini)
}

$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $user_id_profile);
$option = DB::queryFirstRow("SELECT * FROM matchmaking_option WHERE user_id = %i",$user_id_profile);

$games = '';

if($option) {
  $arrayGame = json_decode($option['game']);

  for($i = 0; $i < count($arrayGame); $i++) {

			if($i != count($arrayGame)-1) {
			  //$games .= ucfirst($arrayGame[$i]).", ";
			  $games .= $array_games[$arrayGame[$i]].", ";
			}else {
			  //$games .= ucfirst($arrayGame[$i]);
			  $games .= $array_games[$arrayGame[$i]];
			}
  }
}
$user_profile_images = 'user_pp_files/default_user_pp.jpg';

  if (!empty($user_profile['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_profile_images = $user_pp_file_path;
    }
  }


  $user_banner_image = 'user_banner_files/default_user_banner.jpg';

  if (!empty($user_profile['user_banner_file'])) {
    $user_banner_file_path = 'user_banner_files/' . $user_profile['user_banner_file'];
    
    if (file_exists($user_banner_file_path)) {
        $user_banner_image = $user_banner_file_path;
    }
  }
  
  
  
$follower = DB::queryFirstField("SELECT count(*) FROM followers where user_id = %i", $user_id_profile);			 
$following = DB::queryFirstField("SELECT count(*) FROM followers where follower_id = %i", $user_id_profile);			 

if($follower > 1000) {
  $divFollower = $follower / 1000;
  $follower = number_format($divFollower, 1)."K";
}
if($following > 1000) {
  $divfollowing = $following / 1000;
  $following = number_format($divfollowing, 1)."K";
}

$gameStats = DB::queryFirstField("SELECT SUM(num_of_hours) FROM `matchmaking_availability` WHERE requestor_id =  %i OR approver_id =  %i AND request_status NOT IN ('Rejected', '-')", $user_id_profile, $user_id_profile);			 
$hoursCoPlay = DB::queryFirstField("SELECT SUM(num_of_hours) FROM `matchmaking_availability` WHERE requestor_id =  %i AND request_status NOT IN ('Rejected', '-')", $user_id_profile);			 
$totalPlay = DB::queryFirstField("SELECT count(*) FROM `matchmaking_availability` WHERE requestor_id =  %i AND request_status NOT IN ('Rejected', '-')", $user_id_profile);			 


$arrayfavGames = [];

($user_profile['dota_2'] != '-' ) ? $arrayfavGames[] .= "Dota 2" : '';
($user_profile['pubg'] != '-' ) ? $arrayfavGames[] .= "PUBG" : '';
($user_profile['free_fire'] != '-' ) ? $arrayfavGames[] .= "Free Fire" : '';
($user_profile['mobile_legends'] != '-' ) ? $arrayfavGames[] .= "Mobile Legends" : '';
($user_profile['aov'] != '-' ) ? $arrayfavGames[] .= "AOV" : '';
($user_profile['apex_legends'] != '-' ) ? $arrayfavGames[] .= "Apex Legends" : '';
($user_profile['call_of_duty'] != '-' ) ? $arrayfavGames[] .= "Call Of Duty" : '';
($user_profile['cs_go'] != '-' ) ? $arrayfavGames[] .= "CS GO" : '';
($user_profile['point_blank'] != '-' ) ? $arrayfavGames[] .= "Point Blank" : '';
($user_profile['fifa'] != '-' ) ? $arrayfavGames[] .= "FIFA" : '';
($user_profile['nba'] != '-' ) ? $arrayfavGames[] .= "NBA" : '';
($user_profile['league_of_legends'] != '-' ) ? $arrayfavGames[] .= "League Of Legends" : '';
($user_profile['valorant'] != '-' ) ? $arrayfavGames[] .= "Valorant" : '';
($user_profile['pokemon'] != '-' ) ? $arrayfavGames[] .= "Pokemon" : '';
($user_profile['pes'] != '-' ) ? $arrayfavGames[] .= "PES" : '';
($user_profile['magic_chess'] != '-' ) ? $arrayfavGames[] .= "Magic Chess" : '';
($user_profile['genshin_impact'] != '-' ) ? $arrayfavGames[] .= "Genshin Impact" : '';

$favGames = '';

for($i = 0; $i < count($arrayfavGames); $i++) {

  if($i != count($arrayfavGames)-1) {
    $favGames .= ucfirst($arrayfavGames[$i]).", ";
  }else {
    $favGames .= ucfirst($arrayfavGames[$i]);
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
    <title>Profile - Alter</title>
  </head>

  <body>
    <!-- Header Start -->
    <section class="position-relative">
      <div
        class="p-3 w-100"
        style="
          background-image: url('<?php echo $user_banner_image; ?>');		  
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          height: 200px;
        "
      ></div>
    </section>
    <!-- Header End -->

    <!-- Navbar Top Start -->
	<form action="profile-search.php" method="POST" id="formSearch">
    <div
      id="navbar-top"
      class="fixed-top max-w-sm d-flex p-3 flex-row align-items-center gap-2"
      style="transition: all 200ms"
    >
      <a
        href="home.php"
        class="rounded-circle bg-dark d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
        <i class="bi bi-chevron-left"></i>
      </a>
      <div
        class="d-flex flex-fill flex-row align-items-center border border-secondary rounded-pill px-3 py-1 gap-3 bg-dark bg-opacity-50"
      >
        <i class="bi bi-search fs-5 text-secondary" onclick="document.getElementById('formSearch').submit();"></i>
        <input name="keyword" value="<?php echo $_POST['keyword']; ?>"
          placeholder="Search in Alter Member"
          class="bg-transparent border-0 w-100 text-light"
        />
      </div>

      <div
        class="rounded-circle bg-dark bg-opacity-50 d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
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
	  </div>
			
      <div
        class="rounded-circle bg-dark bg-opacity-50 d-flex align-items-center justify-content-center"
        style="height: 36px; width: 36px"
      >
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

    </div>
	</form>
    <!-- Navbar Top End -->

    <!-- User Profile Start -->
    <section>
      <div class="container">
        <div class="d-flex flex-row align-items-end gap-2">
          <div
            class="border border-dark z-2 rounded-circle"
            style="margin-top: -45px"
          >
            <img
              src="<?php echo $user_profile_images; ?>" 
              alt=""
              class="rounded-circle ratio-1x1"
              width="100"
              height="100"
            />
          </div>
          <div class="flex-fill"></div>
<?php
		  /*
			CREATE TABLE IF NOT EXISTS `followers` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `user_id` bigint(20) DEFAULT NULL,
			  `follower_id` bigint(20) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
		  */

		  // $_GET["user_id_profile"] ==> ini user yang di follow  (yaitu user yg lagi diliat profilenya)
		  // $_SESSION["session_usr_id"] ==> ini user yang ngikutin / nge-follow (yaitu si user login)
		
		  $check_1 = DB::queryFirstField("SELECT count(*) FROM followers where user_id=%i AND follower_id=%i", $user_id_profile, $_SESSION["session_usr_id"]);
		  if($check_1 > 0) {
			  echo "
				  <div onclick=\"window.location.href='unfollow-process.php?fid=$user_id_profile';\"
					class='bg-dark d-flex align-items-center justify-content-center rounded-circle'
					style='width: 44px; height: 44px; cursor: pointer;'
				  >
					<i class='bi bi-person-slash fs-3'></i>
				  </div>			  
			  ";
		  }
		  else {
			  echo "<a class='btn btn-primary rounded-pill py-2 px-4' href='follow-process.php?fid=$user_id_profile'>Follow</a>";
		  }
		  
			
		  ?>		  

        </div>

        <div class="mt-4">
          <div class="d-flex flex-row align-items-center gap-1">
            <div class="text__purple fs-3 lh-1"><?php echo $user_profile['name']; ?></div>
            <img
              src="assets/icon/ic__star-gold.png"
              alt=""
              class="object-fit-contain"
              height="32"
              width="32"
            />
          </div>
          <small>Indonesia/English</small>
          <div class="d-flex flex-row align-items-center gap-2 mt-2">
            <div class="d-block align-items-center gap-2">
              <div
                class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
                style="width: fit-content"
              >
                <div
                    class="rounded-circle"
                    style="width: 10px; height: 10px; background-color: <?= ($option && $option['available'] == 'available') ? 'green' : 'gray' ?>"
                  ></div>
                  <span><small><?= ($option && $option['available'] == 'available') ? 'Available To Play' : 'Offline' ?></small></span>
                    <div
                    class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
                    style="width: fit-content"
                    >
                    <i class="bi bi-gender-<?php echo strtolower($user_profile['gender']); ?>"></i>
                    <span><small><?php echo $user_profile['age']; ?></small></span>
                  </div>
              </div>
              <?php if($option){ ?>
              <div
                class="d-flex flex-row align-items-center gap-2 bg-dark px-2 mt-2 rounded-pill"
                style="width: fit-content"
              >
                <div
                    class="rounded-circle"
                  ><i class="bi bi-cash fs-6"></i> </div>
                  <span><small>
				  <?//= ($option) ? number_format($option['fee'])." / ".$option['time']." Minutes" : '' ?>
				  <?= ($option) ? number_format($option['fee'])." / session" : '' ?>
				  </small></span>
              </div>
              <div
                class="d-flex flex-row align-items-center gap-2 bg-dark px-2 mt-2 rounded-pill"
                style="width: fit-content"
              >
                <div
                    class="rounded-circle"
                  ><i class="bi bi-controller fs-6"></i></div>
                  <span><small><?= ($option) ? $games : '' ?></small></span>
              </div>
              <?php } ?>
            
            </div>
          </div>
        
		
		
		</div>
      </div>
    </section>
    <!-- User Profile End -->

    <!-- User Tab Profile Start -->
    <section class="mt-4">
      <div class="row g-0">
        <div class="col-4">
          <div data-tab="post" class="up__tab-item active">Post</div>
        </div>
        <div class="col-4">
          <div data-tab="stats" class="up__tab-item">Stats</div>
        </div>
        <div class="col-4">
          <div data-tab="review" class="up__tab-item">Review</div>
        </div>
      </div>
    </section>
    <!-- User Tab Profile End -->

    <!-- Post Section Start -->
    <section id="post" class="tab__content d-block">
      <div class="container">
        <!-- Post Status Start -->
		<form action="post-submit.php" method="POST" id="formPost" enctype='multipart/form-data'>
        <input type="hidden" name="post_type" name="post_type" value="text">
        <input type="hidden" name="xposted_to" value="<?php echo $user_id_profile; ?>">
        <div
          class="d-flex flex-row align-items-center bg-dark rounded-3 p-3 gap-3 mt-3"
        >
          <img
            src="<?php echo $user_profile_images; ?>"
            alt=""
            height="48"
            width="48"
            class="rounded-circle object-fit-cover"
          />
          <textarea
            type="text"
            class="bg-transparent border-0 text-light flex-fill"
            style="outline: none"
            placeholder="Write something to <?php echo $user_profile['name']; ?>"
            name="post_text"
            id="post_text"
            style="overflow-wrap: break-word;"
            required
          /></textarea>
		  
          <label style="cursor: pointer" onclick="document.getElementById('formAttachment').submit();">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g clip-path="url(#clip0_12_715)">
                    <path
                      d="M18.3334 10.0001C18.3334 13.9284 18.3334 15.8926 17.1125 17.1126C15.8934 18.3334 13.9284 18.3334 10 18.3334C6.07169 18.3334 4.10752 18.3334 2.88669 17.1126C1.66669 15.8934 1.66669 13.9284 1.66669 10.0001C1.66669 6.07175 1.66669 4.10758 2.88669 2.88675C4.10835 1.66675 6.07169 1.66675 10 1.66675"
                      stroke="#EDEDED"
                      stroke-width="1.5"
                      stroke-linecap="round"
                    />
                    <path
                      d="M1.66669 10.4167L3.12669 9.13925C3.49263 8.81931 3.96647 8.65036 4.45229 8.66661C4.9381 8.68285 5.3996 8.88308 5.74335 9.22675L9.31835 12.8017C9.59578 13.0791 9.96215 13.2497 10.353 13.2836C10.7438 13.3174 11.1341 13.2123 11.455 12.9867L11.7042 12.8117C12.1672 12.4866 12.7268 12.3281 13.2915 12.3621C13.8563 12.3962 14.3928 12.6208 14.8134 12.9992L17.5 15.4167M12.5 4.58341H15.4167M15.4167 4.58341H18.3334M15.4167 4.58341V7.50008M15.4167 4.58341V1.66675"
                      stroke="#EDEDED"
                      stroke-width="1.5"
                      stroke-linecap="round"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_12_715">
                      <rect width="20" height="20" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </label>
            <button class="btn btn-dark" type="submit">
              <i class="bi bi-send fs-5"></i>
            </button>
        </div>
		</form>
		
		<form action="post-attachment.php" method="POST" id="formAttachment" enctype='multipart/form-data'>
		<input type="hidden" name="xposted_to" value="<?php echo $user_id_profile; ?>">
		</form>
		
        <!-- Post Status End -->

        <!-- Post Card Start -->
		<?php
		/*
		CREATE TABLE IF NOT EXISTS `posts` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `post_uuid` varchar(100) DEFAULT NULL,
		  `post_type` varchar(100) DEFAULT NULL,
		  `post_text` text,
		  `post_image` varchar(255) DEFAULT NULL,
		  `post_video` varchar(255) DEFAULT NULL,
		  `post_audio` varchar(255) DEFAULT NULL,
		  `post_file_ext` varchar(10) DEFAULT NULL,
		  `posted_by` bigint(20) DEFAULT NULL,
		  `posted_at` datetime DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		*/		
		$results_1 = DB::query("SELECT * FROM posts where posted_to=%i order by posted_at desc", $user_id_profile);
		foreach ($results_1 as $row_1) {
			
		if ($row_1['post_text'] === null || $row_1['post_text'] === '') {
			$str_see_more = "";
		}
		else {
			 if(strlen($row_1['post_text']) > 100) {
				$str_see_more = "... &nbsp;<a href='#' class='text-secondary'>See more</a>";
			 }
			 else {
				$str_see_more = ""; 
			 }
		}
		
		$user_pp_file = DB::queryFirstField("SELECT user_pp_file FROM users where id=%i", $row_1["posted_by"]);
		$comment_count = DB::queryFirstField("SELECT count(*) FROM post_comments where post_id=%i", $row_1["id"]);
		$liked_count = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i", $row_1["id"]);
		$liked = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i and liked_by = %i", $row_1["id"], $_SESSION["session_usr_id"]);

    $user_images = 'user_pp_files/default_user_pp.jpg';

    if (!empty($user_pp_file)) {
      $user_pp_file_path = 'user_pp_files/' . $user_pp_file;
      
      if (file_exists($user_pp_file_path)) {
          $user_images = $user_pp_file_path;
      }
    }

    ?>
		<section class="post__wrapper">
          <div
            id="1"
            class="post__item position-relative p-3 bg-dark rounded-3 mt-3"
          >
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="<?php echo $user_images; ?>" 
                onclick="location.href='profile.php?user_id_profile=<?php echo $row_1['posted_by']; ?>'"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill"> 
                <div 
                  class="fs-6 lh-1"
                  onclick="location.href='profile.php?user_id_profile=<?php echo $row_1['posted_by']; ?>'"
                  ><?php echo $array_users_name[$row_1['posted_by']]; ?>
                </div>
                <span class="text-secondary" style="font-size: 10pt"
                  ><?php echo $row_1['posted_at']; ?></span
                >
              </div>
              <div class="popup-post__toggle btn btn-dark p-0" data-id="<?php echo $row_1['id']; ?>">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </div>
            </div>

            <div class="mt-3">
              <p>
                <?php echo $row_1['post_text']."".$str_see_more ?>
              </p>
              <img
                src='post_files/<?php echo $row_1['post_image'] ?>'
                alt=''
                class='w-100 object-fit-cover'
                style='max-height: 250px'
              />
              <div
                class="d-flex flex-row align-items-center justify-content-end gap-3 my-2"
              >
                <button class="btn text-secondary p-0 fs__7"><span id="liked<?php echo $row_1['id'] ?>"><?php echo $liked_count; ?></span> Likes</button>
                <button class="btn text-secondary p-0 fs__7" onclick="showComment(<?php echo $row_1['id'] ?>)"><?php echo $comment_count; ?> Comment</button>
                <!-- <button class="btn text-secondary p-0 fs__7">262 Views</button> -->
              </div>
              <div class="row border-top border-dark-subtle">
                <div class="col-4 post__footer-item">
                <div
                    class="d-flex py-2 px-0 flex-row align-items-center justify-content-start gap-2 fs-6"
                    onclick="likePost(<?php echo $row_1['id'] ?>)"
                  >
                    <i class="liked-icon-<?php echo $row_1['id'] ?> bi <?php echo ($liked > 0) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' ?>  fs-4"></i>
                    <div>Like</div>
                  </div>
                </div>
                <div class="col-4 post__footer-item">
                  <div
                    onclick="showComment(<?php echo $row_1['id'] ?>)"
                    class="d-flex py-2 px-0 flex-row align-items-center justify-content-center gap-2 fs-6"
                  >
                    <i class="bi bi-chat-dots fs-4"></i>
                    <div>Comment</div>
                  </div>
                </div>
                <div class="col-4 post__footer-item">
                <div
                    class="share-button d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6"
                    data-id="<?php echo $row_1['id']; ?>"
                  >
                    <i class="bi bi-send fs-4"></i>
                    <div>Share</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Popup Three Dots Post Start -->
            <div
              id="3dots<?php echo $row_1['id']; ?>"
              class="position-absolute bg-dark shadow__primary border border-secondary border-opacity-25 rounded-4 rounded-top-0 rounded-start-4 overflow-hidden d-none"
              style="top: 60px; right: 16px;"
            >
              <button
                class="report-btn btn btn-dark py-1 px-4 d-block w-100 text-start"
                data-id=<?php echo $row_1['id']; ?>
              >
                Report
              </button>
              <button
                class="bookmark-btn btn btn-dark py-1 px-4 d-block w-100 text-start"
                data-id=<?php echo $row_1['id']; ?>
              >
                Bookmark
              </button>
            </div>
            <!-- P  opup Three Dots Post End -->
                <div
                  id="share<?php echo $row_1['id']; ?>"
                  class="position-absolute rounded-4 rounded-bottom-0 rounded-start-4 overflow-hidden d-none"
                  style="bottom: 10px; right: 16px;"
                >
                <div class="post__footer-item">
                      <div
                        class="d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6"
                      >
                        <a target='_blank'
                        href="whatsapp://send?text=https://dev.alterspace.gg"
                        class="social__media-icon rounded-circle bg-secondary"
                      >
                        <i class="bi bi-whatsapp fs-5"></i>
                      </a>
                        <a target='_blank'
                        href="https://www.instagram.com/sharer.php?u=https://dev.alterspace.gg"
                        class="social__media-icon rounded-circle bg-secondary"
                      >
                        <i class="bi bi-instagram fs-5"></i>
                      </a>
                        <a target='_blank'
                        href="https://twitter.com/intent/tweet?url=https://dev.alterspace.gg/"
                        class="social__media-icon rounded-circle bg-secondary"
                      >
                        <i class="bi bi-twitter-x fs-5"></i>
                      </a>
                      <a target='_blank'
                      href="https://www.facebook.com/sharer.php?u=https://dev.alterspace.gg/;"
                      class="social__media-icon rounded-circle bg-secondary"
                      >
                        <i class="bi bi-facebook fs-5"></i>
                      </a>
                      <a
                      class="close-share social__media-icon rounded-circle bg-secondary"
                      data-id="<?php echo $row_1['id']; ?>"
                      >
                        <i class="bi bi-arrow-right fs-5"></i>
                      </a>
                      </div>
                    </div>
                </div>
          </div>
        </section>
		
    <?php
		} // foreach ($results_1 as $row_1) {
		?>
        <!-- Post Card End -->

      </div>
    </section>
    <!-- Post Section End -->

    <!-- Stats Section Start -->
    <section id="stats" class="tab__content d-none">
      <div class="container">
        <!-- Profile Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Profile</h4>
          <div class="row mt-3">
            <div class="col-4">
              <span class="text-secondary fs-small">Followers</span>
              <h6><?= $follower ?></h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Following</span>
              <h6><?= $following ?></h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Profile Views</span>
              <h6>0</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Bio</h6>
            <p class="text-secondary">
              -
            </p>
          </div>
          <div>
		  
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
		  
            <h6>Social Media</h6>
            <div class="row row-cols-auto g-2">
              <div class="col">
                <a
                  href="https://www.instagram.com/sharer.php?u=<?php echo $link; ?>"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-instagram fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a
                  href="https://twitter.com/intent/tweet?text=<?php echo urlencode($user_profile['name']); ?>&url=<?php echo $link; ?>"
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
        <!-- Profile End -->

        <!-- Game Stats Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Game Stats</h4>
          <div class="row mt-3">
            <div class="col-4">
              <span class="text-secondary fs-small">Game Stats</span>
              <h6><?= ($gameStats) ? $gameStats : '0' ?> hr</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Total Wins</span>
              <h6>-</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Hours Co-Play</span>
              <h6><?= ($hoursCoPlay) ? $hoursCoPlay : '0' ?> hr</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Favorite Games</h6>
            <p class="text-secondary">
              <?= ($favGames) ? $favGames : '-';?>
            </p>
          </div>
          <div>
            <h6>Total Successful Co-Play</h6>
            <p class="text-secondary"><?= $totalPlay ?> plays</p>
          </div>
        </div>
        <!-- Game Stats End -->

        <!-- Badges Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h4>Badges</h4>
          <div class="row g-3 mt-3">
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
            <div class="col-3">
              <img
                src="https://placehold.co/100x100.png"
                alt=""
                class="w-100 object-fit-contain opacity-50"
              />
            </div>
          </div>
        </div>
        <!-- Badges End -->
      </div>
    </section>
    <!-- Stats Section End -->
  
    <!-- Review Section Start -->
    <section id="review" class="tab__content d-none">
      <div class="container border-bottom pb-3 border-secondary">
        <!-- Profile Start -->
        <a href="review.php?uid=<?php echo $user_id_profile; ?>">
          <div class="p-3 bg-dark rounded-3 mt-3">
            <div class="fs-5">Rate and review</div>
            <span class="text-secondary">Share your play experience</span>
            <div class="d-flex flex-row align-items-center gap-3 mt-3">
              <img
                src="<?php echo $user_profile_images; ?>"
                width="48"
                height="48"
                alt=""
                class="object-fit-cover rounded-circle"
              />
              <div class="d-flex flex-row align-items-center gap-2">
			  <?php
				if($user_profile['review_value']==0) {
					echo "<i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i>";
				}
				if($user_profile['review_value']==1) {
					echo "<i class='bi bi-star-fill fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i>";
				}
				if($user_profile['review_value']==2) {
					echo "<i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i>";
				}	
				if($user_profile['review_value']==3) {
					echo "<i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star fs-4'></i><i class='bi bi-star fs-4'></i>";
				}
				if($user_profile['review_value']==4) {
					echo "<i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star fs-4'></i>";
				}	
				if($user_profile['review_value']==5) {
					echo "<i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i><i class='bi bi-star-fill fs-4'></i>";
				}					
			  ?>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="container mt-4">
        <h5>Sort by</h5>
        <div class="d-inline">
          <button
            id="sortLatest"
            class="sort__btn btn btn-primary fs-small px-4 py-0 rounded-pill"
          >
            Latest
          </button>
          <button
            id="sortHighest"
            class="sort__btn btn btn-dark fs-small px-4 py-0 rounded-pill"
          >
            Highest
          </button>
          <button
            id="sortLowest"
            class="sort__btn btn btn-dark fs-small px-4 py-0 rounded-pill"
          >
            Lowest
          </button>
        </div>

        <div id="feedback__wrapper">
          
		  
			<?php
			$results_1 = DB::query("SELECT * FROM reviews where user_id_profile=%i order by posted_at desc", $user_id_profile);
			foreach ($results_1 as $row_1) {
				
				$user_pp_file = DB::queryFirstField("SELECT user_pp_file FROM users where id=%i", $row_1['posted_by']);
								
				$user_profile_images = 'user_pp_files/default_user_pp.jpg';

				  if (!empty($user_pp_file)) {
					$user_pp_file_path = 'user_pp_files/' . $user_pp_file;
					
					if (file_exists($user_pp_file_path)) {
						$user_profile_images = $user_pp_file_path;
					}
				  }
  
  
				echo "
				<div class='feedback_item p-3 bg-dark rounded-3 mt-3'>
				<div class='p-3 bg-dark rounded-3 mt-3'>
				  <div class='d-flex flex-row align-items-center gap-3'>
					<img
					  src='".$user_profile_images."'
					  alt=''
					  height='48'
					  width='48'
					  class='rounded-circle object-fit-cover'
					/>
					<div class='flex-fill'>
					  <div class='fs-6 lh-1'>".$array_users_name[$row_1['posted_by']]."</div>
					  <span class='text-secondary date-post' id='date-post' style='font-size: 10pt'
						>".$row_1['posted_at']."</span
					  >
					</div>
					<button class='btn btn-dark p-0'>
					  <i class='bi bi-three-dots-vertical fs-5'></i>
					</button>
				  </div>
				  <div class='mt-3'>
					<div class='d-flex flex-row align-items-center gap-3'>
					  ";
						if($row_1['review_value']==0) {
							echo "<i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i>";
						}
						if($row_1['review_value']==1) {
							echo "<i class='bi bi-star-fill fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i>";
						}
						if($row_1['review_value']==2) {
							echo "<i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i>";
						}	
						if($row_1['review_value']==3) {
							echo "<i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star fs-3'></i><i class='bi bi-star fs-3'></i>";
						}
						if($row_1['review_value']==4) {
							echo "<i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star fs-3'></i>";
						}	
						if($row_1['review_value']==5) {
							echo "<i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i><i class='bi bi-star-fill fs-3'></i>";
						}					
					echo " 
					</div>
					<p class='text-secondary'>
					  ".nl2br($row_1['review_text'])."
					</p>
				  </div>
				</div>
			  </div>
			  ";	
			} // foreach ($results as $row) {		
			
			?>
		         
      </div>
    </section>
    <!-- Review Section End -->

    <!-- Spacer -->
    <div style="height: 100px"></div>

    <!-- Floating Footer Start -->
    <div
      class="fixed-bottom max-w-sm p-3 bg-dark border-top border-white border-opacity-10"
    >
      <div class="row">

        <div class="col-6">
          <a class="btn btn-outline-light rounded-pill w-100" href="#" onclick="document.getElementById('formChatOpener').submit();">Chat</a>
        </div>
        <div class="col-6">
          <button class="btn btn-primary w-100 rounded-pill" onclick="document.getElementById('formPlayOpener').submit();">Play</button>
        </div>
      </div>
    </div>
    <!-- Floating Footer End -->

	<form action="chat-opener.php" method="POST" id="formChatOpener">
		<input type="hidden" name="chat_type" value="DM">
		<input type="hidden" name="user_1" value="<?php echo $_SESSION["session_usr_id"]; ?>">
		<input type="hidden" name="user_2" value="<?php echo $user_id_profile; ?>">
	</form>

	<form action="play-info.php" method="POST" id="formPlayOpener">
		<input type="hidden" name="chat_type" value="DM">
		<input type="hidden" name="user_1" value="<?php echo $_SESSION["session_usr_id"]; ?>">
		<input type="hidden" name="user_id_profile" value="<?php echo $user_id_profile; ?>">
	</form>

  <!-- Comment -->
  <div
      id="popup-comment"
      class="fixed-bottom z-5 max-w-sm bg-dark h-75 shadow-lg rounded-top-4 d-none no-scrollbar "
    >
      <div
        class="sticky-top bg-dark text-center py-4 border-bottom border-secondary no-scrollbar "
      >
        <span class="ps-5"> Comments </span>
        <i
          id="close-comment"
          class="bi bi-x-lg float-end pe-3 cursor__pointer"
        ></i>
      </div>

      <div class="comment__wrapper no-scrollbar ">
        
      </div>

      <div class="py-5"></div>
      <form
        class="fixed-bottom max-w-sm d-flex flex-row align-items-center gap-3 bg-dark p-3 shadow-lg"
      >
        <img
          src="<?php echo $user_profile_images ?>"
          width="48"
          height="48"
          class="rounded-circle"
        />
        <input type="hidden" name="id_post" id="id_post" value=''>
        <input type="hidden" name="reply_comment_id" id="reply_comment_id" value=''>
        <input
          type="text"
          id="comment_post"
          class="w-100 bg-transparent border-0 text-white"
          style="outline: none"
          placeholder="add a comment for  Alter Member..."
        />
        <button
        type="button"
        onclick="sendComment()"
          class="btn btn-primary rounded-pill d-inline-block px-4 py-2"
        >
          Send
        </button>
      </form>
    </div>
    <!-- Popup Comment End -->
	
    <script>
      $(document).ready(function () {
        $(window).scroll(function (e) {
          var offsetY = $(this).scrollTop();
          if (offsetY > 150) {
            $('#navbar-top').addClass('bg-dark shadow');
          } else {
            $('#navbar-top').removeClass('bg-dark shadow');
          }
        });

        $('.up__tab-item').on('click', function () {
          // Remove the "active" class from all tab items
          $('.up__tab-item').removeClass('active');

          // Add the "active" class to the clicked tab
          $(this).addClass('active');

          const tabId = $(this).data('tab');
          $('.tab__content').removeClass('d-block');
          $('.tab__content').removeClass('d-none');
          $('#' + tabId).addClass('d-block');
        });

        // Function to sort and update feedback items
        function sortAndUpdateFeedbackItems(sortFunction) {
          const feedbackItems = $('.feedback_item');
          feedbackItems.sort(sortFunction);
          feedbackItems.detach();
          $('#feedback__wrapper').append(feedbackItems);
        }

        // Button click events
        $('#sortLatest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');
          // Example: sort by date
          sortAndUpdateFeedbackItems(function (a, b) {
            const dateA = new Date($(a).find('#date-post').text());
            const dateB = new Date($(b).find('#date-post').text());
            return dateB - dateA;
          });
        });

        $('#sortLowest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');

          // Example: sort by lowest rating
          sortAndUpdateFeedbackItems(function (a, b) {
            const starsA = $(a).find('.bi-star-fill').length;
            const starsB = $(b).find('.bi-star-fill').length;
            return starsA - starsB;
          });
        });

        $('#sortHighest').click(function () {
          $('.sort__btn').removeClass('btn-primary');
          $('.sort__btn').addClass('btn-dark');
          $(this).addClass('btn-primary');
          // Example: sort by highest rating
          sortAndUpdateFeedbackItems(function (a, b) {
            const starsA = $(a).find('.bi-star-fill').length;
            const starsB = $(b).find('.bi-star-fill').length;
            return starsB - starsA;
          });
        });
      });
    </script>

    <!-- Comment Popup Start -->
    <script>
      $('#btn-comment').click(function () {
        $('#popup-comment').toggle();
      });
      $('#close-comment').click(function () {
        $('#popup-comment').toggle();
      });
      $();
      $('#reply-comment__total').click(function () {
        $(this).removeClass('d-flex');
        $(this).addClass('d-none');
        $('.reply-comment__wrapper').removeClass('d-none');
        $('.reply-comment__wrapper').addClass('d-block');
      });
    </script>
    <!-- Comment Popup Delete -->

    <!-- Post Card Popup More Three Dots  -->
    <script>
      $(document).ready(function () {
        $('.popup-post__toggle').click(function () {
          $(this).closest('.post__item').find('.popup-post__modal').toggle();
        });

        // Report button click functionality
        $('.report-btn').click(function () {
          var id = $(this).data('id')
          $.ajax({
            url: "post-report.php",
            type: 'POST',
            cache: false,
            data: {  'id_post': id},
            success: function(data) {
              var res = $.parseJSON(data);
              if(res.report) {
                alert('Thanks for letting us now, we ll use this to process further ');
              }

            }
          })
          // Implement your report logic here
          postItem.find('.popup-post__modal').hide();
        });

        // Bookmark button click functionality
        $('.bookmark-btn').click(function () {
          var id = $(this).data('id')
          $.ajax({
            url: "post-bookmark.php",
            type: 'POST',
            cache: false,
            data: {  'id_post': id},
            success: function(data) {
              var res = $.parseJSON(data);
              if(res.report) {
                alert('Thanks for letting us now, we ll use this to process further ');
              }

            }
          })
          postItem.find('.popup-post__modal').hide();
          // Implement your bookmark logic here
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('.popup-post__toggle').click(function () {
          var id = $(this).data('id')
          var hide = $('#3dots'+id).hasClass('d-none');
          if (hide) {
            $('#3dots'+id).removeClass('d-none');
          } else {
            $('#3dots'+id).addClass('d-none');
          }
        });

        // Report button click functionality
        $('.report-btn').click(function () {
          var postItem = $(this).closest('.post__item');
          var postId = postItem.attr('id'); // You can use this ID to identify the specific post
          alert('Thanks for letting us now, we ll use this to process further');
          // Implement your report logic here
          postItem.find('.popup-post__modal').hide();
        });

        // Bookmark button click functionality
        $('.bookmark-btn').click(function () {
          var postItem = $(this).closest('.post__item');
          var postId = postItem.attr('id'); // You can use this ID to identify the specific post
          postItem.find('.popup-post__modal').hide();
          // Implement your bookmark logic here
          alert('Thanks for letting us now, we ll use this to process further');
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        $('.share-button').click(function () {
          var id = $(this).data('id')
          var hide = $('#share'+id).hasClass('d-none');
          if (hide) {
            $('#share'+id).removeClass('d-none');
            $(this).addClass('d-none');
          }
        });
        $('.close-share').click(function () {
          var id = $(this).data('id')
          $('#share'+id).addClass('d-none');
          $('.share-button[data-id="'+id+'"]').removeClass('d-none');
        });

      });
    </script>
    <script>
        function showComment(id, reply) {
          $("#id_post").val(id)
          $.ajax({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
              url: "comments.php?x="+reply,
              type: 'POST',
              cache: false,
              data: {  'id': id},
              success: function(data) {
                  $('.comment__wrapper').html(data);
              }
          });
          $('#popup-comment').removeClass('d-none');
        }
        function sendComment() {
          var id = $("#id_post").val()
          var reply = $("#reply_comment_id").val()
          var comment = $("#comment_post").val()
          if(comment) {
            $.ajax({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
              url: "post-comment.php",
              type: 'POST',
              cache: false,
              data: {  'id_post': id, 'comment_post' : comment, 'reply' : reply},
              success: function(data) {
                showComment(id, reply)
              }
          });
          $('#popup-comment').removeClass('d-none');
          $("#comment_post").val("")
          $("#reply_comment_id").val('')
          }
        }

        function replyComment(id, reply){
          $("#id_post").val(id)
          $("#reply_comment_id").val(reply)
          $("#comment_post").focus()

        }

        $('#close-comment').click(function () {
            $('#popup-comment').addClass('d-none');
        });

       
    </script>
    <script>
        function likePost(id) {
          $.ajax({
            url: "post-liked.php",
            type: 'POST',
            cache: false,
            data: {  'id_post': id},
            success: function(data) {
              var res = $.parseJSON(data);
              if(!res.liked) {
                $('.liked-icon-'+id).removeClass('bi-hand-thumbs-up-fill');
                $('.liked-icon-'+id).addClass('bi-hand-thumbs-up');
              } else {
                $('.liked-icon-'+id).removeClass('bi-hand-thumbs-up');
                $('.liked-icon-'+id).addClass('bi-hand-thumbs-up-fill');
              }
              $('#liked'+id).text(res.count);

            }
          })
        }
    </script>
    <!-- Post Card Popup More Three Dots  -->
  </body>
</html>