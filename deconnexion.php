<?php

require_once('phpclass/head.php');
$status = "Offline now";
$sql = mysqli_query($database, "UPDATE etudiant SET status = '{$status}' WHERE id={$_SESSION['id']}");
session_destroy();
header('Location: index.php');
die();
?>