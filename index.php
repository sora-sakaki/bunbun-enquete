<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>bunbun</title>
<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<br/>
<div id="main">

<div class="sub">

<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

if(isset($_SESSION['oauthToken']['screen_name'])){
?>
<div style="float: left">
ログイン中:<?php print($_SESSION['oauthToken']['screen_name']); ?>
</div>
<div style="float: right">
<a href="<?php print($rootURL); ?>/logout.php" style="color:#00f;text-decoration: none">ログアウト</a>
</div>
<div style="clear: both;">
</div>
<H1>読者アンケート</H1>

<form action="post.php" method="post">
<div class="qes">
Q1. 記事一面は面白かったですか？
</div>
<div class="ans">
<input type="radio" name="q1_num" value="1" />1. 面白かった
<input type="radio" name="q1_num" value="2" />2. 普通だぜ
<input type="radio" name="q1_num" value="3" />3. つまらなかった
</div>
<br/>

<div class="desc">
記事一面の感想がありましたらお願いします。
</div>
<textarea row="10" cols="60" name="q1_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br>

<div class="qes">
Q2. 裏面の4コマは面白かったですか？
</div>
<div class="ans">
<input type="radio" name="q2_num" value="1" />1. 面白かった
<input type="radio" name="q2_num" value="2" />2. 普通だぜ
<input type="radio" name="q2_num" value="3" />3. つまらなかった
</div>
<br>

<div class="desc">
記事一面の感想がありましたらお願いします。
</div>
<textarea row="10" cols="60" name="q2_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br>

<div class="qes">
Q3. ネットプリントの説明のイラストはわかりにやすかった？
</div>
<div class="ans">
<input type="radio" name="q3_num" value="1" />1. わかりやすかった
<input type="radio" name="q3_num" value="2" />2. 普通だぜ
<input type="radio" name="q3_num" value="3" />3. わかりにくかった
</div>
<br>
<br>
<div class="qes">
Q4. アンケートシステムの説明はわかりにやすかった？
</div>
<div class="ans">
<input type="radio" name="q4_num" value="1" />1. わかりやすかった
<input type="radio" name="q4_num" value="2" />2. 普通だぜ
<input type="radio" name="q4_num" value="3" />3. わかりにくかった
</div>
<br>
<br>
<div class="qes">
Q5. 次取材して欲しいキャラは？
</div>
<div class="ans">
<input type="radio" name="q5_num" value="1" />1. 博麗霊夢
<input type="radio" name="q5_num" value="2" />2. アリス・マーガトロイド
<input type="radio" name="q5_num" value="3" />3. 十六夜 咲夜
</div>
</li>
<br>
<br>
</div>

<br><br><br>
<div class="sub">
<H1>読者参加企画</H1>
<div class="qes">
Q1.『私の嫁の萌ポイント』(※文字制限数400)<br>
</div>
<div class="desc">
此方は、皆様が愛してやまないであろう幻想郷少女の『誰か』を、何故好きなのかという、<br>
その大好きな点を思う存分に語っていただく場所になります。<br>
暖かい想いがいっぱい篭っているとその誰かさんはとっても嬉し恥ずかしいかも知れません。<br>
</div>
<textarea row="10" cols="60" name="q6_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>

<div class="qes">
Q2.『私のさいきょー厨二設定』(※文字制限数400)<br>
</div>
<div class="desc">
皆様の中での幻想郷少女の設定などを語っていただけたら、と考えております。<br>
常識に囚われずに、自由な発想で、自分なりの設定を語ってみては如何でしょうか。<br>
皆様が考えるあの子の能力のメカニズムや弱点など、貴方の考える凝った厨二設定を教えて下さい。<br>
</div>
<textarea row="10" cols="60" name="q7_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>

<div class="qes">
Q3.『幻想郷に行けたら最初にしたい事』(※文字制限数400)<br>
</div>
<div class="desc">
数々の名所がある幻想郷。もし此方に皆様が遊びに来られたら、皆様は如何しますか？<br>
幻想郷のどの場所で、どのような事をしてみたいのかを語ってみては如何でしょうか。<br>
もしかしたら、同好のお友達がいっぱい生まれるかもしれません。<br>
</div>
<textarea row="2" cols="100" name="q8_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>

<div class="qes">
Q4.『幻想郷川柳』(※文字制限数100)<br>
</div>
<div class="desc">
５・７・５の限られた文で、幻想郷についての何かを詠ってください。<br>
何についての川柳かは特に限定してはいません。何気ない幻想郷の一コマを詠ってみても構いません。<br>
</div>
<textarea row="10" cols="60" name="q9_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>


<div class="qes">
Q5.広告募集<br>
</div>
<div class="desc">
文々丸新聞ではネタ広告を募集しています。<br>
面白いネタをお待ちしております。<br>
</div>
<textarea row="10" cols="60" name="q10_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>

<div class="qes">
Q5.『文々。新聞通信欄』(※文字制限数400)<br>
</div>
<div class="desc">
此方は我々、射命丸、犬走、姫海棠や、その他幻想郷少女に言いたい事がある人はどうぞ。<br>
</div>
<textarea row="10" cols="60" name="q11_text"></textarea>
<div class="count">文字数カウンター:00文字</div>
<br><br>

<input type="checkbox" name="istweet" value="istweet" />ツイートする(※任意)<br>
<textarea class="readtext" row="20" cols="60" name="tweet">文々丸新聞のアンケートに答えました!今なら射命丸文のキーホルダーを抽選で進呈中!くわしくはこちらから!→http://b-news.info #文々丸新聞</textarea>
<br><br>
<input type="submit" value="応募する" />

</form>
<?php
  $twitter = new Twitter();
  $oauth = $twitter->oAuth($consumer_key, $consumer_secret, $_SESSION['oauthToken']['oauth_token'], $_SESSION['oauthToken']['oauth_token_secret']);

} else {
  try {
      $twitter = new Twitter();
      $oauth = $twitter->oAuth($consumer_key, $consumer_secret);
      $requestToken = $oauth->getRequestToken();
      $url = $oauth->getAuthorizeUrl($requestToken);
      $_SESSION['twitter'] = $twitter;
      $_SESSION['oauth'] = $oauth;
  } catch (Exception $e) {
      echo $e;
  }
?>
<H1>読者アンケート</H1>
<div style="margin-top: 20px;">
アンケートに回答するにはTwitterでログインしてください。
</div>
<div style="margin-top: 10px;">
<span style="color:#f00">(注意)</span>アンケートに答えるには文々。新聞公式アカウントのフォローが必須です。こちらでログインすると同時に公式アカウントを<span style="color:#f00">自動でフォロー</span>します。ログインされた場合は、この事項に同意したものとみなします。
</div>
<div style="margin-top: 10px;">
<a href="<?php print($url); ?>" style="color:#00f;text-decoration:none">ログイン</a>
</div>

<?php
}
?>

</div>
</div>
</body>
</html>


