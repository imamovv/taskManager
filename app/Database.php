<?php

use PDO;

function getDatabaseConnection($config)
{
    $dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

$dbConfig = require BASE_PATH . '/app/config.php';
$pdo = getDatabaseConnection($dbConfig['database']);