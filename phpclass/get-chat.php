<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once("sql_database.php");
    $database = sql_database::log_database();
    $outgoing_id = $_SESSION['id'];
    $output = "";
    $sql = "SELECT * FROM message m 
                JOIN conversation c ON m.contient = c.id
                WHERE c.id={$_SESSION['conv']} ORDER BY m.id";
    $query = mysqli_query($database, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $sql2 = "SELECT photo FROM etudiant e
                WHERE e.id={$row['emetteur']}";
            $query2 = mysqli_query($database, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            if ($row['emetteur'] == $_SESSION['id']) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['contenu'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="ressources/profil_image/' . $row2['photo'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['contenu'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}

?>