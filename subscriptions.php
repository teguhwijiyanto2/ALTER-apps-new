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
    <title>Subscriptions</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account_setting.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Subscriptions</span>
          </a>
        </div>

        <!-- Summary Start -->
        <section class="d-flex flex-column gap-2">
          <a href="">
            <div class="bg-dark rounded-3 p-3">
              <h5>Current subcriptions</h5>
              <div class="d-flex flex-row align-items-center gap-3">
                <img
                  src="assets/ilustration/ilus__subs-plus.png"
                  alt="Subscription Plus"
                  width="44"
                  height="44"
                  class="object-fit-cover rounded-2"
                />
                <div class="flex-grow-1">
                  <div class="fs-6">Plus Membership</div>
                  <div class="text-secondary fs-7 lh-sm mt-1">
                    Expired on 15/01/2024
                  </div>
                </div>
                <i class="bi bi-chevron-right"></i>
              </div>
            </div>
          </a>
          <a href="subscriptions__payment-information.php">
            <div
              class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
            >
              <div>
                <div class="fs-6">Payment information</div>
                <div class="text-secondary fs-7 lh-sm mt-1">
                  Mastercard **** **** **** 4532
                </div>
              </div>
              <i class="bi bi-chevron-right"></i>
            </div>
          </a>
          <a href="subscriptions__billing-address.php">
            <div
              class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
            >
              <div>
                <div class="fs-6">Billing address</div>
                <div class="text-secondary fs-7 lh-sm mt-1">
                  CIlandak, Jakarta
                </div>
              </div>
              <i class="bi bi-chevron-right"></i>
            </div>
          </a>
        </section>
        <!-- Summary End -->
      </div>
    </section>
  </body>
</html>
