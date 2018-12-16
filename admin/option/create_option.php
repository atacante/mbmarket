<?php

require_once '../Helper.php';

$sql_sel = "SELECT * FROM `characteristic`";

$result = mysqli_query($conn, $sql_sel );




if (!empty($_POST)) {
    $option_value = $_POST['option_value'];
    $characteristic_id = $_POST['characteristic_id'];



    $sql_create = "INSERT INTO `option` (`option_value`, `characteristic_id`)
             VALUES ('$option_value', '$characteristic_id')";

    //   var_dump($sql);
    $result_create = mysqli_query($conn, $sql_create);

    if (!$result_create) {
        echo "неверные данные </br>";
    }
}

?>



<h1>Добавить новое значение:</h1>
<form action="create_option.php" method="POST">
    <p>
        <select name="characteristic_id">
            <?php
            while ($row = mysqli_fetch_assoc($result))
            {
            ?>
                <option value="<?php echo $row['characteristic_id'] ?> "><?php echo $row['characteristic_name'] ?>(<?php echo $row['characteristic_unit'] ?>)</option>;
            <?php
            }
            ?>

            </select>
        <input type="text" name="option_value" placeholder="значение"/>
    </p>
    <p><input type="submit" value="Добавить"></p>
</form>



