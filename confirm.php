<?php
//DB接続(外部化)
require_once('db_connect.php');
//DBより都道府県リスト取得
require_once('db_fetch_pref.php');
require_once('pref.php');

//create DB instance
//$db = new Database('mysql:dbname=mysql_test; host=localhost; charset=utf8;', 'root', '');
$pdo = Database::getPdo();
//セッション管理
session_start();

//DBより都道府県リスト取得
$pref_array = fetchPref($pdo);

//空白処理用にPOSTデータを配列に格納
$formData = array();
//空白処理
foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        //配列である場合
        foreach ($value as $key_array => $value_array) {
            $formData[$key][$key_array] = trim(mb_convert_kana($value[$key_array], 's', 'utf-8'));
        }
    } else {
        //変数である場合
        $formData[$key] = trim(mb_convert_kana($value, 's', 'utf-8'));
    }
}

//copy formData to var.
$family_name     = $formData['family_name'];
$given_name      = $formData['given_name'];
$sex             = $formData['sex'];
$postalcode      = $formData['postalcode'];
$postalcode_view = implode('-', $postalcode);
$prefecture      = $formData['prefecture'];
$email           = $formData['email'];
$comment         = $formData['comment'];
$hobby           = $formData['hobby'];

//create pref instance
//初回でバリデーションエラー出さなかった時はPOSTの値を使ってインスタンス生成
$pref = new Prefecture($pref_array, (isset($_POST['prefecture']) ? $_POST['prefecture'] : 0));
$prefecture_view = $pref->getPrefById();

//varidate formData
$errormsg = array();

if (empty($family_name)) {
    $errormsg[] = '姓を入力してください。';
} elseif (preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $family_name)) {
    $errormsg[] = '姓は全角で入力してください。';
} elseif (mb_strlen($family_name, 'utf-8') > 50) {
    $errormsg[] = '姓は50文字以内で入力してください。';
}

if (empty($given_name)) {
    $errormsg[] = '名を入力してください。';
} elseif (preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $given_name)) {
    $errormsg[] = '名は全角で入力してください。';
} elseif (mb_strlen($given_name, 'utf-8') > 50) {
    $errormsg[] = '姓は50文字以内で入力してください。';
}

if (empty($sex)) {
    $errormsg[] = '性別を選択してください。';
}

if (empty($postalcode['zone']) || empty($postalcode['district'])) {
    $errormsg[] = '郵便番号を入力してください。';
} elseif (!preg_match_all('/^[0-9]{3}-[0-9]{4}$/', $postalcode_view)) {
    $errormsg[] = '郵便番号を正しく入力してください。';
}
if (empty($prefecture)) {
    $errormsg[] = '都道府県を選択してください。';
}

if (empty($email)) {
    $errormsg[] = 'メールアドレスを入力してください。';
} elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    $errormsg[] =  'メールアドレスを正しく入力してください。<br />';
}

if (!empty($hobby[3]) && empty($hobby[4])) {
    $errormsg[] = 'その他の詳細を入力してください。<br />';
} elseif (empty($hobby[3]) && !empty($hobby[4])) {
    $formData['hobby'][3] = 'その他：';
}

#関数でサニタイジング(出力直前に使用)
function outputForHtml($param){
    if (empty($param)) return false;
    print htmlspecialchars($param, ENT_QUOTES);
}

#入力データをセッション変数に格納
$_SESSION['family_name'] = $formData['family_name'];
$_SESSION['given_name']  = $formData['given_name'];
$_SESSION['sex']         = $formData['sex'];
$_SESSION['postalcode']  = $formData['postalcode'];
$_SESSION['prefecture']  = $formData['prefecture'];
$_SESSION['email']       = $formData['email'];
$_SESSION['hobby']       = $formData['hobby'];
$_SESSION['comment']     = $formData['comment'];

#エラーメッセージがあった場合フォーム画面に戻す
if (!empty($errormsg)) {
    $_SESSION['errormsg'] = $errormsg;
    header("Location:{$_SERVER['HTTP_REFERER']}");
} else {
    if (empty($hobby[3]) && empty($hobby[4])) {
        $hobby_view = implode(' ', array_slice($hobby, 0, 3));
    } else {
        $hobby_view = implode(' ', array_slice($hobby, 0, 3)).'('.$hobby[4].')';
    }
    unset($_SESSION['errormsg']);
}

//DB切断
$pdo = null;

//HTML読込
include_once('confirm.html.php');
?>
