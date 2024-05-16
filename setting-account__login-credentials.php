<?php
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  require_once 'db.class.php';

  $user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $_SESSION["session_usr_id"]);
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
    <title>Setting Account - Login Credentials</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account_setting.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Login Credentials</span>
          </a>
        </div>

        <!-- Form Start -->
        <form method="POST" action="setting-account__login-credentials-process.php">
          <section>
            <div class="mt-3">
              <label for="username" class="form-label">Username</label>
              <input
                class="form-control bg-dark text-light py-2"
                name=""
                value="<?= $user_profile["username"] ?>"
                disabled
              />
              <div class="text-danger visually-hidden">Username not found</div>
            </div>
            <div class="mt-3">
              <label for="username" class="form-label">Phone</label>
              <input
                type="number"
                class="form-control bg-dark text-light py-2"
                name="phone"
                value="<?= $user_profile["phone"] ?>"
                placeholder="Add"
              />
              <div class="text-danger visually-hidden">Phone has used</div>
            </div>
            <div class="mt-3">
              <label for="username" class="form-label">Email Address</label>
              <input
                type="email"
                class="form-control bg-dark text-light py-2"
                name="email"
                value="<?= $user_profile["email"] ?>"
              />
              <div class="text-danger d-none">Email has used</div>
            </div>
            <button
              type="submit"
              class="btn btn-outline-light rounded-pill mt-5 w-100"
            >
              Save
            </button>
          </section>
        </form>
        <!-- Form End -->
      </div>
    </section>
  </body>
</html>
