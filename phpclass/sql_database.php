<?php

class sql_database
{
    public static function log_database(){
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $con = mysqli_connect($servername, $username, $password, "Yo_Dating");
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $con;
    }
}
?>