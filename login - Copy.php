<?php
/*
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
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
    <title>Login - Alter</title>
  </head>

  <body>
    <div
      class="container min-vh-100 d-flex flex-column align-items-center justify-content-center"
    >
      <div class="bg__gradation">
        <h1 class="text-white text-center fw-bold">Login</h1>
      </div>
      <div class="tab__container" style="margin-top: -30px">
        <a href="?s=email" class="tab__item cursor__pointer text-center p-2 <?php echo isset($_GET['s']) && $_GET['s'] == 'email' ? 'active' : ''; ?>">
            Email
        </a>
        <a href="?s=phone" class="tab__item cursor__pointer text-center p-2 <?php echo isset($_GET['s']) && $_GET['s'] == 'phone' ? 'active' : ''; ?>">
            Phone Number
        </a>
    </div>

      <?php
          $emailFormActive = isset($_GET['s']) && $_GET['s'] == 'email';
          $phoneFormActive = isset($_GET['s']) && $_GET['s'] == 'phone';
      ?>

<script>
function switchPswd_login_password() {
  var x = document.getElementById("login_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

      <form
        action="login-process.php"
        id="form-email"
        class="w-100 mt-4 needs-validation <?php echo $emailFormActive ? '' : 'd-none'; ?>" novalidate
        style="display: block"
		    method="POST"
      >	  
        <div class="form__group">
          <label>Email</label>
          <div class="">
            <input
              class="text-input-auth invalid__form"
              type="email"
              name="login_email"
              value="<?php echo isset($_GET['e']) ? $_GET['e'] : ''; ?>"
              placeholder="altermember@gmail.com"
              required
            />
            <div class="invalid-feedback" id="error">Incorrect Email!</div>
            <?php echo isset($_GET['x']) && $_GET['x'] == '1' ? "<small class='invalid__text'>Incorrect Email</small>" : ""; ?>
            
          </div>
        </div>				
        <div class="form__group mt-3">
          <label>Password</label>
          <!-- <div class="form__group-input invalid__form">
            <input type="password" name="password" placeholder="Password" />
            <i id="form-eyes" class="bi bi-eye-slash text-secondary"></i>
          </div>
          <div class="invalid__text mt-2">Must be 8 characters minimum</div> -->
          <div class="position-relative">
            <input
              class="text-input-auth invalid__form"
              type="password"
              name="login_password"
              id="login_password"              
              placeholder="Password"
              required
            />
			<!-- minlength=8 -->
			
            <i
              id="form-eyes" onclick="switchPswd_login_password()"
              class="bi bi-eye-slash text-secondary position-absolute"
              style="top: 12px; right: 12px"
            ></i>
            <?php echo isset($_GET['x']) && $_GET['x'] == '2' ? "<small class='invalid__text'>Incorrect Password</small>" : ""; ?>
            <div class="invalid-feedback" id="error">Incorrect Password!</div>
          </div>
        </div>
        <div
          class="d-flex flex-row align-items-center justify-content-between mt-4"
        >
          <div>
            <input
              class="form-check-input me-1 bg-transparent m-0 fs-5"
              type="checkbox"
              value=""
              id="firstCheckbox"
            />
            <label class="form-check-label text-white lh-1" for="firstCheckbox"
              >Remember me</label
            >
          </div>
          <a href="forgot-password.php" class="text-primary text-decoration-none"
            >Forgot Password?</a
          >
        </div>
		
        <input type="submit" class="btn btn-primary rounded-pill w-100 my-5" value="Login">
      </form>

<script>
function switchPswd_login_password_2() {
  var x = document.getElementById("login_password_2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

      <form
        action="login-byphone-process.php"
        id="form-phone"
        class="w-100 mt-4 needs-validation <?php echo $phoneFormActive ? 'd-block' : 'd-none'; ?>" novalidate
        style="display: block"
		    method="POST"
      >	
		
       <div class="form__group">
          <label>Phone Number</label>
          <div class="">
            <input
              class="text-input-auth invalid__form"
              type="number"
              name="login_phone"
              value="<?php echo isset($_GET['e']) ? $_GET['e'] : ''; ?>"
              placeholder="0876543210"
              required
            />
            <div class="invalid-feedback" id="error">Phone number are not registered</div>
            <?php echo isset($_GET['x']) && $_GET['x'] == '1' ? "<small class='invalid__text'>Phone number are not registered</small>" : ""; ?>
          </div>
        </div>				
        <div class="form__group mt-3">
          <label>Password</label>
          <!-- <div class="form__group-input invalid__form">
            <input type="password" name="password" placeholder="Password" />
            <i id="form-eyes" class="bi bi-eye-slash text-secondary"></i>
          </div>
          <div class="invalid__text mt-2">Must be 8 characters minimum</div> -->
          <div class="position-relative">
            <input id="login_password_2"
              class="text-input-auth invalid__form"
              type="password"
              name="login_password"
              placeholder="*****"
              required
            />
            <i
              id="form-eyes" onclick="switchPswd_login_password_2()"
              class="bi bi-eye-slash text-secondary position-absolute"
              style="top: 12px; right: 12px"
            ></i>
            <?php echo isset($_GET['x']) && $_GET['x'] == '2' ? "<small class='invalid__text'>Incorrect Password</small>" : ""; ?>
            <div class="invalid-feedback" id="error">Must be 8 characters minimum</div>
          </div>
        </div>		
		
        <div
          class="d-flex flex-row align-items-center justify-content-between mt-4"
        >
          <div>
            <input
              class="form-check-input me-1 bg-transparent m-0 fs-5"
              type="checkbox"
              value=""
              id="firstCheckbox"
            />
            <label class="form-check-label text-white lh-1" for="firstCheckbox"
              >Remember me</label
            >
          </div>
          <a href="forgot-password.php" class="text-primary text-decoration-none"
            >Forgot Password?</a
          >
        </div>
        <input type="submit" class="btn btn-primary rounded-pill w-100 my-5" value="Login">
      </form>
      <a
        href="signup.php?s=email"
        class="text-primary text-decoration-none text-center mb-4"
        ><small
          >Need an account? <span class="fw-semibold">SIGN UP</span></small
        ></a
      >
    </div>

		<script>	
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
		  'use strict'

		  // Fetch all the forms we want to apply custom Bootstrap validation styles to
		  var forms = document.querySelectorAll('.needs-validation')

		  // Loop over them and prevent submission
		  Array.prototype.slice.call(forms)
			.forEach(function (form) {
			  form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
				  event.preventDefault()
				  event.stopPropagation()
				}

        // var selector = document.getElementById("login_password").value;
        // var errorMsg = document.getElementById("error");

        // if(selector.length <= 8)
        // {
        //   errorMsg.classList.add("d-block");
        // }

				form.classList.add('was-validated')
			  }, false)
			})
		})()	 
		</script>
		
  </body>
</html>
