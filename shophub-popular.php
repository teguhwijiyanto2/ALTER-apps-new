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
    <title>Popular</title>
  </head>

  <body>
    <section>
      <div class="px-4">
        <div class="py-3">
          <a href="shophub.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>Popular</span>
          </a>
        </div>

        <!-- Summary Start -->
        <div class="row g-3 mb-3">
		
<?php
$results_A2 = DB::query("
SELECT 
billing_items_excel.* 
FROM shophub_promo
LEFT JOIN billing_items_excel ON billing_items_excel.payee_code=shophub_promo.payee_code AND billing_items_excel.product_code=shophub_promo.product_code
WHERE billing_items_excel.id IS NOT NULL
order by billing_items_excel.payee_code asc, billing_items_excel.product_code
");			
			foreach ($results_A2 as $row_A2) {			
			echo "			

			  <div class='col-6'>
				<a href='#' onclick=\"document.getElementById('formPurchase_promo_".$row_A2['id']."').submit();\">
				  <div class='bg-dark rounded-3 overflow-hidden'>
					<img
					  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
					  height='150'
					  class='w-100 object-fit-cover'
					/>
					<div class='p-2'>
					  <div class='fs-6 one__line'>
						".$row_A2['product_name']."
					  </div>
					  <div class='text-secondary fs-8'>
						".$row_A2['sub_category']."
					  </div>
					  <div class='text-primary fs-5 fw-medium'>IDR ".number_format($row_A2['client_price'])."</div>
					</div>
				  </div>
				</a>
			  </div>

						
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase_promo_".$row_A2['id']."'>
				<input type='hidden' name='payeeCode_1' value='".$row_A2['payee_code']."'>
				<input type='hidden' name='productCode_1' value='".$row_A2['product_code']."'>
				<input type='hidden' name='name_1' value='".$row_A2['product_name']."'>
				<input type='hidden' name='description_1' value='".$row_A2['product_description']."'>
				<input type='hidden' name='type_1' value='".$row_A2['category']."'>
				<input type='hidden' name='sub_category_1' value='".$row_A2['sub_category']."'>
				<input type='hidden' name='nominal_1' value='".$row_A2['client_price']."'>
				<input type='hidden' name='clientPrice_1' value='".$row_A2['client_price']."'>
			  </form>
			  </div>			  
			"; 
			
			} // foreach ($results_A2 as $row_A2) {  			
?> 		

<?php
$results_A3 = DB::query("
SELECT 
billing_items_excel.* 
FROM shophub_cashback
LEFT JOIN billing_items_excel ON billing_items_excel.payee_code=shophub_cashback.payee_code AND billing_items_excel.product_code=shophub_cashback.product_code
WHERE billing_items_excel.id IS NOT NULL
order by billing_items_excel.payee_code asc, billing_items_excel.product_code
");			
			foreach ($results_A3 as $row_A3) {	
			echo "			
		  
			  <a
				href='#' onclick=\"document.getElementById('formPurchase_cashback_".$row_A3['id']."').submit();\"
				class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
				style='width: 200px'
			  >
				
				<img
				  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A3['sub_category'])).".png'
				  class='object-fit-cover w-100'
				  width='200'
				  height='150'
				  alt=''
				/>
				
				<div class='p-3'>
				  <h5 class='mb-0'>".$row_A3['product_name']."</h5>
				  <span class='text-secondary fs__7'>".$row_A3['sub_category']."</span>
				  <div class='text-primary fs-5'>IDR ".number_format($row_A3['client_price'])."</div>
				</div>
			  </a>						  
						  		  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase_cashback_".$row_A3['id']."'>
				<input type='hidden' name='payeeCode_1' value='".$row_A3['payee_code']."'>
				<input type='hidden' name='productCode_1' value='".$row_A3['product_code']."'>
				<input type='hidden' name='name_1' value='".$row_A3['product_name']."'>
				<input type='hidden' name='description_1' value='".$row_A3['product_description']."'>
				<input type='hidden' name='type_1' value='".$row_A3['category']."'>
				<input type='hidden' name='sub_category_1' value='".$row_A3['sub_category']."'>
				<input type='hidden' name='nominal_1' value='".$row_A3['client_price']."'>
				<input type='hidden' name='clientPrice_1' value='".$row_A3['client_price']."'>
			  </form>
			  </div>			  
			"; 
			
			} // foreach ($results_A3 as $row_A3) {  			
?>		         
		  
        </div>
        <!-- Summary End -->
      </div>
    </section>
  </body>
</html>
