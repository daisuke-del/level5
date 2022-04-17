<?php

require_once('util2.php');
require_once( dirname( __FILE__ ) . '/dns.php' );
require_once('err.config.php');

session_start();

$errors = [];


$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

$today = date('Y-m-d');


//空欄チェックとデータ型チェック

if (!isset($_POST["signup_email"])||($_POST["signup_email"]==="")){
  $errors[] = "メールアドレスを記入してください";
}
if (!isset($_POST["signup_password"])||($_POST["signup_password"]==="")){
  $errors[] = "パスワードを記入してください";
}
if (!isset($_POST["signup_password2"])||($_POST["signup_password2"]==="")){
  $errors[] = "パスワードを記入してください";
}elseif ($_POST["signup_password"] !== $_POST["signup_password2"]){
  $errors[] = "パスワードが一致しません";
}

if (!isset($_POST["signup_name"])||($_POST["signup_name"]==="")){
  $errors[] = "ニックネームを記入してください";
}
if (!isset($_POST["signup_age"])||($_POST["signup_age"]==="")){
  $errors[] = "年齢を記入してください";
}

if (!isset($_POST["signup_salary"])||($_POST["signup_salary"]==="")){
  $errors[] = "年収を記入してください";
}

if (!isset($_POST["signup_hight"])||($_POST["signup_hight"]==="")){
  $errors[] = "身長を記入してください";
}

if (!isset($_POST["signup_weight"])||($_POST["signup_weight"]==="")){
  $errors[] = "体重を記入してください";
}

if (!isset($_POST["face"])||($_POST["face"]==="")){
  $errors[] = "顔面偏差値を選択してください";
}


