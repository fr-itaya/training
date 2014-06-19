<?php
class Prefecture {
    private $pref_array;
    private $pref_id;

    public function __construct($pref_array, $pref_id = 0) {
        $this->pref_array = $pref_array;
        //選択状態にするvalue値、初期値は「--」
        $this->pref_id = $pref_id; //選択した都道府県
    }

    //都道府県セレクトボックス作成メソッド
    public function createSelectBoxTag () {
        //ローカル変数初期化
        $menu_tag = '';
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
        return $menu_tag;
    }

    //都道府県表示メソッド
    public function getPrefById () {
        //プロパティpref_arrayを利用して表示
        return $this->pref_array[$this->pref_id];
    }
}//end of class
