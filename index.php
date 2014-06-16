<?php
//セッション管理
session_start();
//セッション初期化
$_SESSION = array();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>issue #12</title>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <header>
    <h1>フォーム>TOPページ</h1>
  </header>

  <nav>
    <a href="form.php">フォームを入力する</a>
  </nav>

  <footer>
    <p>Copyright 2014</p>
  </footer>
</body>
</html>
