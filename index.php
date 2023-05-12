<?php
    session_start();
    $WEBSITE = "Yo Dating";
    $OWNER = "Justin Guéchi";
    require_once ("phpclass/sql_database.php");
    $database = sql_database::log_database();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $WEBSITE; ?></title>
    <link rel="stylesheet" href="ressources/stylesheet.css">
    <link rel="stylesheet" href="ressources/logsign_style.css">
    <link rel="icon" href="">
</head>
<body>
<?php
        require_once('phpclass/menu.php');
        echo menu::getHTML();
?>
<div class="titre">
    <p>
        Bienvenue sur
        <?php echo $WEBSITE;
            if (isset($_SESSION['user'])) {
                echo " | Bienvenue : ID n°" . $_SESSION['user'][0] . " " . $_SESSION['user'][1] . " " . $_SESSION['user'][2];
            }
        ?>
    </p>
</div>
<div class="container">
    <?php
        require_once('phpclass/login.php');
        echo login::getHTML();
        require_once('phpclass/signup.php');
        echo signup::getHTML();
        require_once ('phpclass/submit.php');
        submit::submit($database);
    ?>
</div>
<?php
    require_once('phpclass/foot.php');
    echo foot::getHTML($OWNER, date("Y"));
?>
</body>
</html>
<?php

?>