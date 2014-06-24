<?php
require_once('db_connect.php');
require_once('db_fetch_users.php');
require_once('db_fetch_pref.php');
require_once('pref.php');
//DBから取得したユーザ情報を表形式で表示
//まず1ページに全件表示
//今回tdの数は固定ではないから、取ってきたDBの値をtdタグで挟んで連結させる処理を最後のデータまでループさせる
$users = fetchUsers($pdo);

//都道府県表示をIDから名前に
$pref_array = fetchPref($pdo);
//create pref instance
$pref = new Prefecture($pref_array);
//都道府県表示メソッド
$pref_view = array(); 
//$pref_view[] = $pref->getPrefById();
//ここでメソッドgetPrefByIdは汎用性無く使いにくい
//現在の仕様だと登録の過程で都道府県1つ選んで表示するのには楽だが
//セッション変数使えない状態で1画面に複数表示するには…
//(一覧画面はTOPページからリンクを張っているのでセッション消えている)
//というわけで、後で当該メソッドに引数指定しようと思います
$pdo = null;

include_once('list.html.php');
?>
