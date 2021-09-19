<?php
    $dsn = 'mysql:host=localhost;dbname=INFORMATION_SCHEMA';
    $username = 'root';
    $password = '060601';
    $options = [];

    try{
        $connection = new PDO($dsn, $username, $password, $options);
    }catch (PDOException $e) {
        echo "Соединение не установлено: " . $e->getMessage();
    }
?>