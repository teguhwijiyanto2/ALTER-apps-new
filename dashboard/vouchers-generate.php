<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


function random_string($length) {
	
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[random_int(0, $charactersLength - 1)];
	}
	return $randomString;

} // function random_string($length) {

$uuid = random_string(10);


function random_digits($length) {
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= random_int(0, 9);
    }

    return $result;
} // function random_digits($length) {


function random_number($length)
{
    return join('', array_map(function($value) { return $value == 1 ? mt_rand(1, 9) : mt_rand(0, 9); }, range(1, $length)));
}


//echo $uuid;
//echo "<br><br>";

	DB::insert('vouchers', [
		'uuid' => $uuid,
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'prefix' => strtoupper($_POST['prefix']),
		'num_of_vouchers' => $_POST['num_of_vouchers'],
		'length_of_codes' => $_POST['length_of_codes'],
		'item_category' => $_POST['item_category'],
		'discount_cashback_type' => $_POST['discount_cashback_type'],
		'voucher_value' => $_POST['voucher_value'],
		'date_from' => $_POST['date_from'],
		'date_to' => $_POST['date_to'],
		'min_purchase' => $_POST['min_purchase'],
		'quota' => $_POST['num_of_vouchers'],
		'num_used' => 0,		
		'num_available' => $_POST['num_of_vouchers']
	  ]);


for($x=1; $x <= $_POST['num_of_vouchers']; $x++) {
	
	//echo $x . ". " . random_string($_POST['length_of_codes']);
	//echo "<br>";

	$unique_code = random_string($_POST['length_of_codes']);

	DB::insert('voucher_codes', [
		'uuid' => $uuid,
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'prefix' => strtoupper($_POST['prefix']),
		'unique_code' => $unique_code,
		'length_of_codes' => $_POST['length_of_codes'],
		'voucher_code' => strtoupper($_POST['prefix']).$unique_code,
		'single_user_id' => 0,
		'item_category' => $_POST['item_category'],
		'discount_cashback_type' => $_POST['discount_cashback_type'],
		'voucher_value' => $_POST['voucher_value'],
		'date_from' => $_POST['date_from'],
		'date_to' => $_POST['date_to'],
		'min_purchase' => $_POST['min_purchase'],
		'quota' => 1,
		'num_used' => 0,		
		'num_available' => 1,
		'is_used' => 'No'
	  ]);
	
	
} // for($x=0; $x<==$_POST['num_of_vouchers']; $x++) {





echo "
        <script language='javascript'>
        window.location.href='vouchers.php';
        </script>
      ";


?>