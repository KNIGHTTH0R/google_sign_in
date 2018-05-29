<?php

require_once 'client.php';

$redirect = "http://".$_SERVER["HTTP_HOST"];

 if(isset($_GET["code"])){
    $token = $client->authenticate($_GET["code"]);    
    $_SESSION["access_token"] = $client->getAccessToken();
    header("Location:".filter_var($redirect,FILTER_SANITIZE_URL));
    exit();
} 

session_unset();
header("Location:".filter_var($redirect,FILTER_SANITIZE_URL));
?>