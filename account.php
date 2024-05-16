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

$user_profile_images = 'user_pp_files/default_user_pp.jpg';

  if (!empty($user_profile['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $user_profile['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_profile_images = $user_pp_file_path;
    }
  }

$option = DB::queryFirstRow("SELECT * FROM matchmaking_option WHERE user_id = %i",$_SESSION["session_usr_id"]);

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
    <title>Account - Alter</title>
  </head>

  <body>
    <div class="container">
      <div class="w-100 pt-4">
        <!-- Profile Picture Start -->
        <a href="user_profile.php">
          <div class="d-flex flex-row align-items-center gap-3 w-auto">
            <img
              src="<?php echo $user_profile_images; ?>"
              class="rounded-circle"
              height="56"
              width="56"
            />
            <div class="flex-fill">
              <div class="fs-5"><?php echo $_SESSION["session_usr_username"]; ?></div>
              <div
                class="d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill"
                style="width: fit-content"
              >
                <div
                  class="rounded-circle"
                  style="width: 10px; height: 10px; background-color: <?= ($option && $option['available'] == 'available') ? 'green' : 'green' ?>"
				>																										<!-- 'green' : 'gray' -->
				</div>
                <span><small><?= ($option && $option['available'] == 'available') ? 'Online' : 'Online' ?></small></span>
																			   <!-- 'Online' : 'Offline' -->
              </div>
            </div>
            <i class="bi bi-chevron-right fs-5"></i>
          </div>
        </a>
        <!-- Profile Picture End -->

        <!-- Menu Start -->
        <section class="mt-5">
          <div class="w-100 bg-dark rounded-3 px-2 py-3">
            <div class="row">
              <div class="col-4">
                <a href="wallet.php" class="text-center">
                  <div>
                    <img src="assets/icon/ic__profile_wallet.png" />
                  </div>
                  <div class="fs-6">Wallet</div>
                </a>
              </div>
              <div class="col-4">
                <a href="myorder.php" class="text-center">
                  <div>
                    <img src="assets/icon/ic__profile_order.png" />
                  </div>
                  <div class="fs-6">Order</div>
                </a>
              </div>
              <div class="col-4">
                <a href="#" class="text-center">
                  <div>
                    <img src="assets/icon/ic__profile_referal.png" />
                  </div>
                  <div class="fs-6">Referal</div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <!-- Menu End -->

        <!-- Settings Start -->
        <section id="settings__section" class="mt-5">
          <h4>Settings</h4>

          <div class="pt-2">
            <ul id="setting-group" class="list-unstyled">
              <li id="setting-item" class="mb-2">
                <a
                  href="setting__tournament-setting.php"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_cup-star-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Tournament Setting</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="setting__play-options.php"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__solar_gamepad-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Play Options</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="edit_profile.php"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_user-id-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Edit Profile</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="account_setting.php"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_user-rounded-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Account</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <!-- <li id="setting-item" class="mb-2">
                <a
                  href="#"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_shield-user-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Privacy</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li> -->
              <li id="setting-item" class="mb-2">
                <a
                  href="notification-setting.php"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_bell-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">Notification</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="#"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_earth-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">System Language</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="terms-and-conditions.php" target="_blank"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_info-circle-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">About Us</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
              <li id="setting-item" class="mb-2">
                <a
                  href="faq.php" target="_blank"
                  class="d-flex flex-row align-items-center gap-3 p-3 bg-dark rounded-3"
                >
                  <img
                    src="assets/icon/ic__ps_question-square-linear.png"
                    height="24"
                    width="24"
                  />
                  <div class="flex-fill">F A Q</div>
                  <i class="bi bi-chevron-right fs-6"></i>
                </a>
              </li>
            </ul>
          </div>

          <button class="btn btn-danger rounded-pill w-100 mt-3" onclick="window.location.href='logout.php';">
            Log Out
          </button>
        </section>
        <!-- Settings End -->
      </div>
    </div>

    <!-- Navbar Start -->
    <?php
		//include "navbar.inc.php";
	?>
    <!-- Navbar End -->
	
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
                href="shophub.php"
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
	
  </body>
</html>