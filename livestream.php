<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$array_users_name = array();
$array_users_email = array();
$array_users_username = array();
$results_A = DB::query("SELECT * FROM users");
foreach ($results_A as $row_A) {
	$array_users_name[$row_A['id']] = "".$row_A['name']."";
	$array_users_email[$row_A['id']] = "".$row_A['email']."";
	$array_users_username[$row_A['id']] = "".$row_A['username']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];


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
    <title>Livestream - Alter</title>
  </head>

  <body>
    <!-- User Tab Profile Start -->
    <header class="mt-4">
      <div class="row g-0">
        <div class="col-6">
          <a href="timeline.php">
            <div data-tab="post" class="up__tab-item">Feed</div>
          </a>
        </div>
        <div class="col-6">
          <a href="livestream.php">
            <div data-tab="stats" class="up__tab-item active">Livestream</div>
          </a>
        </div>
      </div>
    </header>
    <!-- User Tab Profile End -->

    <!-- Section List Video Start -->
    <section>
      <div class="container">
        <div class="row g-3 mt-2">
          <div class="col-6">
            <a href="livestream.php">
              <div
                class="p-2 rounded-4 d-flex flex-column justify-content-between"
                style="
                  height: 15rem;
                  background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
                "
              >
                <div class="d-flex flex-row align-items-center gap-2">
                  <div class="bg-danger rounded-pill px-2 py-1">
                    <i class="bi bi-broadcast me-1"></i>
                    <small>Live</small>
                  </div>
                  <div class="bg-secondary rounded-pill px-2 py-1">
                    <small>1.3K</small>
                  </div>
                </div>
                <div class="d-flex flex-column gap-2">
                  <div>
                    <span class="fs-5">Lucerio</span>
                    <img
                      src="assets/icon/ic__star-gold.png"
                      alt=""
                      class="object-fit-contain"
                      height="24"
                      width="24"
                    />
                  </div>
                  <div>
                    <small class="bg-secondary rounded-pill px-2 py-1"
                      >Genshin Impact</small
                    >
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6">
            <div
              class="p-2 rounded-4 d-flex flex-column justify-content-between"
              style="
                height: 15rem;
                background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              "
            >
              <div class="d-flex flex-row align-items-center gap-2">
                <div class="bg-danger rounded-pill px-2 py-1">
                  <i class="bi bi-broadcast me-1"></i>
                  <small>Live</small>
                </div>
                <div class="bg-secondary rounded-pill px-2 py-1">
                  <small>1.3K</small>
                </div>
              </div>
              <div class="d-flex flex-column gap-2">
                <div>
                  <span class="fs-5">Lucerio</span>
                  <img
                    src="assets/icon/ic__star-gold.png"
                    alt=""
                    class="object-fit-contain"
                    height="24"
                    width="24"
                  />
                </div>
                <div>
                  <small class="bg-secondary rounded-pill px-2 py-1"
                    >Genshin Impact</small
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div
              class="p-2 rounded-4 d-flex flex-column justify-content-between"
              style="
                height: 15rem;
                background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              "
            >
              <div class="d-flex flex-row align-items-center gap-2">
                <div class="bg-danger rounded-pill px-2 py-1">
                  <i class="bi bi-broadcast me-1"></i>
                  <small>Live</small>
                </div>
                <div class="bg-secondary rounded-pill px-2 py-1">
                  <small>1.3K</small>
                </div>
              </div>
              <div class="d-flex flex-column gap-2">
                <div>
                  <span class="fs-5">Lucerio</span>
                  <img
                    src="assets/icon/ic__star-gold.png"
                    alt=""
                    class="object-fit-contain"
                    height="24"
                    width="24"
                  />
                </div>
                <div>
                  <small class="bg-secondary rounded-pill px-2 py-1"
                    >Genshin Impact</small
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div
              class="p-2 rounded-4 d-flex flex-column justify-content-between"
              style="
                height: 15rem;
                background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              "
            >
              <div class="d-flex flex-row align-items-center gap-2">
                <div class="bg-danger rounded-pill px-2 py-1">
                  <i class="bi bi-broadcast me-1"></i>
                  <small>Live</small>
                </div>
                <div class="bg-secondary rounded-pill px-2 py-1">
                  <small>1.3K</small>
                </div>
              </div>
              <div class="d-flex flex-column gap-2">
                <div>
                  <span class="fs-5">Lucerio</span>
                  <img
                    src="assets/icon/ic__star-gold.png"
                    alt=""
                    class="object-fit-contain"
                    height="24"
                    width="24"
                  />
                </div>
                <div>
                  <small class="bg-secondary rounded-pill px-2 py-1"
                    >Genshin Impact</small
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div
              class="p-2 rounded-4 d-flex flex-column justify-content-between"
              style="
                height: 15rem;
                background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              "
            >
              <div class="d-flex flex-row align-items-center gap-2">
                <div class="bg-danger rounded-pill px-2 py-1">
                  <i class="bi bi-broadcast me-1"></i>
                  <small>Live</small>
                </div>
                <div class="bg-secondary rounded-pill px-2 py-1">
                  <small>1.3K</small>
                </div>
              </div>
              <div class="d-flex flex-column gap-2">
                <div>
                  <span class="fs-5">Lucerio</span>
                  <img
                    src="assets/icon/ic__star-gold.png"
                    alt=""
                    class="object-fit-contain"
                    height="24"
                    width="24"
                  />
                </div>
                <div>
                  <small class="bg-secondary rounded-pill px-2 py-1"
                    >Genshin Impact</small
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div
              class="p-2 rounded-4 d-flex flex-column justify-content-between"
              style="
                height: 15rem;
                background-image: url('https://images.unsplash.com/photo-1682687981674-0927add86f2b?q=80&w=1287&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
              "
            >
              <div class="d-flex flex-row align-items-center gap-2">
                <div class="bg-danger rounded-pill px-2 py-1">
                  <i class="bi bi-broadcast me-1"></i>
                  <small>Live</small>
                </div>
                <div class="bg-secondary rounded-pill px-2 py-1">
                  <small>1.3K</small>
                </div>
              </div>
              <div class="d-flex flex-column gap-2">
                <div>
                  <span class="fs-5">Lucerio</span>
                  <img
                    src="assets/icon/ic__star-gold.png"
                    alt=""
                    class="object-fit-contain"
                    height="24"
                    width="24"
                  />
                </div>
                <div>
                  <small class="bg-secondary rounded-pill px-2 py-1"
                    >Genshin Impact</small
                  >
                </div>
              </div>
            </div>
          </div>
          <span class="text-secondary text-center mt-4">No more to show</span>
        </div>
      </div>
    </section>
    <!-- Section List Video End -->

    <!-- Floating Bottom Plus Button Start  -->
    <div class="button__bottom max-w-sm">
      <a
        href="livestream-add.php"
        class="btn btn-primary float-end rounded-circle d-flex align-items-center justify-content-center p-0 overflow-hidden me-3"
        style="height: 56px; width: 56px"
      >
        <svg
          width="30"
          height="30"
          viewBox="0 0 30 30"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M2.5 15.625V14.375C2.5 10.2663 2.5 8.21125 3.635 6.8275C3.84262 6.57456 4.07456 6.34262 4.3275 6.135C5.7125 5 7.765 5 11.875 5C15.9838 5 18.0387 5 19.4225 6.135C19.6754 6.34262 19.9074 6.57456 20.115 6.8275C20.9925 7.89625 21.1912 9.36625 21.2362 11.875L22.0737 11.4625C24.505 10.2475 25.7212 9.63875 26.6112 10.1888C27.5 10.7387 27.5 12.0988 27.5 14.8175V15.1825C27.5 17.9012 27.5 19.2612 26.6112 19.8112C25.7212 20.3612 24.505 19.7525 22.0737 18.5363L21.2362 18.125C21.1912 20.6337 20.9925 22.1038 20.115 23.1725C19.9074 23.4254 19.6754 23.6574 19.4225 23.865C18.0375 25 15.985 25 11.875 25C7.76625 25 5.71125 25 4.3275 23.865C4.07456 23.6574 3.84262 23.4254 3.635 23.1725C2.5 21.7875 2.5 19.735 2.5 15.625ZM11.875 10.9375C12.1236 10.9375 12.3621 11.0363 12.5379 11.2121C12.7137 11.3879 12.8125 11.6264 12.8125 11.875V14.0625H15C15.2486 14.0625 15.4871 14.1613 15.6629 14.3371C15.8387 14.5129 15.9375 14.7514 15.9375 15C15.9375 15.2486 15.8387 15.4871 15.6629 15.6629C15.4871 15.8387 15.2486 15.9375 15 15.9375H12.8125V18.125C12.8125 18.3736 12.7137 18.6121 12.5379 18.7879C12.3621 18.9637 12.1236 19.0625 11.875 19.0625C11.6264 19.0625 11.3879 18.9637 11.2121 18.7879C11.0363 18.6121 10.9375 18.3736 10.9375 18.125V15.9375H8.75C8.50136 15.9375 8.2629 15.8387 8.08709 15.6629C7.91127 15.4871 7.8125 15.2486 7.8125 15C7.8125 14.7514 7.91127 14.5129 8.08709 14.3371C8.2629 14.1613 8.50136 14.0625 8.75 14.0625H10.9375V11.875C10.9375 11.6264 11.0363 11.3879 11.2121 11.2121C11.3879 11.0363 11.6264 10.9375 11.875 10.9375Z"
            fill="#202020"
          />
        </svg>
      </a>
    </div>
    <!-- Floating Boottom Plus Button End  -->

    <!-- Navbar Start -->
    <div style="height: 90px"></div>
    <nav
      class="navbar fixed-bottom max-w-sm navbar-expand-lg bg-dark shadow p-0"
    >
      <div class="container">
        <div class="flex-grow-1" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto d-flex flex-row">
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="home.php"
              >
                <img src="assets/icon/ic__nav-home.svg" class="mb-1" />
                <div>Home</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="tournament.php"
              >
                <img src="assets/icon/ic__nav-tournament.svg" class="mb-1" />
                <div>Tournament</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary active"
                aria-current="page"
                href="timeline.php"
              >
                <img src="assets/icon/ic__nav-timeline.svg" class="mb-1" />
                <div>Timeline</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="shophub.php"
              >
                <img src="assets/icon/ic__nav-shophub.svg" class="mb-1" />
                <div>ShopHub</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="account.php"
              >
                <img src="assets/icon/ic__nav-profile.svg" class="mb-1" />
                <div>Account</div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->
  </body>
</html>
