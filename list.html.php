<!DOCTYPE html>
<html lang="ja">
<head>
  <title>登録ユーザ一覧</title>
  <meta charset="UTF-8">
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
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
    <ul class="pager">
      <?php if ($current_page > 1) : ?>
          <li><a href="?page=1">1...</a></li>
          <li><a href="?page=<?php print $current_page - 1; ?>">prev</a></li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
          <?php if ($current_page == $i) : ?>
              <li><span class="current"><?php print $i; ?></span></li>
          <?php elseif ($current_page - $max_pagelink <= $i && $i <= $current_page + $max_pagelink) : ?>
              <li><a href="?page=<?php print $i; ?>"><?php print $i; ?></a></li>
          <?php endif; ?>
      <?php endfor; ?>
      <?php if ($current_page < $total_pages) : ?>
          <li><a href="?page=<?php print $current_page + 1; ?>">next</a></li>
          <li><a href="?page=<?php print $total_pages; ?>"><?php print "..." . $total_pages; ?></a></li>
      <?php endif ?>
    </ul>
  </nav>


<nav class="global">
  <h4>動作確認用</h4>
  <ul>
    <li><a href="index.php">TOP</a></li>
    <li><a href="form.php">入力</a></li>
    <li><a href="confirm.php">確認</a></li>
    <li><a href="done.php">完了</a></li>
    <li><span class="current">応募者一覧</span></li>
  </ul>
</nav>

<footer>
    <a href="index.php">TOPへ戻る</a>
    <p>&copy; 2014</p>
  </footer>
</body>
</html>
