<?php
require_once( dirname( __FILE__ ) . '/util2.php' );
//DB接続情報
require_once( dirname( __FILE__ ) . '/dns.php' );
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

$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ログアウト</title>
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
<p>ログアウトしました。</p>

<a href="<?echo $goback?>">戻る</a>

<?php include("footer.php")?>

</body>
</html>