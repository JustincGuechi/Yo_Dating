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
    <?php
    if (!isset($_SESSION['user'])) {
        ?>
        <p>
            Bienvenue sur
            <?php echo $WEBSITE;
            ?>
        </p>
        <?php
    } elseif (isset($_GET['page'])) {
        if ($_GET['page'] == 'profil') {
            ?><p>
            <?php
            echo "Bienvenue : ID n°" . $_SESSION['user'][0] . " " . $_SESSION['user'][1] . " " . $_SESSION['user'][2];
            ?>
            </p>
            <?php
        }
    }
    ?>

</div>
<div class="container">

    <?php
    if (!isset($_SESSION['user'])) {
        require_once('phpclass/login.php');
        echo login::getHTML();
        require_once('phpclass/signup.php');
        echo signup::getHTML();
        require_once('phpclass/submit.php');
        submit::submit($database);
    } else {
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'profil') {
                require_once('phpclass/profil_image.php');
                echo profil_image::getPhoto();
            }
        }
    }
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