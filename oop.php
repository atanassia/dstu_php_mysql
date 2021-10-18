
<?php

    abstract class AUser{

        abstract function showInfo();
    }

    class loginExp extends Exception{
        function __construct($msg){
            $msg .= " логин.\n";
            parent::__construct($msg);
        }
    }

    class passExp extends Exception{
        function __construct($msg){
            $msg .= " пароль.\n";
            parent::__construct($msg);
        }
    }

    class emalExp extends Exception{
        function __construct($msg){
            $msg .= " почту.\n";
            parent::__construct($msg);
        }
    }

    class User extends AUSer{

        private $login;
        private $password;
        private $email;

        public function __construct($login = "", $password = "", $email = ""){
            try{
                if($login == "") 
                    throw new loginExp("Вы не ввели");
                $this->login = $login;

                if($password == "") 
                    throw new passExp("Вы не ввели");
                $this->password = $password;

                if($email == "") 
                    throw new emailExp("Вы не ввели");
                $this->email = $email;
            
            }catch(loginExp $e){
                echo "Ошибка! ", $e->getMessage();
            }catch(passExp $e){
                echo "Ошибка! ", $e->getMessage();
            }catch(emailExp $e){
                echo "Ошибка! ", $e->getMessage();
            }    
        }

        function __destruct(){
            echo "\nОбъект удален\n";
        }

        public function GetLogin(){
            return $this -> login;
        }

        public function GetPassword(){
            return $this -> password;
        }

        public function GetEmail(){
            return $this -> email;
        }

        public function SetLogin($login){
            $this -> login = $login;
        }

        public function SetPassword($password){
            $this -> password = $password;
        }

        public function SetEmail($email){
            $this -> email = $email;
        }

        public function __clone(){
            $this -> login = "guest";
            $this -> password = "qwerty";
            $this -> email = "Guest";
            echo "Объект клонирован\n";
        }

        public function showInfo(){
            echo "Login: $this->login \n";
            echo "Password: $this->password \n";
            echo "Email: $this->email \n";
        }

    }

    class SuperUser extends User{
        private $role = "user";

        public function __construct($login, $password, $email, $role){
            parent::__construct($login, $password, $email);
            $this->role = $role;
        }

        public function SetRole($role)
        {
            $this -> role = $role;
        }

        public function GetRole(){
            return $this -> role;
        }


    }
?>

<?php 

    $user6 = new User("fd", "fdf", "df");
    $user6 -> showInfo();
    // echo $objEmployee -> GetLogin();
    // echo "\n";
    // echo $objEmployee -> GetEmail();
    // $objEmployee -> SetEmail("lsfjhgvfdhsjdofvihddjfkgvlofiduhvjfoedif");
    // echo "\n";
    // echo $objEmployee -> GetEmail();
    // $objEmployee -> __clone();
    // echo "\n";
    // echo $objEmployee -> GetEmail();

    // $objEmployee = new SuperUser;
    // $objEmployee -> role(true);

    //$objEmployee1 = new SuperUser('Bob111', 'Smi11th', '4345');
    //$objEmployee1 -> SetRole("admin");

    // echo $objEmployee1 -> GetEmail();
    // echo "\n";
    // echo $objEmployee1 -> GetRole();
    
?>