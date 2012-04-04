<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

if(!isset($_SESSION['oauthToken']['screen_name'])){
  print('エラーが発生しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');
    die;
}

$link = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
if (!$link) {
  print('エラーが発生しました。スタッフに連絡してください。<a href="'.$rootURL.'">トップページへ</a>');
    die;
}
$db_selected = mysql_select_db($mysql_database, $link);
if (!$db_selected) {
  print('エラーが発生しました。スタッフに連絡してください。<a href="'.$rootURL.'">トップページへ</a>');
    die;
}

$enq_id = 1;
$result = mysql_query('select id from enquete where q_id = '.$enq_id.' AND a_id = "'.$_SESSION['oauthToken']['screen_name'].'"');
if (mysql_fetch_assoc($result)) {
  print('すでに回答済みです。<a href="'.$topURL.'">トップページへ</a>');
    die;
}


if ($_POST['istweet']) {
  try {

    $twitter = new Twitter();
    $oauth = $twitter->oAuth($consumer_key, $consumer_secret, $_SESSION['oauthToken']['oauth_token'], $_SESSION['oauthToken']['oauth_token_secret']);

    $r = $twitter->call('statuses/update', array('status'=>$_POST['tweet']));


  } catch (Exception $e) {
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time()-42000, '/');
    }

    session_destroy();

    print('Twitterとの通信に失敗しました。再度試みてください。<a href="'.$rootURL.'">トップページへ</a>');
  }
}


$num_of_question = 11;
$hash = $_SESSION['oauthToken']['screen_name'];
for ($i = 0; $i < $num_of_question; $i++) {
  if (isset($_POST['q'.($i+1).'_num'])) {
    $a_num = $_POST['q'.($i+1).'_num'];
  } else {
    $a_num = -1;
  }
  if (isset($_POST['q'.($i+1).'_text'])) {
    $a_text = $_POST['q'.($i+1).'_text'];
  } else {
    $a_text = '';
  }
  $result = mysql_query('insert into enquete (enq_id, q_id, a_num, a_text, created_at, a_id) values ('.$enq_id.', '.($i+1).', '.$a_num.', "'.$a_text.'", now(), "'.$hash.'")');
  if (!$result) {
    print('エラーが発生しました。スタッフに連絡してください。<a href="'.$rootURL.'">トップページへ</a>');
      die;
  }
}

header("HTTP/1.1 301");
header("Location: {$topURL}");



