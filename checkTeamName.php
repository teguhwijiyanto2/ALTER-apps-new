<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


$count = DB::queryFirstField("SELECT COUNT(*) FROM tournament_teams where team_name=%s AND tournament_code=%s", $_GET['q'], $_GET['tournament_codex']);

if($count > 0) {
	//echo "&nbsp;";
	//echo "NO";
	echo "-";
} // if($count > 0) {
	
else {
	echo "<i class='bi bi-check-circle-fill fs-3 text-success'></i>";
	//echo $_GET['tournament_codex'];
}


?>