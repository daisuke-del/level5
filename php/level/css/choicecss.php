<?php
  header('Content-Type: text/css; charset=utf-8');
  require_once( dirname( __FILE__ ) . '/../index.php' );

  $rightface = $_SESSION['rightface'];
  $leftface = $_SESSION['leftface'];

?>

input[type=submit]+label:before{
  content: "";
  display: inline-block;
  background-size: contain;
  width: 140px;
  height: 140px;
}

input[type=submit][id="rightface"]+label:before{
  background-image: url(../image/<?php echo $rightface?>);
}

input[type=submit][id="leftface"]+label:before{
  background-image: url(../image/<?php echo $leftface?>);
}
