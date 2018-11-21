<?php

require_once '../db_connection.php';

$sql_list_category = "SELECT * FROM `category`";

$result_list_category = mysqli_query($conn, $sql_list_category);

$list_category = [];
while ($row_int = mysqli_fetch_assoc($result_list_category))
{
    $list_category [] = $row_int;
}



?>


<h1>Добавить новый товар</h1>
<p>Выберите категорию:</p>
<form action="create_product.php" method="POST">
    <select name = "category_select" multiple = "multiple">
        <?php
        foreach ($list_category as $category) {
                $name_category = $category['category_name'];
                $id_category = $category['category_id'];
                ?>
                <option></option>
            <?php
        }
            ?>
    </select>
</form>
