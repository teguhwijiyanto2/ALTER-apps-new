<?php
// Include file gpconfig
include_once 'config.php';
require_once 'db.class.2.php';
date_default_timezone_set('Asia/Jakarta');
// session_start(); // Start session nya
// session_destroy(); 

if(isset($_GET['code'])){
  $gclient->authenticate($_GET['code']);
  $_SESSION['token'] = $gclient->getAccessToken();
  header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
  $gclient->setAccessToken($_SESSION['token']);
}

if ($gclient->getAccessToken()) {

  $gpuserprofile = $google_oauthv2->userinfo->get();

  $email = $gpuserprofile['email'];

  $results_check = DB::queryFirstRow("SELECT * FROM users where email=%s limit 0,1", $email);

  if(empty($results_check)) {
    DB::insert('users', [
      'email' => $email,
      'phone' => '-',
      'password' => '',
      'username' => '',
      'review_value' => 1,
      'otp' => mt_rand(100000, 999999),
      'registration_time' => date("Y-m-d H:i:s"),
      'last_login' => date("Y-m-d H:i:s"),
      'activation_time' => date("Y-m-d H:i:s"),
      'last_logout' => date("Y-m-d H:i:s")
    ]);

    $results_check1 = DB::queryFirstRow("SELECT * FROM users where email=%s limit 0,1", $email);

    $_SESSION["session_usr_id"]=$results_check1['id'];
    $_SESSION["session_usr_email"]=$results_check1['email'];
    $_SESSION["session_usr_phone"]=$results_check1['phone'];
    $_SESSION["session_usr_name"]=$results_check1['name'];
    $_SESSION["session_usr_username"]=$results_check1['username'];
    $_SESSION["session_usr_gender"]=$results_check1['gender'];
    $_SESSION["session_usr_birthdate"]=$results_check1['birthdate'];

    echo("
      <script language='javascript'>
      alert('Welcome to ALTER');
      window.location.href='profile-setup.php';
      </script>
    ");
    
  }else {
      $_SESSION["session_usr_id"]=$results_check['id'];
      $_SESSION["session_usr_email"]=$results_check['email'];
      $_SESSION["session_usr_phone"]=$results_check['phone'];
      $_SESSION["session_usr_name"]=$results_check['name'];
      $_SESSION["session_usr_username"]=$results_check['username'];
      $_SESSION["session_usr_gender"]=$results_check['gender'];
      $_SESSION["session_usr_birthdate"]=$results_check['birthdate'];
      
      echo("
        <script language='javascript'>
        alert('Welcome to ALTER');
        window.location.href='home.php';
        </script>
      ");
  }

} else {
  $authUrl = $gclient->createAuthUrl();
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
    <title>Login - Alter</title>
  </head>

  <body>
    <header>
      <div
        class="container min-vh-100 d-flex flex-column align-items-center justify-content-center"
      >
        <img
          src="assets/img/logo__primary.png"
          class="w-100 object-fit-contain"
          alt=""
        />
        <div class="w-100">
          <a href="login.php?s=email" class="btn btn-primary w-100 rounded-pill"
            >Login</a
          >
          <a href="signup.php?s=email" class="btn btn-outline-light w-100 rounded-pill mt-3"
            >Sign Up</a
          >
        </div>
        <div class="d-flex flex-row align-items-center w-100 my-4 gap-3">
          <div class="w-100 bg-white" style="height: 1px"></div>
          <div class="text-white"><small>or</small></div>
          <div class="w-100 bg-white" style="height: 1px"></div>
        </div>
        <div class="d-flex flex-row align-items-center gap-3">
          <a href="<?php echo($authUrl) ?>" class="bg-white p-2 rounded-circle">
            <img
              src="assets/icon/ic__google.png"
              class="socmed__btn-icon"
              alt=""
            />
          </a>
          <!-- <a href="#" class="bg-white p-2 rounded-circle">
            <img
              src="assets/icon/ic__facebook.png"
              class="socmed__btn-icon"
              alt=""
            />
          </a>
          <a href="#" class="bg-white p-2 rounded-circle">
            <img
              src="assets/icon/ic__dot-three.png"
              class="socmed__btn-icon"
              alt=""
            />
          </a> -->
        </div>
        <div class="mt-5">
          <a
            href="mailto:example@mail.com"
            class="text-primary text-decoration-none"
            >Contact Us</a
          >
        </div>
      </div>
    </header>
  </body>
</html>
