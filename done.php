<?php
//★DB接続(外部化)
include_once('db_connect.php');

//セッション変数使用
session_start();
//DBインスタンス作成・接続メソッド
//db = new Database('mysql:dbname=mysql_test; host=localhost; charset=utf8;', 'root', '');
$pdo = Database::getPdo();
//LIKE文ワイルドカードエスケープ(関数化)
function escape_wildcard($s) {
    return mb_ereg_replace('([_%#])', '#\1', $s);
}
//★データ追加(関数化)
function insertData($pdo, $input) {
    //prepareメソッドでSQL文を作成
    $sql = 'INSERT INTO users (last_name, first_name, email, pref_id, created_at) 
                   VALUES(:last_name, :first_name, :email, :pref_id, :created_at)';
    $stmt = $pdo->prepare($sql);
    //変数名にパラメータバインド
    switch (true) { 
        case !empty($input['family_name']): 
            $stmt->bindValue(':last_name',  $input['family_name'], PDO::PARAM_STR);
            escape_wildcard($input['family_name']);
        case !empty($input['given_name']): 
            $stmt->bindValue(':first_name', $input['given_name'],  PDO::PARAM_STR);
            escape_wildcard($input['given_name']);
        case !empty($input['email']): 
            $stmt->bindValue(':email',      $input['email'],       PDO::PARAM_STR);
            escape_wildcard($input['email']);
        case !empty($input['pref_id']):
            $stmt->bindValue(':pref_id',    $input['prefecture'],     PDO::PARAM_INT);
            escape_wildcard($input['prefecture']);
            break; 
    }
    $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
    //excecuteメソッドでSQL文をDBに発行
    $stmt->execute();
}

//データ追加関数呼び出し
insertData($pdo, $_SESSION);

//★DBとの接続を切る
$pdo = null;

//HTML読込
include_once('done.html.php');
?>
