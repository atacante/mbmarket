<?php

require_once("db_connection.php");

class Helper
{
    private $conn;
    private static $instance;


    public static function getInstance()
    {
        if (self::$instance === null) {
            return new self;
        } else {
            return self::$instance;
        }
    }

    private function __construct()
    {
        $this->setConnection();
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    private function setConnection()
    {

// Create connection
        $this->conn = mysqli_connect(Config::SERVERNAME, Config::USERNAME, Config::PASSWORD, Config::DBNAME);

// Check connection
        if (!$this->conn) {
            echo "Connection failed: " . mysqli_connect_error();
            return false;
        } else {
            return true;
        }
    }


    public function mysqlListToArray($sql)
    {


        $result_list = mysqli_query($this->conn, $sql);


        $list_category = [];

        while ($row_int = mysqli_fetch_assoc($result_list)) {
            $list_category [] = $row_int;

            /*
            [
                0=>[
                    'brand_id'=>1, 'brand_name' => 'Vasya'
                ],
                1=>[
                    'brand_id'=>2, 'brand_name' => 'Petya'
                ],

            ]; */
        }

        return $list_category;
    }

    public function mysqlChange($sql)
    {


        $result_insert = mysqli_query($this->conn, $sql);

        if (!$result_insert){
            echo "Ошибка: изменения не применены";
            return false;
        } else {
            return true;
        }

    }
}