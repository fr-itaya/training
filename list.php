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

//html
include_once('list.html.php');

$pdo = null;
?>
