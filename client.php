<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'vendor/autoload.php';
session_start();
$client = new Google_Client();

$client->setClientId("xxxxxxxxxx");
$client->setClientSecret("xxxxxxxxxxxx");
$client->setApplicationName("STOYS LOGIN");
$client->setRedirectUri("http://localhost/callback.php");
$client->setScopes(array(Google_Service_Oauth2::USERINFO_EMAIL,Google_Service_Oauth2::USERINFO_PROFILE));

$oAuth = new Google_Service_Oauth2($client);

?>