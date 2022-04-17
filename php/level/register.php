<?php
require_once('util2.php');
require_once('err.config.php');

//ホスト名取得
$h = $_SERVER['HTTP_HOST'];
 
// リファラ値があれば、かつ外部サイトかどうか
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
  $goback = $_SERVER['HTTP_REFERER'] ;
}else{
  $goback = 'mypage.php';
}


?>


<!DOCTYPE html>
<html lang='ja'>
<head>
      <meta charset='UTF-8'>
      <title>マイページ登録！</title>
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

  <a href="login_form.php">登録済の方はこちら</a><br><br>

  <p>こちらは新規登録ページです</p>
  <form action="signup_exe.php" method="post" enctype="multipart/form-data">
  <label>メールアドレス：<input type="text" name="signup_email" required></label><br>
  <label>パスワード：<input type="password" name="signup_password" required></label><br>
  <label>パスワード再入力：<input type="password" name="signup_password2" required></label><br>
  <label>ニックネーム：<input type="text" name="signup_name" required></label><br>
  <labal>年齢：<input type="number" name="signup_age" required>歳</label><br>
  <label>年収：<input type="number" name="signup_salary" required> 万円</label><br>
  <label>身長：<input type="number" name="signup_hight" required> cm</label><br>
  <label>体重：<input type="number" name="signup_weight" required> kg</label><br>
  <label>性別：<br>
  <select name="sex" id="sex">
    <option selected value="">性別を選択してください</option>
    <option value='woman'>女性</option>
    <option value='man'>男性</option>
  </select>
</label><br>

  <p>顔写真のアップロード</p>
  <input type="file" name="image"><br>

  <img id='mypic' class='faceimages' src='image/start.jpeg' height='200'>
  <p><span class='badge badge-warning'>顔面偏差値を選択</span></p>
  <div>
  <p>0<input type='range' name='face' step=1 class='form-control-range' id='range' min='0' max='100' value='50'>100</p></div>

  <script>

 var faceimage = ['image/nface_image/face_image/0.jpeg','image/nface_image/face_image/1.jpeg','image/nface_image/face_image/2.jpeg','image/nface_image/face_image/3.jpeg','image/nface_image/face_image/4.jpeg','image/nface_image/face_image/5.jpeg','image/nface_image/face_image/6.jpeg','image/nface_image/face_image/7.jpeg','image/nface_image/face_image/8.jpeg','image/nface_image/face_image/9.jpeg','image/nface_image/face_image/10.jpeg','image/nface_image/face_image/11.jpeg','image/nface_image/face_image/12.jpeg','image/nface_image/face_image/13.jpeg','image/nface_image/face_image/14.jpeg','image/nface_image/face_image/15.jpeg','image/nface_image/face_image/16.jpeg','image/nface_image/face_image/17.jpeg','image/nface_image/face_image/18.jpeg','image/nface_image/face_image/19.jpeg','image/nface_image/face_image/20.jpeg','image/nface_image/face_image/21.jpeg','image/nface_image/face_image/22.jpeg','image/nface_image/face_image/23.jpeg','image/nface_image/face_image/24.jpeg','image/nface_image/face_image/25.jpeg','image/nface_image/face_image/26.jpeg','image/nface_image/face_image/27.jpeg','image/nface_image/face_image/28.jpeg','image/nface_image/face_image/29.jpeg','image/nface_image/face_image/30.jpeg','image/nface_image/face_image/31.jpeg','image/nface_image/face_image/32.jpeg','image/nface_image/face_image/33.jpeg','image/nface_image/face_image/34.jpeg','image/nface_image/face_image/35.jpeg','image/nface_image/face_image/36.jpeg','image/nface_image/face_image/37.jpeg','image/nface_image/face_image/38.jpeg','image/nface_image/face_image/39.jpeg','image/nface_image/face_image/40.jpeg','image/nface_image/face_image/41.jpeg','image/nface_image/face_image/42.jpeg','image/nface_image/face_image/43.jpeg','image/nface_image/face_image/44.jpeg','image/nface_image/face_image/45.jpeg','image/nface_image/face_image/46.jpeg','image/nface_image/face_image/47.jpeg','image/nface_image/face_image/48.jpeg','image/nface_image/face_image/49.jpeg','image/nface_image/face_image/50.jpeg','image/nface_image/face_image/51.jpeg','image/nface_image/face_image/52.jpeg','image/nface_image/face_image/53.jpeg','image/nface_image/face_image/54.jpeg','image/nface_image/face_image/55.jpeg','image/nface_image/face_image/56.jpeg','image/nface_image/face_image/57.jpeg','image/nface_image/face_image/58.jpeg','image/nface_image/face_image/59.jpeg','image/nface_image/face_image/60.jpeg','image/nface_image/face_image/61.jpeg','image/nface_image/face_image/62.jpeg','image/nface_image/face_image/63.jpeg','image/nface_image/face_image/64.jpeg','image/nface_image/face_image/65.jpeg','image/nface_image/face_image/66.jpeg','image/nface_image/face_image/67.jpeg','image/nface_image/face_image/68.jpeg','image/nface_image/face_image/69.jpeg','image/nface_image/face_image/70.jpeg','image/nface_image/face_image/71.jpeg','image/nface_image/face_image/72.jpeg','image/nface_image/face_image/73.jpeg','image/nface_image/face_image/74.jpeg','image/nface_image/face_image/75.jpeg','image/nface_image/face_image/76.jpeg','image/nface_image/face_image/77.jpeg','image/nface_image/face_image/78.jpeg','image/nface_image/face_image/79.jpeg','image/nface_image/face_image/80.jpeg','image/nface_image/face_image/81.jpeg','image/nface_image/face_image/82.jpeg','image/nface_image/face_image/83.jpeg','image/nface_image/face_image/84.jpeg','image/nface_image/face_image/85.jpeg','image/nface_image/face_image/86.jpeg','image/nface_image/face_image/87.jpeg','image/nface_image/face_image/88.jpeg','image/nface_image/face_image/89.jpeg','image/nface_image/face_image/90.jpeg','image/nface_image/face_image/91.jpeg','image/nface_image/face_image/92.jpeg','image/nface_image/face_image/93.jpeg','image/nface_image/face_image/94.jpeg','image/nface_image/face_image/95.jpeg','image/nface_image/face_image/96.jpeg','image/nface_image/face_image/97.jpeg','image/nface_image/face_image/98.jpeg','image/nface_image/face_image/99.jpeg','image/nface_image/face_image/100.jpeg'];


