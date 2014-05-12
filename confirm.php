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

# _POST['hobby']配列の中身をそのまま$hobby[]に格納したい！！
# このあとの処理で、その他にチェックが入っているか、textboxに入力があるかを配列に値があるかどうかで判断したい
#連想配列で格納してみる

foreach ($_POST['hobby'] as $key => $value){
    $hobby[$key] = $value;
}

$errormsg = array();

if(empty($first_name)){
    $errormsg[] = '姓を入力してください。';
}elseif(preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $first_name)){
    $errormsg[] = '姓は全角で入力してください。';
}elseif(mb_strlen($first_name, 'utf-8') > 50){
    $errormsg[] = '姓は50文字以内で入力してください。';
}else{print '姓は正しく入力されています。<br />';}

if(empty($last_name)){
    $errormsg[] = '名を入力してください。';
}elseif(preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $first_name)){
    $errormsg[] = '名は全角で入力してください。';
}elseif(mb_strlen($last_name, 'utf-8') > 50){
    $errormsg[] = '姓は50文字以内で入力してください。';
}else{print '名は正しく入力されています。<br />';}

if(empty($sex)){
    $errormsg[] = '性別を選択してください。';
}else{print '性別は正しく選択されています。<br />';}

if(empty($postalcode[(0|1)])){
    $errormsg[] = '郵便番号を入力してください。';
}else{print '郵便番号は正しく入力されています。<br />';}

if(empty($prefecture)){
    $errormsg[] = '都道府県を選択してください。';
}else{print '都道府県は正しく選択されています。<br />';}

if(empty($email)){
    $errormsg[] = 'メールアドレスを入力してください。';
}elseif(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
    print 'メールアドレスは正しく入力されています。<br />';
}else{$errormsg[] =  'メールアドレスを正しく入力してください。<br />';}

if($hobby[3] =="その他："  && empty($hobby[4])){
    $errormsg[] = 'その他の詳細を入力してください。<br />';
}else{print 'その他の趣味の詳細が正しく入力されています。<br />';}

$count_errormsg = count($errormsg);

for ($i = 0; $i < $count_errormsg; $i++){
    print "$errormsg[$i]<br />\n";
}

#配列のkeyと値確認用
print_r ($_POST['hobby']);
print_r ($hobby);

$hobby_view = implode(' ', array_slice($hobby, 0, 3)).'('.$hobby[4].')';

$first_name      = htmlspecialchars($first_name);
$last_name       = htmlspecialchars($last_name);
$sex             = htmlspecialchars($sex);
$postalcode_view = htmlspecialchars($postalcode_view);
$prefecture      = htmlspecialchars($prefecture);
$email           = htmlspecialchars($email);
$comment         = htmlspecialchars($comment);
$hobby_view      = htmlspecialchars($hobby_view);

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
          <?php print $hobby_view; ?> 
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
