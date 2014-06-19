<?php
//DB接続クラス
class Database {
    private $pdo;

    public function __construct() {
    $this->pdo = '';
    }

    public function connectToDB() {
        $dsn = 'mysql:dbname=mysql_test; host=localhost; charset=utf8;';
        $user = 'root';
        $password = '';
        //接続成功した場合PDOインスタンス生成
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            return $this->pdo;
        } catch (PDOException $e) {
            //接続失敗した時の例外処理:エラー文言を表示
            print('Connection failed:'.$e->getMessage());
            var_dump(method_exists('PDO', 'dsn'));
            die();
        }
    
    }
}
?>
