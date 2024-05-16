
<?php
session_start();
// Include Librari Google Client (API)
include_once 'google-client/Google_Client.php';
include_once 'google-client/contrib/Google_Oauth2Service.php';
$client_id = '1052090495618-u98t360vnpupgqliicdfoc3j9n41pnfk.apps.googleusercontent.com'; // Google client ID
$client_secret = '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'; // Google Client Secret
$redirect_url = 'https://beta.alterspace.gg/auth.php'; // Callback URL
// Call Google API
$gclient = new Google_Client();
$gclient->setApplicationName('Google Login'); // Set dengan Nama Aplikasi Kalian
$gclient->setClientId($client_id); // Set dengan Client ID
$gclient->setClientSecret($client_secret); // Set dengan Client Secret
$gclient->setRedirectUri($redirect_url); // Set URL untuk Redirect setelah berhasil login
$google_oauthv2 = new Google_Oauth2Service($gclient);
?>