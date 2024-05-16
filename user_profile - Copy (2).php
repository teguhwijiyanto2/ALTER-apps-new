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


$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);

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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="vendor/cropimage/profile-image.js"></script>
    <script src="vendor/cropimage/banner-image.js"></script>

    <title>Profile - Alter</title>
  </head>

  <body>
    <!-- Header Start -->
    <section class="position-relative">
	
	  <!--
      <div
        id="banner-profile"
        class="p-3 w-100 cursor__pointer"
        style="
          background-image: url('https://placehold.co/600x300.png');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          height: 200px;
        "
      ></div>
      -->
      <div
        id="banner-profile"
        class="p-3 w-100 cursor__pointer"
        style="
          background-image: url('user_banner_files/<?php echo $user_profile['user_banner_file']; ?>');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          height: 200px;
        "
      ></div>	  
	  
      <!-- Modal View Image Profile Start -->
	  <form action="user-banner-process.php" method="post" enctype="multipart/form-data" id="formUserBanner"> <!-- START formUserBanner -->
      <div
        id="modal-view-banner"
        style="display: none"
        class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
      >
        <div class="bg-dark rounded-4">
          <div class="text-end p-2">
            <i id="close-view-banner" class="bi bi-x-lg cursor__pointer"></i>
          </div>
          <img class="object-fit-contain" style="width: 400px; height: 300px" />
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <label
              for="input-banner"
              class="btn btn-dark w-100 py-2 d-flex flex-row align-items-center gap-2 flex-fill"
              style="font-size: 10pt"
            >
              <i class="bi bi-pencil-square"></i>
              <div>Ubah Gambar</div>
            </label>
            <input type="file" id="input-banner" name="input_banner" hidden />
            <button
              type="button"
              id="delete-banner"
              class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
              style="font-size: 10pt"
            >
              <i class="bi bi-trash-fill"></i>
              <div>Hapus</div>
            </button>
          </div>
        </div>
      </div>
      <!-- Modal View Image Profile End -->

      <!-- Preview Selected Image Profil Start -->
      <div
        id="modal-preview-input-banner"
        style="display: none"
        class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
      >
        <div class="bg-dark rounded-4">
          <img
            id="preview-input-banner"
            class="object-fit-cover"
            style="width: 400px; height: 400px"
          />
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <button
              id="applyCrop"
              type="button"
              class="btn btn-dark py-2 d-flex flex-row align-items-center gap-2 flex-fill"
              style="font-size: 10pt"
            >
              <div class="mx-auto" onclick="document.getElementById('formUserBanner').submit(); alert('hohoho');">Simpan</div>
            </button>
            <button
              id="cancelCrop"
              type="button"
              class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
              style="font-size: 10pt"
            >
              <div class="mx-auto">Batal</div>
            </button>
          </div>
        </div>
      </div>
	  </form> <!-- END formUserBanner -->
      <!-- Preview Selected Image Profil End -->
    </section>
    <!-- Header End -->

    <!-- Navbar Top Start -->
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
        <i class="bi bi-search fs-5 text-secondary"></i>
        <input
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
          <a href="play-request.php" class="position-relative">
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
    <!-- Navbar Top End -->

    <!-- User Profile Start -->
    <section>
      <div class="container">
        <div class="d-flex flex-row align-items-end gap-2">
          <div
            class="border border-dark z-2 rounded-circle"
            style="margin-top: -45px"
          >
		    <!--
            <img
              id="avatar-circle"
              src="https://placehold.co/150x150.png"
              alt=""
              class="rounded-circle ratio-1x1 cursor__pointer"
              width="100"
              height="100"
            />
			-->
            <img
              id="avatar-circle"
              src="user_pp_files/<?php echo $user_profile['user_pp_file']; ?>"
              alt=""
              class="rounded-circle ratio-1x1 cursor__pointer"
              width="100"
              height="100"
            />			
          </div>

          <!-- Modal View Image Profile Start -->
		  <form action="user-pp-process.php" method="post" enctype="multipart/form-data" id="formUserPP"> <!-- START formUserPP -->
          <div
            id="modal-view-avatar"
            style="display: none"
            class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
          >
            <div class="bg-dark rounded-4">
              <div class="text-end p-2">
                <i
                  id="close-view-avatar"
                  class="bi bi-x-lg cursor__pointer"
                ></i>
              </div>
              <img
                class="object-fit-cover"
                style="width: 300px; height: 300px"
              />
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <label
                  for="input-avatar"
                  class="btn btn-dark w-100 py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                  style="font-size: 10pt"
                >
                  <i class="bi bi-pencil-square"></i>
                  <div>Ubah Gambar</div>
                </label>
                <input
                  type="file"
                  id="input-avatar"
                  name="input_avatar"
                  hidden
                />
                <button
                  type="button"
                  id="delete-avatar"
                  class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                  style="font-size: 10pt"
                >
                  <i class="bi bi-trash-fill"></i>
                  <div>Hapus</div>
                </button>
              </div>
            </div>
          </div>
          <!-- Modal View Image Profile End -->

          <!-- Preview Selected Image Profil Start -->
          <div
            id="modal-preview-input-avatar"
            style="display: none"
            class="fixed-top max-w-sm w-100 h-100 bg-black bg-opacity-50 align-items-center justify-content-center"
          >
            <div class="bg-dark rounded-4">
              <img
                id="preview-input-avatar"
                class="object-fit-cover"
                style="width: 400px; height: 400px"
              />
              <div
                class="d-flex flex-row align-items-center justify-content-between"
              >
                <button
                  id="applyCrop"
                  type="button"
                  class="btn btn-dark py-2 d-flex flex-row align-items-center gap-2 flex-fill"
                  style="font-size: 10pt"
                >
                  <div class="mx-auto" onclick="document.getElementById('formUserPP').submit(); alert('yoyoyo');">Simpan</div>
                </button>
                <button
                  id="cancelCrop"
                  type="button"
                  class="btn btn-dark flex-fill py-2 d-flex flex-row align-items-center gap-2 text-danger"
                  style="font-size: 10pt"
                >
                  <div class="mx-auto">Batal</div>
                </button>
              </div>
            </div>
          </div>
		  </form>
          <!-- Preview Selected Image Profil End -->
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
            <div
              class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
              style="width: fit-content"
            >
              <div
                class="rounded-circle"
                style="width: 10px; height: 10px; background-color: green"
              ></div>
              <span><small>Online</small></span>
            </div>
            <div
              class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
              style="width: fit-content"
            >
              <i class="bi bi-gender-<?php echo strtolower($user_profile['gender']); ?>"></i>
              <span><small><?php echo $user_profile['age']; ?></small></span>
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
		<input type="hidden" name="xposted_to" value="0">
		
        <div
          class="d-flex flex-row align-items-center bg-dark rounded-3 p-3 gap-3 mt-3"
        >
          <img
            src="https://placehold.co/48x48.png"
            alt=""
            height="48"
            width="48"
            class="rounded-circle object-fit-cover"
          />
          <textarea
            class="bg-transparent border-0 text-light flex-fill"
            style="outline: none"
            placeholder="Post Something..."
			name="post_text"
			id="post_text"
			style="overflow-wrap: break-word;"
          /></textarea>

            <button class="btn btn-dark" onclick="document.getElementById('formPost').submit();">
              <i class="bi bi-send fs-5"></i>
            </button>
			
          <label for="image" style="cursor: pointer"  onclick="document.getElementById('formAttachment').submit();">
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
          <input type="file" class="d-none" id="image" />
        </div>
		</form>
		
		<form action="post-attachment.php" method="POST" id="formAttachment" enctype='multipart/form-data'>
		<input type="hidden" name="xposted_to" value="0">
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
		$results_1 = DB::query("SELECT * FROM posts where (posted_by=%i AND posted_to=0) OR posted_to=%i order by posted_at desc", $_SESSION["session_usr_id"], $_SESSION["session_usr_id"]);
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
		
		echo "
        <div class='p-3 bg-dark rounded-3 mt-3'>
          <div class='d-flex flex-row align-items-center gap-3'>
            <img
              src='https://placehold.co/48x48.png'
              alt=''
              height='48'
              width='48'
              class='rounded-circle object-fit-cover'
            />
            <div class='flex-fill'>
              <div class='fs-6 lh-1'>".$array_users_name[$row_1['posted_by']]."</div>
              <span class='text-secondary' style='font-size: 10pt'
                >".$row_1['posted_at']."</span
              >
            </div>
            <button class='btn btn-dark p-0'>
              <i class='bi bi-three-dots-vertical fs-5'></i>
            </button>
          </div>

          <div class='mt-3'>
            <p>
              ".$row_1['post_text']."".$str_see_more."
            </p>
            <img
              src='post_files/".$row_1['post_image']."'
              alt=''
              class='w-100 object-fit-cover'
              style='max-height: 250px'
            />
            <div
              class='d-flex flex-row align-items-center justify-content-end gap-3 my-2'
            >
              <button class='btn text-secondary p-0 fs__7'>21 Likes</button>
              <button class='btn text-secondary p-0 fs__7'>2 Comment</button>
              <button class='btn text-secondary p-0 fs__7'>262 Views</button>
            </div>
            <div class='row border-top border-dark-subtle'>
              <div class='col-4 post__footer-item'>
                <div
                  class='d-flex py-2 px-0 flex-row align-items-center justify-content-start gap-2 fs-6'
                >
                  <i class='bi bi-hand-thumbs-up fs-4'></i>
                  <div>Like</div>
                </div>
              </div>
              <div class='col-4 post__footer-item'>
                <div
                  class='d-flex py-2 px-0 flex-row align-items-center justify-content-center gap-2 fs-6'
                >
                  <i class='bi bi-chat-dots fs-4'></i>
                  <div>Comment</div>
                </div>
              </div>
              <div class='col-4 post__footer-item'>
                <div
                  class='d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6'
                >
                  <i class='bi bi-send fs-4'></i>
                  <div>Share</div>
                </div>
              </div>
            </div>
          </div>
        </div>
		";
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
              <h6>4.2K</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Following</span>
              <h6>890</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Profile Views</span>
              <h6>89.2K</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Bio</h6>
            <p class="text-secondary">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Delectus, sit fugit blanditiis repellendus autem saepe iusto
              repellat provident eius minus.
            </p>
          </div>
          <div>
            <h6>Social Media</h6>
            <div class="row row-cols-auto g-2">
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-instagram fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitter-x fs-5"></i>
                </a>
              </div>
              <div class="col">
                <a
                  href="#"
                  class="social__media-icon rounded-circle bg-secondary"
                >
                  <i class="bi bi-twitch fs-5"></i>
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
              <h6>2000 hr</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Total Wins</span>
              <h6>211</h6>
            </div>
            <div class="col-4">
              <span class="text-secondary fs-small">Hours Co-Play</span>
              <h6>300hr</h6>
            </div>
          </div>
          <div class="border-top border-bottom border-secondary pt-3 pb-1 my-3">
            <h6>Favorite Games</h6>
            <p class="text-secondary">
              League of Legends, Genshin Impact, Valorant, Arena of Valor,
              Minecraft
            </p>
          </div>
          <div>
            <h6>Total Successful Co-Play</h6>
            <p class="text-secondary">600 plays</p>
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
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >27 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >28 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
          <div class="feedback_item p-3 bg-dark rounded-3 mt-3">
            <div class="d-flex flex-row align-items-center gap-3">
              <img
                src="https://placehold.co/48x48.png"
                alt=""
                height="48"
                width="48"
                class="rounded-circle object-fit-cover"
              />
              <div class="flex-fill">
                <div class="fs-6 lh-1">Alter Member</div>
                <span
                  id="date-post"
                  class="text-secondary"
                  style="font-size: 10pt"
                  >29 Oct 2023 20:23</span
                ><span style="font-size: 10pt" class="text-secondary"> PM</span>
              </div>
              <button class="btn btn-dark p-0">
                <i class="bi bi-three-dots-vertical fs-5"></i>
              </button>
            </div>

            <div class="mt-3">
              <div class="d-flex flex-row align-items-center gap-3">
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star-fill fs-3"></i>
                <i class="bi bi-star fs-3"></i>
                <i class="bi bi-star fs-3"></i>
              </div>
              <p class="text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Corporis maxime consequatur consequuntur sint at commodi.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Review Section End -->

    <!-- Spacer -->
    <div style="height: 100px"></div>

    <!-- Navbar Bottom Start -->
    <nav
      class="navbar fixed-bottom max-w-sm navbar-expand-lg bg-dark shadow p-0"
    >
      <div class="container">
        <div class="flex-grow-1" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto d-flex flex-row">
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="home.php"
              >
                <img src="assets/icon/ic__nav-home.svg" class="mb-1" />
                <div>Home</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="tournament.php"
              >
                <img src="assets/icon/ic__nav-tournament.svg" class="mb-1" />
                <div>Tournament</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="timeline.php"
              >
                <img src="assets/icon/ic__nav-timeline.svg" class="mb-1" />
                <div>Timeline</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="#"
              >
                <img src="assets/icon/ic__nav-shophub.svg" class="mb-1" />
                <div>ShopHub</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary active"
                aria-current="page"
                href="account.php"
              >
                <img src="assets/icon/ic__nav-profile.svg" class="mb-1" />
                <div>Account</div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar Bottom End -->

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
  </body>
</html>
