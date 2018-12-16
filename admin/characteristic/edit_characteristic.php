<?php

require_once '../Helper.php';


if (isset($_GET['edit_id'])) {
    $edit_id = $_GET["edit_id"];

    $sql_list = "SELECT * 
      FROM  `characteristic` WHERE `characteristic_id`=$edit_id";

    $result = mysqli_query($conn, $sql_list);

    $row_1 = mysqli_fetch_assoc($result);

    $characteristic_name_1 = $row_1['characteristic_name'];
    $characteristic_unit_1 = $row_1['characteristic_unit'];


    if (!empty($_POST)) {
        $characteristic_name = $_POST['characteristic_name'];
        $characteristic_unit = $_POST['characteristic_unit'];


        $sql_edit = "UPDATE `characteristic` SET `characteristic_name`='$characteristic_name',`characteristic_unit`='$characteristic_unit' WHERE `characteristic_id`='$edit_id'";

        $result = mysqli_query($conn, $sql_edit);

        if (!$result) {
            echo "неверные данные";
        } else {
            header("Location: create_characteristic.php");
        }
    }

}


?>

<h1>Редактировать характеристику:</h1>
<form action="edit_characteristic.php?edit_id=<?php echo $edit_id ?>" method="POST">
    <p>
        <input type="text" name="characteristic_name" value="<?php echo $characteristic_name_1 ?>"/>
        <input type="text" name="characteristic_unit" value="<?php echo $characteristic_unit_1 ?>"/>
    </p>
    <p><input type="submit" value="Сохранить"></p>
</form>

