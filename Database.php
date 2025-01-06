<?php
// Database.php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require 'config.php';
        // $options = [
        //     PDO::MYSQL_ATTR_DEFAULT_AUTH_PLUGIN => 'caching_sha2_password',
        // ];
        try {
            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}";
            $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password'], $options);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
