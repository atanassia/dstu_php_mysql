<?php
    require 'database/database.php';
    $table_name = $_GET['table_name'];
    $id = $_GET['id'];
    $sql = 'DELETE FROM ' . $table_name . ' WHERE id = ' . $id . '';
    $statement = $connection->prepare($sql);
    if ($statement->execute()) {
        header("Location: /");
    }
?>