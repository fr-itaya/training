<?php
//空白処理
foreach($_POST as $value){
    //半角スペースを除く
    $value = trim($value);
    //全角スペースを除く
    $value = preg_replace('/^[\s ]*(.*?)[\s ]*$/u', '\1', $value);
}

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$sex=$_POST['sex'];
$postalcode=$_POST['postalcode'];
$postalcode_view = implode('-', $postalcode);
#3桁-4桁に区切ったものをハイフン入れて連結させたい←完了
$prefecture=$_POST['prefecture'];
$email=$_POST['email'];
$comment=$_POST['comment'];

if(isset($_POST['hobby'])){
    $hobby = implode(' ', $_POST['hobby']);
}else{
    $hobby = 'なし';
}

$first_name      = htmlspecialchars($first_name);
$last_name       = htmlspecialchars($last_name);
$sex             = htmlspecialchars($sex);
$postalcode_view = htmlspecialchars($postalcode_view);
$prefecture      = htmlspecialchars($prefecture);
$email           = htmlspecialchars($email);
$comment         = htmlspecialchars($comment);
$hobby           = htmlspecialchars($hobby);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>確認画面</title>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <header>
    <h1>フォーム>確認</h1>
  </header>

  <section>
    <p>
      <table>

        <tr>
          <th>姓</th>
          <td>
          <?php print $first_name; ?>
          </td>
        </tr>

        <tr>
          <th>名</th>
          <td>
          <?php print $last_name; ?>
          </td>
        </tr>

        <tr>
          <th>性別</th>
          <td>
          <?php print $sex; ?>
          </td>
        </tr>

        <tr>
          <th>郵便番号</th>
          <td>
          <?php print $postalcode_view; ?>
          </td>
        </tr>

        <tr>
          <th>都道府県</th>
          <td>
          <?php print $prefecture; ?>
          </td>
        </tr>

        <tr>
          <th>メールアドレス</th>
          <td>
          <?php print $email; ?>
          </td>
        </tr>

        <tr>
          <th>趣味</th>
          <td>
          <?php print $hobby; ?>
          </td>
        </tr>

        <tr>
          <th>ご意見</th>
          <td>
          <?php print $comment; ?>
          </td>
        </tr>
      </table>
    </p>
  </section>

  <nav>
    <form>
      <p> <input type="button" onclick="history.back()" value="戻る" formaction="form.php"></p>

      <p><input type="submit" value="送信" formaction="done.php"></p>
    </form>
  </nav>

  <footer>
    <p>&copy; 2014</p>
  </footer>

</body>
</html>
