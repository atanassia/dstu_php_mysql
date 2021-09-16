<?php
    require 'database/database.php';
    $sql_base_tables = 'SHOW FULL TABLES WHERE Table_type = "BASE TABLE"';
    $sql_views = 'SHOW FULL TABLES WHERE Table_type = "VIEW"';
    $statement_base_tables = $connection -> prepare($sql_base_tables);
    $statement_view = $connection -> prepare($sql_views);
    $statement_base_tables -> execute();
    $statement_view -> execute();
    $tables = $statement_base_tables -> fetchAll(PDO::FETCH_OBJ);
    $views = $statement_view -> fetchAll(PDO::FETCH_OBJ);
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
                    <div class="sidebar sticky-top pt-4">
                        <h5>Таблицы</h5>
                            <ul>
                                <?php foreach($tables as $table): ?>
                                    <li><?= $table->Tables_in_el_library; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <h5>Представления</h5>
                            <ul>
                                <?php foreach($views as $view): ?>
                                    <li><?= $view->Tables_in_el_library; ?></li>
                                <?php endforeach; ?>
                            </ul>
                    </div>
                </div>

                <div class="col-9">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni porro, officiis ratione quod laboriosam aperiam, facere error, exercitationem earum commodi vero pariatur fuga voluptates in numquam tempore at! Vero aliquam, fuga maxime debitis dicta iure deleniti, illum voluptatum ipsa rem possimus mollitia quidem exercitationem quae corporis eos quasi assumenda saepe ut accusantium tenetur, nemo at maiores! Dolore, magni provident? Consequatur magnam recusandae ullam odit error? Perspiciatis, animi! Voluptatem nesciunt ab atque itaque architecto necessitatibus iure fugit sint dolor tenetur asperiores in soluta recusandae, corporis explicabo perferendis similique! Atque, tempore blanditiis unde nostrum deleniti, corrupti consequuntur explicabo temporibus in perferendis repellat neque harum quis dolores excepturi similique porro quia placeat. Molestias debitis minus, cum adipisci quia vel. Reprehenderit voluptatem ea, impedit exercitationem corrupti earum.
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