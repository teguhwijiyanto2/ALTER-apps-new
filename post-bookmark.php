<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

	$return = [];

	$id = $_POST['id_post'];

	$liked = DB::queryFirstField("SELECT count(*) FROM post_bookmarks where post_id=%i and bookmark_by = %i", $id, $_SESSION["session_usr_id"]);

	if ($liked == 0){
		DB::insert('post_bookmarks', [
			'post_id' => $_POST['id_post'],
			'bookmark_by' => $_SESSION["session_usr_id"],
		  ]);
  
		  $return = [
			  'report' => true,
		  ];

		  echo json_encode($return);
			exit;
	}

?>