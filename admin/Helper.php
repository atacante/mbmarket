<?php


class Helper
{

    public static function mysql_to_array ($sql){

        require_once 'db_connection.php';

        $result_list = mysqli_query($conn, $sql);


        $list_category = [];

        while ($row_int = mysqli_fetch_assoc($result_list))
        {
            $list_category [] = $row_int;
        }

        return $list_category;
    }
}