<?php
$mysqli->query("UPDATE Notification SET statutSupression = 'oui' WHEREidNotification  = '" .(int)$_POST['idNotification'] . "' AND idEtudiant = '".$_SESSION['compte']."'");
?>