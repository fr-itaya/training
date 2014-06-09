<?php
//★DB接続
//PDOクラスのオブジェクトを作成
$dsn = 'mysql:dbname=mysql_test;host=localhost';
$user = 'root';
$password = '';
//接続成功した時にオブジェクト作成
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
//接続＼失敗！／した時の例外処理:エラー文言を表示
    print('Connection failed:'.$e -> getMessage());
    die(); 
} 
//★データ追加
//prepareメソッドでSQL文を作成
//(この辺でSQLエスケープ処理？)
//excecuteメソッドでSQL文をDBに発行
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

