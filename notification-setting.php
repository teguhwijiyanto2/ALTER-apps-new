<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$user_notification = DB::queryFirstRow("SELECT * FROM notification_setting where user_id=%i", $_SESSION["session_usr_id"]);

if (!$user_notification) {
  DB::insert('notification_setting', [
	  'user_id' => $_SESSION["session_usr_id"],
	]);

  $user_notification = DB::queryFirstRow("SELECT * FROM notification_setting where user_id=%i", $_SESSION["session_usr_id"]);

}

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
    <title>Notifications Setting</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="account.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Notification Settings</span>
          </a>
        </div>

        <!-- Sound Alert Start -->
        <!-- <div class="p-3 bg-dark rounded-3">
          <a href="" class="nav-link">
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="fs-6">Sound Alert</div>
              <i class="bi bi-chevron-right"></i>
            </div>
          </a>
        </div> -->
        <!-- Sound Alert End -->

        <!-- Summary Start -->
        <div class="p-3 bg-dark rounded-3 mt-3">
          <h5>Preferences</h5>
          <div class="mt-3 d-flex flex-column gap-3">
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="text-secondary">Messages</div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  onclick="changeNotification('messages')"
                  <?php echo ($user_notification['messages'] == 1) ? 'checked' : ''; ?>
                  id=""
                />
              </div>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="text-secondary">Friend request</div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  onclick="changeNotification('friend_request')"
                  <?php echo ($user_notification['friend_request'] == 1) ? 'checked' : ''; ?>
                  id=""
                />
              </div>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="text-secondary">Play request</div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  onclick="changeNotification('play_request')"
                  <?php echo ($user_notification['play_request'] == 1) ? 'checked' : ''; ?>
                  id=""
                />
              </div>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="text-secondary">Tournament request</div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  onclick="changeNotification('tournament_request')"
                  <?php echo ($user_notification['tournament_request'] == 1) ? 'checked' : ''; ?>
                  id=""
                />
              </div>
            </div>
            <div
              class="d-flex flex-row align-items-center justify-content-between"
            >
              <div class="text-secondary">Game updates</div>
              <div class="form-check form-switch">
                <input
                  class="form-check-input fs-5"
                  type="checkbox"
                  role="switch"
                  onclick="changeNotification('games_updated')"
                  <?php echo ($user_notification['games_updated'] == 1) ? 'checked' : ''; ?>
                  id=""
                />
              </div>
            </div>
          </div>
        </div>
        <!-- Summary End -->
      </div>
    </section>
    <script>
      function changeNotification(type) {
            $.ajax({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
              url: "notification_setting_process.php",
              type: 'POST',
              cache: false,
              data: {  'type': type},
              success: function(data) {
              }
          });
        }
    </script>
  </body>
</html>
