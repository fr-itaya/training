//#47 課題3
/*
(function(msg) {
  var msg;
  alert(msg);
})("Hello, World!");
*/
//#48 DOM操作
/*
$(function() {
  $('header').css('font-size', '30px');
  $('#msg').append('<p class="sample">サンプル2です。</p>');
  $('footer').text('Copyright 2013');
});
*/

//#49 クリックイベント
$(function() {
  $('#msg').click(function() {
    $(this).text('テストです。')
  });
});
