<?php
session_start();
require_once("sql_database.php");
$database = sql_database::log_database();
$outgoing_id = $_SESSION['id'];

// Récupérer toutes les conversations liées à l'utilisateur
$sql = "SELECT c.* FROM conversation c 
        JOIN membre m ON c.id = m.idConversation 
        WHERE m.idMembre = {$_SESSION['id']} 
        ORDER BY c.DateDeCreation, c.id";
$query = mysqli_query($database, $sql);
$output = "";

if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} else {
    include_once('data.php');
}

echo $output;


?>

