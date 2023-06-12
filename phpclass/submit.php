<?php
        if (isset($_POST['signsubmit'])) {
            if ($_POST['mdp'] != $_POST['cmdp']) {
                echo "<script> alert('Les mdp doivent être les mêmes')</script>";
            } else {
                $mail = htmlspecialchars($_POST['mail']);
                $mail = strtolower($mail);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $classe = htmlspecialchars($_POST['classe']);
                $password = htmlspecialchars($_POST['mdp']);
                $cost = ['cost' => 12];
                $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $mql = "SELECT count(*) as count FROM etudiant WHERE mail = '$mail'";
                    $mailexists = mysqli_fetch_assoc(mysqli_query($database, $mql));
                    if ($mailexists["count"] == 0) {
                        $sql = "SELECT idAnneScolaire from anneescolaire where nom = '$classe'";
                        $rs = mysqli_query($database, $sql);
                        $row = mysqli_fetch_assoc($rs);
                        $classe = $row['idAnneScolaire'];
                        $date = date("d-m-Y");
                        $photo = htmlspecialchars('profil-vide.png');
                        $check = $database->prepare("INSERT INTO etudiant (mail,nom,prenom, password, idAnneScolaire, photo, dateIns)
                        VALUES ('$mail', '$nom', '$prenom','$password','$classe', '$photo', STR_TO_DATE('$date', '%d-%m-%Y²'))");
                        $check->execute();
                        require_once("notification.php");
                        $result = $check->get_result();
                    } else {
                        echo "<script> alert('Email existe déjà')</script>";
                    }
                }
            }
        }
        if(isset($_POST['logsubmit'])){
            $mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['mdp']);
            $mail = strtolower($mail);
            $check = $database->prepare('SELECT id, nom, prenom, mail, password, photo,description FROM etudiant WHERE mail = ?');
            $check->execute(array($mail));
            $result = $check->get_result();
            $row = $result->num_rows;
            if($row > 0)
             {
                 $data = $result->fetch_assoc();
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['nom'] = $data['nom'];
                        $_SESSION['prenom'] = $data['prenom'];
                        $_SESSION['mail'] = $data['mail'];
                        $_SESSION['photo'] = "ressources/profil_image/" . $data['photo'];
                        $_SESSION['bio'] = $data['description'];
                        header('Location: index.php');
                        $status = "Active now";
                        $sql = mysqli_query($database, "UPDATE etudiant SET status = '{$status}' WHERE id={$_SESSION['id']}");
                        die();

                    } else {
                        echo "<script> displayPopup('Mauvais mots de passe')</script>";
                    }

                } else {
                    echo "<script> displayPopup('Mauvais e-mail')</script>";
                }
             } else {
                echo "<script> displayPopup('Le compte n\'existe pas')</script>";
            }

}
?>