<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';


$count = DB::queryFirstField("SELECT COUNT(*) FROM users where phone=%s limit 0,1", $_POST['phone']);
if($count > 0) {
echo "<script>window.location.href='signup.php?s=phone&x=2&e=".$_POST['phone']."'</script>";
exit();
} // if($count > 0) {

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
    <title>Enter your email - Alter</title>
  </head>

  <body>
    <div
      class="container min-vh-100 d-flex flex-column align-items-center justify-content-center"
    >
      <div class="bg__gradation">
        <h1 class="text-white text-center fw-bold fs-2 mb-3">
          Enter Your Email
        </h1>
        <p class="text-light text-center">
          We will send the verification code to your email
        </p>
      </div>
      <form action="send-otp-verification.php" class="mb-5 w-100" method="POST">
	  <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
	  <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
	  <input type="hidden" name="reg_by_phone" value="Y">
        <input
          type="email"
          class="w-100 p-3 bg-white rounded-4 text-decoration-none"
		  name="email"
		  id="email"
		  required
        />
		  <?php
		  if(isset($_GET['x']) && $_GET['x'] == 1) {
			echo "<div style='color:red;'>Email is already used</div>";
		  } //  if(isset($_GET['x']) && $_GET['x'] == 1) {
		  ?>
        <button type="submit" class="btn btn-primary rounded-pill mt-5 w-100">
          Next
        </button>
      </form>

      <a
        href="mailto:example@mail.com"
        class="text-primary text-decoration-none text-center mb-4"
        ><small>Contact Us</small></a
      >
    </div>
  </body>
</html>
