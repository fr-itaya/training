<?php
//セッション管理
session_start();

//DB接続
$dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
     //接続失敗した時の例外処理:エラー文言を表示
    print('Connection failed:'.$e->getMessage());
    var_dump(method_exists('PDO', 'dsn'));
    die(); 
} 
//空白処理用にPOSTデータを配列に格納
$formData = array();
//空白処理
foreach ($_POST as $key => $value) {
    if (is_array($value)) {
//配列である場合
        foreach ($value as $key_array => $value_array) {
            $formData[$key][$key_array] = trim(mb_convert_kana($value[$key_array], 's', 'utf-8'));
        }
    } else {
//変数である場合
        $formData[$key] = trim(mb_convert_kana($value, 's', 'utf-8'));
    }
}

#都道府県表示用関数
function getPrefById ($pdo, $pref_id) {
    $sql = 'SELECT pref_name FROM prefectures WHERE pref_id = :prefecture';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':prefecture', $pref_id, PDO:: PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_COLUMN);
    return $result;
}

$family_name     = $formData['family_name'];
$given_name      = $formData['given_name'];
$sex             = $formData['sex'];
$postalcode      = $formData['postalcode'];
$postalcode_view = implode('-', $postalcode);
$prefecture      = $formData['prefecture'];
$prefecture_view = getPrefById($dbh, $prefecture);
$email           = $formData['email'];
$comment         = $formData['comment'];
$hobby           = $formData['hobby'];

$errormsg = array();

if (empty($family_name)) {
    $errormsg[] = '姓を入力してください。';
} elseif (preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $family_name)) {
    $errormsg[] = '姓は全角で入力してください。';
} elseif (mb_strlen($family_name, 'utf-8') > 50) {
    $errormsg[] = '姓は50文字以内で入力してください。';
}

if (empty($given_name)) {
    $errormsg[] = '名を入力してください。';
} elseif (preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $given_name)) {
    $errormsg[] = '名は全角で入力してください。';
} elseif (mb_strlen($given_name, 'utf-8') > 50) {
    $errormsg[] = '姓は50文字以内で入力してください。';
}

if (empty($sex)) {
    $errormsg[] = '性別を選択してください。';
}

if (empty($postalcode['zone']) || empty($postalcode['district'])) {
    $errormsg[] = '郵便番号を入力してください。';
} elseif (!preg_match_all('/^[0-9]{3}-[0-9]{4}$/', $postalcode_view)) {
    $errormsg[] = '郵便番号を正しく入力してください。';
}
if (empty($prefecture)) {
    $errormsg[] = '都道府県を選択してください。';
}

if (empty($email)) {
    $errormsg[] = 'メールアドレスを入力してください。';
} elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    $errormsg[] =  'メールアドレスを正しく入力してください。<br />';
}

if (!empty($hobby[3]) && empty($hobby[4])) {
    $errormsg[] = 'その他の詳細を入力してください。<br />';
} elseif (empty($hobby[3]) && !empty($hobby[4])) {
    $formData['hobby'][3] = 'その他：';
}

#関数でサニタイジング(出力直前に使用)
function outputForHtml($param){
    if (empty($param)) return false;
    print htmlspecialchars($param, ENT_QUOTES);
}

#入力データをセッション変数に格納
$_SESSION['family_name'] = $formData['family_name'];
$_SESSION['given_name']  = $formData['given_name'];
$_SESSION['sex']         = $formData['sex'];
$_SESSION['postalcode']  = $formData['postalcode'];
$_SESSION['prefecture']  = $formData['prefecture'];
$_SESSION['email']       = $formData['email'];
$_SESSION['hobby']       = $formData['hobby'];
$_SESSION['comment']     = $formData['comment'];

#エラーメッセージがあった場合フォーム画面に戻す
if (!empty($errormsg)) {
    $_SESSION['errormsg'] = $errormsg;
    header("Location:{$_SERVER['HTTP_REFERER']}");
} else {
    if (empty($hobby[3]) && empty($hobby[4])) {
        $hobby_view = implode(' ', array_slice($hobby, 0, 3));
    } else {
        $hobby_view = implode(' ', array_slice($hobby, 0, 3)).'('.$hobby[4].')';
    }
    unset($_SESSION['errormsg']);
}

//DB切断
$dbh = null;
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
          <?php outputForHtml($formData['family_name']); ?>
          </td>
        </tr>

        <tr>
          <th>名</th>
          <td>
          <?php outputForHtml($formData['given_name']); ?>
          </td>
        </tr>

        <tr>
          <th>性別</th>
          <td>
          <?php outputForHtml($formData['sex']); ?>
          </td>
        </tr>

        <tr>
          <th>郵便番号</th>
          <td>
          <?php outputForHtml($postalcode_view); ?>
          </td>
        </tr>

        <tr>
          <th>都道府県</th>
          <td>
          <?php outputForHtml($prefecture_view); ?>
          </td>
        </tr>

        <tr>
          <th>メールアドレス</th>
          <td>
          <?php outputForHtml($formData['email']); ?>
          </td>
        </tr>

        <tr>
          <th>趣味</th>
          <td>
          <?php outputForHtml($hobby_view); ?> 
          </td>
        </tr>

        <tr>
          <th>ご意見</th>
          <td>
          <?php outputForHtml($formData['comment']); ?>
          </td>
        </tr>
      </table>
    </p>
  </section>

  <nav>
    <form>
      <p><input type="submit" value="戻る" formaction="form.php"></p>

      <p><input type="submit" value="送信" formaction="done.php"></p>
    </form>
  </nav>

  <footer>
    <p>&copy; 2014</p>
  </footer>

</body>
</html>
