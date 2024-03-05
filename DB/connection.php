<?php
$host = 'localhost';
$dbname = 'test';
$username = 'Username';
$password = 'P@ssword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Displayed if the connection is successful
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>