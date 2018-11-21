
<h1>Добавить новое оборудование:</h1>
<form action="create.php" method="POST">
    <p><label>Тип оборудования: <input type="text" name="type" placeholder="Тип оборудования"/></label></p>
    <p><label>Бренд: <input type="text" name="brand" placeholder="Бренд"/></label></p>
    <p><label>Модель<input type="text" name="model" placeholder="Модель"/></label></p>
    <p><label>
            Цена: <input type="text" name="price" placeholder="Цена"/>
        </label> руб.</p>

    <p><label>Характеристики: <textarea type="text" name="characteristic" cols="50" rows="10"></textarea></label></p>
    <p><label>Описание: <textarea type="text" name="description" cols="50" rows="10"></textarea></label></p>
    <p><input type="submit" value="Добавить"></p>
</form>

<?php
require_once 'db_connection.php';

if (!empty($_POST)) {
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $characteristic = $_POST['characteristic'];
    $description = $_POST['description'];

    echo "данные отправлены в обработку  </br>";

    $sql_create = "INSERT INTO `product` (`type`, `brand`, `model`, `price`, `characteristic`, `description`)
             VALUES ('$type', '$brand', '$model', '$price', '$characteristic', '$description' )";

    //   var_dump($sql);
    $result = mysqli_query($conn, $sql_create);

    if (!$result) {
        echo "неверные данные </br>";
    }
}
?>

<a href="list.php">Cписок оборудования</a>