//エラーチェック
if( empty($errors)){

//ポストを更新用データ変数に代入
$sex = $_POST['sex'];
$signup_name = $_POST['signup_name'];
$signup_email = $_POST['signup_email'];
$signup_password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
$signup_age = $_POST['signup_age'];
$signup_salary = $_POST['signup_salary'];
$signup_hight = $_POST['signup_hight'];
$signup_weight = $_POST['signup_weight'];
$signup_face = $_POST['face'];

if($sex == 'man'){
  $signup_face2 = $signup_face * 1.5;
  $signup_salary2 = $signup_salary / 10 -30;
  if ( $signup_salary2 > 100 ){
    $signup_salary2 = 100 ;
  }
  $signup_age2 = abs($signup_age -27);
  $signup_hight2 = $signup_hight - 150;
  $signup_weight2 = abs($signup_weight / ($signup_hight*$signup_hight/10000)-20)*2;

//男性ならmbbsテーブルへ、女性ならbbsテーブルへ
//男性ならmface_imageカラムへ、女性ならface_imageカラムへ
  $bbs = "mbbs";
  $facesimage = "mface_image";

}elseif($sex == 'woman'){
  $signup_face2 = $signup_face * 1.5;
  $signup_salary2 = $signup_salary / 10 -30;
  if ( $signup_salary2 > 100 ){
    $signup_salary2 = 100 ;
  }
  $signup_age2 = $signup_age -23;
  $signup_hight2 = $signup_hight2 = 30 ;
  $signup_weight2 = ($signup_weight / ($signup_hight*$signup_hight/10000)-20)*2;

//男性ならmbbsテーブルへ、女性ならbbsテーブルへ
//男性ならmface_imageカラムへ、女性ならface_imageカラムへ
  $bbs = "bbs";
  $facesimage = "face_image";

}



//フォームに入力されたmailがすでに登録されていないかチェック
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM $bbs WHERE email = :email";
$stm = $pdo->prepare($sql);
$stm->bindValue(':email', $signup_email);
$stm->execute();
$member = $stm->fetch();
//同じメールアドレスがあるか調査
if(!$member == false){

if ($member['email'] === $signup_email) {
  $errors[] = "同じメールアドレスが存在します";
}else{
  $errors[] = "登録情報に問題があります";
}

}else{


if($sex == 'man' or $sex == 'woman'){

  $signup_faceimage = uniqid(mt_rand(), true);//ファイル名をユニーク化
  $signup_faceimage .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
  $file = "image/$facesimage/$signup_faceimage";
  if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$facesimageにファイル名を代入
      move_uploaded_file($_FILES['image']['tmp_name'], './image/' . $facesimage . '/' . $signup_faceimage);//image/$facesimageディレクトリにファイル保存
  }
  

try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  //データベースにレコードを追加
    $sql = "INSERT INTO $bbs (name, face, $facesimage, salary, age, hight, weight, email, password, face2, salary2, age2, hight2, weight2, update_day) VALUES (:name, :face, :faceimage, :salary, :age, :hight, :weight, :email, :password, :face2, :salary2, :age2, :hight2, :weight2, :today)";
    $stm = $pdo->prepare($sql);
    

      $stm->bindValue(':name',$signup_name,PDO::PARAM_STR);
      $stm->bindValue(':face',$signup_face,PDO::PARAM_INT);
      $stm->bindValue(':faceimage',$signup_faceimage,PDO::PARAM_STR);
      $stm->bindValue(':salary',$signup_salary,PDO::PARAM_INT);
      $stm->bindValue(':age',$signup_age,PDO::PARAM_INT);
      $stm->bindValue(':hight',$signup_hight,PDO::PARAM_INT);
      $stm->bindValue(':weight',$signup_weight,PDO::PARAM_INT);
      $stm->bindValue(':email',$signup_email,PDO::PARAM_STR);
      $stm->bindValue(':password',$signup_password,PDO::PARAM_STR);
      $stm->bindValue(':face2',$signup_face2,PDO::PARAM_INT);
      $stm->bindValue(':salary2',$signup_salary2,PDO::PARAM_INT);
      $stm->bindValue(':age2',$signup_age2,PDO::PARAM_INT);
      $stm->bindValue(':hight2',$signup_hight2,PDO::PARAM_INT);
      $stm->bindValue(':weight2',$signup_weight2,PDO::PARAM_INT);
      $stm->bindValue(':today',$today,PDO::PARAM_STR);


      if($stm->execute()){
        $sql = "SELECT name,$facesimage,age,salary,hight,weight FROM $bbs WHERE $facesimage = '$signup_faceimage'";
        $stm = $pdo->prepare($sql);
        $stm->execute();

        $_SESSION = array();//セッションの中身をすべて削除

        $_SESSION['password'] = $signup_password;
        $_SESSION['email'] = $signup_email;
        $_SESSION['sex'] = $sex;
        $_SESSION['name'] = $signup_name;
        $_SESSION['face'] = $signup_face;
        $_SESSION['faceimage'] = $signup_faceimage;
        $_SESSION['salary'] = $signup_salary;
        $_SESSION['age'] = $signup_age;
        $_SESSION['hight'] = $signup_hight;
        $_SESSION['weight'] = $signup_weight;

      }else {
        $errors[] = "追加エラーがありました。";
      }
    
    }catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }

  }else{
    $errors[] = "性別を選択してください";
  }

}

}


?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>登録情報</title>
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

    <div>

    <?php if( !empty($errors) ): ?>
      <ul class="error_message">
        <?php foreach( $errors as $value ): ?>
          <li><?php echo $value; ?></li><br>
        <?php endforeach; ?>
      </ul>
    <?php else:?>      

    <h1>登録情報</h1>
    <?php foreach ($stm as $row): ?>
      <p>名前：<?php echo $row[0]?></p><br>
      <img src="<?php echo $file?>" width="300" height="300">
      <p>年齢：<?php echo $row[2]?></p><br>
      <p>年収：<?php echo $row[3]?></p><br>
      <p>身長：<?php echo $row[4]?></p><br>
      <p>体重：<?php echo $row[5]?></p><br>
    <?php endforeach;?>
    <?php endif; ?>
      
   <hr>
   <p><a href="register.php">戻る</a></p>
    </div>

    <?php include("footer.php"); ?>

  </body>
</html>