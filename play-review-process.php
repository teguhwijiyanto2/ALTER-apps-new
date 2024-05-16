
<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

if($_POST['review_allow'] == 'Review'){
    DB::insert('matchmaking_review', [
        'matchmaking_id' => $_POST["id"],	  
        'point' => $_POST["rating"],
        'review_message' => $_POST["message"],
        'review_by' => $_SESSION["session_usr_id"],
	  
	]);

	DB::query("UPDATE matchmaking_availability SET request_status='Finished' WHERE id = '".$_POST['id']."'");
} else {
	DB::query("UPDATE matchmaking_availability SET request_status='Accepted' WHERE id = '".$_POST['id']."'");

    $play =  DB::queryFirstRow("SELECT * FROM `matchmaking_availability` WHERE id = %i ", $_POST['id']);

    DB::insert('notifications', [
		'category' => 'accepted-order',
		'notif_for' => $play["requestor_id"],
		'notif_from' => $_SESSION["session_usr_id"],
		'title' => $_SESSION["session_usr_name"]. " accepted your order.",
        'data' => $_POST['id']
	  ]);
}

	

    echo "
    <script>
        window.location.href='myorder.php';
    </script>
    ";

?>