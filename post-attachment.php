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
$array_users_name[0] = "";

if(isset($_POST['user_id_profile'])) {
	$user_id_profile = $_POST['user_id_profile']; // INI CERITANYA SI USER INI LAGI NGELIAT PROFILE ORANG LAIN (YAITU SI ID 1 ini)
}
elseif(isset($_GET['user_id_profile'])) {
	$user_id_profile = $_GET['user_id_profile']; // INI CERITANYA SI USER INI LAGI NGELIAT PROFILE ORANG LAIN (YAITU SI ID 1 ini)
}
else {
	$user_id_profile = $_SESSION["session_usr_id"];
}

$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $user_id_profile);

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
    <title>Post in timeline</title>
  </head>

  <body>
    <section>
      <form action="post-submit.php" method="POST" id="formPost" enctype='multipart/form-data'>
	  <input type="hidden" name="xposted_to" id="xposted_to" value="<?php echo $_POST['xposted_to']; ?>">
        <div class="container px-4">
          <div class="py-3">
		  
			<?php
				if($_POST['xposted_to']==0) {
					$href="user_profile.php";
				}
				else {
					$href="profile.php?user_id_profile=".$_POST['xposted_to']."";
				}
			?>
		  
            <a href="<?php echo $href; ?>" >
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>On <?php echo $array_users_name[$_POST['xposted_to']]; ?> Timeline</span>
            </a>
          </div>

          <!-- Header Post Start -->
          <div class="d-flex flex-row align-items-center gap-3">
            <img
              src="user_pp_files/<?php echo $user_profile['user_pp_file']; ?>"
              width="50"
              height="50"
              class="rounded-circle"
            />
            <div>
              <div class="fs-5"><?php echo $array_users_name[$_POST['xposted_to']]; ?></div>
              <div class="fs__7 text-secondary">Posting Publicity</div>
            </div>
          </div>
          <!-- Header Post End -->

          <!-- Body Post Start -->
		  
		  <?php
			if($_POST['xposted_to']==0) {
				$placeholder="Post something...";
			}
			else {
				$placeholder="Write something to ".$array_users_name[$_POST['xposted_to']]."...";
			}
		  ?>
		  
          <div class="mt-4">
            <textarea
              rows="10"
              class="border w-100 border-secondary bg-transparent border p-3 border-secondary rounded-4 text-white"
              style="outline: none"
              placeholder="<?php echo $placeholder; ?>"
			  name="post_text"
			  id="post_text"
            ></textarea>
          </div>
          <!-- Body Post End -->

          <!-- Menu Upload Start -->
		  <input type="hidden" name="post_type" id="post_type" value="text">
          <div class="menu__list mt-5">
            <label onclick="document.getElementById('post_type').value='image';"
              for="photo"
              class="d-flex flex-row border-top border-bottom border-dark p-2 align-items-center cursor__pointer gap-3"
            >
              <i class="bi bi-image-fill fs-4"></i>
              Image
            </label>
            <label onclick="document.getElementById('post_type').value='video';"
              for="photo"
              class="d-flex flex-row border-top border-bottom border-dark p-2 align-items-center cursor__pointer gap-3"
            >
              <i class="bi bi-play-btn-fill fs-4"></i>
              Video
            </label>
            <label onclick="document.getElementById('post_type').value='document';"
              for="photo"
              class="d-flex flex-row border-top border-bottom border-dark p-2 align-items-center cursor__pointer gap-3"
            >
              <i class="bi-solid bi-newspaper"></i>
              &nbsp;&nbsp;Document
            </label>
          </div>
          <input type="file" name="file_1" id="photo" hidden />
          <!-- Menu Upload End -->

          <!-- Preview Uploaded Image Start -->
          <div id="preview-photo" class="mt-3" style="display: none">
            <div class="position-relative">
              <img class="w-100 object-fit-contain" />
              <div
                id="btn-clear-image"
                class="position-absolute top-0 end-0 m-2 cursor__pointer"
              >
                <i class="bi bi-x-circle-fill fs-5 text-dark"></i>
              </div>
            </div>
          </div>

          <!-- Preview Uploaded Image End -->

          <input type="submit" class="btn btn-primary rounded-pill my-4 w-100" value="Post">
        </div>
      </form>
    </section>

    <script>
      $(document).ready(function () {
        $('#photo').change(function () {
          var input = this;

          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              var imgPreview = $('#preview-photo').find('img');
              imgPreview.attr('src', e.target.result);
              $('#preview-photo').show();
              $('#btn-clear-image').click(function () {
                imgPreview.attr('src', '');
                $('.photo').val('');
                $('#preview-photo').hide();
                $('.menu__list').show();
              });
            };

            reader.readAsDataURL(input.files[0]);
            $('.menu__list').hide();
          }
        });
      });
    </script>
  </body>
</html>
