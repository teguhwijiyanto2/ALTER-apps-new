<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
// print_r($_POST);
// exit;

$check = DB::queryFirstRow("SELECT * FROM subscription_billing WHERE user_id = %i",$_SESSION["session_usr_id"]);

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
    <title>Billing Address</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="subscriptions.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Billing Address</span>
          </a>
        </div>

        <form action="subscription-billing-proccess.php" method="POST">
          <!-- Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <div class="mb-3">
              <div class="fs-7 text-secondary">Current address</div>
              <div><?= $check ? $check['address'] : '' ?></div>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label text-secondary fs-7"
                >Change Address</label
              >
              <input
                class="form-control bg-dark text-white py-2"
                name="address"
                placeholder="New address"
              />
            </div>
          </div>
          <!-- Summary End -->

          <button
            type="submit"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Save
          </button>
        </form>
      </div>
    </section>
  </body>
</html>
