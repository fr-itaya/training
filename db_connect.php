<?php
//DB接続クラス
class Database {
    private static $pdo;

    private function __construct($dsn, $user, $password) {
        self::$pdo = '';
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
    
    public static function getPdo() {
        if (is_null(self::$pdo)) {
            self::$pdo = new self;
        }
        return self::$pdo;
    }
}
?>
