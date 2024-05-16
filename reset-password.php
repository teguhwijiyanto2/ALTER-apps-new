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
    <title>Reset Password - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="login.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Make New Passowrd</span>
          </a>
        </div>

        <!-- Summary Start -->
        <form action="reset-password-process.php" method="POST">
          <div
            class="vh-100 d-flex flex-column align-items-center justify-content-center"
          >
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <div class="w-100 mb-3">
              <label for="passowrd" class="form-label">New Password</label>
              <input type="password" name="password" class="form-control py-3" />
              <?php if(isset($_GET['e']) && $_GET['e'] == 1) {
                echo "<div class='invalid__text mt-2'>Must be 8 characters minimum</div>";
              } ?>
              
            </div>
            <div class="w-100 mb-3">
              <label for="passowrd" class="form-label">Confirm Password</label>
              <input type="password" name="confirm-password" class="form-control py-3" />
              <?php if(isset($_GET['e']) && $_GET['e'] == 2) {
                echo "<div class='invalid__text mt-2'>The confirm password didnt match</div>";
              } ?>
              <!-- <span class="text-secondary"
                ><small>
                  8 characters minimum with at least one uppercase
                </small></span
              > -->
            </div>
            <button
              type="submit"
              class="btn btn-primary rounded-pill my-4 w-100"
            >
              Reset Password
            </button>
          </div>
        </form>
        <!-- Summary End -->
      </div>
    </section>
  </body>
</html>
