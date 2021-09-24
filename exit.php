<?php 
    setcookie('username', '', time() - 1);
    setcookie('status', '', time() - 1);
    unset($_SESSION['user']);
    header("Location: /");
?>