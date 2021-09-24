<?php
    require 'templates/start_session.php';
    $table_name = $_GET['table_name'];

    require 'database/database.php';
    $sql_table_data_col = 'SHOW COLUMNS FROM ' . $table_name;
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $table_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

    if ($table_name == 'books'){
        $sql_table_data_col = 'SELECT id, genrename FROM genres';
        $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
        $statement_all_table_data_col -> execute();
        $genres_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

        $sql_table_data_col = 'SELECT id, full_name FROM authors';
        $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
        $statement_all_table_data_col -> execute();
        $authors_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);
    }

    if ($table_name == 'emps'){
        $sql_table_data_col = 'SELECT * FROM depts';
        $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
        $statement_all_table_data_col -> execute();
        $depts_col_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);
    }
?>

<?php 
    $message = '';
    if ($table_name == 'books'){
        if (isset ($_POST['booksname']) && isset($_POST['description']) && isset($_POST['release_date']) && isset($_POST['authorsId']) && isset($_POST['genresId']) ) {
            $booksname = $_POST['booksname'];
            $description = $_POST['description'];
            $release_date = $_POST['release_date'];
            $authorsId = $_POST['authorsId'];
            $genresId = $_POST['genresId'];
            $sql = 'INSERT INTO books(booksname, description, release_date, authorsId, genresId) VALUES(:booksname, :description, :release_date, :authorsId, :genresId)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':booksname' => $booksname, ':description' => $description, ':release_date' => $release_date, ':authorsId' => $authorsId, ':genresId' => $genresId])){
                $message = 'Данные успешно сохранены';
            }
        }
    }
    elseif ($table_name == 'authors'){
        if (isset ($_POST['full_name']) && isset($_POST['birth_date']) && isset($_POST['death_date'])) {
            $full_name = $_POST['full_name'];
            $birth_date = $_POST['birth_date'];
            $death_date = $_POST['death_date'];
            $sql = 'INSERT INTO authors(full_name, birth_date, death_date) VALUES(:full_name, :birth_date, :death_date)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':full_name' => $full_name, ':birth_date' => $birth_date, ':death_date' => $death_date])){
                $message = 'Данные успешно сохранены';
            }
        }
    }
    elseif ($table_name == 'depts'){
        if (isset ($_POST['deptsname'])) {
            $deptsname = $_POST['deptsname'];
            $sql = 'INSERT INTO depts(deptsname) VALUES(:deptsname)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':deptsname' => $deptsname])){
                $message = 'Данные успешно сохранены';
            }
        }
    }
    elseif ($table_name == 'emps'){
        if (isset ($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && isset($_POST['deptId'])) {
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $deptId = $_POST['deptId'];
            $sql = 'INSERT INTO emps(first_name, middle_name, last_name, deptId) VALUES(:first_name, :middle_name, :last_name, :deptId)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name, ':deptId' => $deptId])){
                $message = 'Данные успешно сохранены';
            }
        }
    }
    elseif ($table_name == 'genres'){
        if (isset ($_POST['genrename'])) {
            $genrename = $_POST['genrename'];
            $sql = 'INSERT INTO genres(genrename) VALUES(:genrename)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':genrename' => $genrename])){
                $message = 'Данные успешно сохранены';
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
    <title>Создание записи</title>
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
                <?php if(isset($_COOKIE['status'])): ?>
                    <?php if($_COOKIE['status'] == 1): ?>
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-success">
                                <?= $message; ?>
                            </div>
                        <?php endif; ?>
                            <form method="POST">
                                <div class="text-center">
                                <?php foreach($table_col_data as $column): ?>
                                    <?php if ( $column-> Field == 'id' ) continue; ?>
                                        <div class="row g-3 align-items-center mt-1">
                                            <div class="col-2">
                                                <label for="<?= $column -> Field; ?>" class="mt-3"><?= $column -> Field; ?></label>
                                            </div>
                                            <div class="col-10">
                                                <?php if ( $column-> Type == 'varchar(255)' or $column-> Type == 'varchar(512)' or $column-> Type == 'varchar(256)' ): ?>
                                                    <input type = "text" name="<?= $column -> Field; ?>" id="<?= $column -> Field; ?>" class="form-control" required>
                                                <?php elseif ( $column-> Type == 'date' ): ?>
                                                    <input type = "date" name="<?= $column -> Field; ?>" id="<?= $column -> Field; ?>" class="form-control" required>
                                                <?php elseif ( $column-> Type == 'int' ): ?>
                                                    <?php if ( $column-> Field == 'genresId' ): ?>
                                                        <select name='<?= $column-> Field; ?>' id='<?= $column-> Field; ?>' class="form-select" required>
                                                            <?php foreach($genres_col_data as $genre_col): ?>
                                                                <option value="<?= $genre_col -> id; ?>"><?= $genre_col -> genrename; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php elseif ( $column-> Field == 'authorsId' ): ?>
                                                        <select name='<?= $column-> Field; ?>' id='<?= $column-> Field; ?>' class="form-select">
                                                            <?php foreach($authors_col_data as $author_col): ?>
                                                                <option value="<?= $author_col -> id; ?>"><?= $author_col -> full_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php elseif ( $column-> Field == 'deptId' ): ?>
                                                        <select name='<?= $column-> Field; ?>' id='<?= $column-> Field; ?>' class="form-select">
                                                            <?php foreach($depts_col_data as $dept_col): ?>
                                                                <option value="<?= $dept_col -> id; ?>"><?= $dept_col -> deptsname; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php endif ?>
                                                <?php elseif ( $column-> Type == 'text' ): ?>
                                                    <textarea name="<?= $column -> Field; ?>" class="form-control" id="<?= $column -> Field; ?>" cols="30" rows="5" required></textarea>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                <?php endforeach; ?>

                                <div class="mt-5">
                                    <button class="btn btn-outline-primary w-50" type="submit">Создать запись</button>
                                </div>
                                
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <h3 class="text-center">Недостаточно прав.</h3>
                    <?php endif ?>
                    
                    <?php else: ?>
                        <h3 class="text-center">Недостаточно прав.</h3>
                <?php endif ?>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <?php require 'templates/footer.php'; ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>