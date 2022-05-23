<?php
require_once( dirname( __FILE__ ) . '/util2.php' );
//DB接続情報
require_once( dirname( __FILE__ ) . '/dns.php' );
require_once('err.config.php');

if(!isset($_SESSION)){
  session_start();
}

$today = date('Y-m-d');

//ポストを更新用データ変数に代入
//空欄チェックとデータ型チェック
$update_email = $_POST['update_email'];
if (!isset($_POST["update_email"])||($_POST["update_email"]==="")){
  $update_email = $_SESSION['email'];
}

$update_name = $_POST['update_name'];
if (!isset($_POST["update_name"])||($_POST["update_name"]==="")){
  $update_name = $_SESSION['name'];
}

$update_age = $_POST['update_age'];
if (!isset($_POST["update_age"])||($_POST["update_age"]==="")){
  $update_age = $_SESSION['age'];
}


$update_salary = $_POST['update_salary'];
if (!isset($_POST["update_salary"])||($_POST["update_salary"]==="")){
  $update_salary = $_SESSION['salary'];
}

$update_hight = $_POST['update_hight'];
if (!isset($_POST["update_hight"])||($_POST["update_hight"]==="")){
  $update_hight = $_SESSION['hight'];
}

$update_weight = $_POST['update_weight'];
if (!isset($_POST["update_weight"])||($_POST["update_weight"]==="")){
  $update_weight = $_SESSION['weight'];
}

$email = $_SESSION['email'];

if( empty($errors)){

//性別調査
if($_SESSION['sex'] == 'man'){

  //性別に従ってデータベースを設定
  $bbs = 'mbbs';

  //データを検索用に計算して検索用データ変数に代入
  $update_salary2 = $update_salary / 10 -30;
  if ( $update_salary2 > 100 ){
    $update_salary2 = 100 ;
  }
  $update_age2 = abs($update_age -27);
  $update_hight2 = $update_hight - 150;
  $update_weight2 = abs($update_weight / ($update_hight*$update_hight/10000)-20)*2;
  $faceimage = 'mface_image';

}elseif($_SESSION['sex'] == 'woman'){

  //性別に従ってデータベースを設定
  $bbs = 'bbs';

  //データを検索用に計算して検索用データ変数に代入
  $update_salary2 = $update_salary / 10 -30;
  if ( $update_salary2 > 100 ){
    $update_salary2 = 100 ;
  }
  $update_age2 = abs($update_age -23);
  $update_hight2 = 30;
  $update_weight2 = ($update_weight / ($update_hight*$update_hight/10000)-20)*2;
  $faceimage = 'face_image';
}

if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {

 //DB接続
 $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
 $pdo = new PDO($dsn, $user, $password);
 
 #$sql = "UPDATE :bbs SET email = :update_email, name = :update_name, age = :update_age, salary = :update_salary, hight = :update_hight, weight = :update_weight, salary2 = :update_salary2, age2 = :update_age2, hight2 = :update_hight2, weight2 = :update_weight2 WHERE email = :email";
 
 //データを更新
 $sql = "UPDATE $bbs SET email = '$update_email', name = '$update_name', age = $update_age, salary = $update_salary, hight = $update_hight, weight = $update_weight, salary2 = $update_salary2, age2 = $update_age2, hight2 = $update_hight2, weight2 = $update_weight2 WHERE email = '$email'";
 
 $stm = $pdo->prepare($sql);
 
 /*
 $stm->bindValue(':bbs',$bbs,PDO::PARAM_STR);
 $stm->bindValue(':update_email',$update_email,PDO::PARAM_STR);
 $stm->bindValue(':update_name',$update_name,PDO::PARAM_STR);
 $stm->bindValue(':update_salary',$update_salary,PDO::PARAM_INT);
 $stm->bindValue(':update_age',$update_age,PDO::PARAM_INT);
 $stm->bindValue(':update_hight',$update_hight,PDO::PARAM_INT);
 $stm->bindValue(':update_weight',$update_weight,PDO::PARAM_INT);
 $stm->bindValue(':update_salary2',$update_salary2,PDO::PARAM_INT);
 $stm->bindValue(':update_age2',$update_age2,PDO::PARAM_INT);
 $stm->bindValue(':update_hight2',$update_hight2,PDO::PARAM_INT);
 $stm->bindValue(':update_weight2',$update_weight2,PDO::PARAM_INT);
 $stm->bindValue(':email',$email,PDO::PARAM_STR);
 */
 
 $stm->execute();
 
 //更新後データをセッションに格納し直す
 $_SESSION['email'] = $update_email ;
 $_SESSION['name'] = $update_name ;
 $_SESSION['age'] = $update_age ;
 $_SESSION['salary'] = $update_salary ;
 $_SESSION['hight'] = $update_hight ;
 $_SESSION['weight'] = $update_weight ;
 $_SESSION['email'] = $email ;

}else{

  $update_faceimage = uniqid(mt_rand(), true);//ファイル名をユニーク化
  $update_faceimage .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
  $file = "image/$faceimage/$update_faceimage";
  if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$facesimageにファイル名を代入
      move_uploaded_file($_FILES['image']['tmp_name'], './image/' . $faceimage . '/' . $update_faceimage);//image/$facesimageディレクトリにファイル保存
  }



//DB接続
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $user, $password);

