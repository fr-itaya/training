<?php
require_once('db_connect.php');
require_once('db_fetch_pref.php');
require_once('pref.php');

//ユーザ情報をDBから全取得
function fetchUsers($pdo) {
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt;
}

$pref_array = fetchPref($pdo);
//create pref instance
$pref = new Prefecture($pref_array);
$user_list = array();
$stmt = fetchUsers($pdo); 
while ($user_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
