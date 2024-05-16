<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

	$return = [];

	$id = $_POST['id_post'];

	$liked = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i and liked_by = %i", $id, $_SESSION["session_usr_id"]);
	$liked_count = DB::queryFirstField("SELECT count(*) FROM post_likes where post_id=%i", $id);

	if ($liked > 0){
		DB::query("DELETE FROM `post_likes` WHERE post_id=%i and liked_by = %i", $id, $_SESSION["session_usr_id"]);

		$return = [
			'liked' => false,
			'count' => $liked_count - 1
		];
	}
	else {
		DB::insert('post_likes', [
		  'post_id' => $_POST['id_post'],
		  'liked_by' => $_SESSION["session_usr_id"],
		]);

		$post =  DB::queryFirstRow("SELECT * FROM posts WHERE id=%s ", $id);

		if($post['posted_by'] != $_SESSION["session_usr_id"]) {
			DB::insert('notifications', [
				'category' => 'post-like',
				'notif_for' => $post['posted_by'],
				'notif_from' => $_SESSION["session_usr_id"],
				'title' => 'liked your post.',
				'data' => $post['id']
			  ]);
		}

		$return = [
			'liked' => true,
			'count' => $liked_count + 1
		];
	}
	echo json_encode($return);
	exit;

?>