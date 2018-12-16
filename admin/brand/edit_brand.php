<?php

require_once '../Helper.php';
$db_mbmarket=Helper::getInstance();

if (isset($_GET['id'])) {
    $edit_id = $_GET["id"];

    $sql_list = "SELECT * 
      FROM  `brand` WHERE `brand_id`=$edit_id";

    $row_1=$db_mbmarket->mysqlListToArray($sql_list);

    $brand_name_1 = $row_1[0]['brand_name'];

    if (!empty($_POST)) {
        $brand_name = $_POST['brand_name'];


        $sql_edit = "UPDATE `brand` SET `brand_name`='$brand_name' WHERE `brand_id`='$edit_id'";

        if (!$db_mbmarket->mysqlChange($sql_edit)) {
            echo "неверные данные";
        } else {
            header("Location: create_brand.php");
        }
    }

}


?>

<h1>Редактировать:</h1>
<form action="edit_brand.php?id=<?php echo $edit_id ?>" method="POST">
    <p>
        <input type="text" name="brand_name" value="<?php echo $brand_name_1 ?>"/>
    </p>
    <p><input type="submit" value="Сохранить"></p>
</form>

