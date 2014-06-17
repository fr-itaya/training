<?php
class Prefecture {
    public $pref_array;
    public $pref_id;

    public function __construct($pref_selected) {
        $pref_array = array();
        //選択状態にするvalue値
        if (empty($pref_selected)) {
            $pref_id = 0; //初期値は「--」
        }else{
            $pref_id = $pref_selected; //選択した都道府県
        }
    }

    //都道府県セレクトボックス作成メソッド
    public function createSelectBoxTag($menu_tag) {
        //パラメータ値のチェック
        if (!is_array($this->pref_array) || empty($this->pref_array)) {
          return $menu_tag;
        }
        //selectタグ開始
        $menu_tag .= '<select name="prefecture">';
        //都道府県id-都道府県名の配列をoptionタグの値にする
        foreach ($this->pref_array as $key => $value) {
            $menu_tag .= '<option value="' . $key . '"';
            //選択状態にするか調べる
            if ($key==$this->pref_id) $menu_tag .= ' selected';
                $menu_tag .= '>' . $value . '</option>';
        }
        //selectタグ終了
        $menu_tag .= '</select>';
        
    }

    //都道府県表示メソッド
    public function getPrefById () {
        //もしかして：プロパティpref_arrayを利用すれば一々DBから取得しなくても表示出来る
        return $this->pref_array[$this->pref_id];
    }
}//end of class

    //都道府県リストをDBから取得(この処理も削除？何処でやるべき？)
    /*
    $stmt = $pdo->query('SELECT * FROM prefectures');
    $pref_none = array('--');
    $pref_rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
    $menu_array = array_merge($pref_none, $pref_rows);
     */
    
    //セレクトボックス作成関数呼び出し(不要？)
    //$menu_tag = createSelectBoxTag($menu_array, $menu_name, $sel_value);




    //都道府県表示関数
        /*
    public function getPrefById ($pdo, $pref_id) {
        $sql = 'SELECT pref_name FROM prefectures WHERE pref_id = :prefecture';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':prefecture', $pref_id, PDO:: PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }
         */
?>
