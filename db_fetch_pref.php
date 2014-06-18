<?php
//都道府県リストをDBから取得
//プロパティをprivateにしたことでconfirm.phpに影響が。
//インスタンス化の引数にpref_arrayを使用出来なくなったのでやむなく…
$stmt = $pdo->query('SELECT * FROM prefectures');
$pref_none  = array('--');
$pref_rows  = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
$pref_array = array_merge($pref_none, $pref_rows);
?>
