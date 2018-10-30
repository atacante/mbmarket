<?php

require_once '../db_connection.php';

$sql_sel= "SELECT * FROM `characteristic`";

$result=mysqli_query($conn, $sql_sel);


if (!empty($_POST)) {
    $category_name = $_POST['category_name'];


    $sql_create = "INSERT INTO `category` (`category_name`)
             VALUES ('$category_name')";

    //   var_dump($sql);
    $result_create = mysqli_query($conn, $sql_create);

    $row_create = mysqli_fetch_assoc($result_create);

    if (!$result_create) {
        echo "неверные данные </br>";
    }

    $sql_sel_id = "SELECT MAX(category_id) FROM `category`";

    $result_select_id = mysqli_query($conn, $sql_sel_id);
    $id_row = mysqli_fetch_array($result_select_id);
    $relation_arr = $_POST['characteristic'];
    var_dump($id_row);
    var_dump($relation_arr);
    foreach ($relation_arr as $key => $value) {
        var_dump($value);
        $sql_create_rel = "INSERT INTO `category_characteristic`(`category_id`, `characteristic_id`)
                        VALUES ('$id_row[0]', '$value')";
        $result_relation=mysqli_query($conn, $sql_create_rel);
    }
}
if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $get_id = $_GET["id"];
        $sql_del = "DELETE FROM  `category` WHERE `category_id`=$get_id";

        $result_delete = mysqli_query($conn, $sql_del);
    }

}

$sql_list = "SELECT * 
      FROM  `category`";

$result_list = mysqli_query($conn, $sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Категория</th>
                <th>Характеристики</th>
                <th>Действия</th>
        </thead>";



while ($row = mysqli_fetch_assoc($result_list)) {

    $row_id = $row["category_id"];

    $sql_characteristic = "SELECT * FROM `category_characteristic`
                              INNER JOIN `characteristic` on category_characteristic.characteristic_id = characteristic.characteristic_id WHERE `category_id`=$row_id ";

    $result_characteristic = mysqli_query($conn, $sql_characteristic);

    echo "<tr>
            <th>", $row["category_name"], "</th>
            <th>";
                while ($row_characteristic = mysqli_fetch_assoc($result_characteristic))
                {
                   echo  $row_characteristic["characteristic_name"]."<br/>";
                }
    echo            "</th>
            <th><a href='create_category.php?id=$row_id'>Удалить</a><br/>
                <a href='edit_category.php?id=$row_id'>Редактировать</a>
            </th>
          </tr>";
}
echo "</table>";
?>


<h1>Добавить новую категорию:</h1>
<form action="create_category.php" method="POST">
    <p>
        <input type="text" name="category_name" placeholder="категория"/>
        <select name="characteristic[]" multiple>
            <?php while ($row=mysqli_fetch_assoc($result)){
            ?>
            <option value=<?php echo $row['characteristic_id']?>><?php echo $row['characteristic_name']?></option>
            <?php }
            ?>
        </select>
    </p>
    <p><input type="submit" value="Добавить"></p>
</form>



