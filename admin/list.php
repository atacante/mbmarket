<?php

require_once 'db_connection.php';

if(!empty($_GET)){

    $get_id=$_GET["id"];
    $sql_del="DELETE FROM  `product` WHERE `id`=$get_id";

    $result=mysqli_query($conn, $sql_del);

}

$sql_list="SELECT * 
      FROM  `product`";

$result=mysqli_query($conn, $sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Тип оборудования</th>
                <th>Бренд</th>
                <th>Модель</th>
                <th>Цена</th>
                <th>Свойства</th>
                <th>Описание</th>
                <th>Действия</th>
        </thead>";

while ($row=mysqli_fetch_assoc($result)) {

    $row_id=$row["id"];
    echo "<tr>
            <th>", $row["type"], "</th>
            <th>", $row["brand"], "</th>
            <th>", $row["model"], " </th>
            <th>", $row["price"], " </th>
            <th>", $row["characteristic"], "</th>
            <th>", $row["description"], "</th>
            <th><a href='edit.php?id=$row_id'> Редактировать</a></br>
                <a href='list.php?id=$row_id'>Удалить</a>
            </th></th>
          </tr>";
}
echo "</table>";
?>

<h1><a href="create.php">Добавить оборудование</a></h1>