document.getElementById('sex').onchange = function() {

var sex = document.getElementById('sex');

switch(sex.value) {
case 'woman' :
  faceimage.splice('',101,'image/nface_image/face_image/0.jpeg','image/nface_image/face_image/1.jpeg','image/nface_image/face_image/2.jpeg','image/nface_image/face_image/3.jpeg','image/nface_image/face_image/4.jpeg','image/nface_image/face_image/5.jpeg','image/nface_image/face_image/6.jpeg','image/nface_image/face_image/7.jpeg','image/nface_image/face_image/8.jpeg','image/nface_image/face_image/9.jpeg','image/nface_image/face_image/10.jpeg','image/nface_image/face_image/11.jpeg','image/nface_image/face_image/12.jpeg','image/nface_image/face_image/13.jpeg','image/nface_image/face_image/14.jpeg','image/nface_image/face_image/15.jpeg','image/nface_image/face_image/16.jpeg','image/nface_image/face_image/17.jpeg','image/nface_image/face_image/18.jpeg','image/nface_image/face_image/19.jpeg','image/nface_image/face_image/20.jpeg','image/nface_image/face_image/21.jpeg','image/nface_image/face_image/22.jpeg','image/nface_image/face_image/23.jpeg','image/nface_image/face_image/24.jpeg','image/nface_image/face_image/25.jpeg','image/nface_image/face_image/26.jpeg','image/nface_image/face_image/27.jpeg','image/nface_image/face_image/28.jpeg','image/nface_image/face_image/29.jpeg','image/nface_image/face_image/30.jpeg','image/nface_image/face_image/31.jpeg','image/nface_image/face_image/32.jpeg','image/nface_image/face_image/33.jpeg','image/nface_image/face_image/34.jpeg','image/nface_image/face_image/35.jpeg','image/nface_image/face_image/36.jpeg','image/nface_image/face_image/37.jpeg','image/nface_image/face_image/38.jpeg','image/nface_image/face_image/39.jpeg','image/nface_image/face_image/40.jpeg','image/nface_image/face_image/41.jpeg','image/nface_image/face_image/42.jpeg','image/nface_image/face_image/43.jpeg','image/nface_image/face_image/44.jpeg','image/nface_image/face_image/45.jpeg','image/nface_image/face_image/46.jpeg','image/nface_image/face_image/47.jpeg','image/nface_image/face_image/48.jpeg','image/nface_image/face_image/49.jpeg','image/nface_image/face_image/50.jpeg','image/nface_image/face_image/51.jpeg','image/nface_image/face_image/52.jpeg','image/nface_image/face_image/53.jpeg','image/nface_image/face_image/54.jpeg','image/nface_image/face_image/55.jpeg','image/nface_image/face_image/56.jpeg','image/nface_image/face_image/57.jpeg','image/nface_image/face_image/58.jpeg','image/nface_image/face_image/59.jpeg','image/nface_image/face_image/60.jpeg','image/nface_image/face_image/61.jpeg','image/nface_image/face_image/62.jpeg','image/nface_image/face_image/63.jpeg','image/nface_image/face_image/64.jpeg','image/nface_image/face_image/65.jpeg','image/nface_image/face_image/66.jpeg','image/nface_image/face_image/67.jpeg','image/nface_image/face_image/68.jpeg','image/nface_image/face_image/69.jpeg','image/nface_image/face_image/70.jpeg','image/nface_image/face_image/71.jpeg','image/nface_image/face_image/72.jpeg','image/nface_image/face_image/73.jpeg','image/nface_image/face_image/74.jpeg','image/nface_image/face_image/75.jpeg','image/nface_image/face_image/76.jpeg','image/nface_image/face_image/77.jpeg','image/nface_image/face_image/78.jpeg','image/nface_image/face_image/79.jpeg','image/nface_image/face_image/80.jpeg','image/nface_image/face_image/81.jpeg','image/nface_image/face_image/82.jpeg','image/nface_image/face_image/83.jpeg','image/nface_image/face_image/84.jpeg','image/nface_image/face_image/85.jpeg','image/nface_image/face_image/86.jpeg','image/nface_image/face_image/87.jpeg','image/nface_image/face_image/88.jpeg','image/nface_image/face_image/89.jpeg','image/nface_image/face_image/90.jpeg','image/nface_image/face_image/91.jpeg','image/nface_image/face_image/92.jpeg','image/nface_image/face_image/93.jpeg','image/nface_image/face_image/94.jpeg','image/nface_image/face_image/95.jpeg','image/nface_image/face_image/96.jpeg','image/nface_image/face_image/97.jpeg','image/nface_image/face_image/98.jpeg','image/nface_image/face_image/99.jpeg','image/nface_image/face_image/100.jpeg');
  break;

case 'man' :
  faceimage.splice('',101,'image/nface_image/mface_image/0.jpeg','image/nface_image/mface_image/1.jpeg','image/nface_image/mface_image/2.jpeg','image/nface_image/mface_image/3.jpeg','image/nface_image/mface_image/4.jpeg','image/nface_image/mface_image/5.jpeg','image/nface_image/mface_image/6.jpeg','image/nface_image/mface_image/7.jpeg','image/nface_image/mface_image/8.jpeg','image/nface_image/mface_image/9.jpeg','image/nface_image/mface_image/10.jpeg','image/nface_image/mface_image/11.jpeg','image/nface_image/mface_image/12.jpeg','image/nface_image/mface_image/13.jpeg','image/nface_image/mface_image/14.jpeg','image/nface_image/mface_image/15.jpeg','image/nface_image/mface_image/16.jpeg','image/nface_image/mface_image/17.jpeg','image/nface_image/mface_image/18.jpeg','image/nface_image/mface_image/19.jpeg','image/nface_image/mface_image/20.jpeg','image/nface_image/mface_image/21.jpeg','image/nface_image/mface_image/22.jpeg','image/nface_image/mface_image/23.jpeg','image/nface_image/mface_image/24.jpeg','image/nface_image/mface_image/25.jpeg','image/nface_image/mface_image/26.jpeg','image/nface_image/mface_image/27.jpeg','image/nface_image/mface_image/28.jpeg','image/nface_image/mface_image/29.jpeg','image/nface_image/mface_image/30.jpeg','image/nface_image/mface_image/31.jpeg','image/nface_image/mface_image/32.jpeg','image/nface_image/mface_image/33.jpeg','image/nface_image/mface_image/34.jpeg','image/nface_image/mface_image/35.jpeg','image/nface_image/mface_image/36.jpeg','image/nface_image/mface_image/37.jpeg','image/nface_image/mface_image/38.jpeg','image/nface_image/mface_image/39.jpeg','image/nface_image/mface_image/40.jpeg','image/nface_image/mface_image/41.jpeg','image/nface_image/mface_image/42.jpeg','image/nface_image/mface_image/43.jpeg','image/nface_image/mface_image/44.jpeg','image/nface_image/mface_image/45.jpeg','image/nface_image/mface_image/46.jpeg','image/nface_image/mface_image/47.jpeg','image/nface_image/mface_image/48.jpeg','image/nface_image/mface_image/49.jpeg','image/nface_image/mface_image/50.jpeg','image/nface_image/mface_image/51.jpeg','image/nface_image/mface_image/52.jpeg','image/nface_image/mface_image/53.jpeg','image/nface_image/mface_image/54.jpeg','image/nface_image/mface_image/55.jpeg','image/nface_image/mface_image/56.jpeg','image/nface_image/mface_image/57.jpeg','image/nface_image/mface_image/58.jpeg','image/nface_image/mface_image/59.jpeg','image/nface_image/mface_image/60.jpeg','image/nface_image/mface_image/61.jpeg','image/nface_image/mface_image/62.jpeg','image/nface_image/mface_image/63.jpeg','image/nface_image/mface_image/64.jpeg','image/nface_image/mface_image/65.jpeg','image/nface_image/mface_image/66.jpeg','image/nface_image/mface_image/67.jpeg','image/nface_image/mface_image/68.jpeg','image/nface_image/mface_image/69.jpeg','image/nface_image/mface_image/70.jpeg','image/nface_image/mface_image/71.jpeg','image/nface_image/mface_image/72.jpeg','image/nface_image/mface_image/73.jpeg','image/nface_image/mface_image/74.jpeg','image/nface_image/mface_image/75.jpeg','image/nface_image/mface_image/76.jpeg','image/nface_image/mface_image/77.jpeg','image/nface_image/mface_image/78.jpeg','image/nface_image/mface_image/79.jpeg','image/nface_image/mface_image/80.jpeg','image/nface_image/mface_image/81.jpeg','image/nface_image/mface_image/82.jpeg','image/nface_image/mface_image/83.jpeg','image/nface_image/mface_image/84.jpeg','image/nface_image/mface_image/85.jpeg','image/nface_image/mface_image/86.jpeg','image/nface_image/mface_image/87.jpeg','image/nface_image/mface_image/88.jpeg','image/nface_image/mface_image/89.jpeg','image/nface_image/mface_image/90.jpeg','image/nface_image/mface_image/91.jpeg','image/nface_image/mface_image/92.jpeg','image/nface_image/mface_image/93.jpeg','image/nface_image/mface_image/94.jpeg','image/nface_image/mface_image/95.jpeg','image/nface_image/mface_image/96.jpeg','image/nface_image/mface_image/97.jpeg','image/nface_image/mface_image/98.jpeg','image/nface_image/mface_image/99.jpeg','image/nface_image/mface_image/100.jpeg');
  break;

}

var hoge = document.getElementById('range');

switch(sex.value){
case 'woman':
  document.getElementById('mypic').src=faceimage[hoge.value];
  break;
case 'man':
  document.getElementById('mypic').src=faceimage[hoge.value];
break;
}

}

window.onload = function () {

var hoge = document.getElementById('range');
// 選択した際のイベント取得
hoge.addEventListener('change', (e) => {
  document.getElementById('mypic').src=faceimage[hoge.value];
});
}


</script>



  <div><input type="submit" name="upload" value="登録する"></div>
  <form>

  <hr>

  <a href="<?echo $goback?>">戻る</a><br>

  <?php include("footer.php"); ?>

  </body>
</html>