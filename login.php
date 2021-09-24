<?php
    require 'database/database.php';
    
    $message = "";

    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['remember'])) {

        $login = $_POST["login"];
        $password = $_POST["password"];

        if(!empty($login) && !empty($password)){
            $sql_l = 'SELECT * FROM users WHERE login = :login AND password = :password';
            $statement_l = $connection -> prepare($sql_l);
            $statement_l->execute([':login' => $login, ':password' => $password]);
            $userdata = $statement_l -> fetchAll(PDO::FETCH_OBJ);
            if($userdata){
                $count = 0;
                foreach ($userdata as $row){
                    foreach($row as $table_data){
                        if ($count == 1){
                            $login = $table_data;
                        }
                        elseif($count == 3){
                            $password = $table_data;
                        }
                        elseif($count == 4){
                            $status = $table_data;
                        }
                        $count++;
                    }
                }

                require 'templates/sessions.php';
                session_start();
                $enter_site = false;
                Logout();

                if (count($_POST) > 0)
                    $enter_site = Login($login, $status, $_POST['remember'] == 'on');
                if($enter_site){
                    header("Location: /");
                    exit();
                }
            }
            elseif(count($userdata) == 0){
                $messageUserErr = "Пользователь не найден.";
            }
        }

        else{
            $messageUserErr = "Отсутствуют пароль или логин, введите данные!";
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
    <title>Авторизация</title>
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
                                <h1 class="h3 mb-3 fw-normal">Авторизация</h1>

                                <div class="form-floating mb-1">
                                    <input type="login" name = "login" class="form-control" id="login" placeholder="login" required>
                                    <label for="login">Логин</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="password" name = "password" class="form-control" id="password" placeholder="Пароль" required>
                                    <label for="password">Пароль</label>
                                </div>

                                <div class="checkbox mb-3 mt-3">
                                <label>
                                    <input type="checkbox" name = "remember" id="remember" checked><span class="ms-1">Запомнить меня</span>
                                </label>
                                </div>
                                <button class="w-100 btn btn-md btn-success" type="submit">Отправить</button>
                            </form>
                        </div>
                    </div>
                    <?php if(!empty($messageUserErr)): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Ошибка!</strong> <?= $messageUserErr; ?>
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