<?php
    $env = parse_ini_file(__DIR__ . '/../.env');
    $host = $env['DB_HOST'] ?? 'localhost';
    $db = $env['DB_NAME'] ?? 'db_name';
    $user = $env['DB_USER'] ?? 'user';
    $pass = $env['DB_PASSWORD'] ?? 'pass';
    $charset = $env['DB_CHARSET'] ?? 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }