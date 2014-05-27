//#49 hover event
$(function() {
//$('header').css('font-size', '30px');
  $('#msg').append('<p class="sample">サンプル2です。</p>');
//$('footer').text('Copyright 2013');
$(function() {
  $('.sample').hover(
    function() {
      $(this).css('background-color', '#ffa500'); 
    },
    function() {
      $(this).css('background-color', '');
    });
  });
});


//#49 クリックイベント
/*
$(function() {
  $('#msg').click(function() {
    $(this).text('テストです。')
  });
});
*/
