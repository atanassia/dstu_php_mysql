<?php
    require 'templates/start_session.php';
    $table_name = $_GET['table_name'];

    require 'database/database.php';

    if($table_name == 'books'){
        $sql_table_data = 'SELECT books.id, booksname, description, release_date, full_name, genrename FROM books 
                            JOIN authors on books.authorsId = authors.id
                            JOIN genres on books.genresId = genres.id';
        $table_col_data = array('id', 'Название книги', 'Описание', 'Дата выпуска', 'Имя автора fk','Жанр fk');
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
        $table_col_data = array('id', 'Имя', 'Отчество','Фамилия', 'Отдел fk');
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

    $sql_table_data_col = 'SELECT id, genrename FROM genres';
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $genres_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

    $sql_table_data_col = 'SELECT id, full_name FROM authors';
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $authors_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

    $sql_table_data_col = 'SELECT * FROM depts';
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $depts_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

    $statement_all_table_data = $connection -> prepare($sql_table_data);
    $statement_all_table_data -> execute();
    $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
?>


<?php
    if ($table_name == 'books'){
        if (isset ($_POST['Название книги']) && isset($_POST['Описание']) && isset($_POST['Дата выпуска']) && isset($_POST['Имя автора fk']) && isset($_POST['Жанр fk'])) {
            $booksname = $_POST['Название книги'];
            $description = $_POST['Описание'];
            $release_date = $_POST['Дата выпуска'];
            $authorsId = $_POST['Имя автора fk'];
            $genresId = $_POST['Жанр fk'];
            $sql_table_data = 'SELECT books.id, booksname, description, release_date, full_name, genrename FROM books 
                    JOIN authors on books.authorsId = authors.id
                    JOIN genres on books.genresId = genres.id
                    WHERE booksname LIKE ' . $booksname . ' OR description = :description OR release_date = :release_date OR authorsId = :authorsId OR genresId = :genresId';
            $statement_all_table_data = $connection -> prepare($sql_table_data);
            $statement_all_table_data->execute([':description' => $description, ':release_date' => $release_date, ':authorsId' => $authorsId, ':genresId' => $genresId]);
            $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
        }
    }
    elseif ($table_name == 'authors'){
        if ((isset ($_POST['Имя автора']) && isset($_POST['Дата рождения'])) && isset($_POST['Дата смерти'])) {
            $full_name = $_POST['Имя автора'];
            $birth_date = $_POST['Дата рождения'];
            $death_date = $_POST['Дата смерти'];
            if(empty($death_date)){
                $sql_table_data = 'SELECT * From depts WHERE full_name LIKE ' . $full_name . ' AND birth_date = :birth_date AND death_date = :death_date';
                $statement_all_table_data = $connection -> prepare($sql_table_data);
                if($statement_all_table_data -> execute([':birth_date' => $birth_date, ':death_date' => $death_date])){
                    $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);   
                }
            }
            else{
                $sql_table_data = 'SELECT * From depts WHERE full_name LIKE ' . $full_name . ' AND birth_date = :birth_date';
                $statement_all_table_data = $connection -> prepare($sql_table_data);
                if($statement_all_table_data -> execute([':birth_date' => $birth_date])){
                    $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
                }
            }
        }
    }
    elseif ($table_name == 'depts'){
        if (isset ($_POST['Отделы'])) {
            $deptsname = $_POST['Отделы'];
            $sql_table_data = 'SELECT * From depts WHERE deptsname LIKE ' . '"%' . $deptsname . '%" ';
            $statement_all_table_data = $connection -> prepare($sql_table_data);
            if($statement_all_table_data -> execute()){
                $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
            }          
        }
    }
    elseif ($table_name == 'emps'){
        if (isset($_POST['Имя']) && isset($_POST['Отчество']) && isset($_POST['Фамилия']) && isset($_POST['Отдел fk'])) {
            $first_name = $_POST['Имя'];
            $middle_name = $_POST['Отчество'];
            $last_name = $_POST['Фамилия'];
            $deptId = $_POST['Отдел fk'];
            $sql_table_data = 'SELECT * FROM emps WHERE first_name LIKE ' . '"%' . $first_name . '%"' . ' OR middle_name LIKE ' . '"%' .  $middle_name . '%"' .  ' OR last_name LIKE ' . '"%' .  $last_name . '%"' .  ' OR deptId = :deptId';
            $statement_all_table_data = $connection -> prepare($sql_table_data);
            if($statement_all_table_data -> execute([':deptId' => $deptId])){
                $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
            } 
        }
    }
    elseif ($table_name == 'genres'){
        if (isset ($_POST['Жанр'])) {
            $genrename = $_POST['Жанр'];
            $sql_table_data = 'SELECT * FROM genres WHERE genrename LIKE ' . '"%' . $genrename . '%" ';
            $statement_all_table_data = $connection -> prepare($sql_table_data);
            if($statement_all_table_data -> execute()){
                $table_data = $statement_all_table_data -> fetchAll(PDO::FETCH_OBJ);
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
                    <form method = "POST">
                        <div class="row mb-4 search_data">
                            <?php foreach($table_col_data as $column): ?>
                                <?php if ($column == "id") continue; ?>
                                <div class="col">
                                    <?php if ($column == "Дата выпуска" or $column == "Дата рождения" or $column == "Дата смерти"): ?>
                                        <label for="<?= $column; ?>" class="mt-3"><?= $column; ?></label>
                                        <?php if ($column == "Дата смерти"): ?>
                                            <input type = "date" name="<?= $column; ?>" id="<?= $column; ?>" class="form-control">
                                        <?php else: ?>
                                            <input type = "date" name="<?= $column; ?>" id="<?= $column; ?>" class="form-control" required>
                                        <?php endif; ?>
                                    <?php elseif($column == "Имя автора fk" or $column == "Жанр fk" or $column == "Отдел fk"): ?>
                                        <label for="<?= $column; ?>" class="mt-3"><?= $column; ?></label>
                                        <?php if ( $column == 'Жанр fk' ): ?>
                                            <select name='<?= $column; ?>' id='<?= $column; ?>' class="form-select">
                                                    <?php foreach($genres_col_data as $genre_col): ?>
                                                        <option value="<?= $genre_col -> id; ?>"><?= $genre_col -> genrename; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php elseif ( $column == 'Имя автора fk' ): ?>
                                                <select name='<?= $column; ?>' id='<?= $column; ?>' class="form-select">
                                                    <?php foreach($authors_col_data as $author_col): ?>
                                                        <option value="<?= $author_col -> id; ?>"><?= $author_col -> full_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php elseif ( $column == 'Отдел fk' ): ?>
                                                <select name='<?= $column; ?>' id='<?= $column; ?>' class="form-select">
                                                    <?php foreach($depts_col_data as $dept_col): ?>
                                                        <option value="<?= $dept_col -> id; ?>"><?= $dept_col -> deptsname; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <label for="<?= $column; ?>" class="mt-3"><?= $column; ?></label>
                                        <input type = "text" name="<?= $column; ?>" id="<?= $column; ?>" class="form-control" required>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-1 mt-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Поиск</button>
                            </div>
                        </form>
                    </div>

                    <table class="table table-striped table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <?php foreach($table_col_data as $column): ?>
                                    <td><?= $column; ?></td>
                                <?php endforeach; ?>

                               
                                <?php if(isset($_COOKIE['status'])): ?>
                                    <?php if($_COOKIE['status'] == 1): ?>
                                        <td></td>
                                        <td></td>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if($table_name == 'books'): ?>
                                    <td></td>
                                <?php endif ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($table_data as $data): ?>
                                <tr>
                                    <?php foreach($data as $Row): ?>
                                        <td><?= $Row; ?></td>
                                    <?php endforeach; ?>
                                    
                                    <?php if(isset($_COOKIE['status'])): ?>
                                        <?php if($_COOKIE['status'] == 1): ?>
                                            <td>
                                                <a href="edit.php?table_name=<?= $table_name; ?>&id=<?= $data->id ?>" class="btn btn_create_delete">
                                                    <img alt="" class="" src="/templates/icons/edit.svg">
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Вы точно хотите удалить запись?')" href="delete.php?table_name=<?= $table_name; ?>&id=<?= $data->id ?>" class='btn btn_create_delete'>
                                                    <img alt="" class="" src="/templates/icons/delete.svg">
                                                </a>
                                            </td>
                                        <?php endif ?>
                                    <?php endif ?>
                                    <?php if($table_name == 'books'): ?>
                                        <td>
                                            <a href="comments.php?bookId=<?= $data->id ?>" class="btn btn_create_delete">
                                                <img alt="" class="" src="/templates/icons/comment.svg">
                                            </a>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach; ?>
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