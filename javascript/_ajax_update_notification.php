<?php
session_start();
require_once("../phpclass/sql_database.php");
$database = sql_database::log_database();
if (!empty($_SESSION['id'])) {
$query_notifications = $database->query("SELECT * FROM Notification WHERE receveur = '" . $_SESSION['id'] . "' AND autosuppression='non' AND statutLecture ='non' ");
$nb_notifications = $query_notifications->num_rows;
?><label class="nb_notification"><?php echo $nb_notifications ?></label>
<div class="session-menu">

    <a href="#">Menu</a>

    <ul class="navbar-nav ml-auto">
        <li>
            <div id="containerNotif">
                <div>
                    <?php
                    if ($nb_notifications) {
                        while ($notifications = $query_notifications->fetch_object()) {
                            $query_emetteur = $database->query("SELECT * FROM Etudiant WHERE id = '$notifications->emetteur'");
                            $nb_emetteur = $query_emetteur->num_rows;
                            if ($nb_emetteur)
                                $emetteur = $query_emetteur->fetch_object();
                            else
                                $emetteur = false;
                            ?>
                            <div onmouseover="lireNotif(<?php echo $notifications->idNotification ?>);"
                                 class="alert alert-info p-2 mb-2 align-items-center d-flex notif"
                                 id="notif_<?php echo $notifications->idNotification ?>">
                                <a href="profil.php?id=<?php echo $emetteur->id ?>">
                                    <?php
                                    if ($emetteur->photo) {
                                        ?>
                                        <img src="ressources/profil_image/<?php echo $emetteur->photo; ?>" width="30"/>
                                    <?php } else { ?><img src="ressources/profil_image/profil-vide.png'; ?>"/>
                                    <?php } ?>
                                    <small>
                                        <?php echo ucfirst($emetteur->nom) . ' ' . ucfirst($emetteur->prenom) ?>
                                        - <?php echo $notifications->type ?>
                                    </small>
                                </a>
                                <img src="ressources/signe-de-la-croix.png" width="10"
                                     onclick="deleteNotif(<?php echo $notifications->idNotification ?>);" id="Suppr"
                                     title="Supprimer la notification" style="right:0;top:0;">
                            </div>
                            <?php
                        }
                    } else {
                        ?><p>Aucunes notifications</p>
                    <?php }
                    ?>
                </div>
            </div>
        </li>

        <div>
            <li><a href="profil.php?id=<?php echo $_SESSION['id'] ?>"><i class="fas fa-user-circle"></i> Mon profil</a>
            </li>
            <li><a class="dropdown-item rounded waves-effect waves-light btn-primary mb-0" href="deconnexion.php">Deconnexion
                    <i class="fas fa-sign-out-alt"></i>
                </a></li>
        </div>

    </ul>
    <?php } ?>
</div>
