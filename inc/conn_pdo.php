<?php

require_once('MysqlPdo.php');


$dsn = "mysql:host=localhost;dbname=spellbount_cart;port=3306;charset=utf8";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$db = new MysqlPdo($dsn, "root", "", $opt);

$pdo = $db->pdo;

