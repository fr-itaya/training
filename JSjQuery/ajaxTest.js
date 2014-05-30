//プチプラグイン化:JSONファイル読込&表形式HTML作成
$.fn.loadTable = function() {
  $.getJSON("ajaxTest.json", getLanguage);
}
//表作成
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

//表示とボタンによる繰り返し処理
$(function() {
  $(this).loadTable();
  $(function() {
    $(':button').click(function() {
      $(this).loadTable()
    });
  });
});
