<?php
require_once('db_connect.php');
require_once('db_fetch_pref.php');
require_once('pref.php');
require_once('page_nav.php');

$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';
$db_instance = Database::getInstance($dsn, $user, $password);
$pdo = $db_instance->getPdo();

//ユーザ情報をDBから全取得
function fetchUsers($pdo) {
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt;
}
//DBから都道府県リストを取得
$pref_array = fetchPref($pdo);
//create pref instance
$pref = new Prefecture($pref_array);

//取得したユーザ情報を1行ずつ配列に格納
$user_list = array();
$stmt = fetchUsers($pdo); 
while ($user_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //都道府県IDを都道府県名に変換
    $pref->setPrefId($user_row['pref_id']);
    $user_row['pref_id'] = $pref->getPrefById();
    $user_list[] = $user_row;
}
/*
print '<pre>';
var_dump($user_list);
print '</pre>';
 */     
$pdo = null;

//html
include_once('list.html.php');
?>
