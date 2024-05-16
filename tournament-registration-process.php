<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';


		/*
		<form action='tournament-registration-process.php' method='POST' enctype='multipart/form-data'>
		<input type='hidden' name='tournament_idx' value='<?php echo $_POST['tournament_idx']; ?>'>
		<input type='hidden' name='tournament_codex' value='<?php echo $_POST['tournament_codex']; ?>'>
		<input type='hidden' name='xplayers_per_team' value='<?php echo $_POST['xplayers_per_team']; ?>'>		
		<input type='hidden' name='xregistration_type' value='<?php echo $results_B['registration_type']; ?>'>
		<input type='hidden' name='xparticipant_fee' value='<?php echo $results_B['participant_fee']; ?>'>
		*/
		
		
		
if($_POST['xplayers_per_team'] == 1) { // Single player tournament

/*
	DB::insert('tournament_teams', [
	  'tournament_code' => $_POST['tournament_codex'],
	  'players_per_team' => $_POST['xplayers_per_team'],
	  'single_player_id' => $_POST['players_id[0]'],
	  'single_player_email' => '-',
	  'single_player_username' => $_POST['players_username[0]'],
		'registration_type' => $_POST['xregistration_type'],
		'participant_fee' => $_POST['xparticipant_fee'],
		'payment_status' => 'Not Yet Paid'
	]);
*/

	
	$str_rand = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $team_code = $_POST['tournament_idx'] . substr(str_shuffle($str_rand), 0, 9);

    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['team_logo']['name'];
    $fileSize_1 = $_FILES['team_logo']['size'];
    $fileTmpName_1  = $_FILES['team_logo']['tmp_name'];
    $fileType_1 = $_FILES['team_logo']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	$fileNameFix_1 = $team_code . "." . $fileNameCleaned_1;
if(strlen($fileNameCleaned_1) > 3) {	
    $uploadPath_1 = "team_logo/" . $fileNameFix_1; 
      if (empty($errors_1)) {		  
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "The file " . basename($fileName_1) . " has been uploaded";
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(strlen($fileNameCleaned_1) > 3) {

	DB::insert('tournament_teams', [
	  'registerer_user_id' => $_SESSION["session_usr_id"],	
	  'tournament_code' => $_POST['tournament_codex'],
	  'players_per_team' => $_POST['xplayers_per_team'],
	  'team_code' => $team_code,
	  'team_logo' => $fileNameFix_1,
	  'team_name' => $_POST['team_name'],
	  	'registration_type' => $_POST['xregistration_type'],
		'participant_fee' => $_POST['xparticipant_fee'],
		'payment_status' => 'Not Yet Paid'
	]);
	
	for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {
		DB::insert('tournament_team_players', [
		  'tournament_code' => $_POST['tournament_codex'],
		  'team_code' => $team_code,
		  'team_player_number' => $x,
		  'team_player_id' => $_POST['players_id'][$x],
		  'team_player_email' => '-',
		  'team_player_username' => $_POST['players_username'][$x]
		]);
	} 

    $tour =  DB::queryFirstRow("SELECT * FROM `tournament` WHERE tournament_code = %s ", $_POST['tournament_codex']);

	DB::insert('notifications', [
		'category' => 'tournament-join',
		'notif_for' => $tour["creator_user_id"],
		'notif_from' => $_SESSION["session_usr_id"],
		'title' => $_POST['team_name']. " joining your tournament.",
        'data' => $_POST['tournament_codex']
	  ]);

	  // exit; --> Do Not EXIT here! script redirect dibawah jadi nggak executed
		
	// for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {


} // if($_POST['xplayers_per_team'] == 1) { // Single player tournament

else { // Team player tournament
	
	$str_rand = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $team_code = $_POST['tournament_idx'] . substr(str_shuffle($str_rand), 0, 9);

    $errors_1 = []; // Store errors here
    $fileName_1 = $_FILES['team_logo']['name'];
    $fileSize_1 = $_FILES['team_logo']['size'];
    $fileTmpName_1  = $_FILES['team_logo']['tmp_name'];
    $fileType_1 = $_FILES['team_logo']['type'];
	$fileNameCleaned_1 = str_ireplace(" ","_",basename($fileName_1));
	$fileNameFix_1 = $team_code . "." . $fileNameCleaned_1;
if(strlen($fileNameCleaned_1) > 3) {	
    $uploadPath_1 = "team_logo/" . $fileNameFix_1; 
      if (empty($errors_1)) {		  
        $didUpload_1 = move_uploaded_file($fileTmpName_1, $uploadPath_1);
        if ($didUpload_1) {
          //echo "The file " . basename($fileName_1) . " has been uploaded";
        } else {
          //echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors_1 as $error_1) {
          //echo $error . "These are the errors" . "\n";
        }
      }
} // if(strlen($fileNameCleaned_1) > 3) {

	DB::insert('tournament_teams', [
	  'registerer_user_id' => $_SESSION["session_usr_id"],
	  'tournament_code' => $_POST['tournament_codex'],
	  'players_per_team' => $_POST['xplayers_per_team'],
	  'team_code' => $team_code,
	  'team_logo' => $fileNameFix_1,
	  'team_name' => $_POST['team_name'],
	  	'registration_type' => $_POST['xregistration_type'],
		'participant_fee' => $_POST['xparticipant_fee'],
		'payment_status' => 'Not Yet Paid'
	]);
	
	for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {
		DB::insert('tournament_team_players', [
		  'tournament_code' => $_POST['tournament_codex'],
		  'team_code' => $team_code,
		  'team_player_number' => $x,
		  'team_player_id' => $_POST['players_id'][$x],
		  'team_player_email' => '-',
		  'team_player_username' => $_POST['players_username'][$x]
		]);
	} 

    $tour =  DB::queryFirstRow("SELECT * FROM `tournament` WHERE tournament_code = %s ", $_POST['tournament_codex']);

	DB::insert('notifications', [
		'category' => 'tournament-join',
		'notif_for' => $tour["creator_user_id"],
		'notif_from' => $_SESSION["session_usr_id"],
		'title' => $_POST['team_name']. " joining your tournament.",
        'data' => $_POST['tournament_codex']
	  ]);

	  // exit; --> Do Not EXIT here! script redirect dibawah jadi nggak executed
		
	// for($x=1;$x<=$_POST['xplayers_per_team'];$x++) {

} // else { // Team player tournament


/*
	echo "
	<script>
		window.location.href='tournament-registration-confirmation.php';
	</script>
	";
*/

		if($_POST['xregistration_type']=="Free") {
			echo "<form action='tournament-registration-confirmation-free.php' method='POST' enctype='multipart/form-data' id='formTournamentRegistrationConfirmation'>";
		}
		if($_POST['xregistration_type']=="Paid") {
			echo "<form action='tournament-registration-confirmation-paid.php' method='POST' enctype='multipart/form-data' id='formTournamentRegistrationConfirmation'>";
		}

			echo "
				  <input type='hidden' name='tournament_idx' value='".$_POST['tournament_idx']."'>
				  <input type='hidden' name='tournament_codex' value='".$_POST['tournament_codex']."'>
				  <input type='hidden' name='team_codex' value='".$team_code."'>
				  <input type='hidden' name='xplayers_per_team' value='".$_POST['xplayers_per_team']."'>
				  <input type='hidden' name='xregistration_type' value='".$_POST['xregistration_type']."'>
				  <input type='hidden' name='xparticipant_fee' value='".$_POST['xparticipant_fee']."'>
				  </form>
				  <body onload=\"document.getElementById('formTournamentRegistrationConfirmation').submit();\">
				 ";
				 // 

?>