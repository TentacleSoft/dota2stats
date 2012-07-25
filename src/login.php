<?php
//require_once '../vendor/openid/openid.php';
//
//try {
//    # Change 'localhost' to your domain name.
//    $openid = new LightOpenID('localhost:8080');
//    if(!$openid->mode) {
//        echo '!$openid->mode';
//        if(isset($_GET['login'])) {
//            $openid->identity = 'http://steamcommunity.com/openid';
//            header('Location: ' . $openid->authUrl());
//        }
//?>
<!--<form action="?login" method="post">
    <button>Login with Steam</button>
</form>-->
//<?php
//    } elseif($openid->mode == 'cancel') {
//        echo 'User has canceled authentication!';
//    } else {
//        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
//    }
//} catch(ErrorException $e) {
//    echo $e->getMessage();
//}
require_once 'loginSteam.php';

$steam = new SteamSignIn();

$url = $steam->genUrl();

echo $url;