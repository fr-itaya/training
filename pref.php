<?php
class Prefecture {
    public $pref_array;
    public $pref_id;

    public function __construct() {
        $pref_array = array();
        //選択状態にするvalue値
        if (empty($_SESSION['prefecture'])) {
            $pref_id = 0; //初期値は「--」
        }else{
            $pref_id = $_SESSION['prefecture']; //選択した都道府県
        }
    }

    //都道府県セレクトボックス作成メソッド
    public function createSelectBoxTag($menu_tag) {
    
    }

    //都道府県表示メソッド
    public function getPrefById () {

    }
}//end of class

    //都道府県セレクトボックス作成
    public function createSelectBoxTag() {

        //パラメータ値のチェック
        if (!is_array($prefecture_array) || empty($prefecture_array) || empty($prefecture_name)) {
          return $menu_tag;
        }

        $menu_tag .= '<select name="prefecture">';
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
    /*
    $stmt = $pdo->query('SELECT * FROM prefectures');
    $pref_none = array('--');
    $pref_rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
    $menu_array = array_merge($pref_none, $pref_rows);
     */
    
    //セレクトボックス作成関数呼び出し
    //$menu_tag = createSelectBoxTag($menu_array, $menu_name, $sel_value);




    //都道府県表示関数
    public function getPrefById ($pdo, $pref_id) {
        /*
        $sql = 'SELECT pref_name FROM prefectures WHERE pref_id = :prefecture';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':prefecture', $pref_id, PDO:: PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
         */
    }
?>
