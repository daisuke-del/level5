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

$email = $_SESSION['email'];
$name = $_SESSION['name'];
$age = $_SESSION['age'];
$salary = $_SESSION['salary'];
$hight = $_SESSION['hight'];
$weight = $_SESSION['weight'];

//文字エンコードの検証
if (!cken($_POST)){
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is " . $encoding;
  //エラーメッセージの表示とコードのキャンセル
  exit($err);
}
//HTMLエスケープ
$_POST = es($_POST);

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
    <title>登録内容変更</title>
</head>
<body>
<?php include("navbar.php"); ?>

<h1>登録変更ページ</h1>
<form action="update.php" method="post" enctype="multipart/form-data">
<div>
  <label>登録画像を変更</label>
  <input type="file" name="image">
</div>
<div>
    <label>メールアドレス：<label>
    <input type="text" name="update_email" value = "<?php echo $email?>">
</div>
<div>
    <label>名前：
    <input type="text" name="update_name" value="<? echo $name ?>"><label>
</div>
<div>
    <label>年齢：
    <input type="number" name="update_age" value="<?php echo $age ?>" min="0" max="130" >歳<label>
</div>
<div>
    <label>年収：
    <input type="number" name="update_salary" value="<?php echo $salary?>" min="0" max="10000000000">万円<label>
</div>
<div>
    <label>身長：
    <input type="number" name="update_hight" value="<?echo $hight?>" min="0" max="250">cm<label>
</div>
<div>
    <label>体重：
    <input type="number" name="update_weight" value="<?echo $weight?>" min="0" max="500">kg<label>
</div>

<div><input type="submit" value= "更新"></div>


</form>

<hr>

<a href="<?echo $goback?>">戻る</a><br>

<?php include("footer.php"); ?>

</body>

</html>