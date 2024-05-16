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
    <title>ShopHub</title>
  </head>

  <body>
    <section>
      <div class="">
        <div class="py-3 px-4">
          <a href="shophub.php">
            <i class="bi bi-chevron-left fs-5 me-2"></i>
            <span>ShopHub by Category</span>
          </a>
        </div>

        <!-- Banner Start -->
        <div>
          <img
            src="assets/img/temp/shophub-more-category-banner.png"
            height="250"
            class="w-100 object-fit-cover"
          />
        </div>
        <!-- Banner end -->

        <!-- Tab Start -->
        <!-- prettier-ignore -->
        <div class="tab__more-category overflow-x-scroll" style="white-space: nowrap; ">
          <div data-tab="1_mobile_prepaid" class="d-inline-block px-3 up__tab-item" id="btn_tab_1_mobile_prepaid">Mobile Prepaid</div>
          <div data-tab="2_mobile_data" class="d-inline-block px-3 up__tab-item" id="btn_tab_2_mobile_data">Mobile Data</div>
          <div data-tab="3_top_up_game" class="d-inline-block px-3 up__tab-item" id="btn_tab_3_top_up_game">Top Up Game</div>
          <div data-tab="4_ewallet" class="d-inline-block px-3 up__tab-item" id="btn_tab_4_ewallet">eWallet</div>
          <div data-tab="5_voucher" class="d-inline-block px-3 up__tab-item" id="btn_tab_5_voucher">Voucher</div>       
        </div>
        <!-- Tab End -->

        <!-- =============================================== -->
        <!-- Tab Content 1_mobile_prepaid Start -->
        <section id="1_mobile_prepaid" class="tab__content d-block">
			
