<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
// print_r($_POST);
// exit;

$check = DB::queryFirstRow("SELECT * FROM subscription_setting WHERE user_id = %i AND type = %s",$_SESSION["session_usr_id"],$_GET['x']);

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
    <title>Payment Detail</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="subscriptions__payment-information.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Subscription Detail</span>
          </a>
        </div>
        <form id="form" action="subscription-proccess.php" method="POST">

          <!-- Withdraw to Start -->
          <div class="p-3 bg-dark rounded-3 mt-3">
            <h5>Subscription Detail</h5>
            <div class="d-flex flex-row align-items-center gap-3 py-3">
              <input type="hidden" name="type" value="<?= $_GET['x']?>">
              <img
                src="assets/icon/ic__pay-<?= $_GET['x'] ?>.png"
                alt=""
                width="44"
                height="44"
              />
              <div>
                <div class="mt-3">
                  <label for="username" class="form-label">Nama Akun</label>
                  <input
                    class="form-control bg-dark text-light py-2"
                    type="text"
                    name="nama_akun"
                    value="<?= (isset($check)) ? $check['name_account'] : '' ?>"
                  />
                </div>
                <div class="mt-3">
                  <label for="username" class="form-label"><?= ($_GET['x'] != 'debit') ? 'No Hp' : 'No Rekening' ?></label>
                  <input
                    class="form-control bg-dark text-light py-2"
                    type="number"
                    name="number"
                    value="<?= (isset($check)) ? $check['number'] : '' ?>"
                  />
                </div>
              </div>
            </div>
          </div>
          <!-- Withdraw to End -->

          <!-- Button Submit Pay Start -->
          <button
            id="submitButton"
            type="submit"
            class="btn btn-outline-light rounded-pill w-100 my-3"
          >
            Confirm
          </button>
          <!-- Button Submit Pay End -->
        </form>
      </div>
    </section>
  </body>
</html>
