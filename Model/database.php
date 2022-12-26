<?php

class DB
{
    public $error = '';
    private $pdo;

    const DB_HOST = "localhost";
    const DB_NAME = "payment";
    const DB_CHARSET = 'utf8';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    public function __construct()
    {
        $this->pdo = new PDO((string) [
            "mysql:host=" . $this::DB_HOST . ";dbname=" . $this::DB_NAME . ";charset=" . $this::DB_CHARSET,
            $this::DB_USER, $this::DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        ]);
    }

    public function __destruct()
    {
        if ($this->pdo != null)
        {
            $this->pdo = null;
        }
    }
}

$_DB = new DB();
