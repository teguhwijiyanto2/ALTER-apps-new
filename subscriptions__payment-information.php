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
    <title>Payment - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="subscriptions.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Payment Information</span>
          </a>
        </div>

        <div class="">
          <!-- Current Wallet Start -->
          <!-- <div class="wallet-group mt-4">
            <h6>Current Payment</h6>
            <div class="list-wrapper">
              <div
                class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
              >
                <img
                  src="assets/icon/ic__pay-current.png"
                  alt=""
                  width="44"
                  height="44"
                />
                <span class="flex-fill">Mastercard **** **** **** 4532</span>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </div> -->
          <!-- Current Wallet End -->

          <!-- List Wallet Start -->
          <section>
            <h6 class="text-secondary mt-4">Choose other method :</h6>
            <div class="wallet-group mt-4">
              <h6>Ater Wallet</h6>
              <div class="list-wrapper">
                <div
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__wallet.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">Alter Wallet</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
              </div>
            </div>
            <div class="wallet-group mt-4">
              <h6>QRIS</h6>
              <div class="list-wrapper">
                <div
                  onclick="window.location.href='subscription-detail.php?x=qris'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-qris.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">QRIS</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
              </div>
            </div>
            <div class="wallet-group mt-4">
              <h6>E-Wallet</h6>
              <div class="list-wrapper">
                <div
                  onclick="window.location.href='subscription-detail.php?x=gopay'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-gopay.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">Gopay</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
                <div
                onclick="window.location.href='subscription-detail.php?x=dana'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-dana.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">Dana</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
                <div
                onclick="window.location.href='subscription-detail.php?x=ovo'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-ovo.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">Ovo</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
                <div
                onclick="window.location.href='subscription-detail.php?x=shoope'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-shoope.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">ShoopePay</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
              </div>
            </div>
            <div class="wallet-group mt-4">
              <h6>Credit/Debit Card</h6>
              <div class="list-wrapper">
                <div
                onclick="window.location.href='subscription-detail.php?x=debit'"
                  class="d-flex flex-row align-items-center gap-3 border-bottom border-secondary border-opacity-50 py-3"
                >
                  <img
                    src="assets/icon/ic__pay-debit.png"
                    alt=""
                    width="44"
                    height="44"
                  />
                  <span class="flex-fill">Credit/Debit Card</span>
                  <i class="bi bi-chevron-right"></i>
                </div>
              </div>
            </div>
          </section>
          <!-- List Wallet End -->
        </div>
      </div>
    </section>

    <!-- MODAL PAYMENT METHOD -->

    <div
      id="popup"
      class="position-absolute top-0 start-0 w-100 bg-dark z-3"
      style="display: none"
    ></div>

    <script>
      $(document).ready(function () {
        $("#open_popup").click(function () {
          $("#popup").fadeIn();
        });
        $("#close_popup").click(function () {
          $("#popup").fadeOut();
        });
      });
    </script>
  </body>
</html>
