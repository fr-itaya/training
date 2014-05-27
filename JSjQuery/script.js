//#47 課題3
/*
(function(msg) {
  var msg;
  alert(msg);
})("Hello, World!");
*/

$(function() {
  $('h1').css('font-size', '30px');
  $('#msg').append('<p class="sample">サンプル2です。</p>');
  $('footer').text('Copyright 2013');
});
