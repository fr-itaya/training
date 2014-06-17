<?php
class Prefecture {
    public $prefecture_array;
    public $prefecture_name;
    public $prefecture_sel_value;
    public $menu_tag;

    //都道府県セレクトボックス作成
    public function GetSelectBoxTag($prefecture_array, $prefecture_name, $prefecture_sel_value = '') {
        $menu_tag = '';

    //パラメータ値のチェック
    if (!is_array($prefecture_array) || empty($prefecture_array) || empty($prefecture_name)) {
      return $menu_tag;
    }

    $menu_tag .= '<select name="' . $prefecture_name . '">';
    foreach ($prefecture_array as $key => $value) {
        $menu_tag .= '<option value="' . $key . '"';
        //選択状態にするか調べる
        if ($key==$prefecture_sel_value) $menu_tag .= ' selected';
            $menu_tag .= '>' . $value . '</option>';
    }
    $menu_tag .= '</select>';

    return $menu_tag;
    }

    //都道府県リストをDBから取得
    $stmt = $pdo->query('SELECT * FROM prefectures');
    $pref_none = array('--');
    $pref_rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
    $menu_array = array_merge($pref_none, $pref_rows);
    //メニューの名前
    $menu_name = 'prefecture';
    
    //選択状態にするvalue値
    if (empty($_SESSION['prefecture'])) {
        $sel_value = 0; //初期値は「--」
    }else{
        $sel_value = $_SESSION['prefecture']; //選択した都道府県
    }
    
    //セレクトボックス作成関数呼び出し
    $menu_tag = GetSelectBoxTag($menu_array, $menu_name, $sel_value);
    
    
    //都道府県表示関数
    public function getPrefById ($pdo, $pref_id) {
        $sql = 'SELECT pref_name FROM prefectures WHERE pref_id = :prefecture';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':prefecture', $pref_id, PDO:: PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }
}
?>
