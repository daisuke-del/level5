<?php
require_once('util2.php');
require_once('err.config.php');


//文字エンコードの検証
if (!cken($_POST)){
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is " . $encoding;
  //エラーメッセージの表示とコードのキャンセル
  exit($err);
}
//HTMLエスケープ
$_POST = es($_POST);

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
      <title>自分を知ろう！</title>
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
    <form method="post" action="index.php">

    <?php if($page == 1){ ?>
      <p>あなたの性別を選択してください</p>

      <input type="radio" name="sex" value="man" id="man"><label for="man"></label>
      <input type="radio" name="sex" value="woman" id="woman"><label for="woman"></label><br>
      <button type="submit" name="submit_1_1">次のページへ</button>

    <?php }elseif($page == 1.1){ ?>
      <h1>どっちが好み？</h1>

      <div class="choice_submits">
      <input type="submit" name="submit_1_2" id="leftface" value="left"><label for="leftface"></label>
      <p> or </p>
      <input type="submit" name="submit_1_2" id="rightface" value="right"><label for="rightface"></label>
      </div>

    </form>

    <?php }elseif($page == 1.2){ ?>
      <h1>どっちが好み？</h1>

      <div class="choice_submits">

      <input type="submit" name="submit_1_3" id="leftface"><label for="leftface"></label>
      <p> or </p>
      <input type="submit" name="submit_1_3" id="rightface"><label for="rightface"></label>

      </div>

    <?php }elseif($page == 1.3){ ?>
      <h1>どっちが好み？</h1>

      <div class="choice_submits">

      <input type="submit" name="submit_2" id="leftface"><label for="leftface"></label>
      <p> or </p>
      <input type="submit" name="submit_2" id="rightface"><label for="rightface"></label>

    </div>
      

    <?php }elseif($page == 2){ ?>

      <img id='mypic' class='faceimages' src='' height='200'>
      <p><span class='badge badge-warning'>顔面偏差値を選択</span></p>
      <p>0<input type='range' name='face' step=1 class='form-control-range' id='range' min='0' max='100' value='50'>100</p><br>
      <button type="submit" name="submit_3">次のページへ</button>

      <script>

        let faceimage = <?php echo $json_array; ?>


        var hoge = document.getElementById('range');
        document.getElementById('mypic').src=faceimage[50];

        window.onload = function () {

        var hoge = document.getElementById('range');
        // 選択した際のイベント取得
        hoge.addEventListener('change', (e) => {
          document.getElementById('mypic').src=faceimage[hoge.value];
        });
        }

      </script>

    <?php }elseif($page == 3){ ?>

          <label>年齢：
            <select name='age' required>

              <option value="">-</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
              <option value="32">32</option>
              <option value="33">33</option>
              <option value="34">34</option>
              <option value="35">35</option>
              <option value="36">36</option>
              <option value="37">37</option>
              <option value="38">38</option>
              <option value="39">39</option>
              <option value="40">40</option>
              <option value="41">41</option>
              <option value="42">42</option>
              <option value="43">43</option>
              <option value="44">44</option>
              <option value="45">45</option>
              <option value="46">46</option>
              <option value="47">47</option>
              <option value="48">48</option>
              <option value="49">49</option>
              <option value="50">50</option>
              <option value="51">51</option>
              <option value="52">52</option>
              <option value="53">53</option>
              <option value="54">54</option>
              <option value="55">55</option>
              <option value="56">56</option>
              <option value="57">57</option>
              <option value="58">58</option>
              <option value="59">59</option>
              <option value="60">60</option>
              <option value="61">61</option>
              <option value="62">62</option>
              <option value="63">63</option>
              <option value="64">64</option>
              <option value="65">65</option>
              <option value="66">66</option>
              <option value="67">67</option>
              <option value="68">68</option>
              <option value="69">69</option>
              <option value="70">70</option>
              <option value="71">71</option>
              <option value="72">72</option>
              <option value="73">73</option>
              <option value="74">74</option>
              <option value="75">75</option>
              <option value="76">76</option>
              <option value="77">77</option>
              <option value="78">78</option>
              <option value="79">79</option>
              <option value="80">80</option>
              <option value="81">81</option>
              <option value="82">82</option>
              <option value="83">83</option>
              <option value="84">84</option>
              <option value="85">85</option>
              <option value="86">86</option>
              <option value="87">87</option>
              <option value="88">88</option>
              <option value="89">89</option>
              <option value="90">90</option>
              <option value="91">91</option>
              <option value="92">92</option>
              <option value="93">93</option>
              <option value="94">94</option>
              <option value="95">95</option>
              <option value="96">96</option>
              <option value="97">97</option>
              <option value="98">98</option>
              <option value="99">99</option>

            </select>
          </label><br>

          <label>年収：
            <input type='number' name='salary' placeholder='年収を入力' required> 万円
          </label><br>
          <button type="submit" name="submit_4">次のページへ</button>

    <?php }elseif($page == 4){ ?>

          <label>身長：<input type='number' name='hight' placeholder='身長を入力' required> cm
          </label><br>

          <label>体重：<input type='number' name='weight' placeholder='体重を入力' required> kg
          </label><br>

          <button type="submit" name="submit_5">次のページへ</button>

    <?php }elseif($page == 5){ ?>

      <p>出会う方法を選ぶ</p>

      <div class="submits">

      <input type="submit" name="workplace" id="workplace"><label for="workplace"></label>
      <input type="submit" name="jointparty" id="jointparty"><label for="jointparty"></label>
      <input type='submit' name='introduction' id='introduction'><label for="introduction"></label>
      <input type='submit' name='tinder' id='tinder'><label for="tinder"></label>
      <input type='submit' name='pairs' id='pairs'><label for="pairs"></label>
      <input type='submit' name='club' id='club'><label for="club"></label>
    
     </div>




     <?php }elseif($page == 6){ ?>

    <div>
    <?php if( !empty($error_message) ): ?>

      <ul class="error_message">
        <?php foreach( $error_message as $value ): ?>
          <li><?php echo $value; ?></li><br>
        <?php endforeach; ?>
      </ul>

    <?php else:?>

      <h1>マッチング結果</h1>

      <?php foreach ($stm as $row): ?>
        <p><?php echo $row[0]?>(<?php echo $row[1]?>歳)</p>
        <a class="thumbnail" href='<?php echo "image/${imagelink}"?>/<?php echo $row[2] ?>' target="_blank"><image src='<?php echo "image/${imagelink}"?>/<?php echo $row[2]?>'></a>
        <p><?php echo $row[3]?>cm</p>
        <p>年収<?php echo $row[4]?>万円</p><br>
      <?php endforeach ?>

    <?php endif; ?>

        <input type="submit" value="戻る" ><br>
        <a href="mypage.php">マイページへ</a>

    </div>


    <?php }elseif($page == 10){ ?>

      <?php foreach ($error_message as $error): ?>
        <p><?php echo $error?></p>
      <?php endforeach ?>

    </div>

    <?php } ?>

    </form>

    <hr>

    <a href="<?echo $goback?>">診断をやめる</a><br>

    <?php include("footer.php"); ?>
    
  </body>
</html>