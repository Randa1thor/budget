//this folder and files should be moved outside of the web server directory

<?php 



$host = '127.0.0.1';
$db   = 'test';
$user = '';
$pass = '';
$charset = 'utf8mb4';

$dsn = "sqlite:".__DIR__."/budget.sqlite3";

//"mysql:host=$host;dbname=$db;charset=$charset";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options); 
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


?>