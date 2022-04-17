<?php
require_once( dirname( __FILE__ ) . '/util2.php' );
//DB接続情報
require_once( dirname( __FILE__ ) . '/dns.php' );
require_once('err.config.php');

if(!isset($_SESSION)){
  session_start();
}

//ホスト名取得
$h = $_SERVER['HTTP_HOST'];
 
// リファラ値があれば、かつ外部サイトかどうか
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
  $goback = $_SERVER['HTTP_REFERER'] ;
}else{
  $goback = 'login/mypage.php';
}

//文字エンコードの検証
if (!cken($_POST)){
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is " . $encoding;
  //エラーメッセージの表示とコードのキャンセル
  exit($err);
}
//HTMLエスケープ
$_POST = es($_POST);

if(isset($_SESSION['email'])){
  $value = $_SESSION['email'];
  $_SESSION['email'] = $value ;
}else{
  $value = "";
}

?>



<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF=8'>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/choicecss.php" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
    <script type='text/javascript' src='js/submitbtn.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>ログイン</title>
</head>
<body>
<?php include("navbar.php"); ?>

<h1>ログインページ</h1>
<form action="login.php" method="post">
<div>
<label>性別：<br>
    <select name="sex" id="sex">
      <option value='woman'>女性</option>
      <option value='man'>男性</option>
    </select><br>
</div>
<div>
    <label>メールアドレス：<label>
    <input type="text" name="email" required value="<?echo $value?>">
</div>
<div>
    <label>パスワード：<label>
    <input type="password" name="password" required>
</div>
<input type="submit" value="ログイン">
</form>

<hr>

<a href="<?echo $goback?>">戻る</a><br>

<?php include("footer.php"); ?>

</body>

</html>