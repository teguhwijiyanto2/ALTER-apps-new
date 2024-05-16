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
    <title>Forgot Password - Alter</title>
  </head>

  <body>
  <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="login.php?s=email">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Forgot Password</span>
          </a>
        </div>

        <!-- Summary Start -->
        <form action="forgot-password-process.php" method="POST" class="mb-5 w-100">
          <div
            class="vh-100 d-flex flex-column align-items-center justify-content-center"
          >
            <p>
              Please provide your email. If the account exists, we'll send you a
              link to reset your password.
            </p>
            <div class="w-100">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control py-3" value="<?php echo (isset($_GET['e'])) ? $_GET['e'] : ''  ?>" />
              <?php echo (isset($_GET['x'])) ? "<small class='text-danger'>Email are not registered</small>" : ''  ?>

            </div>
            <button
              type="submit"
              class="btn btn-primary rounded-pill my-4 w-100"
              
            >
              Send link to email
            </button>
          </div>
        </form>
        <!-- Summary End -->
      </div>
    </section>
  </body>
</html>
