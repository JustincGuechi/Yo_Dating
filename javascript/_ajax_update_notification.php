<?php
if ($nb_notifications) {
    while ($notifications = $query_notifications->fetch_object()) {
        // récupération des informations de l'emmeteur
        $query_emetteur = $mysqli->query("SELECT * FROM Etudiant WHERE idEtu = '$notifications->idEmetteur'");
        $nb_emetteur = $query_ emetteur->num_rows;
        if ($nb_emetteur)
            $emetteur = $query_emetteur->fetch_object();
        else
            $emetteur = false;?>
    <div onmouseover="lireNotif(<?php echo $notifications->idNotification ?>);
        " class="alert alert-info p-2 mb-2 align-items-center d-flex notif" id="notif_
        <?php echo $notifications->idNotification ?>">
        <a class="p-0 mr-2" href="<?php echo $_SITE_URL ?>profilePublic.php?idEtu=<?php echo $emetteur->idEtu ?>">
            <?php
                if (isset($emetteur->photo)) {
                    ?>
                    <img class="img-fluid" src="<?php echo 'img/profiles/' . $emetteur->photo; ?>" width="30" />
                <?php } else { ?>
                    <img class="img-fluid" src="<?php echo 'img/profiles/default-picture.png'; ?>" />
                <?php } // if photo  ?>
    </a>
        <small>
            <?php echo ucfirst($emetteur->nom) . ' ' . ucfirst($emetteur->prenom) ?> - <?php echo $notifications->type ?>
        </small>
        <i onclick="deleteNotif(<?php echo $notifications->idNotification ?>);" title="Supprimer la notification" class="rounded p-1 pointer absolute  far fa-trash-alt" style="right:0;top:0;">
        </i>
        </div><?php} // while
    } // if notifications
else {?>
    <p class="text-center my-3">Aucunes notifications</p>
<?php } // else notifications ?>
