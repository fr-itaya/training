<?php
//DB接続クラス
class Database {
    private $pdo;
    private static $instance;

    private function __construct($dsn, $user, $password) {
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

    public static function getInstance($dsn, $user, $password) {
        if (is_null(self::$instance)) {
            self::$instance = new self($dsn, $user, $password);
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>
