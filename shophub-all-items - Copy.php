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



// $url = 'https://bgtest.e2pay.co.id/bg/restful/prepaidProduct';

$url = 'https://bg.e2pay.co.id/bg/restful/prepaidProduct'; // URL Biller PRODUCTION
/*
$data = array(
    "bankChannel" => "6017",
    "bankId" => "00000010",
	"type" => "".$_GET['cat'].""
);
*/
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
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','date:2024-02-22T11:40:00+0700','authorization:/7doaUqu6pshoAmYkSKvV3z6cnCP+CT5G5PEzawdGWU='));
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

        <!-- Shop by Category Start -->
        <section id="shop-category__section" class="mt-5">
          <div class="mt-5">
            <h4>Shop > <?php echo $array_product_category_name[$_GET['cat']]; ?></h4>
            <div class="row mt-2 g-3">


<div class='col-12'>
				  <table style='border:1px solid white;' border='2'>
				  		<th style='border:1px solid white;'>NO</th>
						<th style='border:1px solid white;'>TYPE </th>
						<th style='border:1px solid white;'>PAYEE CODE</th>
						<th style='border:1px solid white;'>PRODUCT CODE</th>
						<th style='border:1px solid white;'>NAME</th>
						<th style='border:1px solid white;'>DESCRIPTION</th>
						<th style='border:1px solid white;'>NOMINAL</th>
            <th style='border:1px solid white;'>CLIENT PRICE</th>
<?php
$item_no = 0;


foreach ($data_responses as $index => $data_response) {

	$item_no++;

	//echo "$index => $data_response<br>";
	//echo "<br>";

	
	/*
	foreach ($data_response as $key => $val) {
		//echo "$key => $val<br>";
		// Parsing process here :		
		// sample 1 data return:
				//productCode => 1201
				//nominal => 108000
				//payeeCode => 10002
				//name => Paket Data
				//description => Paket Data
				//type => 2
				//clientPrice => 108000.00		
	} // foreach ($data_response as $key => $val) {
	*/	

/*
	echo "
              <div class='col-6'>
				  <a
					href='#' onclick=\"document.getElementById('formPurchase_".$item_no."').submit();\"
					class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
					style='width: 200px'
				  >
					<div class='p-3'>
					  <h5 class='mb-0'>".$data_response['name']."</h5>
					  <span class='text-secondary fs__7'>".$data_response['description']."</span>
					  <div class='text-primary fs-5'>IDR ".number_format($data_response['clientPrice'])."</div>
					</div>
				  </a>
              </div>
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase_".$item_no."'>
				<input type='hidden' name='payeeCode_1' value='".$data_response['payeeCode']."'>
				<input type='hidden' name='productCode_1' value='".$data_response['productCode']."'>
				<input type='hidden' name='name_1' value='".$data_response['name']."'>
				<input type='hidden' name='description_1' value='".$data_response['description']."'>
				<input type='hidden' name='type_1' value='".$data_response['type']."'>
				<input type='hidden' name='nominal_1' value='".$data_response['nominal']."'>
				<input type='hidden' name='clientPrice_1' value='".$data_response['clientPrice']."'>
			  </form>
			  </div>
	";		
*/

	echo "
              
					<tr>
						<td style='border:1px solid white;'>".$item_no."</td>
						<td style='border:1px solid white;'>".$data_response['type']."</td>						
						<td style='border:1px solid white;'>".$data_response['payeeCode']."</td>
						<td style='border:1px solid white;'>".$data_response['productCode']."</td>
						<td style='border:1px solid white;'>".$data_response['name']."</td>
						<td style='border:1px solid white;'>".$data_response['description']."</td>
						<td style='border:1px solid white;'>".$data_response['nominal']."</td>
            <td style='border:1px solid white;'>".$data_response['clientPrice']."</td>
				  </tr>

	";	
		
} // foreach ($data_responses as $index => $data_response) {
?>
	</table>
</div>

			  
            </div>
          </div>
        </section>
        <!-- Shop by Category End -->
      </div>
    </div>

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
