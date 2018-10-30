<?php

require_once '../db_connection.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET["id"];

    $sql_list = "SELECT * 
      FROM  `category` 
          INNER JOIN `category_characteristic` on category.category_id = category_characteristic.category_id
            INNER JOIN `characteristic` on characteristic.characteristic_id=category_characteristic.characteristic_id
    WHERE category.`category_id`=$edit_id";

    $result = mysqli_query($conn, $sql_list);
    $result_select=mysqli_query($conn,$sql_list);

    $sql_list_all = "SELECT * FROM `characteristic`";
    $result_list_all = mysqli_query($conn, $sql_list_all);

    $row_1 = mysqli_fetch_assoc($result);

    $category_name_1 = $row_1['category_name'];

    if (!empty($_POST)) {
        $category_name = $_POST['category_name'];


        $sql_edit = "UPDATE `category` SET `category_name`='$category_name' WHERE `category_id`='$edit_id'";

        $result = mysqli_query($conn, $sql_edit);

        if (!$result) {
            echo "неверные данные";
        } else {
            header("Location: create_category.php");
        }
    }

}


?>

<h1>Редактировать:</h1>
<form action="edit_category.php?id=<?php echo $edit_id ?>" method="POST">
    <p>
        <input type="text" name="category_name" value="<?php echo $category_name_1 ?>"/>
    </p>
    <p>Характерстики:<br/>
        <select name="characteristic[]" multiple>
            <?php while ($row_list_all=mysqli_fetch_assoc($result_list_all)){?>
                <option value="<?php echo $row_list_all['characteristic_id']?>"
                <?php while ($row_select=mysqli_fetch_assoc($result_select)){

                    if ($row_select['characteristic_id']==$row_list_all['characteristic_id'])
                    {
                        echo "selected";
                        break;
                    }
                }?>
                ><?php echo $row_list_all['characteristic_name']?></option>
            <?php }
            ?>
        </select>
    </p>
    <p><input type="submit" value="Сохранить"></p>
</form>

