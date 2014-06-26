<?php
class PageNav {
    public $linksNum = 6;
    public $parOnePage = 10;
    public $topEnd = 2;
    public $between = '...';
    public $prevStr = 'PREV';
    public $nextStr = 'NEXT';
    //page番号を指定するクエリ文字列
    public $query   = 'page';
    //ulタグに入るクラス値
    public $class   = 'pager';

    function __constract($option = false) { //引数名後で考える
        if (is_array($option) && count($option) > 0) {
            array_walk($option, array($this, 'option'));  
        }
    }

    function createPageNav {
    
    }

    
}

?>
