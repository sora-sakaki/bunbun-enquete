<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

if(isset($_SESSION['oauth']) == false) {
  print('エラーが発生しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');
    die;
}

$twitter = $_SESSION['twitter'];
$oauth = $_SESSION['oauth'];

unset($_SESSION['twitter']);
unset($_SESSION['oauth']);

$oauth_token = $_GET['oauth_token'];
$oauth_verifier = $_GET['oauth_verifier'];

try {
    $token = $oauth->getAccessToken($oauth_verifier);
    $_SESSION['oauthToken'] = $token;
    header("HTTP/1.1 301");
    header("Location: {$rootURL}/follow.php");
} catch (Exception $e) {
  $_SESSION = array();

  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
  }

  session_destroy();

  print('Twitterとの通信に失敗しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');

}

