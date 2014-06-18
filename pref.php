<?php
//都道府県リストをDBから取得(この処理も削除？何処でやるべき？)
$stmt = $pdo->query('SELECT * FROM prefectures');
$pref_none  = array('--');
$pref_rows  = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
$pref_array = array_merge($pref_none, $pref_rows);

class Prefecture {
    public $pref_array;
    public $pref_id;

    public function __construct($pref_id = 0, $pref_array) {
        $this->pref_array = $pref_array;
        //選択状態にするvalue値、初期値は「--」
        if ($pref_id != 0) {
            $this->pref_id = $pref_id; //選択した都道府県
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
        global $pref_tag;
        $pref_tag = $menu_tag;
    }

    //都道府県表示メソッド
    public function getPrefById () {
        //プロパティpref_arrayを利用して表示
        return $this->pref_array[$this->pref_id];
    }
}//end of class
