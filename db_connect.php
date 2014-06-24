<?php
//DB接続クラス
class Database {
    private static $pdo;
    private $dsn;
    private $user;
    private $password;

    private function __construct($dsn, $user, $password) {
        self::$pdo = '';
        $this->dsn = $dsn;
        $this->user= $user;
        $this->password = $password;
        //接続成功した場合PDOインスタンス生成
        try {
            self::$pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            //接続失敗した時の例外処理:エラー文言を表示
            print('Connection failed:'.$e->getMessage());
            var_dump(method_exists('PDO', 'dsn'));
            die();
        }
    }
    public static function getInstance($dsn, $user, $password) {
        if (is_null(self::$pdo)) {
            self::$pdo = new PDO($dsn, $user, $password);
        }
        return self::$pdo;
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>
