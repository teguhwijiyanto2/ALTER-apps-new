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
    <title>Verifikasi OTP - Alter</title>
  </head>

  <body>
	<form
        id="otp_form"
        class="w-100 mt-4"
        action="otp-verification-check.php"
        style="display: block"
		method="POST"
    >
	<input type="hidden" name="xmail" value="<?php echo $_GET['mail']; ?>">
    <div
      class="container min-vh-100 d-flex flex-column align-items-center justify-content-center"
    >
      <div class="bg__gradation">
        <h1 class="text-white text-center fw-bold fs-2 mb-3">
          Enter Verification Code
        </h1>
        <p class="text-light text-center">
          We’ve sent an OTP code to <?php echo $_GET['mail']; ?> <br />Fill the code below
          to verify
        </p>
      </div>
      <div class="mb-5">
        <div class="row g-2">
          <div class="col-2 align-items-center">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_1" id="otp_1"
			  onkeyup="document.getElementById('otp_2').focus();"
            />
          </div>
          <div class="col-2">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_2" id="otp_2"
			  onkeyup="document.getElementById('otp_3').focus();"
            />
          </div>
          <div class="col-2">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_3" id="otp_3"
			  onkeyup="document.getElementById('otp_4').focus();"
            />
          </div>
          <div class="col-2">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_4" id="otp_4"
			  onkeyup="document.getElementById('otp_5').focus();"
            />
          </div>
          <div class="col-2">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_5" id="otp_5"
			  onkeyup="document.getElementById('otp_6').focus();"
            />
          </div>
          <div class="col-2">
            <input
              type="number"
              class="w-100 py-2 py-lg-2 text-center fs-1 rounded-3"
			  name="otp_6" id="otp_6"
			  onkeyup="document.getElementById('otp_form').submit();"
            />
          </div>
        </div>
      </div>

      <a href="#" class="text-primary text-decoration-none text-center mb-4"
        ><small
          >Didnt receive the OTP?<span class="fw-semibold"> RESEND</span></small
        ></a
      >
    </div>
  <form>
  </body>
</html>
