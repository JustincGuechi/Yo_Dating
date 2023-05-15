<?php
$mysqli->query("UPDATE Notification SET statutLecture = 'oui'WHEREidNotification  = '" . (int)$_POST['idNotification'] . "'ANDidEtudiant    = '".$_SESSION['compte']."'");
?>