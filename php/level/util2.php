<?php

function es(array|string $data, string $charset='UTF-8'):mixed{
  if(is_array($data)){
    return array_map(__METHOD__, $data);
  }else{
    return htmlspecialchars(string:$data, flags:ENT_QUOTES, encoding:$charset);
  }
}

//配列文字のエンコード
function cken(array $data): bool{
  $result = true;
  foreach ($data as $key => $value){
    //含まれている値が配列であれば連結する
    if (is_array($value)){
      $value = implode("",$value);
    }
    if (!mb_check_encoding($value)){
      //文字エンコードが一致しなかった時
      $result = false;
      //foreachでの走査をブレイク
      break;
    }
  }
  return $result;
}

?>