<!DOCTYPE html>
<html lang="ja">
<head>
  <title>確認画面</title>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<?php
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$sex=$_POST['sex'];
$postalcode=$_POST['postalcode'];
$postalcode_view = implode('-', $postalcode);
#3桁-4桁に区切ったものをハイフン入れて連結させたい←完了
$prefecture=$_POST['prefecture'];
print $prefecture;#確認のため
/*print ($menu_array[]);*/
/*$prefecture_flip=array_flip($menu_array);*/
$prefecture_view=$menu_array['prefecture'];
$email=$_POST['email'];
$hobby=$_POST['hobby'];
$comment=$_POST['comment'];

$first_name=htmlspecialchars($first_name);
$last_name=htmlspecialchars($last_name);
$sex=htmlspecialchars($sex);
$postalcode_view=htmlspecialchars($postalcode_view);
$prefecture_view=htmlspecialchars($prefecture_view);
$email=htmlspecialchars($email);
$comment=htmlspecialchars($comment);

print '<header>';
print '<h1>フォーム>確認</h1>';
print '</header>';

print '<section>';
print '<p>';
print '<table>';

print '<tr>';
print '<th>姓</th>';
print '<td>';
print $first_name;
print '</td>';
print '</tr>';

print '       <tr>';
print '         <th>名</th>';
print '         <td>';
print $last_name;
print '</td>';
print '       </tr>';

print '       <tr>';
print '         <th>性別</th>';
print '         <td>';
print $sex;
print '</td>';
print '   </tr>';

print '       <tr>';
print '         <th>郵便番号</th>';
print '         <td>';
print $postalcode_view;
print '</td>';
print '       </tr>';

print '       <tr>';
print '         <th>都道府県</th>';
print '         <td>';
print ($prefecture_view);
print '</td>';
print '       </tr>';

print '       <tr>';
print '         <th>メールアドレス</th>';
print '         <td>';
print $email;
print '</td>';
print '       </tr>';

print '       <tr>';
print '         <th>趣味</th>';
print '         <td>';
print $hobby;
print '</td>';
print '        </tr>';

print '        <tr>';
print '          <th>ご意見</th>';
print '          <td>';
print $comment;
print '</td>';
print '        </tr>';
print '      </table>';
print '    </p>';
print '  </section>';

print '  <nav>';
print '    <form>';
print '<input type="button" onclick="history.back()" value="戻る" formaction="form.php">';

print '<input type="submit" value="送信" formaction="done.php">';
print '    </form>';
print '  </nav>';

print '  <footer>';
print '    <p>&copy; 2014</p>';
print '  </footer>';
?>
</body>
</html>
