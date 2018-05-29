<?php
error_reporting(E_ALL);

require_once 'client.php';

if(isset($_REQUEST["logout"])){
    session_unset();
    $client->revokeToken();
}

if(isset($_SESSION["access_token"]) && $_SESSION["access_token"]){
    $client->setAccessToken($_SESSION["access_token"]);
}

if ($client->getAccessToken()) {
    //$userData = $oAuth->userinfo->get();
    //$userData = $oAuth->userinfo_v2_me->get(); // ikinci yol
    $userData = $client->verifyIdToken(); // üçüncü yol

    $_SESSION["access_token"] = $client->getAccessToken();

    /* echo "<pre>";
    print_r($userData);
    echo "</pre>"; */

    $email = filter_var($userData['email'], FILTER_SANITIZE_EMAIL);
    $img = filter_var($userData['picture'], FILTER_VALIDATE_URL);
    $personMarkup = "$email<div><img src='$img?sz=100'></div>";

    print $personMarkup;

    echo '<a href="?logout">Çıkış Yap</a>';

    exit();
}

$auth_link = $client->createAuthUrl();

echo '<a href="'.filter_var($auth_link, FILTER_SANITIZE_URL).'">Google ile giriş yap</a>';

?>
