<?php
//セッション変数使用
session_start();
//★DB接続
//PDOクラスのオブジェクトを作成
$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';
//値の受取確認用(後で消します)
var_dump($_SESSION);

//★データ追加(関数化)
function insertData($pdo) {
    //prepareメソッドでSQL文を作成
    $sql = 'INSERT INTO users (last_name, first_name, email, pref_id, created_at) 
                   VALUES(:last_name, :first_name, :email, :pref_id, :created_at)';
    $stmt = $pdo->prepare($sql);
    //変数名にパラメータバインド
    switch (true) { 
        case !empty($_SESSION['family_name']): 
            $stmt->bindValue(':last_name',  $_SESSION['family_name'], PDO::PARAM_STR);
        case !empty($_SESSION['given_name']): 
            $stmt->bindValue(':first_name', $_SESSION['given_name'],  PDO::PARAM_STR);
        case !empty($_SESSION['email']): 
            $stmt->bindValue(':email',      $_SESSION['email'],       PDO::PARAM_STR);
        case !empty($_SESSION['pref_id']):
            $stmt->bindValue(':pref_id',    $_SESSION['pref_id'],     PDO::PARAM_INT);
            break; 
    }
    $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
    //excecuteメソッドでSQL文をDBに発行
    $stmt->execute();
}

try {
    //接続成功した時にオブジェクト作成
    $dbh = new PDO($dsn, $user, $password);
    insertData($dbh);
} catch (PDOException $e) {
    //接続＼失敗！／した時の例外処理:エラー文言を表示
    print('Connection failed:'.$e->getMessage());
    var_dump(method_exists('PDO', 'dsn'));
    die(); 
} 
//★DBとの接続を切る
$dbh = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ご応募ありがとうございました</title>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <header>
    <h1>フォーム>完了</h1>
  </header>

  <section>
    <p>応募しました</p>
    <a href="index.php">TOPページへ</a>
  </section>

  <footer>
    <p>Copyright 2014</p>
  </footer>
</body>
</html>

