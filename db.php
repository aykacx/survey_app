<?php
$servername = "104.247.163.244";
$username = "halilroot";
$password = "halilroot123456";
$dbname = "admin_halil_test";
$port = "3306";

try {
    $dsn = "mysql:host=$servername;port=$port;dbname=$dbname";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('connection failed:' . $e->getMessage() . 'code:' . $e->getCode());
}
?>