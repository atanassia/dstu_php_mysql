<?php
    function Login($login, $status, $remember, $password){
        if($login == '')
            return false;
        session_start();
        $_SESSION['username'] = $login;
        $_SESSION['status'] = $status;

        if($remember != ""){
            setcookie('USERNAME', $login, time() + 3600 * 24 * 7, '/');
            setcookie('PASSWORD', $password, time() + 3600 * 24 * 7, '/');
        }
        else{
            setcookie('USERNAME', $login, 1, '/');
            setcookie('PASSWORD', $password, 1, '/');
        }
        return true;
    }

    function Logout(){
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['status']);
        session_destroy();
    }
?>