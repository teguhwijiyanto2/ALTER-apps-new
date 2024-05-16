<?php
    // Include file gpconfig
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require_once 'db.class.php';

    $user = DB::query("SELECT * FROM users WHERE id = " . $_SESSION["session_usr_id"]);
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    $results_check = DB::queryFirstRow("SELECT * FROM users where email=%s AND password=%s order by id desc limit 0,1", $user[0]["email"], md5($decoded['current_password']));

    header('Content-Type: application/json; charset=utf-8');

    if ($results_check != null) {
        DB::query("UPDATE `users` SET `password`=%s WHERE `users`.`id`=%i", md5($decoded["new_password"]), $_SESSION["session_usr_id"]);

        echo json_encode([
            "status" => true,
            "message" => "Password match."
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Password not match."
        ]);
    }
?>