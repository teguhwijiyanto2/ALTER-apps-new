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

$user_id_profile = $_GET['uid'];

$user_profile = DB::queryFirstRow("SELECT * FROM users where id=%i", $user_id_profile);


$user_profile_images = 'user_pp_files/default_user_pp.jpg';

  if (!empty($user_profile['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_profile_images = $user_pp_file_path;
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
    <title>Home - Alter</title>
  </head>

  <body>
    <section>
	<form action="review-process.php" method="POST">
	<input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
      <div class="container px-4">
        <div class="py-3">
          <a href="profile.php">
            <i class="bi bi-chevron-left fs-5"></i>
            <span>Reviews for <?php echo $user_profile['name']; ?></span>
          </a>
        </div>

        <div>
          <div class="d-flex flex-row align-items-center gap-3 mt-3">
            <img
              src="<?php echo $user_profile_images; ?>"
              alt=""
              height="48"
              width="48"
              class="rounded-circle object-fit-cover"
            />
            <div class="flex-fill">
              <div class="fs-6 lh-1"><?php echo $user_profile['name']; ?></div>
              <span class="text-secondary" style="font-size: 10pt"
                >Posting publicly</span
              >
            </div>
          </div>

          <div
            class="d-flex flex-row align-items-center justify-content-between gap-3 my-4"
          >
				<div id="div_stars" style="cursor:pointer;">
					<i class="bi bi-star fs-1" onclick="setReviewValue(1);"></i>
					<i class="bi bi-star fs-1" onclick="setReviewValue(2);"></i>
					<i class="bi bi-star fs-1" onclick="setReviewValue(3);"></i>
					<i class="bi bi-star fs-1" onclick="setReviewValue(4);"></i>
					<i class="bi bi-star fs-1" onclick="setReviewValue(5);"></i>
				</div>	
          </div>
				<input type="hidden" name="review_value" id="review_value" value="0">
          <label>Tell us more about your experience</label>
          <textarea
            placeholder="Share details of your own experience from the play"
            class="w-100 mt-2 bg-transparent border border-secondary rounded-4 text-white p-4"
            id=""
            cols="30"
            rows="5"
			name="review_text"
          ></textarea>
        </div>

        <div class="fixed-bottom max-w-sm p-4">
          <input class="btn btn-primary w-100" type="submit" value="Post">
        </div>
      </div>
	  </form>
    </section>
	
<script>
function setReviewValue(val) {
	if(val==1) {
		document.getElementById('div_stars').innerHTML="<i class='bi bi-star-fill fs-1' onclick='setReviewValue(1);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(2);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(3);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(4);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(5);'></i>";
		document.getElementById('review_value').value=1;
	}
	if(val==2) {
		document.getElementById('div_stars').innerHTML="<i class='bi bi-star-fill fs-1' onclick='setReviewValue(1);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(2);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(3);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(4);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(5);'></i>";
		document.getElementById('review_value').value=2;
	}
	if(val==3) {
		document.getElementById('div_stars').innerHTML="<i class='bi bi-star-fill fs-1' onclick='setReviewValue(1);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(2);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(3);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(4);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(5);'></i>";
		document.getElementById('review_value').value=3;
	}
	if(val==4) {
		document.getElementById('div_stars').innerHTML="<i class='bi bi-star-fill fs-1' onclick='setReviewValue(1);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(2);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(3);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(4);'></i>&nbsp;<i class='bi bi-star fs-1' onclick='setReviewValue(5);'></i>";
		document.getElementById('review_value').value=4;
	}
	if(val==5) {
		document.getElementById('div_stars').innerHTML="<i class='bi bi-star-fill fs-1' onclick='setReviewValue(1);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(2);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(3);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(4);'></i>&nbsp;<i class='bi bi-star-fill fs-1' onclick='setReviewValue(5);'></i>";
		document.getElementById('review_value').value=5;
	}	
}
</script>
	
  </body>
</html>
