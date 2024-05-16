<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';



$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

$array_product_category_name = array("1"=>"Mobile Prepaid","2"=>"Mobile Data","3"=>"Top Up Game","4"=>"eWallet","5"=>"Voucher");




$url = 'https://bgtest.e2pay.co.id/bg/restful/prepaidProduct';
$data = array(
    "bankChannel" => "6017",
    "bankId" => "00000010"
);
$encodedData = json_encode($data);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // only for localhost nih, krn gak ada SSLnya!
$data_string = urlencode(json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','date:2023-11-15T11:40:00+0700','authorization:HiNRluaEgjL1wRzpcRGGRr4R+ra42KL5tTIRRNlzljU='));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
$result_prepaidProduct = curl_exec($curl);
// Check the return value of curl_exec(), too
if ($result_prepaidProduct === false) {
	throw new Exception(curl_error($curl), curl_errno($curl));
}
// Check HTTP return code, too; might be something else than 200
$httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
//echo $result_prepaidProduct;



$json_decoded = json_decode($result_prepaidProduct, true);
$data_responses = $json_decoded["data"];

foreach ($data_responses as $index => $data_response) {
	//echo "$index => $data_response<br>";
	//echo "<br>";
	foreach ($data_response as $key => $val) {
		//echo "$key => $val<br>";
		// Parsing process here :
		
		/* sample 1 data return:
			productCode => 1201
			nominal => 108000
			payeeCode => 10002
			name => Paket Data
			description => Paket Data
			type => 2
			clientPrice => 108000.00
		*/
		// ALTER cuma jalanin Mobile Prepaid, Paket Data, Game, eWallet, & eVoucher (type 1,2,3,4,5) !
		/* namingnya :
			Mobile Prepaid --> Mobile Prepaid
			Paket Data --> Mobile Data
			Game --> Top Up Game
			eWallet --> eWallet
			eVoucher --> Voucher
		*/		
		
	} // foreach ($data_response as $key => $val) {
} // foreach ($data_responses as $index => $data_response) {

	
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
    <title>Shophub - Alter</title>
  </head>

  <body>
    <div class="container">
      <div class="w-100 pt-4">
	  
        <!-- Top Bar Start -->
        <div class="d-flex flex-row align-items-center w-100 gap-1">
          <div
            class="d-flex flex-fill flex-row align-items-center border border-secondary rounded-pill px-3 py-1 gap-3"
          >
            <i class="bi bi-search fs-4 text-secondary"></i>
            <input
              placeholder="Search for games or friends"
              class="bg-transparent border-0 w-100 text-light"
            />
          </div>
          <a href="chat.php">
            <img
              src="assets//icon/ic__bubble-chat.svg"
              height="36"
              width="36"
            />
          </a>
          <img src="assets//icon/ic__bell.svg" height="36" width="36" />
        </div>
        <!-- Top Bar End -->

        <!-- Banner Carousel Start -->
        <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-indicators" style="bottom: -40px">
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
          </div>
          <div class="carousel-inner mt-4">
            <div class="carousel-item active">
              <img
                src="https://placehold.co/600x400.png"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="https://placehold.co/600x400.png"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="https://placehold.co/600x400.png"
                class="d-block w-100 rounded-4 p-1"
                alt="..."
              />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!-- Banner Carousel End -->

        <!-- Shop By Games Start -->
		<!--
        <section id="shop-games__section" class="mt-5">
          <div
            class="d-flex flex-row align-items-center justify-content-between"
          >
            <h4>Shop by Games</h4>
            <a href="#" class="text-decoration-none">
              <i class="bi bi-chevron-right fs-4"></i>
            </a>
          </div>

          <div class="row g-3 pt-2">
            <div class="col-4">
              <img
                src="https://placehold.co/400x400.png"
                alt=""
                class="w-100 h-100 ratio-1x1 object-fit-cover rounded-3"
              />
            </div>
            <div class="col-4">
              <img
                src="https://placehold.co/400x400.png"
                alt=""
                class="w-100 ratio-1x1 object-fit-cover rounded-3"
              />
            </div>
            <div class="col-4">
              <img
                src="https://placehold.co/400x400.png"
                alt=""
                class="w-100 ratio-1x1 object-fit-cover rounded-3"
              />
            </div>
          </div>
        </section>
		-->
        <!-- Shop By Games End -->

        <!-- Shop by Category Start -->
        <section id="shop-category__section" class="mt-5">
          <div class="mt-5">
            <h4>Shop by Category</h4>
            <div class="row mt-2 g-3">

              <div class="col-6">
                <a
                  href="shophub-by-category.php?cat=1"
                  class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center gap-3"
                  style="min-height: 96px"
                >
                  <img
                    src="assets/icon/ic__shop-console.png"
                    alt="Top Up"
                    height="46"
                    width="46"
                  />
                  <span class="fs-5">Mobile Prepaid</span>
                </a>
              </div>
			  
              <div class="col-6">
                <a
                  href="shophub-by-category.php?cat=2"
                  class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center gap-3"
                  style="min-height: 96px"
                >
                  <img
                    src="assets/icon/ic__shop-key.png"
                    alt="Top Up"
                    height="46"
                    width="46"
                  />
                  <span class="fs-5">Mobile Data</span>
                </a>
              </div>

              <div class="col-6">
                <a
                  href="shophub-by-category.php?cat=3"
                  class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center gap-3"
                  style="min-height: 96px"
                >
                  <img
                    src="assets/icon/ic__shop-user.png"
                    alt="Top Up"
                    height="46"
                    width="46"
                  />
                  <span class="fs-5">Top Up Game</span>
                </a>
              </div>			  
			  
              <div class="col-6">
                <a
                  href="shophub-by-category.php?cat=4"
                  class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center gap-3"
                  style="min-height: 96px"
                >
                  <img
                    src="assets/icon/ic__shop-user.png"
                    alt="Top Up"
                    height="46"
                    width="46"
                  />
                  <span class="fs-5">eWallet</span>
                </a>
              </div>
			  
              <div class="col-6">
                <a
                  href="shophub-by-category.php?cat=5"
                  class="bg-dark rounded-3 p-3 d-flex flex-row align-items-center gap-3"
                  style="min-height: 96px"
                >
                  <img
                    src="assets/icon/ic__shop-dollar.png"
                    alt="Top Up"
                    height="46"
                    width="46"
                  />
                  <span class="fs-5">Voucher</span>
                </a>
              </div>		  
			  
            </div>
          </div>
        </section>
        <!-- Shop by Category End -->
      </div>
    </div>

    <!-- Popular Start -->
    <section id="popular__section" class="mt-5">
      <div
        class="d-flex px-3 flex-row align-items-center justify-content-between"
      >
        <h4>Popular</h4>
        <a href="#" class="text-decoration-none">
          <i class="bi bi-chevron-right fs-4"></i>
        </a>
      </div>

      <div
        class="bg__violet py-4 d-flex flex-row align-items-cemter gap-3 mt-3"
      >
        <div class="">
          <img
            src="assets/img/shop__promo-keqing.png"
            class="object-fit-contain h-100 ms-3"
            width="150"
            alt=""
          />
        </div>
        <div
          class="flex-fill d-inline overflow-x-scroll overflow-y-hidden"
          style="white-space: nowrap"
        >
          <a
            href="purchase-details.php"
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">3270+400 Gems</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </a>
          <a
            href="#"
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">3270+400 Gems</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </a>
          <div
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">3270+400 Gems</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="bg__dark-yellow py-4 d-flex flex-row align-items-cemter gap-3"
      >
        <div class="">
          <img
            src="assets/img/shop__promo-cashback.png"
            class="object-fit-contain h-100 ms-3"
            width="150"
            alt=""
          />
        </div>
        <div
          class="flex-fill d-inline overflow-x-scroll overflow-y-hidden"
          style="white-space: nowrap"
        >
          <a
            href="#"
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">2010 Diamonds</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </a>
          <a
            href="#"
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">2010 Diamonds</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </a>
          <a
            href="#"
            class="bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2"
            style="width: 200px"
          >
            <img
              src="https://placehold.co/200x150.png"
              class="object-fit-cover w-100"
              height="130"
              alt=""
            />
            <div class="p-3">
              <h5 class="mb-0">2010 Diamonds</h5>
              <span class="text-secondary fs__7">Rp 360.000</span>
              <div class="text-primary fs-5">Rp 380.000</div>
            </div>
          </a>
        </div>
      </div>
    </section>
    <!-- Popular End -->

    <!-- Navbar Start -->
    <div style="height: 120px"></div>
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
                class="nav-link py-2 text-secondary"
                aria-current="page"
                href="timeline.php"
              >
                <img src="assets/icon/ic__nav-timeline.svg" class="mb-1" />
                <div>Timeline</div>
              </a>
            </li>
            <li class="nav-item w-100 text-center">
              <a
                class="nav-link py-2 text-secondary active"
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
