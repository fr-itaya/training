<?php
//セッション管理
session_start();

//DB接続
require_once('db_connect.php');

$errormsg = array();
if (!empty($_SESSION['errormsg'])) {
    $errormsg = $_SESSION['errormsg'];
}

//入力値にエラーがある場合はエラー文言を表示
if (!empty($errormsg)) {
    $count_errormsg = count($errormsg);
    for ($i = 0; $i < $count_errormsg; $i++) {
        print "$errormsg[$i]<br />\n";
    }
}

//住所欄の都道府県セレクトボックスを生成(外部化)
include_once('pref.php');
//create pref instance
$pref = new Prefecture();
$pref->getSelectBoxTag();

//ラジオボタン入力値保持
$sex_checked = array();
if (isset($_SESSION['sex']) && ($_SESSION['sex'] == '男性')) {
    $sex_checked[0] = 'checked';
} elseif (isset($_SESSION['sex']) && ($_SESSION['sex'] == '女性')) {
    $sex_checked[1] = 'checked';
}

//チェックボックス入力値保持
$hobby_checked = array();
if (isset($_SESSION['hobby'])) {
    foreach (array_slice($_SESSION['hobby'], 0, 3, TRUE) as $key => $value) {
        if ($_SESSION['hobby'][$key] != NULL) {
            $hobby_checked[$key] = 'checked';
        } else {
            $hobby_checked[$key] = '';
        }
    }
}

//DB切断
$pdo = null;

//HTML読込
include_once('form.html.php');
?>
