<?php
session_start();

if (isset($_POST['id'])) {
    $conversationId = $_POST['id'];
    $_SESSION['conv'] = $conversationId;
} else {
    echo 'Erreur : ID de conversation manquant';
}
?>
