<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

 
//$_SESSION["session_usr_id"] = $_GET['sid'];


	$results_check = DB::queryFirstRow("SELECT * FROM users where id=%i", $_GET['sid']);
	
	$_SESSION["session_usr_id"]=$results_check['id'];
	$_SESSION["session_usr_email"]=$results_check['email'];
	$_SESSION["session_usr_phone"]=$results_check['phone'];
	$_SESSION["session_usr_name"]=$results_check['name'];
	$_SESSION["session_usr_username"]=$results_check['username'];
	$_SESSION["session_usr_gender"]=$results_check['gender'];
	$_SESSION["session_usr_birthdate"]=$results_check['birthdate'];
	



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

$array_cities = array();
$results_A = DB::query("SELECT * FROM cities order by name asc");
foreach ($results_A as $row_A) {
	$array_cities[$row_A['id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];

$array_games = array();
$results_A = DB::query("SELECT * FROM games order by id asc");
foreach ($results_A as $row_A) {
	$array_games[$row_A['game_name_id']] = "".$row_A['name']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];


/*
			'mpsreturnurl'    => "https://beta.alterspace.gg/purchase-item-payment-success.php?sid=".$_POST['session_usr_id']."&id1=".$str_rand."&id2=".$your_orderid."&id3=".$_POST['cust_id_parameter']."&id4=".$_POST['type_1']."", 
			// id1 --> str_rand ; id2 --> order_id ; id3 --> cust_id_parameter (Phone Number / Game Account ID), untuk parameter custID di API purchase
*/


DB::query("update purchase_items set payment_status='Success', payment_time=now() where user_id=%i AND str_rand=%s AND order_id=%s", 
											$_SESSION["session_usr_id"], $_GET["id1"], $_GET["id2"]);


$results_purchase_item = DB::queryFirstRow("SELECT * FROM purchase_items where user_id=%i AND str_rand=%s AND order_id=%s", 
											$_SESSION["session_usr_id"], $_GET["id1"], $_GET["id2"]);


//echo "SELECT * FROM purchase_items where user_id=".$_SESSION["session_usr_id"]." AND str_rand='".$_GET["id1"]."' AND order_id='".$_GET["id2"]."' <br>";


$str_rand = $_GET["id1"];
$your_orderid = $_GET["id2"];
$users_cust_id_parameter = $_GET["id3"]; // cust_id_parameter (Phone Number / Game Account ID), untuk parameter custID di API purchase
$cat_type = $_GET["id4"]; // type / category, ini utk menentukan endpoint API purchase mana yang dipakai (ada 5 opsi, tergantung typenya)
 
/*
 	$rand = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$str_rand = substr(str_shuffle($rand), 0, 9).rand();

    $your_orderid = "".$_SESSION["session_usr_id"]."".$str_rand;
*/


 
$StringToSign = "";
$StringToSign .= "purchase"; // "purchase";
$StringToSign .= "\n";
$StringToSign .= "00000010";
$StringToSign .= "\n";
//$StringToSign .= "8888"; // "202401220007"; // "".$your_orderid."";
$StringToSign .= "20240125".$_SESSION["session_usr_id"]."".$_GET["id1"]."".$_GET["id2"].""; // "202401220007"; // "".$your_orderid."";
$StringToSign .= "\n";
$StringToSign .= "6017";
$StringToSign .= "\n";
$StringToSign .= "".$users_cust_id_parameter.""; // "081234000001";
$StringToSign .= "\n";
$StringToSign .= "2024-01-25T12:00:00+0700";

//echo $StringToSign;
$StringToSign2 = "checkPurchase<br>00000010<br>8888<br><br>999<br>2024-01-25T12:00:00+0700";
//echo $StringToSign2;
//echo "<br><br>";

//echo base64_encode(hash_hmac('sha256', $StringToSign, '3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=', true));
//$signature = base64_encode(hash_hmac('sha256', $StringToSign, '3lN1j3/tpRwmgcQFoq9/pyzgP77aRY7MBFhEIfiXQZ4=', true));
$signature = base64_encode(hash_hmac('sha256', $StringToSign, 'jgfUN+5CXlVolflG/oXc094dL0M+KcZe2QrOUXNNlvg=', true)); // SecretKey PRODUCTION : jgfUN+5CXlVolflG/oXc094dL0M+KcZe2QrOUXNNlvg=

//echo "<br><br>";	
//echo $signature;
//echo "<br><br>";	
	
	// $url = 'https://bgtest.e2pay.co.id/bg/restful/purchase/game';
	//$url = 'https://bgtest.e2pay.co.id/bg/restful/purchase/mobile_prepaid';
	// $url = 'https://bgtest.e2pay.co.id/bg/restful/checkPurchase/mobile_prepaid';

/*	
1 Mobile Prepaid /bg/restful/purchase/mobile_prepaid POST
2 eWallet (Closed Amount) /bg/restful/purchase/ewallet POST
3 Data Plan /bg/restful/purchase/paket_data POST
4 Game Voucher /bg/restful/purchase/game POST
5 eVoucher /bg/restful/purchase/evoucher POST
*/
	
	
	

	if($cat_type=="1") {
		$url = 'https://bg.e2pay.co.id/bg/restful/purchase/mobile_prepaid'; // URL Biller PRODUCTION
	}
	if($cat_type=="2") {
		$url = 'https://bg.e2pay.co.id/bg/restful/purchase/paket_data'; // URL Biller PRODUCTION
	}
	if($cat_type=="3") {
		$url = 'https://bg.e2pay.co.id/bg/restful/purchase/game'; // URL Biller PRODUCTION
	}
	if($cat_type=="4") {
		$url = 'https://bg.e2pay.co.id/bg/restful/purchase/ewallet'; // URL Biller PRODUCTION
	}
	if($cat_type=="5") {
		$url = 'https://bg.e2pay.co.id/bg/restful/purchase/evoucher'; // URL Biller PRODUCTION
	}



/*
Mobile Prepaid /bg/restful/purchase/mobile_prepaid  Type/Category : 1
Data Plan /bg/restful/purchase/paket_data  Type/Category : 2
Game Voucher /bg/restful/purchase/game  Type/Category : 3
eWallet (Closed Amount) /bg/restful/purchase/ewallet  Type/Category : 4
eVoucher /bg/restful/purchase/evoucher  Type/Category : 5


4.3 Prepaid Product
This POST endpoint is used to do transaction prepaid product.

1 Mobile Prepaid /bg/restful/purchase/mobile_prepaid
2 eWallet (Closed Amount) /bg/restful/purchase/ewallet
3 Data Plan /bg/restful/purchase/paket_data
4 Game Voucher /bg/restful/purchase/game
5 eVoucher /bg/restful/purchase/evoucher

4.3.1 Mobile Prepaid (type 1) / eWallet  (type 4) / Data Plan (type 2)
4.3.2 Game Voucher  (type 3) / eVoucher (type 5)
*/



	$data = array(
	 "bankChannel" => "6017",
	 "bankId" => "00000010",
	 "bankRefNo" => "20240125".$_SESSION["session_usr_id"]."".$_GET["id1"]."".$_GET["id2"]."", // "202401220007"; // "".$your_orderid."";
	 "custAccNo" => "1111111111", // "1111111111",
	 "custId" => "".$users_cust_id_parameter."", // "081234000001",
	 "dateTrx" => "2024-01-25T12:00:00Z",
	 "payeeCode" => "".$results_purchase_item['payee_code']."",  // "10027", // 
	 "productCode" => "".$results_purchase_item['product_code']."", // "2001", // 
	 "serverId" => "12345"
	);	
	// "bankRefNo" => "20240125".$_SESSION["session_usr_id"]."".$_GET["id1"]."".$_GET["id2"]."", // "202401220007"; // "".$your_orderid."";

	
	$encodedData = json_encode($data);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // only for localhost nih, krn gak ada SSLnya!
	$data_string = urlencode(json_encode($data));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','date:2024-01-25T12:00:00+0700','authorization:'.$signature.''));
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
	
	/*
	echo $httpReturnCode;
	echo "<br><br>";	
	echo $result_prepaidProduct;
	echo "<br><br>";
	echo $encodedData;
	*/
	
	
	/*
	$resultnya = array(
    "billRefNo" => "",
    "infoText" => "",
    "bankRefNo" => "202401220004",
    "code" => 0,
    "serialNumber" => "",
    "payeeCode" => "10014",
    "resultCode" => "00",
    "description" => "Game Voucher",
    "secretCode" => "",
    "expirydDate" => "",
    "dateTrx" => "2024-01-22T12:00:00Z",
    "message" => "Success",
    "bankChannel" => "6017",
    "custAccNo" => "1111111111",
    "bankId" => "00000010",
    "custRefNo" => "100004336772",
    "productCode" => "1001",
    "custId" => "081234000001",
    "nominalVoucher" => "51000.00"
	);	
	$result_prepaidProduct = json_encode($resultnya);
	*/
	
	
	$json_decoded = json_decode($result_prepaidProduct, true);
	$data_responses = $json_decoded["data"];
	
	//echo $data_responses['message'];
		
/*
		DB::insert('billing_tests', [
		  'input_parameter' => $encodedData,
		  'string_to_sign' => $StringToSign,
		  'signature' => $signature,
		  'returned_result' => $json_decoded['message'], // $json_decoded,
		  'data_responses_message' => $json_decoded['message'],
		]);
*/	
		
		/*
	CREATE TABLE `billing_tests` (
  `id` bigint(20) NOT NULL,
  `input_parameter` text DEFAULT NULL,
  `string_to_sign` text DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `testing_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
	*/
	
	
/*
if $httpReturnCode = 401 --> $result_prepaidProduct = "Authentication not the same";


if $httpReturnCode = 200 :
	$json_decoded['message']
		"message": "Success",
		"message": "Duplicate Transaction",
		"message": "Transaction Failed",
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
    <title>Payment Confirmation - Alter</title>
  </head>

  <body>
    <section>
      <div class="container px-4">
        <div class="py-3">
          <a href="shophub.php">
            <i class="bi bi-x-lg fs-5 me-2"></i>
            <span>Payment Confirmed</span>
          </a>
        </div>
        <form action="">
          <div
            class="d-flex flex-column align-items-center justify-content-center"
          >
            <img
              src="assets/ilustration/ilus__check-success.png"
              alt=""
              class="w-50"
            />
			
			<?php
			if($httpReturnCode = "200" && $json_decoded['message']=="Success") {
				echo "
					<h5 class='text__purple mb-0'>Transaction Succesful</h5>
					<span class='text-secondary'>Enjoy your purchased items</span>
				";	
				$a = DB::query("update purchase_items set purchase_status='Success', purchase_time=now() where order_id=%s", $your_orderid);
			} // if($httpReturnCode = "200" && $data_responses['message']=="Success") {
			
			else {
				echo "
					<h5 class='text__purple mb-0' style='color:red;'>Transaction Failed!!</h5>
					<span class='text-danger'>Something wrong with the purchasing process.</span>
					<span class='text-danger'>We have refund & add IDR ".number_format($results_purchase_item['total_amount'])." to your E-Wallet balance.</span>
				";	
/*								
				DB::insert('purchase_item_refund', [
				  'user_id' => $_SESSION["session_usr_id"],
				  'str_rand' => $str_rand,
				  'order_id' => $your_orderid,
				  'mpsvcode' => $results_purchase_item['mpsvcode'],
				  'payee_code' => $results_purchase_item['payee_code'],
				  'product_code' => $results_purchase_item['product_code'],
				  'name' => $results_purchase_item['name'],
				  'description' => $results_purchase_item['description'],
				  'type' => $results_purchase_item['type'],
				  'nominal' => $results_purchase_item['nominal'],
				  'client_price' => $results_purchase_item['client_price'],
				  'payment_method' => $results_purchase_item['payment_method'],
				  'currency' => $results_purchase_item['currency'],
				  'total_amount' => $results_purchase_item['total_amount'],
				  'payment_status' => $results_purchase_item['payment_status'],
				  'payment_time' => $results_purchase_item['payment_time'],
				  'purchase_status' => 'Failed',
				  'purchase_time' => date('Y-m-d H:i:s'),
				  'status' => 'Active',
				  'transaction_time' => $results_purchase_item['transaction_time'],
				]);
*/
				$b = DB::query("update purchase_items set purchase_status='Failed', purchase_time=now() where order_id=%s", $your_orderid);
				
				$b = DB::query("update users set user_wallet = user_wallet + ".$results_purchase_item['total_amount']." where id=%i", $_SESSION["session_usr_id"]);
				
			} // else {
			?>
			
          </div>
          <!-- Summary Start -->
          <div class="p-3 bg-dark rounded-3 mt-5">
            <h5>Summary
			</h5>
            <div class="mt-3 d-flex flex-column gap-1">
			             
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Name</span>
                <span class="text-light fs-5"><?php echo $results_purchase_item['name']; ?></span>
              </div>

			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Description</span>
                <span class="text-light fs-5"><?php echo $results_purchase_item['description']; ?></span>
              </div>
			  
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Product Code</span>
                <span class="text-light fs-5"><?php echo $results_purchase_item['product_code']; ?></span>
              </div>

			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Payee Code</span>
                <span class="text-light fs-5"><?php echo $results_purchase_item['payee_code']; ?></span>
              </div>
			  
              <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Total Paid</span>
                <span class="text-light fs-5">IDR <?php echo number_format($results_purchase_item['total_amount']); ?></span>
              </div>
              
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Payment Method</span>
                <span class="text-light fs-5">ALTER Payment <?php //echo $results_purchase_item['payment_method']; ?></span>
              </div>
			  
              <!--
			  <div class="d-flex flex-row align-items-center justify-content-between text-secondary">
                <span>Payment Time</span>
                <span class="text-light fs-5"><?php //echo $results_purchase_item['purchase_time']; ?></span>
              </div>
			  -->
			  
            </div>
          </div>
          <!-- Summary End -->
          <a
            href="shophub.php"
            class="btn btn-outline-light rounded-pill my-4 w-100"
          >
            Confirmed
          </a>
        </form>
      </div>
	  	  
		<!-- Checker -->
		<!--
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo json_encode(json_decode($encodedData), JSON_PRETTY_PRINT); ?>  
		</div>
		
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo $StringToSign; ?>  
		</div>

		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo $signature; ?>  
		</div>
		
		<div class="p-3 bg-dark rounded-3 mt-5">
			<?php //echo json_encode(json_decode($result_prepaidProduct), JSON_PRETTY_PRINT); ?>
		</div>
		
    </section>
	
	
<?
/*
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'librarysmtp/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //hostname/domain yang dipergunakan untuk setting smtp
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'teguh@alterspace.gg';                  //SMTP username
    $mail->Password   = 'sys.admin3';                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('teguh@alterspace.gg', 'ALTER');
    //$mail->addAddress("".$_POST['email']."", '');     //email tujuan
	$mail->addAddress("teguh.wijiyanto@gmail.com", '');     //email tujuan

	//$to = "".$results_check['email'].""; 
	$to = "teguh.wijiyanto@gmail.com";
	
	$from = "teguh@alterspace.gg"; 
	$fromName = 'A.L.T.E.R'; 
	 	 
	$htmlContent = " 
    <section>
      <div class='container px-4'>
        <div class='py-3'>
          <a href='shophub.php'>
            <i class='bi bi-x-lg fs-5 me-2'></i>
            <span>Payment Confirmed</span>
          </a>
        </div>
          <div
            class='d-flex flex-column align-items-center justify-content-center'
          >
            <img
              src='assets/ilustration/ilus__check-success.png'
              alt=''
              class='w-50'
            />
			";
			<?php
			if($httpReturnCode = '200' && $json_decoded['message']=='Success') {
				echo "
					<h5 class='text__purple mb-0'>Transaction Succesful</h5>
					<span class='text-secondary'>Enjoy your purchased items</span>
				";	
				
			} // if($httpReturnCode = '200' && $data_responses['message']=='Success') {			
			else {
				echo "
					<h5 class='text__purple mb-0' style='color:red;'>Transaction Failed!!</h5>
					<span class='text-danger'>Something wrong with the purchasing process.</span>
					<span class='text-danger'>We have refund & add IDR ".number_format($results_purchase_item['total_amount'])." to your E-Wallet balance.</span>
				";
			} // else {
			?>
		  echo "
          </div>
          <!-- Summary Start -->
          <div class='p-3 bg-dark rounded-3 mt-5'>
            <h5>Summary
			</h5>
            <div class='mt-3 d-flex flex-column gap-1'>
			              					 
			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Transaction ID</span>
                <span class='text-light fs-5'>".$your_orderid."</span>
              </div>						 
						 
			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Name</span>
                <span class='text-light fs-5'>".$results_purchase_item['name']."</span>
              </div>

			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Description</span>
                <span class='text-light fs-5'>".$results_purchase_item['description']."</span>
              </div>
			  
			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Product Code</span>
                <span class='text-light fs-5'>".$results_purchase_item['product_code']."</span>
              </div>

			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Payee Code</span>
                <span class='text-light fs-5'>".$results_purchase_item['payee_code']."</span>
              </div>
			  
              <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Total Paid</span>
                <span class='text-light fs-5'>IDR ".$results_purchase_item['total_amount'])."</span>
              </div>
              
			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Payment Method</span>
                <span class='text-light fs-5'>ALTER Payment</span>
              </div>
			  
			  <div class='d-flex flex-row align-items-center justify-content-between text-secondary'>
                <span>Transaction Time</span>
                <span class='text-light fs-5'>".date('d-m-Y H:i:s')."</span>
              </div>
			  
            </div>
          </div>
          <!-- Summary End -->
      </div>
		
    </section>
	"; 

//$mail->Subject = "[ALTER - Biller] Transaction Success for ".$results_purchase_item['name']."";
$mail->Subject = "[ALTER - Biller] Transaction Failed & Refunded for ".$results_purchase_item['name']."";	

    $mail->isHTML(true); //Set email format to HTML
    $mail->Body    = $htmlContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}	

*/
?>	
	
	
  </body>
</html>
