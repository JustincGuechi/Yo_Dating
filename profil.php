<?php
session_start();
$WEBSITE = "Yo Dating";
$OWNER = "Justin GUECHI";
require_once('phpclass/sql_database.php');
$database = sql_database::log_database();
if (!isset($_SESSION['user'])) {
    header('Location : index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $WEBSITE; ?></title>
    <link rel="stylesheet" href="ressources/stylesheet.css">
    <link rel="stylesheet" href="ressources/profil_style.css">
    <link rel="icon" href="">
</head>
<body>
<?php
require_once('phpclass/menu.php');
echo menu::GetHtml();
?>
<div class="container">
    <div class="profil">
        <div class="image_profil">
            <img src="ressources/profil_image/WIN_20230511_19_46_21_Pro.jpg">
        </div>
        <div class="head_profil">
            <div class="titre">
                <h1 class="titre">Profil</h1>
            </div>
            <div class="pseudo">
                <p>
                    <?php
                    echo $_SESSION['user'][0] . " " . $_SESSION['user'][1];
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
require_once('phpclass/foot.php');
echo foot::GetHtml($OWNER, Date('Y'));
?>
</body>
</html>

