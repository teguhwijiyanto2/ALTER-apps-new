<?php
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
/*
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
*/
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

        <!-- Shop by Category Start -->
        <section id="shop-category__section" class="mt-5">
          <div class="mt-5">
            <h4>Shop > Summary</h4>
            <div class="row mt-2 g-3">


<div class='col-12'>
				  <table style='border:1px solid white;' border='2'>
				  		<!--<th style='border:1px solid white;'>NO</th>-->
						<th style='border:1px solid white;'>CATEGORY</th>
						<th style='border:1px solid white;'>SUB CATEGORY</th>
						<th style='border:1px solid white;'>PAYEE CODE</th>
						<th style='border:1px solid white;'>PRODUCT CODE</th>
						<th style='border:1px solid white;'>NAME</th>
						<th style='border:1px solid white;'>SUGGESTED END USER PRICE</th>
<?php

$array_cat = array("1"=>"Mobile Prepaid", "2"=>"Mobile Data", "3"=>"Game", "4"=>"eWallet", "5"=>"eVoucher");

$item_no = 0;

$item_missing = 0;

$str_missing = "";

$results_B = DB::query("SELECT * FROM billing_items_excel order by category asc, sub_category asc");
foreach ($results_B as $data_response) {
$item_no++;


	echo "
            
					<tr>
						<!--<td style='border:1px solid white;'>$item_no</td>-->
						
						<td style='border:1px solid white;' nowrap>".$array_cat[$data_response['category']]."</td>
						<td style='border:1px solid white;' nowrap>".$data_response['sub_category']."</td>
						<td style='border:1px solid white;' nowrap>".$data_response['payee_code']."</td>						
						<td style='border:1px solid white;' nowrap>".$data_response['product_code']."</td>
						<td style='border:1px solid white;' nowrap>".$data_response['product_name']."</td>
						<td style='border:1px solid white;' nowrap>".number_format($data_response['client_price'])."</td>
				    </tr>
	";	
		
} // foreach ($data_responses as $index => $data_response) {

?>
	</table>	
	
	<?php
	
	
	/*
	echo "<br>";	
	echo "Exist : $ada";
	echo "<br>";
	echo "NOT Exist : $nggak_ada";
	*/
	?>
	
</div>

			  
            </div>
          </div>
        </section>
        <!-- Shop by Category End -->
      </div>
    </div>


  </body>
</html>
