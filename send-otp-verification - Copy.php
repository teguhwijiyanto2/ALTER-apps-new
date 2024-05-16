<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

/*  
INSERT INTO `alter_apps_db`.`users` (`id`, `email`, `phone`, `password`, `name`, `gender`, `birthdate`, `dota_2`, `pubg`, `free_fire`, `mobile_legends`, `aov`, `apex_legends`, 
`call_of_duty`, `cs_go`, `point_blank`, `fifa`, `nba`, `league_of_legends`, `valorant`, `pokemon`, `pes`, `magic_chess`, `genshin_impact`, `weekly_play`, 
`daily_play`, `registration_time`, `last_login`) VALUES (NULL, 'teguh@mail.com', '-', 'ze5ztxertxe54', NULL, NULL, NULL, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
*/



	$otp = mt_rand(100000, 999999);

	$default_pswd = 'user123';
	
	DB::insert('users', [
	  'email' => $_POST['email'],
	  'phone' => $_POST['phone'],
	  'password' => md5($_POST['password']),
	  'otp' => $otp,
	  'registration_time' => date("Y-m-d H:i:s")
	]);


$to = "".$_POST['email'].""; 
$from = "teguh@alterspace.gg"; 
$fromName = 'A.L.T.E.R'; 
 
$subject = "[ALTER] E-mail Registration & OTP"; 
 
$htmlContent = " 
    <html> 
    <head> 
        <title>Welcome to CodexWorld</title> 
    </head> 
    <body> 
        <h1>Thanks you for joining with us!</h1> 
        <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
            <tr> 
                <th>Your Email:</th><td>".$_POST['email']."</td> 
            </tr>
            <tr> 
                <th>Your Phone Number:</th><td>".$_POST['phone']."</td> 
            </tr> 			
            <tr> 
                <th>Your Password:</th><td>".$_POST['password']."</td> 
            </tr> 

            <tr> 
                <th>OTP Verification Code:</th><td><b>".$otp."</b></td> 
            </tr> 
        </table> 
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
//$headers .= 'Cc: welcome@example.com' . "\r\n"; 
//$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
    echo 'Email has sent successfully.'; 
}else{ 
   echo 'Email sending failed.'; 
}

//echo $htmlContent;

echo "<script>window.location.href='otp-verification.php?mail=".$_POST['email']."'</script>";


?>