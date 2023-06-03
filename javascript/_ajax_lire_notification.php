<?php
session_start();
require_once("../phpclass/sql_database.php");
$database = sql_database::log_database();
$database->query("UPDATE Notification SET statutLecture = 'oui' 
                WHERE idNotification  = '" . (int)$_POST['idNotification'] . "' AND receveur = '" . $_SESSION['id'] . "'");
?>