<?php
$results_A = DB::query("SELECT DISTINCT(sub_category) FROM billing_items_excel WHERE category=%i", 1);
foreach ($results_A as $row_A) {

$sc_link = str_ireplace(' ','_',strtolower($row_A['sub_category']));

echo "	
          <div aria-label=".$row_A['sub_category']."> <!-- START -->
            <div onclick=\"window.location.href='shophub-by-sub-category.php?cat=1&sc=$sc_link';\" style='cursor:pointer;'
              class='px-4 py-3 d-flex flex-row align-items-center justify-content-between'
            >
              <h5>".$row_A['sub_category']."</h5>
              <a href='shophub-by-sub-category.php?cat=1&sc=$sc_link'>
                <i class='bi bi-chevron-right'></i>
              </a>
            </div>

            <!-- List -->
            <div class='overflow-x-scroll px-4' style='white-space: nowrap'>
";			
			
			$results_A2 = DB::query("SELECT * FROM billing_items_excel WHERE category=%i AND sub_category=%s ORDER BY id ASC", 1, $row_A['sub_category']);
			foreach ($results_A2 as $row_A2) {	
			echo "			
						  <a
							href='#' onclick=\"document.getElementById('formPurchase1_".$row_A2['id']."').submit();\"
							class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
							style='width: 200px'
						  >
						    
							<img
							  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
							  class='object-fit-cover w-100'
							  height='130'
							  alt=''
							/>
							
							<div class='p-3'>
							  <h5 class='mb-0'>".$row_A2['product_name']."</h5>
							  <!--
							  <span
								class='text-secondary fs__7 text-decoration-line-through'
								>Rp 360.000</span
							  >
							  -->
							  <div class='text-primary fs-5'>IDR ".number_format($row_A2['client_price'])."</div>
							</div>
						  </a>
						  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase1_".$row_A2['id']."'>
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
		  
echo "			  
            </div>
			<!-- END List -->
          
		  </div> <!-- END -->	
";	
	
} // foreach ($results_A as $row_A) {
?>

		</section>
        <!-- Tab Content 1_mobile_prepaid end -->
        <!-- =============================================== -->






        <!-- Tab Content 2_mobile_data Start -->
        <section id="2_mobile_data" class="tab__content d-block">
			
<?php
$results_A = DB::query("SELECT DISTINCT(sub_category) FROM billing_items_excel WHERE category=%i", 2);
foreach ($results_A as $row_A) {

$sc_link = str_ireplace(' ','_',strtolower($row_A['sub_category']));

echo "	
          <div aria-label=".$row_A['sub_category']."> <!-- START -->
            <div onclick=\"window.location.href='shophub-by-sub-category.php?cat=2&sc=$sc_link';\" style='cursor:pointer;'
              class='px-4 py-3 d-flex flex-row align-items-center justify-content-between'
            >
              <h5>".$row_A['sub_category']."</h5>
              <a href='shophub-by-sub-category.php?cat=2&sc=$sc_link'>
                <i class='bi bi-chevron-right'></i>
              </a>
            </div>

            <!-- List -->
            <div class='overflow-x-scroll px-4' style='white-space: nowrap'>
";			
			
			$results_A2 = DB::query("SELECT * FROM billing_items_excel WHERE category=%i AND sub_category=%s ORDER BY id ASC", 2, $row_A['sub_category']);
			foreach ($results_A2 as $row_A2) {	
			echo "			
						  <a
							href='#' onclick=\"document.getElementById('formPurchase2_".$row_A2['id']."').submit();\"
							class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
							style='width: 200px'
						  >
						    
							<img
							  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
							  class='object-fit-cover w-100'
							  height='130'
							  alt=''
							/>
							
							<div class='p-3'>
							  <h5 class='mb-0'>".$row_A2['product_name']."</h5>
							  <!--
							  <span
								class='text-secondary fs__7 text-decoration-line-through'
								>Rp 360.000</span
							  >
							  -->
							  <div class='text-primary fs-5'>IDR ".number_format($row_A2['client_price'])."</div>
							</div>
						  </a>
						  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase2_".$row_A2['id']."'>
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
		  
echo "			  
            </div>
			<!-- END List -->
          
		  </div> <!-- END -->	
";	
	
} // foreach ($results_A as $row_A) {
?>

		</section>
        <!-- Tab Content 2_mobile_data end -->
        <!-- =============================================== -->




        <!-- Tab Content 3_top_up_game Start -->
        <section id="3_top_up_game" class="tab__content d-block">
			
<?php
$results_A = DB::query("SELECT DISTINCT(sub_category) FROM billing_items_excel WHERE category=%i", 3);
foreach ($results_A as $row_A) {

$sc_link = str_ireplace(' ','_',strtolower($row_A['sub_category']));

echo "	
          <div aria-label=".$row_A['sub_category']."> <!-- START -->
            <div onclick=\"window.location.href='shophub-by-sub-category.php?cat=3&sc=$sc_link';\" style='cursor:pointer;'
              class='px-4 py-3 d-flex flex-row align-items-center justify-content-between'
            >
              <h5>".$row_A['sub_category']."</h5>
              <a href='shophub-by-sub-category.php?cat=3&sc=$sc_link'>
                <i class='bi bi-chevron-right'></i>
              </a>
            </div>

            <!-- List -->
            <div class='overflow-x-scroll px-4' style='white-space: nowrap'>
";			
			
			$results_A2 = DB::query("SELECT * FROM billing_items_excel WHERE category=%i AND sub_category=%s ORDER BY id ASC", 3, $row_A['sub_category']);
			foreach ($results_A2 as $row_A2) {	
			echo "			
						  <a
							href='#' onclick=\"document.getElementById('formPurchase3_".$row_A2['id']."').submit();\"
							class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
							style='width: 200px'
						  >
						    
							<img
							  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
							  class='object-fit-cover w-100'
							  height='130'
							  alt=''
							/>
							
							<div class='p-3'>
							  <h5 class='mb-0'>".$row_A2['product_name']."</h5>
							  <!--
							  <span
								class='text-secondary fs__7 text-decoration-line-through'
								>Rp 360.000</span
							  >
							  -->
							  <div class='text-primary fs-5'>IDR ".number_format($row_A2['client_price'])."</div>
							</div>
						  </a>
						  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase3_".$row_A2['id']."'>
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
		  
echo "			  
            </div>
			<!-- END List -->
          
		  </div> <!-- END -->	
";	
	
} // foreach ($results_A as $row_A) {
?>

		</section>
        <!-- Tab Content 3_top_up_game end -->
        <!-- =============================================== -->




        <!-- Tab Content 4_ewallet Start -->
        <section id="4_ewallet" class="tab__content d-block">
			
<?php
$results_A = DB::query("SELECT DISTINCT(sub_category) FROM billing_items_excel WHERE category=%i", 4);
foreach ($results_A as $row_A) {

$sc_link = str_ireplace(' ','_',strtolower($row_A['sub_category']));

echo "	
          <div aria-label=".$row_A['sub_category']."> <!-- START -->
            <div onclick=\"window.location.href='shophub-by-sub-category.php?cat=4&sc=$sc_link';\" style='cursor:pointer;'
              class='px-4 py-3 d-flex flex-row align-items-center justify-content-between'
            >
              <h5>".$row_A['sub_category']."</h5>
              <a href='shophub-by-sub-category.php?cat=4&sc=$sc_link'>
                <i class='bi bi-chevron-right'></i>
              </a>
            </div>

            <!-- List -->
            <div class='overflow-x-scroll px-4' style='white-space: nowrap'>
";			
			
			$results_A2 = DB::query("SELECT * FROM billing_items_excel WHERE category=%i AND sub_category=%s ORDER BY id ASC", 4, $row_A['sub_category']);
			foreach ($results_A2 as $row_A2) {	
			echo "			
						  <a
							href='#' onclick=\"document.getElementById('formPurchase4_".$row_A2['id']."').submit();\"
							class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
							style='width: 200px'
						  >
						    
							<img
							  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
							  class='object-fit-cover w-100'
							  height='130'
							  alt=''
							/>
							
							<div class='p-3'>
							  <h5 class='mb-0'>".$row_A2['product_name']."</h5>
							  <!--
							  <span
								class='text-secondary fs__7 text-decoration-line-through'
								>Rp 360.000</span
							  >
							  -->
							  <div class='text-primary fs-5'>IDR ".number_format($row_A2['client_price'])."</div>
							</div>
						  </a>
						  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase4_".$row_A2['id']."'>
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
		  
echo "			  
            </div>
			<!-- END List -->
          
		  </div> <!-- END -->	
";	
	
} // foreach ($results_A as $row_A) {
?>

		</section>
        <!-- Tab Content 4_ewallet end -->
        <!-- =============================================== -->




        <!-- Tab Content 5_voucher Start -->
        <section id="5_voucher" class="tab__content d-block">
			
<?php
$results_A = DB::query("SELECT DISTINCT(sub_category) FROM billing_items_excel WHERE category=%i", 5);
foreach ($results_A as $row_A) {

$sc_link = str_ireplace(' ','_',strtolower($row_A['sub_category']));

echo "	
          <div aria-label=".$row_A['sub_category']."> <!-- START -->
            <div onclick=\"window.location.href='shophub-by-sub-category.php?cat=5&sc=$sc_link';\" style='cursor:pointer;'
              class='px-4 py-3 d-flex flex-row align-items-center justify-content-between'
            >
              <h5>".$row_A['sub_category']."</h5>
              <a href='shophub-by-sub-category.php?cat=5&sc=$sc_link'>
                <i class='bi bi-chevron-right'></i>
              </a>
            </div>

            <!-- List -->
            <div class='overflow-x-scroll px-4' style='white-space: nowrap'>
";			
			
			$results_A2 = DB::query("SELECT * FROM billing_items_excel WHERE category=%i AND sub_category=%s ORDER BY id ASC", 5, $row_A['sub_category']);
			foreach ($results_A2 as $row_A2) {	
			echo "			
						  <a
							href='#' onclick=\"document.getElementById('formPurchase5_".$row_A2['id']."').submit();\"
							class='bg-dark rounded-3 d-inline-block h-100 overflow-hidden me-2'
							style='width: 200px'
						  >
						    
							<img
							  src='assets/img/temp/".str_ireplace(' ','_',strtolower($row_A2['sub_category'])).".png'
							  class='object-fit-cover w-100'
							  height='150'
							  alt=''
							/>
							
							<div class='p-3'>
							  <h5 class='mb-0'>".$row_A2['product_name']."</h5>
							  <!--
							  <span
								class='text-secondary fs__7 text-decoration-line-through'
								>Rp 360.000</span
							  >
							  -->
							  <div class='text-primary fs-5'>IDR ".number_format($row_A2['client_price'])."</div>
							</div>
						  </a>
						  
			  <div style='display:none;'>
			  <form action='purchase-item.php' method='POST' id='formPurchase5_".$row_A2['id']."'>
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
		  
echo "			  
            </div>
			<!-- END List -->
          
		  </div> <!-- END -->	
";	
	
} // foreach ($results_A as $row_A) {
?>

		</section>
        <!-- Tab Content 5_voucher end -->
        <!-- =============================================== -->


      </div>
    </section>

    <script>
      $(document).ready(function () {
        // Tab Click Content
        var tabsItem = $(".up__tab-item");
        var tabsContent = $(".tab__content");
        tabsItem.on("click", function () {
          var tabId = $(this).data("tab");
          tabsItem.removeClass("active");
          $(this).addClass("active");
          tabsContent.removeClass("d-block");
          $(`#${tabId}`).addClass("d-block");
        });
      });
    </script>
	
	<?php
	if($_GET['cat']==1) { echo "<body onload=\"document.getElementById('btn_tab_1_mobile_prepaid').click();\"> "; }
	if($_GET['cat']==2) { echo "<body onload=\"document.getElementById('btn_tab_2_mobile_data').click();\"> "; }
	if($_GET['cat']==3) { echo "<body onload=\"document.getElementById('btn_tab_3_top_up_game').click();\"> "; }
	if($_GET['cat']==4) { echo "<body onload=\"document.getElementById('btn_tab_4_ewallet').click();\"> "; }
	if($_GET['cat']==5) { echo "<body onload=\"document.getElementById('btn_tab_5_voucher').click();\"> "; }
	?>
	
  </body>
</html>
