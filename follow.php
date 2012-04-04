<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

if(!isset($_SESSION['oauthToken']['screen_name'])){
  print('エラーが発生しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');
    die;
}

try {
  $twitter = new Twitter();
  $oauth = $twitter->oAuth($consumer_key, $consumer_secret, $_SESSION['oauthToken']['oauth_token'], $_SESSION['oauthToken']['oauth_token_secret']);

  $r = $twitter->call('friendships/exists', array('screen_name_b'=>'bunbun_news', 'screen_name_a'=>$_SESSION['oauthToken']['screen_name']));


  if (!$r) {
    $r = $twitter->call('friendships/create', array('screen_name'=>'bunbun_news', 'follow' => 'true'));
  }


  header("HTTP/1.1 301");
  header("Location: {$rootURL}");
} catch (Exception $e) {
  $_SESSION = array();

  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
  }

  session_destroy();

  print('Twitterとの通信に失敗しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');
}

