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

if (isset($_SESSION['email']) && isset($_SESSION['sex'])) {//ログインしているとき
    $email = $_SESSION['email'];
    $username = $_SESSION['name'];
    $sex = $_SESSION['sex'];
    $link = '<a href="update_form.php">登録情報を変更</a>';
    //DB接続
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($sex == 'man'){
      $bbs = 'mbbs';
      $faceimage = 'mface_image';
    }elseif($sex == 'woman'){
      $bbs = 'bbs';
      $faceimage = 'face_image';
    }
    
        $sql = "SELECT name,face,$faceimage,age,salary,hight,weight,update_day FROM $bbs WHERE email = '$email' ";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $file = "../image/$faceimage/";

        foreach($stm as $row){
          $name = $row[0];
          $face = $row[1];
          $image = $row[2];
          $age = $row[3];
          $salary = $row[4];
          $hight = $row[5];
          $weight = $row[6];
          $update_day = $row[7];
          $today = date('Y-m-d');

          $day = (strtotime($today) - strtotime($update_day) )/ 86400;
        }

        $_SESSION['sex'] = $sex;
        $_SESSION['face'] = $face;
        $_SESSION['age'] = $age;
        $_SESSION['salary'] = $salary;
        $_SESSION['hight'] = $hight;
        $_SESSION['weight'] = $weight;
        $_SESSION['day'] = $day;

        $_SESSION['choice_sex'] = $sex;
        $_SESSION['face2'] = $face;
        $_SESSION['age2'] = $age;
        $_SESSION['salary2'] = $salary;
        $_SESSION['hight2'] = $hight;
        $_SESSION['weight2'] = $weight;


        

  }else{

    $errors[] = "登録データが見つかりません";
    $link = '<a href="register.php">会員登録</a></br><a href="login_form.php">ログイン</a>';

  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type='text/javascript' src='js/jquery-3.6.0.min.js'></script>
    <script type='text/javascript' src='js/submitbtn.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
  <?php include("navbar.php"); ?>
    <div>

   <?php if(isset($_SESSION['email']) && isset($_SESSION['sex']) ): ?>

    <form method="post" action="index.php">

    <h1>登録情報</h1>
    <p>名前：<?php echo $name?></p>
    <p>現在の顔面偏差値レベル：<?php echo $face?></p>
    <p>顔面偏差値の妥当性：<?php echo $day?>日</p>
    <p>※妥当性は顔写真画像の最終更新日からの日数を表示</p>
    <img src="<?php echo $file ?><?php echo $image?>" width="300" height="300">
    <p>年齢：<?php echo $age?>歳</p>
    <p>年収：<?php echo $salary?>万円</p>
    <p>身長：<?php echo $hight?>cm</p>
    <p>体重：<?php echo $weight?>kg</p>

       <input type ="submit" name="submit_5" value="あなたのマッチング相手を診断">
    </form>

    <?php else:?> 

      <p>ログインしてません</p>

    <?php endif; ?>
      
   <hr>
   <a href="<?echo $goback?>">戻る</a><br>

   <?php echo $link; ?>
    </div>

    <?php include("footer.php"); ?>

  </body>

</html>