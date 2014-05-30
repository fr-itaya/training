$(function() {
  $.getJSON("ajaxTest.json", getLanguage);
});

function getLanguage(data) {
  $(data.languages).each(function() {
    var createTable = '<tr>'    +
                      '<th>'    + this.id   + '</th>' +
                      '<td>'    + this.name + '</td>' +
                      '<td>'    + this.kana + '</td>' +
                      '</tr>';
    $("table").append(createTable);
  });
};
/*
$(function() {
  $(':button').click(
    getLanguage());
});
*/
