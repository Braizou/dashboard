<?php

require_once __DIR__ . '/../config/init.php';

// Connexion à la BDD
class Database {
    public static function connect(){
        $pdo = new PDO(DSN, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }
}