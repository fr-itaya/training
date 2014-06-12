<?php
//セッション変数使用
session_start();
//★DB接続
//PDOクラスのオブジェクトを作成
$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';
//値の受取確認用(後で消します)
//var_dump($_SESSION);
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

try {
    //接続成功した時にオブジェクト作成
    $dbh = new PDO($dsn, $user, $password);
    insertData($dbh, $_SESSION);
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

