<?php
$id_compte = $database->insert_id;
$dateActuelle = new DateTime();
$_DATE_TIME = $dateActuelle->format('Y-m-d H:i:s');
if ($id_compte != null) {
    echo "<script> alert('id_compte '.$id_compte)</script>";
    ////////////// DEBUT NOTIFICATION //////////////// envoie d'une notification à tout les utilisateur sauf le nouvel inscrit
    $query_etudiants = $database->prepare("SELECT id FROM etudiant WHERE id != '$id_compte'");
    $query_etudiants->execute();
    $result = $query_etudiants->get_result();
    while ($etudiants = $result->fetch_assoc()) {
        $database->query("INSERT INTO notification SET receveur = '" . $etudiants['id'] . "' , 
        type = 'nouveau compte', dateAjout = '$_DATE_TIME', emetteur = '$id_compte', autosuppression='non', statutLecture='non', statutSuppression='non'");
    }////////////// FIN NOTIFICATION //////////////
    $_SESSION['id'] = $id_compte;
} else {
    echo "<script> alert('id_compte'.$id_compte)</script>";
}
?>