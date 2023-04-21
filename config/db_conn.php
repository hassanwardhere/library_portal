<?php 
$host = '127.0.0.1';
$db   = 'librarydb';
$user = 'root';
$pass = '';
$port = "3306";
$charset = 'utf8mb4'; 

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$conn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
try {
     $pdo = new \PDO($conn, $user, $pass, $options);
     // echo 'Connection successful';
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
     // echo 'Connection error';
}

?>