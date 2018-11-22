<?php

require_once '../db_connection.php';

$sql_list_category = "SELECT * FROM `category`";
$sql_list_brand = "SELECT * FROM `brand`";

$result_list_category = mysqli_query($conn, $sql_list_category);
$result_list_brand = mysqli_query($conn, $sql_list_brand);

$list_category = [];
while ($row_int = mysqli_fetch_assoc($result_list_category))
{
    $list_category [] = $row_int;
}


?>


<h1>Добавить новый товар</h1>
<p>Выберите категорию:</p>
<form action="create_product.php" method="POST">
    <select name = "category_select" >
        <?php

        foreach ($list_category as $category) {

                ?>
                <option value="<?php echo $category['category_id']?>"
                <?php

                if ($_POST) {
                    if ($_POST['category_select'] == $category['category_id']) {
                        echo "selected";
                    }
                }?>
                ><?php echo $category['category_name']?></option>
            <?php
        }
            ?>
    </select>
    <?php
        if ($_POST){

        }
        ?>
    <input type="submit" value="Выбрать">
</form>
