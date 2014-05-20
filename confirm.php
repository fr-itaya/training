<?php
//セッション管理
session_start();

//空白処理用にPOSTデータを配列に格納
$formData = array();
//空白処理
foreach($_POST as $key => $value){
    if(is_array($value)){
//配列用
        foreach($value as $key_array => $value_array){
            $formData[$key][$key_array] = trim(mb_convert_kana($value[$key_array], 's', 'utf-8'));
        }
    }else{
//変数用の処理
        $formData[$key] = trim(mb_convert_kana($value, 's', 'utf-8'));
    }
}

$family_name     = $formData['family_name'];
$given_name      = $formData['given_name'];
$sex             = $formData['sex'];
$postalcode      = $formData['postalcode'];
$postalcode_view = implode('-', $postalcode);
$prefecture      = $formData['prefecture'];
$email           = $formData['email'];
$comment         = $formData['comment'];

# formData['hobby']配列の中身をそのまま$hobby[]に格納したい
# このあとの処理で、その他にチェックが入っているか、textboxに入力があるかを配列に値があるかどうかで判断したい
#連想配列で格納してみる

/*foreach ($formData['hobby'] as $key => $value){
    $hobby[$key] = $value;
}*/

$hobby = $formData['hobby'];

$errormsg = array();

if(empty($family_name)){
    $errormsg[] = '姓を入力してください。';
}elseif(preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $family_name)){
    $errormsg[] = '姓は全角で入力してください。';
}elseif(mb_strlen($family_name, 'utf-8') > 50){
    $errormsg[] = '姓は50文字以内で入力してください。';
}//else{print '姓は正しく入力されています。<br />';}

if(empty($given_name)){
    $errormsg[] = '名を入力してください。';
}elseif(preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $given_name)){
    $errormsg[] = '名は全角で入力してください。';
}elseif(mb_strlen($given_name, 'utf-8') > 50){
    $errormsg[] = '姓は50文字以内で入力してください。';
}//else{print '名は正しく入力されています。<br />';}

if(empty($sex)){
    $errormsg[] = '性別を選択してください。';
}//else{print '性別は正しく選択されています。<br />';}

if(empty($postalcode['zone']) || empty($postalcode['district'])){
    $errormsg[] = '郵便番号を入力してください。';
}elseif(preg_match_all('/^[0-9]{3}-[0-9]{4}$/', $postalcode_view)){
/*    print '郵便番号は正しく入力されています。<br />';*/
}else{
    $errormsg[] = '郵便番号を正しく入力してください。';
}
if(empty($prefecture)){
    $errormsg[] = '都道府県を選択してください。';
}//else{print '都道府県は正しく選択されています。<br />';}

if(empty($email)){
    $errormsg[] = 'メールアドレスを入力してください。';
}elseif(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
  //  print 'メールアドレスは正しく入力されています。<br />';
}else{$errormsg[] =  'メールアドレスを正しく入力してください。<br />';}

if($hobby[3] == 'その他：'  && empty($hobby[4])){
    $errormsg[] = 'その他の詳細を入力してください。<br />';
}elseif(empty($hobby[3]) && isset($hobby[4])){
    $hobby[3] = 'その他：';
}

#SQL特殊文字エスケープ用関数


#エラー文言がある場合、フォーム画面に戻す
if(!empty($errormsg)){
    $_SESSION['family_name'] = $formData['family_name'];
    $_SESSION['given_name']  = $formData['given_name'];
    $_SESSION['sex']         = $formData['sex'];
    $_SESSION['postalcode']  = $formData['postalcode'];
    $_SESSION['prefecture']  = $formData['prefecture'];
    $_SESSION['email']       = $formData['email'];
    $_SESSION['hobby']       = $formData['hobby'];
    $_SESSION['comment']     = $formData['comment'];
    $_SESSION['errormsg']    = $errormsg;
    header("Location:{$_SERVER['HTTP_REFERER']}");
}

$hobby_view = implode(' ', array_slice($hobby, 0, 3)).'('.$hobby[4].')';

$family_name      = addslashes(htmlspecialchars($family_name, ENT_QUOTES));
$given_name       = addslashes(htmlspecialchars($given_name, ENT_QUOTES));
$sex              = addslashes(htmlspecialchars($sex, ENT_QUOTES));
$postalcode_view  = addslashes(htmlspecialchars($postalcode_view, ENT_QUOTES));
$prefecture       = addslashes(htmlspecialchars($prefecture, ENT_QUOTES));
$email            = addslashes(htmlspecialchars($email, ENT_QUOTES));
$comment          = addslashes(htmlspecialchars($comment, ENT_QUOTES));
$hobby_view       = addslashes(htmlspecialchars($hobby_view, ENT_QUOTES));

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
          <?php print $family_name; ?>
          </td>
        </tr>

        <tr>
          <th>名</th>
          <td>
          <?php print $given_name; ?>
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
