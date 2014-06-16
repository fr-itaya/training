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

