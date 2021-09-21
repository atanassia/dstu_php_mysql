<?php
    $message = "";
    $emailErr = $loginErr = $passwordErr = $cpasswordErr = "";
    $emailv = $passwordv = $cpasswordv = "";
    $email = $login = $password = $cpassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Validates email
        if (empty($_POST["email"])) {
            $emailErr = "Вы забыли ввести почту!";
        } 
        else {
            $emailv = test_input($_POST["email"]);
            // проверка валидности почты
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$emailv)) {
                $emailErr = "Введен неправильный формат почты!"; 
            }
            else{
                $email = $_POST["email"];
            }
        }

        //Validates Login
        if (empty($_POST["login"])) {
            $loginrErr = "Вы забыли ввести логин!";
        } 
        else {
            $login = $_POST["login"];
        }

        //Validates password & confirm passwords.
        if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
            $passwordv = test_input($_POST["password"]);
            $cpasswordv = test_input($_POST["cpassword"]);
            if (strlen($_POST["password"]) <= '5') {
                $passwordErr = "Ваш пароль должен содержать не менее 5 символов!";
            }
            elseif(!preg_match("#[0-9]+#",$passwordv)) {
                $passwordErr = "Ваш пароль должен содержать хотя бы одно число!";
            }
            elseif(!preg_match("#[A-Z]+#",$passwordv)) {
                $passwordErr = "Ваш пароль должен содержать хотя бы одну заглавную букву!";
            }
            elseif(!preg_match("#[a-z]+#",$passwordv)) {
                $passwordErr = "Ваш пароль должен содержать хотя бы одну строчную букву!";
            }
            else {
                $password = $_POST["password"];
            }
        }
        elseif(!($_POST["password"] == $_POST["cpassword"])){
            $cpasswordErr = "Пароли не совпадают";
        }
        elseif(!empty($_POST["cpassword"])) {
            $cpasswordErr = "Проверьте, ввели ли Вы пароль или подтверждение пароля верно!";
        } 
        else {
            $password = $_POST["password"];
        }
    
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    require 'database/database.php';

    if(!empty($login) && !empty($email) && !empty($password)){
        $sql_l = 'SELECT * FROM users WHERE EXISTS (SELECT * FROM users WHERE login = :login)';
        $statement_l = $connection -> prepare($sql_l);
        $statement_l->execute([':login' => $login]);
        if($statement_l -> fetchAll(PDO::FETCH_OBJ)){
            $loginErr = 'Пользователь с таким логином уже существует!';
        }
        else{
            $sql = 'INSERT INTO users(login, email, password) VALUES(:login, :email, :password)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':login' => $login, ':email' => $email, ':password' => $password])){
                $message = 'Вы успешно зарегистрировались!';
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Регистрация</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body class = "d-flex flex-column h-100">
    
    <!-- Header -->
    <?php require 'templates/header.php'; ?>

    <div class="flex-shrink-0 mb-4">
        <main class="container-fluid mt-4">
            <div class="row justify-content-center">
                
                <div class="col-2">
                    <?php require 'templates/sidebar.php'; ?>
                </div>

                <div class="col-9">
                    <div class="text-center">
                        <div class="form-sign-up">
                            <form method = "POST" class="needs-validation was-validated">
                                <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

                                <div class="form-floating mb-1">
                                    <input type="login" name = "login" class="form-control" id="login" placeholder="login" required>
                                    <label for="login">Логин</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="email" name ="email" class="form-control" id="email" placeholder="name@example.com" required>
                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="password" name = "password" class="form-control" id="password" placeholder="Пароль" required>
                                    <label for="password">Пароль</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="password" name = "cpassword" class="form-control" id="cpassword" placeholder="Подтверждение пароля" required>
                                    <label for="cpassword">Подтверждение пароля</label>
                                </div>

                                <div class="checkbox mb-3 mt-3">
                                <label>
                                    <input type="checkbox" value="remember-me"><span class="ms-1">Запомнить меня</span>
                                </label>
                                </div>
                                <button class="w-100 btn btn-md btn-success" type="submit">Отправить</button>
                            </form>
                        </div>
                    </div>
                    <?php if(!empty($message)): ?>
                        <div class="alert alert-success">
                            <?= $message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($emailErr)): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Проблемы с почтой!</strong> <?= $emailErr; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($loginErr)): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Проблемы с логином!</strong> <?= $loginErr; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($passwordErr)): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Проблемы с паролем!</strong> <?= $passwordErr; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($cpasswordErr)): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Проблемы с подтверждением пароля!</strong> <?= $cpasswordErr; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <?php require 'templates/footer.php'; ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>