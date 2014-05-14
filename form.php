<?php
//セッション管理
session_start();

$errormsg = array();
foreach($_SESSION['errormsg'] as $key => $value){
    $errormsg[$key] = $value;
}
//エラーがある場合はエラー文言を表示
if(isset($errormsg)){
    $count_errormsg = count($errormsg);
    for($i = 0; $i < $count_errormsg; $i++){
        print "$errormsg[$i]<br />\n";
    } 
}

//住所欄の都道府県セレクトボックスを生成
function GetSelectBoxTag($prefecture_array, $prefecture_name, $prefecture_sel_value = '') {
    $menu_tag = '';

    //パラメータ値のチェック
    if (!is_array($prefecture_array) || empty($prefecture_array) || empty($prefecture_name)) {
        return $menu_tag;
    }

    $menu_tag .= '<select name="' . $prefecture_name . '">';
    foreach ($prefecture_array as $key => $value) {
        $menu_tag .= '<option value="' . $value . '"';
        //選択状態にするか調べる
        if ($key==$prefecture_sel_value) $menu_tag .= ' selected';
        $menu_tag .= '>' . $value . '</option>';
    }
    $menu_tag .= '</select>';

    return $menu_tag;
}


//都道府県リスト
$menu_array = array('都道府県を選択','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','新潟県','富山県','石川県','福井県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');

//メニューの名前
$menu_name = 'prefecture';

//選択状態にするvalue値
$sel_value = 13; //東京都のこと

//セレクトボックス作成関数呼び出し
$menu_tag = GetSelectBoxTag($menu_array, $menu_name, $sel_value);

//ラジオボタン入力値保持
$sex_checked = array();
if(isset($_SESSION['sex']) && ($_SESSION['sex'] == '男性')){
    $sex_checked[0] = 'checked';
}elseif(isset($_SESSION['sex']) && ($_SESSION['sex'] == '女性')){
    $sex_checked[1] = 'checked';
}

//セレクトボタン入力値保持
$hobby_checked = array();
if(isset($_SESSION['hobby'])){
    foreach(array_slice($_SESSION['hobby'], 0, 3) as $key => $value){
        $hobby_checked[$key] = 'checked';
    }
}

print_r($_SESSION);
?>

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
          <label>姓：</label><input type="text" name="family_name" size="20" value="<?php print $_SESSION['family_name']; ?>">
          <label>名：</label><input type="text" name="given_name" size="20" value="<?php print $_SESSION['given_name']; ?>">
        </p>

        <p>
          <label>性別：</label>
          <ul>
            <li><input type="radio" name="sex" value="男性" <?php print $sex_checked[0]; ?>/>男性</li>
            <li><input type="radio" name="sex" value="女性" <?php print $sex_checked[1]; ?>/>女性</li>
          </ul>
        </p>

        <p><label>郵便番号：</label><input type="text" name="postalcode[]" size="10" maxlength="3" value="<?php print $_SESSION['postalcode'][0]; ?>">-<input type="text" name="postalcode[]" size="10" maxlength="4" value="<?php print $_SESSION['postalcode'][1]; ?>"></p>

        <p>
          <label>都道府県：</label>
          <?php echo $menu_tag; ?>
        </p>

        <p><label>メールアドレス：</label><input type="email" name="email" size="30" maxlength="40" value="<?php print $_SESSION['email']; ?>"></p>

        <p>
          <label>趣味はなんですか：</label>
          <input type="hidden" name="hobby[1]" value="">
          <input type="checkbox" name="hobby[1]" value="音楽鑑賞" <?php print $hobby_checked[1]; ?>>音楽鑑賞
          <input type="hidden" name="hobby[2]" value="">
          <input type="checkbox" name="hobby[2]" value="映画鑑賞" <?php print $hobby_checked[2]; ?>>映画鑑賞
          <input type="hidden" name="hobby[3]" value="">
          <input type="checkbox" name="hobby[3]" value="その他：" <?php print $hobby_checked[3]; ?>>その他
          <input type="text" name="hobby[4]" size="10" maxlength="15" value="<?php print $_SESSION['hobby'][4]; ?>">
        </p>

        <p><label>ご意見：</label><textarea name="comment" cols="20" rows="2" maxlength="40"><?php print $_SESSION['comment']; ?></textarea></p>

        <p><input type="submit" value="確認" formaction="confirm.php"></p>
      </fieldset>
    </form>
  </section>

  <footer>
     <p>&copy; 2014</p>
  </footer>
</body>
</html>
