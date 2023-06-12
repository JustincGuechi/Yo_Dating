<?php

class sql_database
{
    public static function log_database(){
        $servername = "localhost";
        $username = "user";
        $password = "root";

        try {
            $con = mysqli_connect($servername, $username, $password, "yo_dating");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $con;
    }
}
?>