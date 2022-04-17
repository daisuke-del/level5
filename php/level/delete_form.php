<?php
require_once( dirname( __FILE__ ) . '/util2.php' );
require_once('err.config.php');

//ホスト名取得
$h = $_SERVER['HTTP_HOST'];
 
// リファラ値があれば、かつ外部サイトかどうか
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
  $goback = $_SERVER['HTTP_REFERER'] ;
}else{
  $goback = 'mypage.php';
}


if(!isset($_SESSION)){
  session_start();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>会員登録削除</title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/choicecss.php" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
  <script type='text/javascript' src='js/submitbtn.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php include("navbar.php"); ?>

<h1>会員情報削除</h1>
<form action="delete.php" method="post">
<div>
<label>性別：<br>
    <select name="sex" id="sex">
      <option value='woman'>女性</option>
      <option value='man'>男性</option>
    </select><br>
</div>
<div>
    <label>メールアドレス：<label>
    <input type="text" name="email" required>
</div>
<div>
    <label>パスワード：<label>
    <input type="password" name="password" required>
</div>
<input type="submit" value="会員情報を削除">
</form>

<a href="<?echo $goback?>">戻る</a>

<?php include("footer.php")?>

</body>
</html>