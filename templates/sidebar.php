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

<div class="sidebar sticky-top pt-4">
    <h5>Таблицы</h5>
        <ul>
            <?php foreach($tables as $table): ?>
                <?php if($table->Tables_in_el_library == "users") continue; ?>
                <?php if($table->Tables_in_el_library == "comments") continue; ?>
                <li><a href="data_output.php?table_name=<?= $table->Tables_in_el_library; ?>"><?= $table->Tables_in_el_library; ?></a></li>                          
            <?php endforeach; ?>
        </ul>

    <h5>Представления</h5>
        <ul>
            <?php foreach($views as $view): ?>
                <li><a href="data_output.php?table_name=<?= $view->Tables_in_el_library; ?>"><?= $view->Tables_in_el_library; ?></a></li>                          
            <?php endforeach; ?>
        </ul>
    
    <?php if(isset($_COOKIE['username'])): ?>
        <?php if($_COOKIE['status'] == 1): ?>
            <div>
                <a class="create_button btn btn-outline-light btn-lg" type="button" href="create.php?table_name=<?= $table_name; ?>">Создать запись</a>
            </div>
        <?php endif ?>
    <?php endif ?>

</div>