#$sql = "UPDATE :bbs SET email = :update_email, name = :update_name, age = :update_age, salary = :update_salary, hight = :update_hight, weight = :update_weight, salary2 = :update_salary2, age2 = :update_age2, hight2 = :update_hight2, weight2 = :update_weight2 WHERE email = :email";

//データを更新

//旧画像を削除
$sql2 = "SELECT $faceimage FROM $bbs WHERE email = '$update_email'";
$stm2 = $pdo->prepare($sql2);
$stm2->execute();
$result = $stm2->fetch(PDO::FETCH_ASSOC);
$result[] = $result;
$result1 =current($result[0]);
$file2 = "image/$faceimage/$result1";

unlink($file2);


$sql = "UPDATE $bbs SET email = '$update_email', name = '$update_name', age = $update_age, salary = $update_salary, hight = $update_hight, weight = $update_weight, salary2 = $update_salary2, age2 = $update_age2, hight2 = $update_hight2, weight2 = $update_weight2 ,$faceimage = '$update_faceimage' , update_day = '$today' WHERE email = '$email'";

$stm = $pdo->prepare($sql);

/*
$stm->bindValue(':bbs',$bbs,PDO::PARAM_STR);
$stm->bindValue(':update_email',$update_email,PDO::PARAM_STR);
$stm->bindValue(':update_name',$update_name,PDO::PARAM_STR);
$stm->bindValue(':update_salary',$update_salary,PDO::PARAM_INT);
$stm->bindValue(':update_age',$update_age,PDO::PARAM_INT);
$stm->bindValue(':update_hight',$update_hight,PDO::PARAM_INT);
$stm->bindValue(':update_weight',$update_weight,PDO::PARAM_INT);
$stm->bindValue(':update_salary2',$update_salary2,PDO::PARAM_INT);
$stm->bindValue(':update_age2',$update_age2,PDO::PARAM_INT);
$stm->bindValue(':update_hight2',$update_hight2,PDO::PARAM_INT);
$stm->bindValue(':update_weight2',$update_weight2,PDO::PARAM_INT);
$stm->bindValue(':email',$email,PDO::PARAM_STR);
*/

$stm->execute();

//更新後データをセッションに格納し直す
$_SESSION['email'] = $update_email ;
$_SESSION['name'] = $update_name ;
$_SESSION['age'] = $update_age ;
$_SESSION['salary'] = $update_salary ;
$_SESSION['hight'] = $update_hight ;
$_SESSION['weight'] = $update_weight ;
$_SESSION['email'] = $email ;

}

$smg = '登録情報を更新しました';

//マイページを表示
include_once 'mypage.php';

}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>更新結果</title>
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

<?php if( !empty($errors) ):?>
  <ul class="error_message">
  <?php foreach( $errors as $value ): ?>
    <li><?php echo $value; ?></li><br>
        <?php endforeach; ?>
   </ul>
  <?php else:?> 

   <p><?echo $smg?></p>

<?php endif; ?>
  </body>
</html>
  
