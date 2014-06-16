<?php
//DB接続
$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';
//接続成功した場合PDOインスタンス生成
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    //接続失敗した時の例外処理:エラー文言を表示
    print('Connection failed:'.$e->getMessage());
    var_dump(method_exists('PDO', 'dsn'));
    die();
}
?>
