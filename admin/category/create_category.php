<?php

require_once '../Helper.php';
$db_mbMarket=Helper::getInstance();


$sql_sel= "SELECT * FROM `characteristic`";

$all = $db_mbMarket->mysqlListToArray($sql_sel);


if (!empty($_POST)) {
    $category_name = $_POST['category_name'];


    $sql_create = "INSERT INTO `category` (`category_name`)
             VALUES ('$category_name')";

    $db_mbMarket->mysqlChange($sql_create);


    $sql_sel_id = "SELECT MAX(category_id) FROM `category`";

    $id_row = $db_mbMarket->mysqlListToArray($sql_sel_id);
    $id_category = $id_row[0]["MAX(category_id)"];
    var_dump($id_category);
    $relation_arr = $_POST['characteristic'];

    foreach ($relation_arr as $key => $value) {

        $sql_create_rel = "INSERT INTO `category_characteristic`(`category_id`, `characteristic_id`)
                        VALUES ('$id_category', '$value')";

        $db_mbMarket->mysqlChange($sql_create_rel);
    }
}
if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $get_id = $_GET["id"];
        $sql_del = "DELETE FROM  `category` WHERE `category_id`=$get_id";

        $db_mbMarket->mysqlChange($sql_del);
    }

}

$sql_list = "SELECT * 
      FROM  `category`";

$row = $db_mbMarket->mysqlListToArray($sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Категория</th>
                <th>Характеристики</th>
                <th>Действия</th>
        </thead>";



foreach ($row as $value) {

    $row_id = $value["category_id"];

    $sql_characteristic = "SELECT * FROM `category_characteristic`
                              INNER JOIN `characteristic` on category_characteristic.characteristic_id = characteristic.characteristic_id WHERE `category_id`=$row_id ";

    $row_characteristic =  $db_mbMarket->mysqlListToArray($sql_characteristic);

    echo "<tr>
            <th>", $value["category_name"], "</th>
            <th>";
                foreach ($row_characteristic as $category)
                {
                   echo  $category["characteristic_name"]."<br/>";
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
            <?php foreach ($all as $character){
            ?>
            <option value=<?php echo $character['characteristic_id']?>><?php echo $character['characteristic_name']?></option>
            <?php }
            ?>
        </select>
    </p>
    <p><input type="submit" value="Добавить"></p>
</form>



