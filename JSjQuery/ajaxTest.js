$(function() {
/*
  $.ajax({
    url:'ajaxTest.json',
    dataType:'json',
    success: function(){
*/
  $.getJSON("ajaxTest.json", getLanguage);
});

function getLanguage(data) {
  $(data.languages).each(function() {
    $("#result").append(
          '<table>' +
          '<tr>'    +
          '<th>'    + this.id   + '</th>' +
          '<td>'    + this.name + '</td>' +
          '<td>'    + this.kana + '</td>' +
          '</tr>'   +
          '</table>'
    );
  });
};
/*
$(function() {
  $(':button').click(
    getLanguage());
});
*/
