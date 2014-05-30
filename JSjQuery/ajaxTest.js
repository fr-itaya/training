//プチプラグイン化:JSONファイル読込&表形式HTML作成
$.fn.loadTable = function() {
  $.getJSON("ajaxTest.json", getLanguage);
}
//表作成
function getLanguage(data) {
  var createRow, createTable;
  $(data.languages).each(function() {
    createRow    ='<tr>'    +
                      '<th>'    + this.id   + '</th>' +
                      '<td>'    + this.name + '</td>' +
                      '<td>'    + this.kana + '</td>' +
                      '</tr>';
    createTable  += createRow;
  });
  $("table").append(createTable);
};

//表示とボタンによる繰り返し処理
$(function() {
  $(this).loadTable();
  $(':button').click(function() {
    $(this).loadTable()
  });
});
