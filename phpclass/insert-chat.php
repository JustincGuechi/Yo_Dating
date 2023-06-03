<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once("sql_database.php");
    $database = sql_database::log_database();
    $outgoing_id = $_SESSION['id'];
    $incoming_id = mysqli_real_escape_string($database, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($database, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($database, "INSERT INTO message (contenu, contient, emetteur)
                                        VALUES ('$message','$incoming_id', '$outgoing_id')") or die();
    }
} else {
    header("location: ../login.php");
}
?>