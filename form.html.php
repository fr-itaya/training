<!DOCTYPE html>
<html lang="ja">
<head>
  <title>フォーム</title>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <header>
    <h1>フォーム>入力</h1>
  </header>

  <section>
    <form action="confirm.php" method="post">
      <fieldset name="form">
        <legend>フォーム</legend>
  
        <p>
          <label>姓：</label><input type="text" name="family_name" size="20" value='<?php if (isset($_SESSION['family_name'])) print htmlspecialchars($_SESSION['family_name']); ?>'>
          <label>名：</label><input type="text" name="given_name" size="20" value='<?php if (isset($_SESSION['given_name'])) print htmlspecialchars($_SESSION['given_name']); ?>'>
        </p>

        <p>
          <label>性別：</label>
          <ul>
            <li><input type="radio" name="sex" value='男性' <?php if (isset($sex_checked[0])) print $sex_checked[0]; ?>/>男性</li>
            <li><input type="radio" name="sex" value='女性' <?php if (isset($sex_checked[1])) print $sex_checked[1]; ?>/>女性</li>
          </ul>
        </p>

        <p><label>郵便番号：</label><input type="text" name="postalcode[zone]" size="10" maxlength="3" value='<?php if (isset($_SESSION['postalcode'])) print htmlspecialchars($_SESSION['postalcode']['zone']); ?>'>-<input type="text" name="postalcode[district]" size="10" maxlength="4" value='<?php if (isset($_SESSION['postalcode'])) print htmlspecialchars($_SESSION['postalcode']['district']); ?>'></p>

        <p>
          <label>都道府県：</label>
          <?php print $pref->createSelectBoxTag(); ?>
        </p>

        <p><label>メールアドレス：</label><input type="email" name="email" size="30" maxlength="40" value='<?php if (isset($_SESSION['email'])) print htmlspecialchars($_SESSION['email']); ?>'></p>

        <p>
          <label>趣味はなんですか：</label>
          <input type="hidden" name="hobby[1]" value=''>
          <input type="checkbox" name="hobby[1]" value='音楽鑑賞' <?php if (isset($hobby_checked[1])) print $hobby_checked[1]; ?>>音楽鑑賞
          <input type="hidden" name="hobby[2]" value=''>
          <input type="checkbox" name="hobby[2]" value='映画鑑賞' <?php if (isset($hobby_checked[2])) print $hobby_checked[2]; ?>>映画鑑賞
          <input type="hidden" name="hobby[3]" value=''>
          <input type="checkbox" name="hobby[3]" value='その他：' <?php if (isset($hobby_checked[3])) print $hobby_checked[3]; ?>>その他
          <input type="text" name="hobby[4]" size="10" maxlength="15" value='<?php if (isset($_SESSION['hobby'][4])) print htmlspecialchars($_SESSION['hobby'][4]); ?>'>
        </p>

        <p><label>ご意見：</label><textarea name="comment" cols="20" rows="2" maxlength="40"><?php if (isset($_SESSION['comment'])) print htmlspecialchars($_SESSION['comment']); ?></textarea></p>

        <p><input type="submit" value="確認" formaction="confirm.php"></p>
      </fieldset>
    </form>
  </section>

  <footer>
     <p>&copy; 2014</p>
  </footer>
</body>
</html>
