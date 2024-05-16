<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.2.php';

//echo "session_usr_id" . $_SESSION["session_usr_id"];


if(isset($_SESSION["session_usr_id"]) && $_SESSION["session_usr_id"] !== "") {
	
		$results_check = DB::queryFirstRow("SELECT * FROM users where id=%i", $_SESSION["session_usr_id"]);

		$_SESSION["session_usr_id"]=$results_check['id'];
		$_SESSION["session_usr_email"]=$results_check['email'];
		$_SESSION["session_usr_phone"]=$results_check['phone'];
		$_SESSION["session_usr_name"]=$results_check['name'];
		$_SESSION["session_usr_username"]=$results_check['username'];
		$_SESSION["session_usr_gender"]=$results_check['gender'];
		$_SESSION["session_usr_birthdate"]=$results_check['birthdate'];
		
		echo("
		<script language='javascript'>
		window.location.href='home.php';
		</script>
		");

} // if(isset($_SESSION["session_usr_id"]) && $_SESSION["session_usr_id"] !== "") {

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
    <title>Alter</title>
  </head>

  <body>
    <section>
      <div class="">
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-bs-ride="carousel"
          data-bs-wrap="false"
        >
          <div class="carousel-indicators" style="margin-bottom: 5.5rem">
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="3"
              aria-label="Slide 4"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="4"
              aria-label="Slide 5"
            ></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div
                class="min-vh-100 d-flex flex-column align-items-center justify-content-center"
              >
                <div
                  class="d-flex flex-column align-items-center justify-content-center"
                  style="flex: 1"
                >
                  <h2 class="text-primary text-center">Welcome to</h2>
                  <img
                    src="assets/img/logo__primary.png"
                    class="onboarding__img"
                    alt=""
                  />
                  <p class="text-white text-center px-4">
                    Discover gaming, connect with friends, compete in
                    tournaments, and shop for in-game items—all in one place.
                  </p>
                </div>
                <div style="flex: 1"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div
                class="vh-100 d-flex flex-column align-items-center justify-content-center"
              >
                <div
                  class="d-flex flex-column align-items-center justify-content-center"
                  style="flex: 8"
                >
                  <img
                    src="assets/img/onboarding__step-1.png"
                    class="onboarding__img"
                    alt=""
                  />
                  <h2 class="text-primary text-center">Discover Friends</h2>
                  <p class="text-white text-center px-4">
                    Connect with gamers who share your interests. Play, chat,
                    and strategize together like never before.
                  </p>
                </div>
                <div style="flex: 1"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div
                class="vh-100 d-flex flex-column align-items-center justify-content-center"
              >
                <div
                  class="d-flex flex-column align-items-center justify-content-center"
                  style="flex: 9"
                >
                  <img
                    src="assets/img/onboarding__step-2.png"
                    class="onboarding__img"
                    alt=""
                  />
                  <h2 class="text-primary text-center">In-Game Chats</h2>
                  <p class="text-white text-center px-4">
                    Stay in touch with your gaming buddies in real-time. Share
                    tactics, celebrate victories, and immerse yourself in the
                    gaming action.
                  </p>
                </div>
                <div style="flex: 1"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div
                class="vh-100 d-flex flex-column align-items-center justify-content-center"
              >
                <div
                  class="d-flex flex-column align-items-center justify-content-center"
                  style="flex: 8"
                >
                  <img
                    src="assets/img/onboarding__step-3.png"
                    class="onboarding__img"
                    alt=""
                  />
                  <h2 class="text-primary text-center">Compete in Battles</h2>
                  <p class="text-white text-center px-4">
                    Showcase your skills, climb leaderboards, and explore the
                    in-app shop for exclusive tournament-related items.
                  </p>
                </div>
                <div style="flex: 1"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div
                class="vh-100 d-flex flex-column align-items-center justify-content-center"
              >
                <div
                  class="d-flex flex-column align-items-center justify-content-center"
                  style="flex: 9"
                >
                  <img
                    src="assets/img/onboarding__step-4.png"
                    class="onboarding__img"
                    alt=""
                  />
                  <h2 class="text-primary text-center">Explore ShopHub</h2>
                  <p class="text-white text-center px-4">
                    Shop for unique in-game items and power-ups in our
                    marketplace, gain the edge you need for victory.
                  </p>
                  <div class="onboarding__btn">
                    <a
                      href="auth.php"
                      class="btn btn-primary rounded-pill px-4 py-2"
                      >Get Started!</a
                    >
                  </div>
                </div>
                <div style="flex: 1"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
