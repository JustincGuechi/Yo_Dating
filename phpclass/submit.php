<?php

class submit
{
    public static function submit($database){
        if (isset($_POST['signsubmit'])) {
            if ($_POST['mdp'] != $_POST['cmdp']) {
                echo "<script> alert('Les mdp doivent être les mêmes')</script>";
            } else {
                $mail = htmlspecialchars($_POST['mail']);
                $mail = strtolower($mail);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $classe = htmlspecialchars($_POST['classe']);
                $cost = ['cost' => 12];
                $password = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_BCRYPT, $cost);
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $mql = "SELECT count(*) as count FROM Etudiant WHERE mail = '$mail'";
                    $mailexists = mysqli_fetch_assoc(mysqli_query($database, $mql));
                    if ($mailexists["count"] == 0) {
                        $sql = "SELECT idAnneScolaire from AnneeScolaire where nom = '$classe'";
                        $rs = mysqli_query($database, $sql);
                        $row = mysqli_fetch_assoc($rs);
                        $classe = $row['idAnneScolaire'];
                        $date = date("d-m-Y");
                        $photo = htmlspecialchars('profil-vide.png');
                        $sql = "INSERT INTO Etudiant (mail,nom,prenom, password, idAnneScolaire, photo, dateIns)
                        VALUES ('$mail', '$nom', '$prenom','$password','$classe', '$photo', STR_TO_DATE('$date', '%d-%m-%Y'))";
                        try {
                            $rs = mysqli_query($database, $sql);
                        } catch (PDOException $e) {
                            echo "Connection failed: " . $e->getMessage();
                        }
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
            $check = $database->prepare('SELECT id, nom, prenom, mail, password, photo FROM Etudiant WHERE mail = ?');
            $check->execute(array($mail));
            $result = $check->get_result();
            $row = $result->num_rows;
            if($row > 0)
             {
                 $data = $result->fetch_assoc();
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['user'] = array();
                        $_SESSION['user'][] = $data['id'];
                        $_SESSION['user'][] = $data['nom'];
                        $_SESSION['user'][] = $data['prenom'];
                        $_SESSION['user'][] = $data['mail'];
                        $_SESSION['user'][] = "ressources/profil_image/" . $data['photo'];
                        header('Location: index.php');
                        die();

                    }else{echo "<script> alert('password')</script>";}

                }else{echo "<script> alert('mail')</script>";}
             }else{echo "<script> alert('account')</script>";}


        }
    }
}
?>