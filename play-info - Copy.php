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

$user_profile = DB::queryFirstRow("SELECT * FROM users where id=%i", $_POST['user_id_profile']);

$user_profile_images = 'https://placehold.co/150x150.png';

  if (!empty($user_profile['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_profile_images = $user_pp_file_path;
    }
  }

/*
	<form action="play-info.php" method="POST" id="formPlayOpener">
		<input type="hidden" name="chat_type" value="DM">
		<input type="hidden" name="user_1" value="<?php echo $_SESSION["session_usr_id"]; ?>">
		<input type="hidden" name="user_id_profile" value="<?php echo $user_id_profile; ?>">
	</form>
	*/
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

    <script src="vendor/datetimepicker/contrib/jquery-1.9.1.js"></script>

    <script src="vendor/datetimepicker/contrib/hammerjs/hammer.min.js"></script>
    <script src="vendor/datetimepicker/contrib/hammerjs/hammer.fakemultitouch.js"></script>

    <link rel="stylesheet" href="vendor/datetimepicker/lib/drum.css" />
    <link rel="stylesheet" href="css/timepicker.css" />
    <link rel="stylesheet" href="css/calendar.css" />
    <script src="vendor/datetimepicker/lib/drum.js"></script>
    <title>Play With <?php echo $user_profile['name']; ?></title>
    <style>
      .form__section {
        display: none;
      }

      .form__section.active {
        display: block;
      }
    </style>
  </head>

  <body>
    <form action="play-process.php" method="POST">
	<input type="hidden" name="user_id_profile" value="<?php echo $user_id_profile; ?>">	

      <!-- Step 1 Start -->
      <section
        id="step1"
        aria-label="Play With Alter Member"
        class="form__section active"
      >
        <div class="container px-4">
          <div class="py-3">
            <a href="profile.php?user_id_profile=<?php echo $user_id_profile; ?>">
              <i class="bi bi-x-lg fs-5 me-2"></i>
              <span>Play With <?php echo $user_profile['name']; ?></span>
            </a>
          </div>

          <!-- Basic Information Start -->
          <div class="p-3 bg-dark rounded-3">
            <h5>Basic Information</h5>
            <div
              class="form__group mt-4 border-bottom border-secondary border-opacity-50 pb-3"
            >
                <label>Select Game</label>
                <select name="selGame" id="selGame"
                  class="form-select form__group-select"
                  aria-label="Default select example" onchange="document.getElementById('div_TxtSelectedGame').innerHTML=this.value; document.getElementById('div_TxtSelectedGame2').innerHTML=this.value;"
                >
                  <option selected>Select</option>
				  <?php
					foreach($array_games as $key_1 => $val_1) {
						echo "<option value='$key_1'>$val_1</option>";
					} // foreach($array_cities as $key_1 => $val_1) {
				  ?>
                </select>				
            </div>
			
			<div class="form__group mt-3">
              <label>Date & Time</label>
              <div class="form__group-input">
                <input type="datetime-local" class="form-control" name="datetime_play" id="datetime_play"  onchange="document.getElementById('div_TxtDateTimePlay').innerHTML=this.value; document.getElementById('div_TxtDateTimePlay2').innerHTML=this.value;" />
                <script>
					var today = new Date().toISOString().slice(0, 16);
					document.getElementById("datetime_play").min = today;
                </script>
			  </div>
            </div>		
			
            <div
              class="form__group mt-4 border-bottom border-secondary border-opacity-50 pb-3"
            >
                <label>Duration of Play (In Session)</label>
                <select name="selHours" id="selHours" onchange="document.getElementById('div_TxtSelectedHour').innerHTML=this.value; document.getElementById('div_TxtSelectedHour2').innerHTML=this.value;"
                  class="form-select form__group-select"
                  aria-label="Default select example"
                >
                  <option selected>Select</option>
				  <?php
					for($a=1;$a<=5;$a++) {
						echo "<option value='$a'>$a</option>";
					} // for($a=1;$a<=5;$a++) {
				  ?>
                </select>
            </div>
            <div class="form__group mt-3">
              <label>Notes</label>
              <div class="form__group-input">
                <input type="text" name="notes" placeholder="Notes" />
              </div>
            </div>
          </div>
          <!-- Basic Information End -->

          <!-- Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Payment</h5>
            <p class="text-secondary">
              This is a free Play, you wont be charged anything.
            </p>
          </div>
          <!-- Summary End -->
          <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="2"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 1 End -->

      <!-- Step 2 Start -->
      <section
        id="step2"
        aria-label="Pick the available date"
        class="form__section min-vh-100"
      >
        <div class="container px-4">

          <!-- Play With Start -->
          <div class="p-3 bg-dark rounded-3">
            <h6>Play With</h6>
            <div class="d-flex flex-row align-items-center gap-3 mt-3">
              <img
                src="<?= $user_profile_images ?>"
                alt=""
                class="rounded-circle"
                style="height: 50px; width: 50px"
              />
              <span><?php echo $user_profile['name']; ?></span>
            </div>
            <div class="mt-3 d-flex flex-column gap-1">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Games</span>
                <span class="text-light fs-5" id="div_TxtSelectedGame"></span>
              </div>			  
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Playing Time</span>
                <span class="text-light fs-5" id="div_TxtDateTimePlay"></span>
              </div>			  

              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Hours of Play (in Hours)</span>
                <span class="text-light fs-5" id="div_TxtSelectedHour"></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Payment</span>
                <span class="text-light fs-5">Free</span>
              </div>
            </div>
          </div>
          <!-- Play With End -->
		  
		  <!--
		  		  <input type="submit" value="Submit"
            id="next"
            onclick="onNext()"
            data-next="2"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
		  -->
		  
		  <!-- Button Next Start -->
          <button
            id="next"
            onclick="onNext()"
            data-next="2"
            type="button"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
          <!-- Button Next End -->		  
        </div>
      </section>
      <!-- Step 2 End -->

      <!-- Step 3 Start -->
      <section
        id="step3"
        aria-label="Play Summary"
        class="form__section min-vh-100"
      >
        <div class="container px-4">
          <div class="py-3">
            <div onclick="onPrev()" class="cursor__pointer">
              <i class="bi bi-chevron-left fs-5 me-2"></i>
              <span>Play Summary</span>
            </div>
          </div>

          <!-- Play With Start -->
          <div class="p-3 bg-dark rounded-3">
            <h5>Play With</h5>
            <div class="d-flex flex-row align-items-center gap-3 mt-3">
              <img
                src="<?= $user_profile_images ?>"
                alt=""
                class="rounded-circle"
                style="height: 50px; width: 50px"
              />
              <span><?php echo $user_profile['name']; ?></span>
            </div>
            <div class="mt-3 d-flex flex-column gap-1">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Games</span>
                <span class="text-light fs-5" id="div_TxtSelectedGame2"></span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
              </div>
            </div>
          </div>
          <!-- Play With End -->

          <!-- Schedule Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Schedule</h5>
            <div class="d-flex flex-row align-items-center gap-3 mt-3">
              <img
                src="<?= $user_profile_images ?>"
                alt=""
                class="rounded-circle"
                style="height: 50px; width: 50px"
              />
              <span><?php echo $user_profile['name']; ?></span>
            </div>
            <div class="mt-3 d-flex flex-column gap-1">
						
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Playing Time</span>
                <span class="text-light fs-5" id="div_TxtDateTimePlay2"></span>
              </div>			  

              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Hours of Play (in Hours)</span>
                <span class="text-light fs-5" id="div_TxtSelectedHour2"></span>
              </div>
  
            </div>
          </div>
          <!-- Schedule End -->

          <!-- Payment Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Payment</h5>
            <div class="mt-3 d-flex flex-column gap-1">
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>1 x hourly fee</span>
                <span>Free</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between text-secondary"
              >
                <span>Other</span>
                <span>-</span>
              </div>
              <div
                class="d-flex flex-row align-items-center justify-content-between border-top border-secondary border-opacity-50 pt-2"
              >
                <span>Total</span>
                <span class="text-light fs-5">Free</span>
              </div>
            </div>
          </div>
          <!-- Payment End -->

		  <input type="submit" value="Submit"
            id="next"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
		  
          <!-- Button Next Start 
          <!-- 
		  <button
            id="next"
            data-next="3"
            type="submit"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Next
          </button>
		  -->
          <!-- Button Next End -->
        </div>
      </section>
      <!-- Step 3 End -->
    </form>

    <!-- All Popup -->
    <!-- Popup Time Picker Start -->
    <div
      id="timepicker-popup"
      class="position-absolute top-0 start-0 h-100 w-100 bg-black bg-opacity-50 d-flex flex-column justify-content-end opacity-0"
      style="display: none"
    >
      <div class="bg-dark w-100 rounded-top-4 p-3 pt-4 text-center">
        <h5>Wed, 23 Nov 2023</h5>
        <p class="text-secondary">
          Scroll, then tap 'Next' to select the desired time.
        </p>
        <div aria-label="time">
          <div class="w-100">
            <select id="number" class="drum" name="numbers">
              <option value="1">08:00 - 09:00</option>
              <option value="2">09:00 - 10:00</option>
              <option value="3">10:00 - 11:00</option>
              <option value="4">11:00 - 12:00</option>
              <option value="5">12:00 - 13:00</option>
              <option value="6">13:00 - 14:00</option>
              <option value="7">14:00 - 15:00</option>
              <option value="8">15:00 - 16:00</option>
              <option value="9">16:00 - 17:00</option>
              <option value="10">17:00 - 18:00</option>
              <option value="11">18:00 - 19:00</option>
              <option value="12">19:00 - 20:00</option>
              <option value="13">20:00 - 21:00</option>
              <option value="14">21:00 - 22:00</option>
            </select>
          </div>
        </div>
        <button
          id="next"
          onclick="onNext()"
          data-next="3"
          type="button"
          class="btn btn-outline-light rounded-pill my-4 w-100"
        >
          Next
        </button>
      </div>
    </div>
    <!-- Popup Time Picker End -->

    <script>
      Hammer.plugins.fakeMultitouch();
      let currenSection = 1;
      let totalSection = $('.form__section').length;

      setTimeout(function () {
        $('#timepicker-popup').removeClass('d-flex');
      }, 1);
      $('#number').drum({
        panelCount: 10,
        dail_w: 40,
        dail_h: 15,
        dail_stroke_width: 2,
        dail_stroke_color: '#fff',
      });

      function onNext() {
        if (currenSection <= totalSection) {
          $('.form__section').removeClass('active');
          $(`#step${currenSection + 1}`).addClass('active');
          currenSection++;
        }
      }

      function onPrev(n) {
        if (currenSection <= totalSection) {
          $('.form__section').removeClass('active');
          $(`#step${currenSection - 1}`).addClass('active');
          currenSection--;
        }
      }

      $('.days li').click(function () {
        $('#timepicker-popup').addClass('d-flex');
        $('#timepicker-popup').removeClass('opacity-0');
        $(this).children('span').addClass(' active');
      });
      $('#timepicker-popup').click(function () {
        $('.days li span').removeClass('active');
        $(this).removeClass('d-flex');
      });
    </script>
  </body>
</html>
