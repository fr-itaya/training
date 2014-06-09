<?php
//★DB接続
//PDOクラスのオブジェクトを作成
$dsn = 'mysql:dbname=mysql_test; host=localhost';
$user = 'root';
$password = '';
//接続成功した時にオブジェクト作成
try {
    $dbh = new PDO($dsn, $user, $password);
//オブジェクト生成確認
    if ($dbh == null) {
        print('＼失敗！／<br />');
    } else {
        print('成功！<br />');
    }
//★データ追加
//prepareメソッドでSQL文を作成
    $sql = 'INSERT INTO users (last_name, first_name, email, pref_id, created_at) VALUES(:last_name, :first_name, :email, :pref_id, :created_at)';
    $stmt = $dbh -> prepare($sql);
//変数名にパラメータバインド
    $stmt -> bindValue(':last_name',  $_POST['family_name'], PDO::PARAM_STR);
    $stmt -> bindValue(':first_name', $_POST['given_name'],  PDO::PARAM_STR);
    $stmt -> bindValue(':email',      $_POST['email'],       PDO::PARAM_STR);
    $stmt -> bindValue(':pref_id',    $_POST['pref_id'],     PDO::PARAM_INT);
    $stmt -> bindValue(':created_at', date('Y-m-d H:i:s'));
//(この辺でSQLエスケープ処理？)
//excecuteメソッドでSQL文をDBに発行
    $stmt -> execute();
} catch (PDOException $e) {
//接続＼失敗！／した時の例外処理:エラー文言を表示
    print('Connection failed:'.$e -> getMessage());
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

