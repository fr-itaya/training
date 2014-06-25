<!DOCTYPE html>
<html lang="ja">
<head>
   <title>登録ユーザ一覧</title>
   <meta charset="UTF-8">
   <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <header>
    <h1>フォーム>一覧</h1>
  </header>
  
  <section>
    <table id="horizontal">
      <thead>
        <tr>
          <th>ID</th>
          <th>姓</th>
          <th>名</th>
          <th>メールアドレス</th>
          <th>都道府県</th>
          <th>登録日時</th>
          <th>更新日時</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($user_list as $user_row): ?>
        <tr>
        <?php foreach ($user_row as $val): ?>
          <td><?php print $val ?></td>
        <?php endforeach ?>
        </tr>
      <?php endforeach ?>
      </tbody>
    </table>
  </section>

  <nav>
  <!--PENDING-->
  </nav>

  <footer>
    <a href="index.php">TOPへ戻る</a>
    <p>Copyright 2014</p>
  </footer>
</body>
</html>
