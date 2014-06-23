<?php
//都道府県リストをDBから取得
function fetchPref($pdo) {
    $pref_array = array();
    $stmt = $pdo->query('SELECT * FROM prefectures');
    $pref_none  = array('--');
    $pref_rows  = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
    $pref_array = array_merge($pref_none, $pref_rows);
    return $pref_array;
}

?>
