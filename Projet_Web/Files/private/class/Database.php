<?php 
namespace App;

class Database {

    public static function get_PDO(): \PDO
    {
        return new \PDO('mysql:host=localhost;dbname=???;charset=utf8', '', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }

}