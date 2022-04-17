$(function(){
  $("nav").hide();
  $(".menu-icon").click(function(){//メニューボタンをクリックしたとき
      $("nav").toggle(200);//0.2秒で表示したり非表示にしたりする
  });
});