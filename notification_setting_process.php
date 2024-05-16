<?php
    // Include file gpconfig
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    require_once 'db.class.php';

    $user = $_SESSION["session_usr_id"];
    $type = $_POST['type'];
    $change = 0;

    $user_notification = DB::queryFirstRow("SELECT * FROM notification_setting where user_id=%i", $user);


    if($type == 'messages'){
        if($user_notification['messages'] == 0){
            $change = 1;
        }
        DB::query("UPDATE `notification_setting` SET `messages`=%i WHERE `user_id`=%i", $change, $user);
    }elseif($type == 'friend_request'){
        if($user_notification['friend_request'] == 0){
            $change = 1;
        }
        DB::query("UPDATE `notification_setting` SET `friend_request`=%i WHERE `user_id`=%i", $change, $user);
    }elseif($type == 'play_request'){
        if($user_notification['play_request'] == 0){
            $change = 1;
        }
        DB::query("UPDATE `notification_setting` SET `play_request`=%i WHERE `user_id`=%i", $change, $user);
    }elseif($type == 'tournament_request'){
        if($user_notification['tournament_request'] == 0){
            $change = 1;
        }
        DB::query("UPDATE `notification_setting` SET `tournament_request`=%i WHERE `user_id`=%i", $change, $user);
    }elseif($type == 'games_updated'){
        if($user_notification['games_updated'] == 0){
            $change = 1;
        }
        DB::query("UPDATE `notification_setting` SET `games_updated`=%i WHERE `user_id`=%i", $change, $user);
    }

    return true;


     
?>