<?php
    require_once 'db_connection.php';

    if (!empty($_GET)) {
        $get_id = $_GET["id"];

        $sql_list = "SELECT * 
      FROM  `product` WHERE `id`=$get_id";

        $result = mysqli_query($conn, $sql_list);

        $row_1 = mysqli_fetch_assoc($result);

        $type_1 = $row_1['type'];
        $brand_1 = $row_1['brand'];
        $model_1 = $row_1['model'];
        $price_1 = $row_1['price'];
        $characteristic_1 = $row_1['characteristic'];
        $description_1 = $row_1['description'];
    }

if (!empty($_POST)) {
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $characteristic = $_POST['characteristic'];
    $description = $_POST['description'];

    echo "данные отправлены в обработку";


    $sql_edit="UPDATE `product` SET `type`='$type',`brand`='$brand',`model`='$model', `characteristic`='$characteristic',`description`='$description',`price`='$price' WHERE `id`='$get_id'";

    $result = mysqli_query($conn, $sql_edit);

    if (!$result) {
        echo "неверные данные";
    }
}

?>

    <h1>Редактирование:</h1>
    <form action="edit.php?id=<?echo $get_id;?>" method="POST">
    <p><label>Тип оборудования: <input type="text" name="type" value="<?echo $type_1;?>"/></label></p>
    <p><label>Бренд: <input type="text" name="brand" value="<?echo $brand_1;?>"/></label></p>
    <p><label>Модель<input type="text" name="model" value="<?echo $model_1;?>"/></label></p>
    <p><label>
            Цена: <input type="text" name="price" value="<?echo $price_1;?>"/>
        </label> руб.</p>

    <p><label>Характеристики: <textarea type="text" name="characteristic" cols="50" rows="10"><?echo $characteristic_1;?></textarea></label></p>
    <p><label>Описание: <textarea type="text" name="description" cols="50" rows="10"><?echo $description_1;?></textarea></label></p>
    <p><input type="submit" value="Cохранить"></p>
    </form>


<a href="list.php">Cписок оборудования</a>


