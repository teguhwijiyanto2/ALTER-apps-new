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

<?php
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
unset $_COOKIE['user'];

  echo "Cookie 'user' is set!<br>";
  echo "Value is: " . $_COOKIE['user'];
  */
  
//setcookie('login_email', 'teguh@alterspace.gg', time() + (86400 * 30), "/"); // 86400 = 1 day
//setcookie('login_password', '123', time() + (86400 * 30), "/"); // 86400 = 1 day

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
    <title>Connect Players</title>
  </head>

  <body>
  
<?php
// <a href='shophub-by-sub-category.php?cat=1&sc=".str_ireplace(' ','_',strtolower($row_A['sub_category']))."'>

$sub_category = str_ireplace('_',' ',ucwords($_GET['sc']));

$array_category = array("1"=>"Mobile Prepaid","2"=>"Mobile Data","3"=>"Top Up Game","4"=>"eWallet","5"=>"Voucher");
?>
  
    <section>
      <div class="px-4">
        <div class="py-3">

			<div
				  id="navbar-top"
				  class="max-w-sm d-flex p-3 flex-row align-items-center gap-2"
				  style="transition: all 200ms; cursor:pointer;"
				  onclick="window.location.href='home.php';"
				>

			  <a
				href="home.php"
				class="rounded-circle bg-dark d-flex align-items-center justify-content-center"
				style="height: 36px; width: 36px"
			  >
				<i class="bi bi-chevron-left"></i>
			  </a>
				Connect
			</div>

        </div>

        <!-- Summary Start -->
        <div class="row g-3 mb-3" style="margin-top:20px;">
		
<?php
$results_1 = DB::query("SELECT * FROM users where id<>%i ORDER BY RAND()", $_SESSION["session_usr_id"]);
foreach ($results_1 as $row_1) {
	
	$array_users_name[$row_1['id']] = "".$row_1['name']."";
	$array_users_email[$row_1['id']] = "".$row_1['email']."";
	$array_users_username[$row_1['id']] = "".$row_1['username']."";

  //validasi user picture tersedia atau tidak
  $user_images = 'user_pp_files/default_user_pp.jpg';

  if (!empty($row_1['user_pp_file'])) {
    $user_pp_file_path = 'user_pp_files/' . $row_1['user_pp_file'];
    
    if (file_exists($user_pp_file_path)) {
        $user_images = $user_pp_file_path;
    }
  }
	
	
	
$user_profile = DB::queryFirstRow("SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM users where id=%i", $row_1['id']);
$option = DB::queryFirstRow("SELECT * FROM matchmaking_option WHERE user_id = %i", $row_1['id']);


$games = '';

/*
if($option) {
  $arrayGame = json_decode($option['game']);

  for($i = 0; $i < count($arrayGame); $i++) {

    if($i != count($arrayGame)-1) {
      $games .= ucfirst($arrayGame[$i]).", ";
    }else {
      $games .= ucfirst($arrayGame[$i]);
    }
  }
}	
*/
	
	if(isset($option) && $option['available'] == 'available') { 
		$online_offline = "Available To Play";
		$circle_color = "green";
		//$user_fee = "".number_format($option['fee'])." / ".$option['time']." Minutes";
		$user_fee = "".number_format($option['fee'])." / session";
		$user_games = "Mobile Legends, Pubg";	
		// $user_games = $games;
		
		  $arrayGame = json_decode($option['game']);

		  for($i = 0; $i < count($arrayGame); $i++) {

			if($i != count($arrayGame)-1) {
			  //$games .= ucfirst($arrayGame[$i]).", ";
			  $games .= $array_games[$arrayGame[$i]].", ";
			}else {
			  //$games .= ucfirst($arrayGame[$i]);
			  $games .= $array_games[$arrayGame[$i]];
			}
		  }
		
	} 
	else 
	{ 
		$online_offline = "Offline"; 
		$circle_color = "grey";
		$user_fee = "";
		$user_games = "";			
	}
	

	
	
	echo "<div class='col-6' style='border:0px solid red;'>
	<div style='height:100%; border:0.5px solid grey; border-radius: 10px;'>
              <div style='cursor:pointer;' onclick=\"window.location.href='profile.php?user_id_profile=".$row_1['id']."';\"
                class='d-flex flex-row align-items-center gap-3 p-3'
              >
			  
			  <table width='100%'>
			  
			  <tr><td>
			  
                <img
                  src='".$user_images."'
                  alt=''
                  class='rounded-2 object-fit-cover ratio-1x1'
                  height='64'
                  width='64'
                />
								
			  </td><td>		
			    <!--
				<span><small><div>			  
				&nbsp;<b>".$row_1['name']."</b>
				<span><small>&nbsp;".$user_profile['age']."</small></span>
				<i class='bi bi-gender-".strtolower($user_profile['gender'])."'></i>
				<br>
				<span><small>&nbsp;".$online_offline."</small></span>
		        -->
			  </td></tr>
			  	  
			  <tr><td colspan='2' style='padding-bottom:5px;'><span><small><div>			  
				<b>".$row_1['name']."</b>
				&nbsp;&nbsp;<i class='bi bi-gender-".strtolower($user_profile['gender'])."'></i>
				<span><small>".$user_profile['age']."</small></span> 
			  </div></small></span></td></tr>
			  
			  <tr><td colspan='2'>
			  				  <div
								class='d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill'
								style='width: fit-content'
							  >
								  <div
									class='rounded-circle'
									style='width: 10px; height: 10px; background-color: ".$circle_color."'
								  ></div>
								  <span><small>".$online_offline."</small></span>
									<div
									class='d-flex flex-row align-items-center gap-2 bg-dark px-2 rounded-pill'
									style='width: fit-content'
									>
								  </div>
							  </div>
			  </td></tr>
			  ";
			  
			  if(isset($option) && $option['available'] == 'available') {
			  echo "
			  <tr><td colspan='2'>
									  <div
										class='d-flex flex-row align-items-center gap-2 bg-dark px-2 mt-2 rounded-pill'
										style='width: fit-content'
									  >
										<div
											class='rounded-circle'
										  ><i class='bi bi-cash fs-6'></i> </div>
										  <span><small>".$user_fee."</small></span>
									  </div></td></tr>
			  <tr><td colspan='2'>
			  						  <div
										class='d-flex flex-row align-items-center gap-2 bg-dark px-2 mt-2 rounded-pill'
										style='width: fit-content'
									  >
										<div
											class='rounded-circle'
										  ><i class='bi bi-controller fs-6'></i></div>
										  <span><small>".$games."</small></span>
									  </div>
			  </td></tr>
			  ";
			  } // if(isset($option) && $option['available'] == 'available') {
			  else {
			  echo "
			  <tr><td colspan='2'>
				&nbsp;
			  <tr><td colspan='2'>
				&nbsp;
			  </td></tr>
			  <tr><td colspan='2'>
				&nbsp;<br>
			  </td></tr>
			  
			  ";
			  } //  else {
				  
			  echo "
			  </table>
				
              </div>  
	</div>
	</div>";
	

	
} // foreach ($results_1 as $row_1) {
//echo $array_users_username[$row_1['id']];
?>         
		  
        </div>
        <!-- Summary End -->
      </div>
    </section>
  </body>
</html>
