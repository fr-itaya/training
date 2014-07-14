<?php
require_once('db_connect.php');
require_once('db_fetch_pref.php');
require_once('pref.php');
//require_once('page_nav.php');

$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';
$db_instance = Database::getInstance($dsn, $user, $password);
$pdo = $db_instance->getPdo();

//ページリンク表示用
$rowsParPage = 10;
//ページ番号の最大表示数
$max_pagelink = 2;
//ユーザ情報をDBから1頁分取得
function fetchUsers($pdo, $current_page, $rowsParPage) {
    $offset = $rowsParPage * ($current_page - 1);
    $stmt = $pdo->query("SELECT * FROM users LIMIT " . $offset . "," . $rowsParPage . ";");
    return $stmt;
}

//前へ・次へボタン表示用にデータ総数と総ページ数を取得
$total_users = $pdo->query('SELECT COUNT( * ) FROM users;')->fetch(PDO::FETCH_COLUMN);
$total_pages = ceil($total_users / $rowsParPage);

//現在のページをGETで取得
if (!empty($_GET['page'])) {
    if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])) {
        $current_page = ($_GET['page'] > $total_pages) ? 1 : (int)$_GET['page'];
    } else {
        $current_page = 1;
    }
} else {
    $current_page = 1;
}

//DBから都道府県リストを取得
$pref_array = fetchPref($pdo);
//create pref instance
$pref = new Prefecture($pref_array);

//取得したユーザ情報を1行ずつ配列に格納
$user_list = array();
$stmt = fetchUsers($pdo, $current_page, $rowsParPage); 
while ($user_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //都道府県IDを都道府県名に変換
    $pref->setPrefId($user_row['pref_id']);
    $user_row['pref_id'] = $pref->getPrefById();
    $user_list[] = $user_row;
}

$pdo = null;

//html
include_once('list.html.php');
?>
