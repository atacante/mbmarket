<?php

require_once '../Helper.php';
$db_mbmarket = Helper::getInstance();


if (!empty($_POST)) {
    $brand_name = $_POST['brand_name'];


    $sql_create = "INSERT INTO `brand` (`brand_name`)
             VALUES ('$brand_name')";

    $db_mbmarket->mysqlChange($sql_create);
}


if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $get_id = $_GET["id"];
        $sql_del = "DELETE FROM  `brand` WHERE `brand_id`=$get_id";
        $db_mbmarket->mysqlChange($sql_del);

    }

}

$sql_list = "SELECT *
      FROM  `brand`";


$listedArray = $db_mbmarket->mysqlListToArray($sql_list);


echo "<table border='1'>
        <thead> 
            <tr>
                <th>Брэнд</th>
                <th>Действия</th>
        </thead>";

foreach ($listedArray as $value) {

    $row_id = $value["brand_id"];
    echo "<tr>
            <th>", $value["brand_name"], "</th>
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



