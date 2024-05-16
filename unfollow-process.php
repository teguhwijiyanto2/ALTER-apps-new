<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

/*
CREATE TABLE IF NOT EXISTS `followers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `follower_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
*/

	// $_GET["user_id_profile"] ==> ini user yang di follow  (yaitu user yg lagi diliat profilenya)
	// $_SESSION["session_usr_id"] ==> ini user yang ngikutin / nge-follow (yaitu si user login)
	
	/*
	DB::insert('followers', [
	  'user_id' => $_GET["fid"], 
	  'follower_id' => $_SESSION["session_usr_id"]
	]);
	*/	
	
	$delete = DB::queryFirstField("DELETE from followers where follower_id=%i AND user_id=%i", $_SESSION["session_usr_id"], $_GET["fid"]);

/*
	echo("
	<script language='javascript'>
	alert('Successfully followed. Thank you.');
	window.location.href='profile.php';
	</script>
	")
*/

	echo("
	<script language='javascript'>
	window.location.href='profile.php?user_id_profile=".$_GET['fid']."';
	</script>
	")
	
?>