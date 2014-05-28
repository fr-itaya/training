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

//submitされた時に入力値チェック
$(function() {
  $('form').submit(
    function() {
      var str = ':text[name="val"]';
      if ($(str).val() === '') {
        alert('入力してください');
      } else if ($(str).val().match(/^[0-9]+$/)) {
        alert('数字です');
      } else {
        alert('数字以外です');
      }
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
