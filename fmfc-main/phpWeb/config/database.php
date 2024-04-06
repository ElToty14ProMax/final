<?php
// config/database.php
$host = 'localhost';
$db   = 'usuarios';
$user = 'postgres';
$pass = 'Toty*020314';
$charset = 'utf8';
$dsn = "pgsql:host=$host;dbname=$db;options='--client_encoding=UTF8'";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
?>