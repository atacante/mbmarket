<?php

require_once '../db_connection.php';



if (!empty($_POST)) {
    $brand_name = $_POST['brand_name'];




    $sql_create = "INSERT INTO `brand` (`brand_name`)
             VALUES ('$brand_name')";

    //   var_dump($sql);
    $result = mysqli_query($conn, $sql_create);

    if (!$result) {
        echo "неверные данные </br>";
    }
}

if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $get_id = $_GET["id"];
        $sql_del = "DELETE FROM  `brand` WHERE `brand_id`=$get_id";

        $result = mysqli_query($conn, $sql_del);
    }

}

$sql_list = "SELECT * 
      FROM  `brand`";

$result = mysqli_query($conn, $sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Брэнд</th>
                <th>Действия</th>
        </thead>";

while ($row = mysqli_fetch_assoc($result)) {

    $row_id = $row["brand_id"];
    echo "<tr>
            <th>", $row["brand_name"], "</th>
            <th><a href='create_brand.php?id=$row_id'>Удалить</a><br/>
                <a href='edit_brand.php?id=$row_id'>Редактировать</a>
            </th>
          </tr>";
}
echo "</table>";
?>


<h1>Добавить новый брэнд:</h1>
<form action="create_brand.php" method="POST">
    <p>
        <input type="text" name="brand_name" placeholder="брэнд"/>
    </p>
    <p><input type="submit" value="Добавить"></p>
</form>



