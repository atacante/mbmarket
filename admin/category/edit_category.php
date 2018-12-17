<?php

require_once '../Helper.php';
$db_mbMarket = Helper::getInstance();

if (isset($_GET['id'])) {
    $edit_id = $_GET["id"];

    $sql_list = "SELECT * 
      FROM  `category` 
          LEFT JOIN `category_characteristic` on category.category_id = category_characteristic.category_id
            LEFT JOIN `characteristic` on characteristic.characteristic_id=category_characteristic.characteristic_id
    WHERE category.`category_id`=$edit_id";

    $list = $db_mbMarket->mysqlListToArray($sql_list);

    $sql_list_all = "SELECT * FROM `characteristic`";

    $list_all = $db_mbMarket->mysqlListToArray($sql_list_all);


    $category_name_1 = $list[0]['category_name'];


    if (!empty($_POST)) {
        $new_category_name = $_POST['category_name'];
        $characteristic_arr = $_POST['characteristic'];


        $sql_edit = "UPDATE `category` SET `category_name`='$new_category_name' WHERE `category_id`='$edit_id'";

        $db_mbMarket->mysqlChange($sql_edit);

        $sql_clear_char = "DELETE FROM `category_characteristic` WHERE `category_id`='$edit_id'";

        $db_mbMarket->mysqlChange($sql_clear_char);
        $result_update = 1;
        foreach ($characteristic_arr as $value) {
            $sql_update_char = "INSERT INTO `category_characteristic` (`category_id`, `characteristic_id`) 
                              VALUES ('$edit_id', '$value')";
            $result_update = $db_mbMarket->mysqlChange($sql_update_char);
        }
        if (!$result_update) {
            echo "неверные данные";
        } else {
            header("Location: create_category.php");
        }
    }


    ?>

    <h1>Редактировать:</h1>
    <form action="edit_category.php?id=<?php echo $edit_id ?>" method="POST">
        <p>
            <input type="text" name="category_name" value="<?php echo $category_name_1 ?>"/>
        </p>
        <p>Характерстики:<br/>
            <?php
            $characteristicSet = false;
            foreach ($list as $row_set_all) {
                if (isset($row_set_all['characteristic_id'])) {
                    $row_select [] = $row_set_all ['characteristic_id'];
                    $characteristicSet = true;
                }
            }

            ?>
            <select name="characteristic[]" multiple>
                <!--Show all characteristics-->
                <?php foreach ($list_all as $row_list_all) { ?>
                    <option value="<?php echo $row_list_all['characteristic_id'] ?>"


                        <?php
                        if ($characteristicSet) {
                            foreach ($row_select as $selected_characteristic) {
                                if ($selected_characteristic == $row_list_all['characteristic_id']) {
                                    echo "selected";
                                    break;
                                }

                            }
                        } ?>
                    ><?php echo $row_list_all['characteristic_name'] ?></option>

                <?php }
                ?>
            </select>
        </p>
        <p><input type="submit" value="Сохранить"></p>
    </form>
    <?php
} else {
    echo "нет данных для редактирования <br/>";
    echo "<a href='create_category.php'>Вернуться к предыдущей странице </a>";
}
?>
