<?php
    $dsn = 'mysql:host=localhost;dbname=el_library';
    $username = 'root';
    $password = '060601';
    $options = [];

    try{
        $connection = new PDO($dsn, $username, $password, $options);
        // echo "Соединение установлено: ";
    }catch (PDOException $e) {
        echo "Соединение не установлено: " . $e->getMessage();
    }
?>