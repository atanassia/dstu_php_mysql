<?php
    $table_name = $_GET['table_name'];
    $id = $_GET['id'];

    require 'database/database.php';
    $sql_table_data_col = 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $id . '';
    $statement_all_table_data_col = $connection -> prepare($sql_table_data_col);
    $statement_all_table_data_col -> execute();
    $table_atribute_data = $statement_all_table_data_col -> fetchAll(PDO::FETCH_OBJ);

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
                <!-- <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                    <?= $message; ?>
                    </div>
                <?php endif; ?> -->
                    <form method="POST">
                        <?php foreach($table_atribute_data as $data): ?>
                            <div class="form-group">
                                <label for="<?= $data -> Field; ?>"><?= $data; ?></label>
                                <input value="<?= $data; ?>" name="<?= $data -> Field; ?>" id="<?= $data -> Field; ?>" class="form-control">
                            </div>
                        <?php endforeach; ?>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-info">Сохранить</button>
                        </div>
                    </form>
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