<?php
// includes/database-connection.php

$type     = 'mysql';
$server   = 'localhost';
$db       = 'artfolio_db';
$charset  = 'utf8mb4';
$username = 'root';
$password = '';

$dsn = "$type:host=$server;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    include 'includes/database-troubleshooting.php';
    exit;
}