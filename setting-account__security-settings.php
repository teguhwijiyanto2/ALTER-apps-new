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
    <title>Security Settings</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account_setting.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Security Settings</span>
          </a>
        </div>

        <!-- Summary Start -->
        <section class="d-flex flex-column gap-2">
          <a href="change-password.php">
            <div
              class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
            >
              <div class="fs-6">Change your password</div>
              <i class="bi bi-chevron-right"></i>
            </div>
          </a>
          <div class="bg-dark rounded-3 p-3">
            <h5>Two factor authentification</h5>
            <div
              class="d-flex flex-row align-items-center justify-content-between gap-3 mt-3"
            >
              <div>
                <div class="fs-6">Text Message</div>
                <div class="text-secondary fs-7 lh-sm mt-1">
                  Use your mobile phone to receive a text message with an
                  authentication code.
                </div>
              </div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  id=""
                />
              </div>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between gap-3 mt-3"
            >
              <div>
                <div class="fs-6">Authentication App</div>
                <div class="text-secondary fs-7 lh-sm mt-1">
                  Use an app to get the authentication code when you log in to
                  Alter.
                </div>
              </div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  id=""
                />
              </div>
            </div>
          </div>
          <div
            class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
          >
            <div class="fs-6">Password reset protection</div>
            <div class="form-check form-switch">
              <input
                class="form-check-input fs-5"
                type="checkbox"
                role="switch"
                id=""
              />
            </div>
          </div>
          <a href="login-activity.php">
            <div
              class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
            >
              <div class="fs-6">Login Activity</div>
              <i class="bi bi-chevron-right"></i>
            </div>
          </a>
          <a href="">
            <div
              class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
            >
              <div>
                <div class="fs-6">Connected accounts</div>
                <div class="text-secondary fs-7 lh-sm mt-1">
                  Manage accounts that are connected to Alter to log in
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
