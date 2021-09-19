<?php
    $table_name = $_GET['table_name'];

    require 'database/database.php';

    if($table_name == 'books'){
        $sql_table_data = 'SELECT books.id, booksname, description, release_date, full_name, genrename FROM books 
                            JOIN authors on books.authorsId = authors.id
                            JOIN genres on books.genresId = genres.id';
        $table_col_data = array('id', 'Название книги', 'Описание', 'Дата выпуска', 'Имя автора','Жанр');
    }
    elseif($table_name == 'authors'){
        $sql_table_data = 'SELECT * From authors';
        $table_col_data = array('id', 'Имя автора', 'Дата рождения', 'Дата смерти');
    }
    elseif($table_name == 'depts'){
        $sql_table_data = 'SELECT * From depts';
        $table_col_data = array('id', 'Отделы');
    }
    elseif($table_name == 'emps'){
        $sql_table_data = 'SELECT emps.id, first_name, middle_name, last_name, deptsname FROM emps 
                            JOIN depts on emps.deptId = depts.id';
        $table_col_data = array('id', 'Имя', 'Отчество','Фамилия', 'Отдел');
    }
    elseif($table_name == 'genres'){
        $sql_table_data = 'SELECT * From genres';
        $table_col_data = array('id', 'Жанр');
    }
    elseif($table_name == '1972_author_birthday'){
        $sql_table_data = 'SELECT * From 1972_author_birthday';
        $table_col_data = array('id', 'Имя автора', 'Дата рождения', 'Дата смерти');
    }
    elseif($table_name == 'names_a_authors'){
        $sql_table_data = 'SELECT * From names_a_authors';
        $table_col_data = array('id', 'Имя автора', 'Дата рождения', 'Дата смерти');
    }
    elseif($table_name == '2_1972_names_a'){
        $sql_table_data = 'SELECT * From 2_1972_names_a';
        $table_col_data = array('id', 'Имя автора', 'Дата рождения', 'Дата смерти');
    }
    elseif($table_name == 'allbooks'){
        $sql_table_data = 'SELECT * From allbooks';
        $table_col_data = array('id', 'Название книги', 'Описание', 'Дата выпуска','id автора','id жанра');
    }
    elseif($table_name == 'task_12'){
        $sql_table_data = 'SELECT * From task_12';
        $table_col_data = array('Название','Имя автора','Жанр');
    }

    $statement_all_table_data = $connection -> prepare($sql_table_data);
    $statement_all_table_data -> execute();
    $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
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
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td colspan="10" class="text-center table-info"><a class="create_button" href="create.php?table_name=<?= $table_name; ?>">Создать запись</a></td>
                            </tr>
                            <tr>
                                <?php foreach($table_col_data as $column): ?>
                                    <td><?= $column; ?></td>
                                <?php endforeach; ?>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($table_data as $data): ?>
                                <tr>
                                    <?php foreach($data as $Row): ?>
                                        <td><?= $Row; ?></td>
                                    <?php endforeach; ?>
                                    <td>
                                        <a href="edit.php?table_name=<?= $table_name; ?>&id=<?= $data->id ?>" class="btn create_a">
                                            <img alt="" class="" src="/templates/icons/edit.svg">
                                        </a>
                                        <a onclick="return confirm('Вы точно хотите удалить запись?')" href="delete.php?table_name=<?= $table_name; ?>&id=<?= $data->id ?>" class='btn'>
                                            <img alt="" class="" src="/templates/icons/delete.svg">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="10" class="text-center table-info"><a class="create_button" href="create.php?table_name=<?= $table_name; ?>">Создать запись</a></td>
                            </tr>
                        </tbody>
                    </table>
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

<!-- 
SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'; -->