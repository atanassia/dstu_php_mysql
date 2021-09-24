<?php 
    require 'templates/start_session.php';

    $bookId = $_GET['bookId'];

    require 'database/database.php';

    $sql_book = 'SELECT * FROM books WHERE id = ' . $bookId;
    $statement_book = $connection -> prepare($sql_book);
    $statement_book -> execute();
    $books_data = $statement_book -> fetchAll(PDO::FETCH_OBJ);

    $sql_table_data_col = 'SELECT * FROM comments WHERE bookId = ' . $bookId;
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $books_comments = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

    if(isset($_COOKIE['username'])){
        $sql_user = 'SELECT id FROM users WHERE login = ' . '"' . $_COOKIE['username'] . '"';
        $statement_user = $connection -> prepare($sql_user);
        $statement_user -> execute();
        $user_data = $statement_user -> fetchAll(PDO::FETCH_OBJ);
        foreach ($user_data as $idfield){
            foreach($idfield as $key => $value){
                $user_id = $value;
            }
        }
    }

    if (isset($_POST['comment']) && isset($user_id) && isset($bookId)) {
        $comment = $_POST['comment'];
        $usersId = $user_id;
        $sql_comment = 'INSERT INTO comments(bookId, usersId, comment_text) VALUES(:bookId, :usersId, :comment)';
        $statement_comment = $connection->prepare($sql_comment);
        if($statement_comment->execute([':bookId' => $bookId, ':usersId' => $usersId, ':comment' => $comment])){
            header("Location: comments.php?bookId=$bookId");
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
    <title>PHP + MySQL</title>
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
                    <div class="row">
                        <div class="col-4">
                            <?php foreach($books_data as $data): ?>
                                <?php foreach($data as $key => $value): ?>
                                    <?php if($key == 'booksname'): ?>
                                        <h3 class="text-center"><?= $value; ?></h3>
                                    <?php elseif($key == 'description'): ?>
                                    <p class="books_description"><?= $value; ?></p>
                                    <?php elseif($key == 'release_date'): ?>
                                    <span class="text-muted">Дата выхода - <?= $value; ?></span>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="col-8">
                            <h3 class="text-center mb-4">Комментарии к книге</h3>
                            <div class="comments_section">
                                <?php foreach($books_comments as $data): ?>
                                    <div class="mb-4">
                                        <?php foreach($data as $key => $value): ?>
                                            <?php if($key == 'comment_text'): ?>
                                                <div class="comment">
                                                    <?= $value; ?>
                                                </div>
                                                <hr class="mt-2" style="width:70%; margin: 0 auto;">   
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>  
                                <?php endforeach; ?>
                                <?php if(isset($_COOKIE['username'])): ?>
                                    <?php if($_COOKIE['status'] == 1 or $_COOKIE['status'] == 0): ?>
                                        <div class="comment">
                                            <form method = "POST">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <input type = "text" name="comment" id="comment" class="form-control" autofocus>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
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