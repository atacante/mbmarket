<?php


require_once '../Helper.php';


if (!empty($_POST)) {
    $characteristic_name = $_POST['characteristic_name'];
    $characteristic_unit = $_POST['characteristic_unit'];



    $sql_create = "INSERT INTO `characteristic` (`characteristic_name`, `characteristic_unit`)
             VALUES ('$characteristic_name', '$characteristic_unit')";

    //   var_dump($sql);
    $result = mysqli_query($conn, $sql_create);

    if (!$result) {
        echo "неверные данные </br>";
    }
}

if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $get_id = $_GET["id"];
        $sql_del = "DELETE FROM  `characteristic` WHERE `characteristic_id`=$get_id";

        $result = mysqli_query($conn, $sql_del);
    }

}

$sql_list = "SELECT * 
      FROM  `characteristic`";

$result = mysqli_query($conn, $sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Характеристика</th>
                <th>Единицы измерения</th>
                <th>Действия</th>
        </thead>";

while ($row = mysqli_fetch_assoc($result)) {

    $row_id = $row["characteristic_id"];
    echo "<tr>
            <th>", $row["characteristic_name"], "</th>
            <th>", $row["characteristic_unit"], "</th>
            <th><a href='edit_characteristic.php?edit_id=$row_id'>Редактировать</a></br>
                <a href='create_characteristic.php?id=$row_id'>Удалить</a>
            </th></th>
          </tr>";
}
echo "</table>";
?>


<h1>Добавить новую характеристику:</h1>
<form action="create_characteristic.php" method="POST">
    <p>
        <input type="text" name="characteristic_name" placeholder="имя характеристики"/>
        <input type="text" name="characteristic_unit" placeholder="единицы измерения"/>
    </p>
    <p><input type="submit" value="Добавить"></p>
</form>



