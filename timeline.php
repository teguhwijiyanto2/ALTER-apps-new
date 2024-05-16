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
    <title>Timeline - Alter</title>
  </head>

  <body>
    <!-- User Tab Profile Start -->
    <header class="mt-4">
      <div class="row g-0">
        <div class="col-6">
          <a href="timeline.php">
            <div data-tab="post" class="up__tab-item active">Feed</div>
          </a>
        </div>
        <div class="col-6">
          <a href="livestream.php">
            <div data-tab="stats" class="up__tab-item">Livestream</div>
          </a>
        </div>
      </div>
    </header>
    <!-- User Tab Profile End -->

    <!-- Feed Category Start -->
    <section>
      <div class="d-flex flex-row align-items-center gap-3 mt-3 mx-3">
        <a href="#" class="btn btn-primary px-4 py-1 rounded-pill">Trends</a>
        <a href="timeline-following.php" class="btn btn-secondary px-4 py-1 rounded-pill">Following</a>
      </div>
    </section>
    <!-- Feed Category End -->

    <!-- Post Section Start -->
    <section id="post" class="tab__content d-block">
      <div class="container">
	  
        <!-- Post Status Start -->
		<!--
        <div
          class="d-flex flex-row align-items-center bg-dark rounded-3 p-3 gap-3 mt-3"
        >
          <img
            src="".$user_profile_images.""
            alt=""
            height="48"
            width="48"
            class="rounded-circle object-fit-cover"
          />
          <input
            type="text"
            class="bg-transparent border-0 text-light flex-fill"
            style="outline: none"
            placeholder="Post Something..."
          />

          <label for="image" style="cursor: pointer">
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
		-->
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
				
		// Query for Trends --> algoritma-nya masih TBD. Sekarang show all aja dulu
		$results_1 = DB::query("SELECT * FROM posts order by posted_at desc", $_SESSION["session_usr_id"], $_SESSION["session_usr_id"]);
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

    $comment_count = DB::queryFirstField("SELECT count(*) FROM post_comments where post_id=%i", $row_1["id"]);
		$liked_count = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i", $row_1["id"]);
		$liked = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i and liked_by = %i", $row_1["id"], $_SESSION["session_usr_id"]);
    $user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $row_1['posted_by']);

    $iconLiked = ($liked > 0) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up';
    $user_profile_images = 'user_pp_files/default_user_pp.jpg';

      if (!empty($user_profile['user_pp_file'])) {
        $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
        
        if (file_exists($user_pp_file_path)) {
            $user_profile_images = $user_pp_file_path;
        }
      }
		
		echo "
        <div class='p-3 bg-dark rounded-3 mt-3 position-relative'>
          <div class='d-flex flex-row align-items-center gap-3' onclick=\"window.location.href='profile.php?user_id_profile=".$row_1['posted_by']."';\">
            <img
              src='".$user_profile_images."'
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
              <button class='btn text-secondary p-0 fs__7'><span id='liked".$row_1['id']."'>".$liked_count."</span> Likes</button>
              <button class='btn text-secondary p-0 fs__7' onclick='showComment(".$row_1['id'].")'>".$comment_count." Comment</button>
            </div>
            <div class='row border-top border-dark-subtle'>
            <div class='col-4 post__footer-item'>
              <div
                class='d-flex py-2 px-0 flex-row align-items-center justify-content-start gap-2 fs-6'
                onclick='likePost(".$row_1['id'].")'
              >
                <i class='liked-icon-".$row_1['id']." bi ".$iconLiked."  fs-4'></i>
                <div>Like</div>
              </div>
            </div>
            <div class='col-4 post__footer-item'>
              <div
                onclick='showComment(".$row_1['id'].")'
                class='d-flex py-2 px-0 flex-row align-items-center justify-content-center gap-2 fs-6'
              >
                <i class='bi bi-chat-dots fs-4'></i>
                <div>Comment</div>
              </div>
            </div>
            <div class='col-4 post__footer-item'>
            <div
                class='share-button d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6'
                data-id='".$row_1['id']."'
              >
                <i class='bi bi-send fs-4'></i>
                <div>Share</div>
              </div>
            </div>
            </div>
          </div>
          <!-- Popup Three Dots Post Start -->
          <div
            id='3dots".$row_1['id']."'
            class='position-absolute bg-dark shadow__primary border border-secondary border-opacity-25 rounded-4 rounded-top-0 rounded-start-4 overflow-hidden d-none'
            style='top: 60px; right: 16px;'
          >
            <button
              class='report-btn btn btn-dark py-1 px-4 d-block w-100 text-start'
              data-id=".$row_1['id']."
            >
              Report
            </button>
            <button
              class='bookmark-btn btn btn-dark py-1 px-4 d-block w-100 text-start'
              data-id=".$row_1['id']."
            >
              Bookmark
            </button>
          </div>
          <!-- P  opup Three Dots Post End -->
          <!-- Popup Three Dots Post Start -->
          <div
            id='share".$row_1['id']."'
            class='position-absolute rounded-4 rounded-bottom-0 rounded-start-4 overflow-hidden d-none'
            style='bottom: 10px; right: 16px;'
          >
          <div class='post__footer-item'>
                <div
                  class='d-flex py-2 px-0 flex-row align-items-center justify-content-end gap-2 fs-6'
                >
                  <a target='_blank'
                  href='whatsapp://send?text=https://beta.alterspace.gg'
                  class='social__media-icon rounded-circle bg-secondary'
                >
                  <i class='bi bi-whatsapp fs-5'></i>
                </a>
                  <a target='_blank'
                  href='https://www.instagram.com/sharer.php?u=https://beta.alterspace.gg'
                  class='social__media-icon rounded-circle bg-secondary'
                >
                  <i class='bi bi-instagram fs-5'></i>
                </a>
                  <a target='_blank'
                  href='https://twitter.com/intent/tweet?url=https://beta.alterspace.gg/'
                  class='social__media-icon rounded-circle bg-secondary'
                >
                  <i class='bi bi-twitter-x fs-5'></i>
                </a>
                <a target='_blank'
                href='https://www.facebook.com/sharer.php?u=https://beta.alterspace.gg/;'
                class='social__media-icon rounded-circle bg-secondary'
                >
                  <i class='bi bi-facebook fs-5'></i>
                </a>
                <a
                class='close-share social__media-icon rounded-circle bg-secondary'
                data-id='".$row_1['id']."'
                >
                  <i class='bi bi-arrow-right fs-5'></i>
                </a>
                </div>
              </div>
          </div>
          <!-- P  opup Three Dots Post End -->
        </div>
		";
		} // foreach ($results_1 as $row_1) {
		?>
        <!-- Post Card End -->
      </div>
    </section>
    <!-- Post Section End -->

    <!-- Navbar Start -->
    <div style="height: 120px"></div>
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
                class="nav-link py-2 text-secondary active"
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
                href="shophub.php"
              >
                <img src="assets/icon/ic__nav-shophub.svg" class="mb-1" />
                <div>ShopHub</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
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
    <div
      id="popup-comment"
      class="fixed-bottom z-5 max-w-sm bg-dark h-75 shadow-lg rounded-top-4 d-none no-scrollbar "
    >
      <div
        class="sticky-top bg-dark text-center py-4 border-bottom border-secondary no-scrollbar"
      >
        <span class="ps-5"> Comments </span>
        <i
          id="close-comment"
          class="bi bi-x-lg float-end pe-3 cursor__pointer"
        ></i>
      </div>

      <div class="comment__wrapper no-scrollbar">
        
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
    <!-- Navbar End -->
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
        function showComment(id,reply) {
          console.log('tess')
          $("#id_post").val(id)
          $.ajax({
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
              url: "post-comment.php",
              type: 'POST',
              cache: false,
              data: {  'id_post': id, 'comment_post' : comment, 'reply' : reply},
              success: function(data) {
                showComment(id,reply)
              }
          });
          $('#popup-comment').removeClass('d-none');
          $("#comment_post").val('')
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
  </body>
</html>
