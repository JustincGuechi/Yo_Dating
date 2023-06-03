<?php
require_once('phpclass/head.php');
?>
<body>
<link rel="stylesheet" href="ressources/setting.css">
<?php
require_once('phpclass/menu.php');
?>
<div class="titre">
</div>
<div class="container">
    <?php
    if (isset($_SESSION['id'])) { ?>
        <div class="setting">
            <h2>Parametre</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" name="Image" accept=".jpg, .jpeg, .png">
                </div>
                <button type="submit" name="picture">Changer d'image</button>

            </form>
            <form method="post">
                <div class="input-group">
                    <input type="text" name="nom" placeholder="Nom" value="<?php echo $_SESSION['nom'] ?>">
                </div>
                <div class="input-group">
                    <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $_SESSION['prenom'] ?>">
                </div>
                <div class="input-group">
                    <input type="email" name="mail" placeholder="Adresse e-mail"
                           value="<?php echo $_SESSION['mail'] ?>">
                </div>
                <div class="input-group">
                    <input type="text" name="bio" placeholder="BIO" value="<?php echo $_SESSION['bio'] ?>">
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" name="setting">Modifier</button>
            </form>
        </div>
        <?php
        if (isset($_POST['setting'])) {
            $mail = htmlspecialchars($_POST['mail']);
            $mail = strtolower($mail);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $bio = htmlspecialchars($_POST['bio']);
            $id = $_SESSION['id'];
            $password = htmlspecialchars($_POST['password']);
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $check = $database->prepare("SELECT password FROM Etudiant WHERE id = '$id'");
                $check->execute();
                $result = $check->get_result();
                $data = $result->fetch_assoc();
                if (password_verify($password, $data['password'])) {
                    $check = $database->prepare("UPDATE etudiant SET nom = '$nom', prenom = '$prenom' 
                              , mail = '$mail' , description='$bio' WHERE id = '$id'");
                    $check->execute();
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['nom'] = $nom;
                    $_SESSION['bio'] = $bio;
                    $_SESSION['mail'] = $mail;
                    header('Location: profil.php?id=' . $_SESSION['id']);
                }
            }
        }
        if (isset($_POST['picture'])) {
            $target = "ressources/profil_image/";
            $name = $_FILES['Image']['name'];
            $targetf = $target . basename($name);
            if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetf)) {
                $check = $database->prepare("UPDATE etudiant SET photo = ? WHERE id = '{$_SESSION['id']}'");
                $check->execute(array($name));
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
    ?>
</div>
<?php
require_once('phpclass/foot.php');
?>
</body>
</html>