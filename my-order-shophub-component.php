<?php 
session_start(); 
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$categ = $_POST['categ'];
$date = $_POST['date'];
$search = $_POST['search'];
$id = $_SESSION["session_usr_id"];

$query = "SELECT * FROM `purchase_items` WHERE user_id ='".$id."'";

if($categ != 'All Status') {
    $query .= " AND purchase_status = '".$categ."'";
}

if($date == 30){
    $ago = date('Y-m-d', strtotime('-30 days'));

    $query .= " AND purchase_time >= '".$ago."'";
}
if($date == 90){
    $ago = date('Y-m-d', strtotime('-90 days'));

    $query .= " AND purchase_time >= '".$ago."'";
}

if($search) {
    $query .= " AND name LIKE '%".$search."%'";
}

$query .= " ORDER BY purchase_time DESC";


$results = DB::query($query);

foreach ($results as $shop) {
	
$logo = DB::queryFirstField("SELECT sub_category FROM billing_items_excel where payee_code=%s limit 0,1", $shop['payee_code']);
	
?>

<div class="list-play__item bg-dark rounded-3 overflow-hidden">
    <div class="opacity-100">
    <div
        class="float-end bg__violet py-1 px-3 fs-8"
        style="border-bottom-left-radius: 10px"
    >
        <?= $shop['purchase_status'] ?>
    </div>
    <div class="d-flex flex-row align-items-center gap-2 p-3">
		<?php
		echo "
        <img
        src=\"assets/img/temp/".str_ireplace(' ','_',strtolower($logo)).".png\"
        width='48'
        height='48'
        class='rounded-2 object-fit-contain'
        />
		";
		?>
        <div>
        <div><?= $shop['name'] ?></div>
        <div class="text-secondary fs-8"><?= $shop['description'] ?></div>
        </div>
    </div>
    <div class="px-3">
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Total Paid</span>
        <span class="text-light fs-5">Rp <?= $shop['total_amount'] ?></span>
        </div>
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Payment Method</span>
        <span class="text-light fs-5"><?= $shop['payment_method'] ?></span>
        </div>
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Payment Date</span>
        <span class="text-light fs-5"><?= $shop['purchase_time'] ?></span>
        </div>
        <div
        class="d-flex flex-row align-items-center justify-content-between text-secondary"
        >
        <span>Purchase ID</span>
        <span class="text-light fs-5"><?= $shop['order_id'] ?></span>
        </div>
    </div>
    </div>
    <div class="p-3 d-flex flex-row align-items-center gap-3 mt-2">
        <?php if($shop['purchase_status'] == 'Success'){ ?>
        <button class="btn btn-primary btn-sm rounded-pill w-100 py-2">
            Repurchase
        </button>
        <?php }if($shop['purchase_status'] == 'Failed'){ ?>
        <button class="btn btn-outline-light btn-sm rounded-pill w-100 py-2">
            Try Again
        </button>
        <?php } ?>
    </div>
</div>

<?php } ?>