<?php
require_once('phpclass/head.php');
$check = $database->prepare('SELECT id, nom, prenom, mail, photo, status, description FROM Etudiant WHERE id = ?');
$check->execute(array($_GET['id']));
$result = $check->get_result();
$row = $result->num_rows;
if ($row > 0) {
    $data = $result->fetch_assoc();
    $photo = "ressources/profil_image/" . $data['photo'];
}
?>
<body>
<link rel="stylesheet" href="style.css">
<?php
require_once('phpclass/menu.php');
?>
<div class="container">
    <?php ($data['status'] == "Offline now") ? $status = "#EE2C2CFF" : $status = "#2CDC26FF"; ?>
    <div class="PhotoRonde" style="border: 5px solid <?php echo $status ?>">
        <?php
        require_once('phpclass/profil_image.php');
        echo profil_image::image($photo)
        ?>
    </div>

    <div class="ListeNom">
        <dt class="TitreNom">
            <p1>Nom : <?php echo $data['nom'] ?></p1>
        </dt>
        <dt class="TitrePrenom">
            <p1>Prénom : <?php echo $data['prenom'] ?></p1>
        </dt>
    </div>

    <div class="listeDescrpiton">
        <dt class="description">
            <p3>description :</p3>
        </dt>
    </div>
    <dt class="texte"><p>Bio : <?php echo $data['description'] ?></p></dt>

    <div class="centrerlesblocs">
        <dt class="TitreMail">
            <p1><?php echo $data['mail'] ?> </p1>
        </dt>
        <?php if ($_SESSION['id'] == $_GET['id']) { ?>
            <div class="modifier">
                <dt class="mmmm"><a href="setting.php">Modifier</a></dt>
            </div>
        <?php } ?>
    </div>
</div>
<?php
require_once('phpclass/foot.php');
?>
</body>
</html>