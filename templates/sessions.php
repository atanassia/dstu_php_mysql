<?php
    function Login($login, $status, $remember){
        if($login == '')
            return false;
        $_SESSION['user'] = $login;

        if($remember){
            setcookie('username', $login, time() + 3600 * 24 * 7, '/');
            setcookie('status', $status, time() + 3600 * 24 * 7, '/');
        }
        return true;
    }

    function Logout(){
        setcookie('username', '', time() - 1);
        setcookie('status', '', time() - 1);
        unset($_SESSION['user']);
        header("Location: /");
    }
?>