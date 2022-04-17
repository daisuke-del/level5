<?php
require_once('util2.php');
require_once( dirname( __FILE__ ) . '/dns.php' );
require_once('err.config.php');

$isError = false;
$error_message = array();

session_start();

$page = 1;

if(isset($_POST['submit_1_1'])){

    #sexがチェックされているか確認
    if( empty($_POST['sex']) ) {
  
      $_SESSION['error'] = array ('性別を選択してください');
      $error_message = $_SESSION['error'] ;
  
      $page = 10 ; #エラーページへ
  
    }else{
      //POST送信内容をSESSION配列に格納
    $_SESSION['choice_sex'] = $_POST['sex']; 
    $sex = $_SESSION['choice_sex'];
  
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  
  #ランダムにレコード取得
    if($sex =='man'){

      $maxnu = "SELECT COUNT( * ) FROM bbs " ;
      try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm0 = $pdo->prepare($maxnu);

        $stm0->execute();
        $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
        $maxnum = current($maxnum);
        $maxnum = $maxnum - 1 ;
        if($maxnum < 2){
          $maxnum = 2 ;
        }
      
  
      }catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
      }

      $choiceimage = array();

      while($choiceimage === array()){
        $randnum = mt_rand(2,$maxnum);
        $randnum = $randnum - 1 ;

        $sql1 = "SELECT face_image FROM (select * from bbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;


        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm1 = $pdo->prepare($sql1);
        $stm1->execute();

        while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
        $choiceimage[]= $result;
        }

      }


      $leftface0 = current($choiceimage[0]);
      $rightface0 = current($choiceimage[1]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "face_image/" . $rightface0 ;
      $_SESSION['leftface'] = "face_image/" . $leftface0 ;

        

  
    }elseif($sex =='woman'){

      $maxnu = "SELECT COUNT( * ) FROM mbbs"; ;

      try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm0 = $pdo->prepare($maxnu);

        $stm0->execute();
        $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
        $maxnum = current($maxnum);
        $maxnum = $maxnum - 1 ;
        if($maxnum < 2){
          $maxnum = 2 ;
        }
        
      
  
      }catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
      }

      $choiceimage = array();
      while($choiceimage == array()){
        $randnum = mt_rand(2,$maxnum);
        $randnum = $randnum - 1 ;

        $sql1 = "SELECT mface_image FROM (select * from mbbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;


        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm1 = $pdo->prepare($sql1);
        $stm1->execute();

        while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
        $choiceimage[]= $result;
        }

    }

      $rightface0 = current($choiceimage[1]);
      $leftface0 = current($choiceimage[0]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "mface_image/" . $rightface0 ;
      $_SESSION['leftface'] = "mface_image/" . $leftface0 ;

  
    }


    $page = 1.1; //1.1ページ目に遷移
  
   }
  

}elseif(isset($_POST['submit_1_2'])){

  $sex = $_SESSION['choice_sex'];

  if($sex == "man"){
    $bbs = "bbs" ;
    $facesimage = "face_image";
  }elseif($sex =="woman"){
    $bbs = "mbbs" ;
    $facesimage = "mface_image";
  }

   $leftface0 = $_SESSION['leftface0'];
   $rightface0 = $_SESSION['rightface0'];


  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $choicedface_1_2 = $_POST['submit_1_2'];
  if($choicedface_1_2 == "left"){

    $sql_1_2 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$leftface0'";

    $stm_1_2 = $pdo->prepare($sql_1_2);
    $stm_1_2->execute();
    

    $sql_1_2_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$rightface0'";

    $stm_1_2_1 = $pdo->prepare($sql_1_2_1);
    $stm_1_2_1->execute();

  }elseif($choicedface_1_2 == "right"){

    $sql_1_2 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$rightface0'";

    $stm_1_2 = $pdo->prepare($sql_1_2);
    $stm_1_2->execute();
    
    $sql_1_2_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$leftface0'";

    $stm_1_2_1 = $pdo->prepare($sql_1_2_1);
    $stm_1_2_1->execute();
  }

#ランダムにレコード取得
  if($sex =='man'){

    $maxnu = "SELECT COUNT( * ) FROM bbs" ;

    try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $stm0 = $pdo->prepare($maxnu);

      $stm0->execute();
      $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
      $maxnum = current($maxnum);
      $maxnum = $maxnum - 1 ;
      if($maxnum < 2){
        $maxnum = 2 ;
      }
    

    }catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }

    $choiceimage = array();
    while($choiceimage === array()){
      
      $randnum = mt_rand(2,$maxnum);
      $randnum = $randnum - 1 ;

      $sql1 = "SELECT face_image FROM (select * from bbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;
    
      $stm1 = $pdo->prepare($sql1);
    
      $stm1->execute();
      while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
      $choiceimage[]= $result;
      }

    }

      $rightface0 = current($choiceimage[1]);
      $leftface0 = current($choiceimage[0]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "face_image/" . $rightface0 ;
      $_SESSION['leftface'] = "face_image/" . $leftface0 ;


  }elseif($sex =='woman'){

    $maxnu = "SELECT COUNT( * ) FROM mbbs" ;

    try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $stm0 = $pdo->prepare($maxnu);

      $stm0->execute();
      $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
      $maxnum = current($maxnum);
      $maxnum = $maxnum - 1 ;
      if($maxnum < 2){
        $maxnum = 2 ;
      }
    

    }catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }

    //配列の初期化
    $choiceimage = array();
    while($choiceimage === array()){

      //ランダムな整数を取得
      $randnum = mt_rand(2,$maxnum);
      $randnum = $randnum - 1 ;

      //ランダムな整数をもとに検索
      $sql1 = "SELECT mface_image FROM (select * from mbbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;

      $stm1 = $pdo->prepare($sql1);
      $stm1->execute();
      while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
        $choiceimage[]= $result;
      }

   }

      $rightface0 = current($choiceimage[1]);
      $leftface0 = current($choiceimage[0]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "mface_image/" . $rightface0 ;
      $_SESSION['leftface'] = "mface_image/" . $leftface0 ;

  }


  $page = 1.2; //1.2ページ目に遷移



}elseif(isset($_POST['submit_1_3'])){

  $sex = $_SESSION['choice_sex'];

  //性別チェック
  if($sex == "man"){
    $bbs = "bbs" ;
    $facesimage = "face_image";
  }elseif($sex =="woman"){
    $bbs = "mbbs" ;
    $facesimage = "mface_image";
  }

   $leftface0 = $_SESSION['leftface0'];
   $rightface0 = $_SESSION['rightface0'];


  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $choicedface_1_3 = $_POST['submit_1_3'];

  //左の画像が選ばれた場合
  if($choicedface_1_3 == "left"){

    //左の顔面偏差値をプラス1
    $sql_1_3 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$leftface0'";

    $stm_1_3 = $pdo->prepare($sql_1_3);
    $stm_1_3->execute();
    
    //右の顔面偏差値をマイナス1
    $sql_1_3_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$rightface0'";

    $stm_1_3_1 = $pdo->prepare($sql_1_3_1);
    $stm_1_3_1->execute();

    //右の画像が選ばれた場合
  }elseif($choicedface_1_3 == "right"){

    //右の顔面偏差値をプラス1
    $sql_1_3 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$rightface0'";

      $stm_1_3 = $pdo->prepare($sql_1_3);
      $stm_1_3->execute();
    
      //左の顔面偏差値をマイナス1
    $sql_1_3_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$leftface0'";

    $stm_1_3_1 = $pdo->prepare($sql_1_3_1);
      $stm_1_3_1->execute();
  }

#ランダムにレコード取得
  if($sex =='man'){

    $maxnu = "SELECT COUNT( * ) FROM bbs" ;

    try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $stm0 = $pdo->prepare($maxnu);

      $stm0->execute();
      $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
      $maxnum = current($maxnum);
      $maxnum = $maxnum - 1 ;
      if($maxnum < 2){
        $maxnum = 2 ;
      }
    

    }catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }


    $choiceimage = array();
    while($choiceimage === array()){

      $randnum = mt_rand(2,$maxnum);
      $randnum = $randnum - 1 ;

      $sql1 = "SELECT face_image FROM (select * from bbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;

      $stm1 = $pdo->prepare($sql1);
    
      $stm1->execute();
      while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
      $choiceimage[]= $result;
      }
    
    }


      $rightface0 = current($choiceimage[1]);
      $leftface0 = current($choiceimage[0]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "face_image/" . $rightface0 ;
      $_SESSION['leftface'] = "face_image/" . $leftface0 ;


  }elseif($sex =='woman'){

    $maxnu = "SELECT COUNT( * ) FROM mbbs" ;

    try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $stm0 = $pdo->prepare($maxnu);

      $stm0->execute();
      $maxnum = $stm0->fetch(PDO::FETCH_ASSOC);
      $maxnum = current($maxnum);
      $maxnum = $maxnum - 1 ;
      if($maxnum < 2){
        $maxnum = 2 ;
      }
    

    }catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }

    $choiceimage = array();
    while($choiceimage === array()){

      $randnum = mt_rand(2,$maxnum);
      $randnum = $randnum - 1 ;


      $sql1 = "SELECT mface_image FROM (select * from mbbs order by face desc) as a LIMIT 2 OFFSET $randnum " ;

      $stm1 = $pdo->prepare($sql1);
      $stm1->execute();

      while($result = $stm1->fetch(PDO::FETCH_ASSOC)){
      $choiceimage[]= $result;
      }

    }

      $rightface0 = current($choiceimage[1]);
      $leftface0 = current($choiceimage[0]);

      $_SESSION['rightface0'] = $rightface0;
      $_SESSION['leftface0'] = $leftface0;

      $_SESSION['rightface'] = "mface_image/" . $rightface0 ;
      $_SESSION['leftface'] = "mface_image/" . $leftface0 ;

  }


  $page = 1.3; //1.3ページ目に遷移


}elseif(isset($_POST['submit_2'])){

  $sex = $_SESSION['choice_sex'];

  if($sex == "man"){
    $bbs = "bbs" ;
    $facesimage = "face_image";
  }elseif($sex =="woman"){
    $bbs = "mbbs" ;
    $facesimage = "mface_image";
  }

  $leftface0 = $_SESSION['leftface0'];
  $rightface0 = $_SESSION['rightface0'];

  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $choicedface_1_4 = $_POST['submit_2'];
  if($choicedface_1_4 == "left"){

    $sql_1_4 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$leftface0'";

    $stm_1_4 = $pdo->prepare($sql_1_4);
    $stm_1_4->execute();
    

    $sql_1_4_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$rightface0'";

    $stm_1_4_1 = $pdo->prepare($sql_1_4_1);
    $stm_1_4_1->execute();

  }elseif($choicedface_1_4 == "right"){

    $sql_1_4 = "UPDATE $bbs SET face = face +1 WHERE $facesimage = '$rightface0'";

      $stm_1_4 = $pdo->prepare($sql_1_4);
      $stm_1_4->execute();
    
    $sql_1_4_1 = "UPDATE $bbs SET face = face -1 WHERE $facesimage = '$leftface0'";

    $stm_1_4_1 = $pdo->prepare($sql_1_4_1);
      $stm_1_4_1->execute();
  }

  if($sex ==='woman'){
    $faceimage = ['image/nface_image/face_image/0.jpeg','image/nface_image/face_image/1.jpeg','image/nface_image/face_image/2.jpeg','image/nface_image/face_image/3.jpeg','image/nface_image/face_image/4.jpeg','image/nface_image/face_image/5.jpeg','image/nface_image/face_image/6.jpeg','image/nface_image/face_image/7.jpeg','image/nface_image/face_image/8.jpeg','image/nface_image/face_image/9.jpeg','image/nface_image/face_image/10.jpeg','image/nface_image/face_image/11.jpeg','image/nface_image/face_image/12.jpeg','image/nface_image/face_image/13.jpeg','image/nface_image/face_image/14.jpeg','image/nface_image/face_image/15.jpeg','image/nface_image/face_image/16.jpeg','image/nface_image/face_image/17.jpeg','image/nface_image/face_image/18.jpeg','image/nface_image/face_image/19.jpeg','image/nface_image/face_image/20.jpeg','image/nface_image/face_image/21.jpeg','image/nface_image/face_image/22.jpeg','image/nface_image/face_image/23.jpeg','image/nface_image/face_image/24.jpeg','image/nface_image/face_image/25.jpeg','image/nface_image/face_image/26.jpeg','image/nface_image/face_image/27.jpeg','image/nface_image/face_image/28.jpeg','image/nface_image/face_image/29.jpeg','image/nface_image/face_image/30.jpeg','image/nface_image/face_image/31.jpeg','image/nface_image/face_image/32.jpeg','image/nface_image/face_image/33.jpeg','image/nface_image/face_image/34.jpeg','image/nface_image/face_image/35.jpeg','image/nface_image/face_image/36.jpeg','image/nface_image/face_image/37.jpeg','image/nface_image/face_image/38.jpeg','image/nface_image/face_image/39.jpeg','image/nface_image/face_image/40.jpeg','image/nface_image/face_image/41.jpeg','image/nface_image/face_image/42.jpeg','image/nface_image/face_image/43.jpeg','image/nface_image/face_image/44.jpeg','image/nface_image/face_image/45.jpeg','image/nface_image/face_image/46.jpeg','image/nface_image/face_image/47.jpeg','image/nface_image/face_image/48.jpeg','image/nface_image/face_image/49.jpeg','image/nface_image/face_image/50.jpeg','image/nface_image/face_image/51.jpeg','image/nface_image/face_image/52.jpeg','image/nface_image/face_image/53.jpeg','image/nface_image/face_image/54.jpeg','image/nface_image/face_image/55.jpeg','image/nface_image/face_image/56.jpeg','image/nface_image/face_image/57.jpeg','image/nface_image/face_image/58.jpeg','image/nface_image/face_image/59.jpeg','image/nface_image/face_image/60.jpeg','image/nface_image/face_image/61.jpeg','image/nface_image/face_image/62.jpeg','image/nface_image/face_image/63.jpeg','image/nface_image/face_image/64.jpeg','image/nface_image/face_image/65.jpeg','image/nface_image/face_image/66.jpeg','image/nface_image/face_image/67.jpeg','image/nface_image/face_image/68.jpeg','image/nface_image/face_image/69.jpeg','image/nface_image/face_image/70.jpeg','image/nface_image/face_image/71.jpeg','image/nface_image/face_image/72.jpeg','image/nface_image/face_image/73.jpeg','image/nface_image/face_image/74.jpeg','image/nface_image/face_image/75.jpeg','image/nface_image/face_image/76.jpeg','image/nface_image/face_image/77.jpeg','image/nface_image/face_image/78.jpeg','image/nface_image/face_image/79.jpeg','image/nface_image/face_image/80.jpeg','image/nface_image/face_image/81.jpeg','image/nface_image/face_image/82.jpeg','image/nface_image/face_image/83.jpeg','image/nface_image/face_image/84.jpeg','image/nface_image/face_image/85.jpeg','image/nface_image/face_image/86.jpeg','image/nface_image/face_image/87.jpeg','image/nface_image/face_image/88.jpeg','image/nface_image/face_image/89.jpeg','image/nface_image/face_image/90.jpeg','image/nface_image/face_image/91.jpeg','image/nface_image/face_image/92.jpeg','image/nface_image/face_image/93.jpeg','image/nface_image/face_image/94.jpeg','image/nface_image/face_image/95.jpeg','image/nface_image/face_image/96.jpeg','image/nface_image/face_image/97.jpeg','image/nface_image/face_image/98.jpeg','image/nface_image/face_image/99.jpeg','image/nface_image/face_image/100.jpeg'];
  } elseif($sex ==='man'){
    $faceimage = ['image/nface_image/mface_image/0.jpeg','image/nface_image/mface_image/1.jpeg','image/nface_image/mface_image/2.jpeg','image/nface_image/mface_image/3.jpeg','image/nface_image/mface_image/4.jpeg','image/nface_image/mface_image/5.jpeg','image/nface_image/mface_image/6.jpeg','image/nface_image/mface_image/7.jpeg','image/nface_image/mface_image/8.jpeg','image/nface_image/mface_image/9.jpeg','image/nface_image/mface_image/10.jpeg','image/nface_image/mface_image/11.jpeg','image/nface_image/mface_image/12.jpeg','image/nface_image/mface_image/13.jpeg','image/nface_image/mface_image/14.jpeg','image/nface_image/mface_image/15.jpeg','image/nface_image/mface_image/16.jpeg','image/nface_image/mface_image/17.jpeg','image/nface_image/mface_image/18.jpeg','image/nface_image/mface_image/19.jpeg','image/nface_image/mface_image/20.jpeg','image/nface_image/mface_image/21.jpeg','image/nface_image/mface_image/22.jpeg','image/nface_image/mface_image/23.jpeg','image/nface_image/mface_image/24.jpeg','image/nface_image/mface_image/25.jpeg','image/nface_image/mface_image/26.jpeg','image/nface_image/mface_image/27.jpeg','image/nface_image/mface_image/28.jpeg','image/nface_image/mface_image/29.jpeg','image/nface_image/mface_image/30.jpeg','image/nface_image/mface_image/31.jpeg','image/nface_image/mface_image/32.jpeg','image/nface_image/mface_image/33.jpeg','image/nface_image/mface_image/34.jpeg','image/nface_image/mface_image/35.jpeg','image/nface_image/mface_image/36.jpeg','image/nface_image/mface_image/37.jpeg','image/nface_image/mface_image/38.jpeg','image/nface_image/mface_image/39.jpeg','image/nface_image/mface_image/40.jpeg','image/nface_image/mface_image/41.jpeg','image/nface_image/mface_image/42.jpeg','image/nface_image/mface_image/43.jpeg','image/nface_image/mface_image/44.jpeg','image/nface_image/mface_image/45.jpeg','image/nface_image/mface_image/46.jpeg','image/nface_image/mface_image/47.jpeg','image/nface_image/mface_image/48.jpeg','image/nface_image/mface_image/49.jpeg','image/nface_image/mface_image/50.jpeg','image/nface_image/mface_image/51.jpeg','image/nface_image/mface_image/52.jpeg','image/nface_image/mface_image/53.jpeg','image/nface_image/mface_image/54.jpeg','image/nface_image/mface_image/55.jpeg','image/nface_image/mface_image/56.jpeg','image/nface_image/mface_image/57.jpeg','image/nface_image/mface_image/58.jpeg','image/nface_image/mface_image/59.jpeg','image/nface_image/mface_image/60.jpeg','image/nface_image/mface_image/61.jpeg','image/nface_image/mface_image/62.jpeg','image/nface_image/mface_image/63.jpeg','image/nface_image/mface_image/64.jpeg','image/nface_image/mface_image/65.jpeg','image/nface_image/mface_image/66.jpeg','image/nface_image/mface_image/67.jpeg','image/nface_image/mface_image/68.jpeg','image/nface_image/mface_image/69.jpeg','image/nface_image/mface_image/70.jpeg','image/nface_image/mface_image/71.jpeg','image/nface_image/mface_image/72.jpeg','image/nface_image/mface_image/73.jpeg','image/nface_image/mface_image/74.jpeg','image/nface_image/mface_image/75.jpeg','image/nface_image/mface_image/76.jpeg','image/nface_image/mface_image/77.jpeg','image/nface_image/mface_image/78.jpeg','image/nface_image/mface_image/79.jpeg','image/nface_image/mface_image/80.jpeg','image/nface_image/mface_image/81.jpeg','image/nface_image/mface_image/82.jpeg','image/nface_image/mface_image/83.jpeg','image/nface_image/mface_image/84.jpeg','image/nface_image/mface_image/85.jpeg','image/nface_image/mface_image/86.jpeg','image/nface_image/mface_image/87.jpeg','image/nface_image/mface_image/88.jpeg','image/nface_image/mface_image/89.jpeg','image/nface_image/mface_image/90.jpeg','image/nface_image/mface_image/91.jpeg','image/nface_image/mface_image/92.jpeg','image/nface_image/mface_image/93.jpeg','image/nface_image/mface_image/94.jpeg','image/nface_image/mface_image/95.jpeg','image/nface_image/mface_image/96.jpeg','image/nface_image/mface_image/97.jpeg','image/nface_image/mface_image/98.jpeg','image/nface_image/mface_image/99.jpeg','image/nface_image/mface_image/100.jpeg'];
  }

  $json_array = json_encode($faceimage);

  $page = 2; //2ページ目に遷移


}elseif(isset($_POST['submit_3'])){
 
    $_SESSION['face2'] = $_POST['face']; 
    
    $page = 3; //3ページ目に遷移

}elseif(isset($_POST['submit_4'])){

   #age,salaryが入力されているか確認
    if( empty($_POST['age']) || empty($_POST['salary']) ) {

      $error_message = array("");

      if( empty($_POST['age']) ){

        $error_message[] = '年齢を入力してください';
      }

      if( empty($_POST['salary']) ){

        $error_message[] = '年収を入力してください';
      }

      $_SESSION['error'] = $error_message ;
      $error_message = $_SESSION['error'] ;


      $page = 10 ; #エラーページへ

    }else{

    $_SESSION['age2'] = $_POST['age']; 
    $_SESSION['salary2'] = $_POST['salary']; 

    $page = 4; //4ページ目に遷移

    }

}elseif(isset($_POST['submit_5'])){

  if( empty($_SESSION['hight']) || empty($_SESSION['weight'])){

  #hight,weightyが入力されているか確認
  if( empty($_POST['hight']) || empty($_POST['weight'])) {

    $error_message = array("");

    if( empty($_POST['hight']) ){

      $error_message[] = '身長を入力してください';
    }

    if( empty($_POST['weight']) ){

      $error_message[] = '体重を入力してください';
    }

    $_SESSION['error'] = $error_message ;
    $error_message = $_SESSION['error'] ;


    $page = 10 ; #エラーページへ

  }else{

    $_SESSION['hight2'] = $_POST['hight']; 
    $_SESSION['weight2'] = $_POST['weight'];

  }

  }

  $page = 5; //5ページ目に遷移



}elseif(isset($_POST['workplace'])){

  //SESSION送りしたデータを変数に代入
  $sex = $_SESSION['choice_sex'];
  $face = $_SESSION['face2'];
  $age = $_SESSION['age2'];
  $salary = $_SESSION['salary2'];
  $hight = $_SESSION['hight2'];
  $weight = $_SESSION['weight2'];


  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";


  if($sex =='man'){

    $imagelink = 'face_image';
    
    $salary2 = $salary / 10 -30 ;
    if ( $salary2 > 100 ){
      $salary2 = 100 ;
    }

    $face2 = 1.5 * $face;
    $age2 = abs($age -27) ;
    $hight2 = $hight - 150 ;
    $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;

    
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (3.5 * $face2 + 3 * $salary2 - 1.5 * $age2 + 2 * $hight2 - $weight2) > (4 * T1.face2 + 2 * T1.salary2 - T1.age2  + T1.hight2 - T1.weight2) ORDER BY (4 * T1.face2 + 2 * T1.salary2 - T1.age2  + T1.hight2 - T1.weight2) DESC LIMIT 10";
    
    $stm= $pdo->prepare($sql);
    $stm->execute();


  }elseif($sex =='woman'){

    $imagelink = 'mface_image';

    $salary2 = $salary / 10 -30 ;
    if ( $salary2 > 100 ){
      $salary2 = 100 ;
    }

    $face2 = 1.5 * $face;
    $age2 = $age -23 ;
    $hight2 = 30 ;
    $weight2 = ($weight / ($hight*$hight/10000)-20)*2;

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (4 * $face2 + 2* $salary2 - $age2 + $hight2 - $weight2) > (3.5 * T1.face2 + 3 * T1.salary2 - 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) ORDER BY (3.5 * T1.face2 + 3 * T1.salary2 - 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) DESC LIMIT 10";
    
    $stm = $pdo->prepare($sql);
    $stm->execute();


  }

  $page = 6; //6ページ目に遷移

  }elseif(isset($_POST['jointparty'])){

    //SESSION送りしたデータを変数に格納
    $sex = $_SESSION['choice_sex'];
    $face = $_SESSION['face2'];
    $age = $_SESSION['age2'];
    $salary = $_SESSION['salary2'];
    $hight = $_SESSION['hight2'];
    $weight = $_SESSION['weight2'];
  
  
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  
  
    if($sex =='man'){
  
      $imagelink = 'face_image';
      
      $salary2 = $salary / 10 -30 ;
      if ( $salary2 > 100 ){
        $salary2 = 100 ;
      }
  
      $face2 = 1.5 * $face;
      $age2 = abs($age -27) ;
      $hight2 = $hight - 150 ;
      $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;
  
  
      $sql = "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (6.5 * $face2 + 1.5 * $salary2 - 4 * $age2 + 3 * $hight2 - 2 * $weight2) > (7 * T1.face2 + 1 * T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 -  2 * T1.weight2) ORDER BY (7 * T1.face2 + 1 * T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 -  2 * T1.weight2) DESC LIMIT 10";
  
      
  
      try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm = $pdo->prepare($sql);
      
        $stm->execute();
  
      }catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
      }
  
  
    }elseif($sex =='woman'){
  
      $imagelink = 'mface_image';
  
      $salary2 = $salary / 10 -30 ;
      if ( $salary2 > 100 ){
        $salary2 = 100 ;
      }
  
      $face2 = 1.5 * $face;
      $age2 = $age -23 ;
      $hight2 = 30 ;
      $weight2 = ($weight / ($hight*$hight/10000)-20)*2;
  
      $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (4 * $face2 + 2* $salary2 - $age2 + $hight2 - $weight2) > (3.5 * T1.face2 + 3 * T1.salary2 + 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) ORDER BY (3.5 * T1.face2 + 3 * T1.salary2 + 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) DESC LIMIT 10";
  
      try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $stm= $pdo->prepare($sql);
      
        $stm->execute();
  
      }catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
      }
  
    }
  
    $page = 6; //6ページ目に遷移
  
    }elseif(isset($_POST['introduction'])){

      //SESSION送りしたデータを変数に格納
      $sex = $_SESSION['choice_sex'];
      $face = $_SESSION['face2'];
      $age = $_SESSION['age2'];
      $salary = $_SESSION['salary2'];
      $hight = $_SESSION['hight2'];
      $weight = $_SESSION['weight2'];
    
    
      $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
    
    
      if($sex =='man'){
    
        $imagelink = 'face_image';
        
        $salary2 = $salary / 10 -30 ;
        if ( $salary2 > 100 ){
          $salary2 = 100 ;
        }
    
        $face2 = 1.5 * $face;
        $age2 = abs($age -27) ;
        $hight2 = $hight - 150 ;
        $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;
    
    
        $sql = "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (3 * $face2 + 2 * $salary2 - 1.5 * $age2 + 2 * $hight2 - $weight2) > (3.5 * T1.face2 + 2 * T1.salary2 - T1.age2  + T1.hight2 - T1.weight2) ORDER BY (3.5 * T1.face2 + 2 * T1.salary2 - T1.age2  + T1.hight2 - T1.weight2) DESC LIMIT 10";
    
        
    
        try{
          $pdo = new PDO($dsn, $user, $password);
          $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
          $stm = $pdo->prepare($sql);
        
          $stm->execute();
    
        }catch (Exception $e){
          echo '<span class="error">エラーがありました。</span><br>';
          echo $e->getMessage();
        }
    
    
      }elseif($sex =='woman'){
    
        $imagelink = 'mface_image';
    
        $salary2 = $salary / 10 -30 ;
        if ( $salary2 > 100 ){
          $salary2 = 100 ;
        }
    
        $face2 = 1.5 * $face;
        $age2 = $age -23 ;
        $hight2 = 30 ;
        $weight2 = ($weight / ($hight*$hight/10000)-20)*2;
    
        $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (3.5 * $face2 + 2* $salary2 - $age2 + $hight2 - $weight2) > (3 * T1.face2 + 2 * T1.salary2 - 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) ORDER BY (3 * T1.face2 + 2 * T1.salary2 - 1.5 * T1.age2  + 2 * T1.hight2 - T1.weight2) DESC LIMIT 10";
    
        try{
          $pdo = new PDO($dsn, $user, $password);
          $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
          $stm = $pdo->prepare($sql);
        
          $stm->execute();
    
        }catch (Exception $e){
          echo '<span class="error">エラーがありました。</span><br>';
          echo $e->getMessage();
        }
    
      }
    
      $page = 6; //6ページ目に遷移
    
      }elseif(isset($_POST['tinder'])){

        //SESSION送りしたデータを変数に格納
        $sex = $_SESSION['choice_sex'];
        $face = $_SESSION['face2'];
        $age = $_SESSION['age2'];
        $salary = $_SESSION['salary2'];
        $hight = $_SESSION['hight2'];
        $weight = $_SESSION['weight2'];
      
      
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
      
      
        if($sex =='man'){
      
          $imagelink = 'face_image';
          
          $salary2 = $salary / 10 -30 ;
          if ( $salary2 > 100 ){
            $salary2 = 100 ;
          }
      
          $face2 = 1.5 * $face;
          $age2 = abs($age -27) ;
          $hight2 = $hight - 150 ;
          $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;
      
      
          $sql = "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (7 * $face2 + 1 * $salary2 - 2 * $age2 + 2 * $hight2 - 1 * $weight2) > (9 * T1.face2 + 1 * T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 -  2 * T1.weight2) ORDER BY (9 * T1.face2 + 1 * T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 -  2 * T1.weight2) DESC LIMIT 10";
      
          
      
          try{
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
            $stm = $pdo->prepare($sql);
          
            $stm->execute();
      
          }catch (Exception $e){
            echo '<span class="error">エラーがありました。</span><br>';
            echo $e->getMessage();
          }
      
      
        }elseif($sex =='woman'){
      
          $imagelink = 'mface_image';
      
          $salary2 = $salary / 10 -30 ;
          if ( $salary2 > 100 ){
            $salary2 = 100 ;
          }
      
          $face2 = 1.5 * $face;
          $age2 = $age -23 ;
          $hight2 = 30 ;
          $weight2 = ($weight / ($hight*$hight/10000)-20)*2;
      
          $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (9 * $face2 + $salary2 - 2 * $age2 + 2 * $hight2 - 2 * $weight2) > (7 * T1.face2 + T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 - T1.weight2) ORDER BY (7 * T1.face2 + T1.salary2 - 2 * T1.age2  + 2 * T1.hight2 - T1.weight2) DESC LIMIT 10";
      
          try{
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
            $stm = $pdo->prepare($sql);
          
            $stm->execute();
      
          }catch (Exception $e){
            echo '<span class="error">エラーがありました。</span><br>';
            echo $e->getMessage();
          }
      
        }
      
        $page = 6; //6ページ目に遷移
      
        }elseif(isset($_POST['pairs'])){

          //SESSION送りしたデータを変数に格納
          $sex = $_SESSION['choice_sex'];
          $face = $_SESSION['face2'];
          $age = $_SESSION['age2'];
          $salary = $_SESSION['salary2'];
          $hight = $_SESSION['hight2'];
          $weight = $_SESSION['weight2'];
        
        
          $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
        
        
          if($sex =='man'){
        
            $imagelink = 'face_image';
            
            $salary2 = $salary / 10 -30 ;
            if ( $salary2 > 100 ){
              $salary2 = 100 ;
            }
        
            $face2 = 1.5 * $face;
            $age2 = abs($age -27) ;
            $hight2 = $hight - 150 ;
            $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;
        
        
            $sql =  "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (6.5 * $face2 + 4 * $salary2 - 3 * $age2 + 3 * $hight2 - 1 * $weight2) > (8 * T1.face2 + 1 * T1.salary2 - 4 * T1.age2  + 2 * T1.hight2 -  4 * T1.weight2) ORDER BY (8 * T1.face2 + 1 * T1.salary2 - 4 * T1.age2  + 2 * T1.hight2 -  4 * T1.weight2) DESC LIMIT 10";
            
        
            try{
              $pdo = new PDO($dsn, $user, $password);
              $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
              $stm = $pdo->prepare($sql);
            
              $stm->execute();
        
            }catch (Exception $e){
              echo '<span class="error">エラーがありました。</span><br>';
              echo $e->getMessage();
            }
        
        
          }elseif($sex =='woman'){
        
            $imagelink = 'mface_image';
        
            $salary2 = $salary / 10 -30 ;
            if ( $salary2 > 100 ){
              $salary2 = 100 ;
            }
        
            $face2 = 1.5 * $face;
            $age2 = $age -23 ;
            $hight2 = 30 ;
            $weight2 = ($weight / ($hight*$hight/10000)-20)*2;
        
            $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (8 * $face2 + $salary2 - 4 * $age2 + 2 * $hight2 - 4 * $weight2) > (6.5 * T1.face2 + 4 * T1.salary2 - 3 * T1.age2  + 3 * T1.hight2 - T1.weight2) ORDER BY (6.5 * T1.face2 + 4 * T1.salary2 - 3 * T1.age2  + 3 * T1.hight2 - T1.weight2) DESC LIMIT 10";
        
            try{
              $pdo = new PDO($dsn, $user, $password);
              $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
              $stm = $pdo->prepare($sql);
            
              $stm->execute();
        
            }catch (Exception $e){
              echo '<span class="error">エラーがありました。</span><br>';
              echo $e->getMessage();
            }
        
          }
        
          $page = 6; //6ページ目に遷移
        
          }elseif(isset($_POST['club'])){

            //SESSION送りしたデータを変数に格納
            $sex = $_SESSION['choice_sex'];
            $face = $_SESSION['face2'];
            $age = $_SESSION['age2'];
            $salary = $_SESSION['salary2'];
            $hight = $_SESSION['hight2'];
            $weight = $_SESSION['weight2'];
          
          
            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
          
          
            if($sex =='man'){
          
              $imagelink = 'face_image';
              
              $salary2 = $salary / 10 -30 ;
              if ( $salary2 > 100 ){
                $salary2 = 100 ;
              }
          
              $face2 = 1.5 * $face;
              $age2 = abs($age -27) ;
              $hight2 = $hight - 150 ;
              $weight2 = abs($weight / ($hight*$hight/10000)-20)*2;
          
          
              $sql = "SELECT T1.name,T1.age,T1.face_image,T1.hight,T1.salary FROM bbs AS T1 WHERE (6 * $face2 + 2 * $salary2 - 2 * $age2 + 4 * $hight2 - 2 * $weight2) > (8 * T1.face2 - 2 * T1.age2  + T1.hight2 - T1.weight2) ORDER BY (8 * T1.face2 - 2 * T1.age2  + T1.hight2 - T1.weight2) DESC LIMIT 10";
          
              
          
              try{
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                $stm = $pdo->prepare($sql);
              
                $stm->execute();
          
              }catch (Exception $e){
                echo '<span class="error">エラーがありました。</span><br>';
                echo $e->getMessage();
              }
          
          
            }elseif($sex =='woman'){
          
              $imagelink = 'mface_image';
          
              $salary2 = $salary / 10 -30 ;
              if ( $salary2 > 100 ){
                $salary2 = 100 ;
              }
          
              $face2 = 1.5 * $face;
              $age2 = $age -23 ;
              $hight2 = 30 ;
              $weight2 = ($weight / ($hight*$hight/10000)-20)*2;
          
              $sql = "SELECT T1.name,T1.age,T1.mface_image,T1.hight,T1.salary FROM mbbs AS T1 WHERE (8 * $face2 - 2 * $age2 + $hight2 - $weight2) > (6 * T1.face2 + 2 * T1.salary2 - 2 * T1.age2  + 4 * T1.hight2 - 2 * T1.weight2) ORDER BY (6 * T1.face2 + 2 * T1.salary2 - 2 * T1.age2  + 4 * T1.hight2 - 2 * T1.weight2) DESC LIMIT 10";
          
              try{
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                $stm = $pdo->prepare($sql);
              
                $stm->execute();
          
              }catch (Exception $e){
                echo '<span class="error">エラーがありました。</span><br>';
                echo $e->getMessage();
              }


          
            }

            $sqlall = "SELECT * FROM mbbs";
              try{
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                $stmall = $pdo->prepare($sqlall);
                $stmall->execute();
                while($resultall = $stmall->fetch(PDO::FETCH_ASSOC)){
                  $resultall[] = $resultall;
                }
          
              }catch (Exception $e){
                echo '<span class="error">エラーがありました。</span><br>';
                echo $e->getMessage();
              }
          
            $page = 6; //6ページ目に遷移

          
            }



  include_once 'form.php';

  ?>