<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$count = DB::queryFirstField("select count(*) from chat_room where chat_type='DM' AND ((user_id_1=%i AND user_id_2=%i) OR (user_id_1=%i AND user_id_2=%i))", $_POST['user_1'], $_POST['user_2'], $_POST['user_1'], $_POST['user_2']);

if($count == 0) {
	
/*
	CREATE TABLE IF NOT EXISTS `chat_room` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_room_uuid` varchar(255) DEFAULT NULL,
  `chat_type` varchar(10) DEFAULT NULL,
  `user_id_1` bigint(20) DEFAULT NULL,
  `user_id_2` bigint(20) DEFAULT NULL,
  `group_chat_name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/

/*
	<form action="chat-opener.php" method="POST" id="formChatOpener">
		<input type="text" name="chat_type" value="DM">
		<input type="text" name="user_1" value="<?php echo $_SESSION["session_usr_id"]; ?>">
		<input type="text" name="user_2" value="<?php echo $user_id_profile; ?>">
	</form>
*/
	
	$chat_room_uuid = bin2hex(random_bytes(32));
	
	DB::insert('chat_room', [
	  'chat_room_uuid' => $chat_room_uuid,
	  'chat_type' => 'DM',
	  'user_id_1' => $_POST['user_1'],
	  'user_id_2' => $_POST['user_2'],
	  'group_chat_name' => '-'
	]);
	
} // if($count == 0) {

if($count > 0) {
	
	$result_1 = DB::queryFirstRow("select * from chat_room where chat_type='DM' AND ((user_id_1=%i AND user_id_2=%i) OR (user_id_1=%i AND user_id_2=%i))", $_POST['user_1'], $_POST['user_2'], $_POST['user_1'], $_POST['user_2']);
	$chat_room_uuid = $result_1['chat_room_uuid'];

} // if($count > 0) {
	
	
	echo "
	<form action='chat.php' method='POST' id='formChatOpener'>
		<input type='hidden' name='chat_type' value='DM'>
		<input type='hidden' name='chat_room_uuidx' value='".$chat_room_uuid."'>
	</form>
	<body onload=\"document.getElementById('formChatOpener').submit();\">
	";




	/*
	<form action="chat.php" method="POST" id="formChatOpener">
		<input type="text" name="chat_type" value="DM">
		<input type="text" name="chat_room_uuid" value="DM">
		<input type="text" name="user_1" value="<?php echo $_SESSION["session_usr_id"]; ?>">
		<input type="text" name="user_2" value="<?php echo $user_id_profile; ?>">
	</form>
	
	CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(255) DEFAULT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  `message` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `chat_room` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(255) DEFAULT NULL,
  `chat_type` varchar(10) DEFAULT NULL,
  `user_id_1` bigint(20) DEFAULT NULL,
  `user_id_2` bigint(20) DEFAULT NULL,
  `group_chat_name` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


select count(*) from chat_room where chat_type='DM' AND ((user_id_1=%i AND user_id_2=%i) OR (user_id_2=%i AND user_id_1=%i));


CREATE TABLE IF NOT EXISTS `chat_room_member` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
	*/
	

?>

