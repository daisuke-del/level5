<?php

require_once('util2.php');
require_once( dirname( __FILE__ ) . '/dns.php' );

//ホスト名取得
$h = $_SERVER['HTTP_HOST'];
 
// リファラ値があれば、かつ外部サイトかどうか
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
  $goback = $_SERVER['HTTP_REFERER'] ;
}else{
  $goback = 'mypage.php';
}


$errors = [];


$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";


//空欄チェックとデータ型チェック
if (!isset($_POST["sex"])||($_POST["sex"]==="")){
  $errors[] = "パスワードを記入してください";
}else{
  $sex = $_POST['sex'];
}
if (!isset($_POST["email"])||($_POST["email"]==="")){
  $errors[] = "メールアドレスを記入してください";
}else{
  $email = $_POST['email'];
}
if (!isset($_POST["password"])||($_POST["password"]==="")){
  $errors[] = "パスワードを記入してください";
}

//エラーチェック
if( empty($errors)){

if($sex == 'man'){
//男性ならmbbsテーブルへ、女性ならbbsテーブルへ
  $bbs = "mbbs";

}elseif($sex == 'woman'){
//男性ならmbbsテーブルへ、女性ならbbsテーブルへ
  $bbs = "bbs";

}

//フォームに入力されたmailがすでに登録されていないかチェック
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM $bbs WHERE email = :email";
$stm = $pdo->prepare($sql);
$stm->bindValue(':email', $email);
$stm->execute();
$member = $stm->fetch();

//レコードが存在しているかどうか
if(!$member == false){
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['password'], $member['password'])) {

  $sql = "DELETE FROM $bbs WHERE email = :email";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':email', $email);
  $stm->execute();
  
} else {
  $errors[] = "パスワードが一致しません";
}

}else{
  $errors[] = "該当するメールアドレスが見つかりませんでした";
}


}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>登録情報削除</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tablestyle.css">
  </head>

  <body>
  <?php include("navbar.php"); ?>

  <?php if( !empty($errors) ): ?>
      <ul class="error_message">
        <?php foreach( $errors as $value ): ?>
          <li><?php echo $value; ?></li><br>
        <?php endforeach; ?>
      </ul>
    <?php else:?>   
      <p>登録情報の削除が完了しました</p>   
    <?php endif; ?>


  <hr>
   <p><a href="<?php echo $goback?>">戻る</a></p>

    <?php include("footer.php"); ?>

  </body>
</html>