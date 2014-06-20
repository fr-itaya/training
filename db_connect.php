<?php
//DB接続クラス
class Database {
    private $pdo;

    public function __construct($dsn, $user, $password) {
        $this->pdo = '';
        //接続成功した場合PDOインスタンス生成
        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            //接続失敗した時の例外処理:エラー文言を表示
            print('Connection failed:'.$e->getMessage());
            var_dump(method_exists('PDO', 'dsn'));
            die();
        }
    }
    
    public function getPdo() {
        return $this->pdo;
    }
}
?>
