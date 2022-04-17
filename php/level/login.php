<?php
require_once( dirname( __FILE__ ) . '/util2.php' );
//DB接続情報
require_once( dirname( __FILE__ ) . '/dns.php' );
require_once('err.config.php');

if(!isset($_SESSION)){
  session_start();
}


//空欄チェックとデータ型チェック
if (!isset($_POST["sex"])||($_POST["sex"]==="")){
  $errors[] = "パスワードを記入してください";
}else{
  $_SESSION['sex'] = $_POST['sex'];
}
if (!isset($_POST["email"])||($_POST["email"]==="")){
  $errors[] = "メールアドレスを記入してください";
}else{
  $email = $_POST['email'];
}

//エラーチェック
if( empty($errors)){

//DB接続
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

if($_SESSION['sex'] == 'man'){

  try{
    $sql = "SELECT * FROM mbbs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $member = $stmt->fetch();
    if($member == false){

      $msg = 'メールアドレスもしくはパスワードが間違っています。';
      $link = '<a href="login_form.php">戻る</a>';

    }else{
    //指定したハッシュがパスワードにマッチしているかチェック
    if (password_verify($_POST['password'], $member['password'])) {
        //DBのユーザー情報をセッションに保存
        $_SESSION['email'] = $member['email'];
        $_SESSION['name'] = $member['name'];
        $_SESSION['age'] = $member['age'];
        $_SESSION['salary'] = $member['salary'];
        $_SESSION['hight'] = $member['hight'];
        $_SESSION['weight'] = $member['weight'];
        $msg = 'ログインしました。';
        header("Location:mypage.php");
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="login_form.php">戻る</a>';
    }

  }

      
  
  }catch (Exception $e){
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }
  
}elseif($_SESSION['sex'] == 'woman'){

  try{

  $sql = "SELECT * FROM bbs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $member = $stmt->fetch();
    if($member == false){

      $msg = 'メールアドレスもしくはパスワードが間違っています。';
      $link = '<a href="login_form.php">戻る</a>';

    }else{
    //指定したハッシュがパスワードにマッチしているかチェック
    if (password_verify($_POST['password'], $member['password'])) {
        //DBのユーザー情報をセッションに保存
        $_SESSION['email'] = $member['email'];
        $_SESSION['name'] = $member['name'];
        $_SESSION['age'] = $member['age'];
        $_SESSION['salary'] = $member['salary'];
        $_SESSION['hight'] = $member['hight'];
        $_SESSION['weight'] = $member['weight'];
        header("Location:mypage.php");
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="login_form.php">戻る</a>';
    }

    }

  }catch (Exception $e){
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
  }

}else{
  $errors[] = "性別を選択してください";
}

}else{

$msg = 'ログインできませんでした';
$link = '<a href="login_form.php">戻る</a>';

}

?>
<a><?php echo $msg; ?></a><br>
<?php echo $link; ?>