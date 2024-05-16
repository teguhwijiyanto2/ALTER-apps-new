<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

	$return = [];

	$id = $_POST['id_post'];

	$liked = DB::queryFirstField("SELECT count(*) FROM post_reports where post_id=%i and report_by = %i", $id, $_SESSION["session_usr_id"]);
	$liked_count = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i", $id);

	if ($liked == 0){
		DB::insert('post_reports', [
			'post_id' => $_POST['id_post'],
			'report_by' => $_SESSION["session_usr_id"],
		  ]);
  
		  $return = [
			  'report' => true,
		  ];

		  echo json_encode($return);
			exit;
	}

?>