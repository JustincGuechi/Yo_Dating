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
                    $mailexists = mysqli_fetch_assoc(mysqli_query($database, "SELECT count(*) as count FROM user WHERE mail = '$mail'"));
                    if ($mailexists["count"] == 0) {
                        $sql = "INSERT INTO user (mail,nom,prenom, classe, mdp) 
                        VALUES ('$mail', '$nom', '$prenom', '$classe','$password')";
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
            $check = $database->prepare('SELECT nom, prenom, mail, mdp FROM user WHERE mail = ?');
            $check->execute(array($mail));
            $result = $check->get_result();
            $row = $result->num_rows;
            if($row > 0)
             {
                 $data = $result->fetch_assoc();
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    if(password_verify($password, $data['mdp']))
                    {
                        $_SESSION['user'] = array();
                        $_SESSION['user'][]=$data['nom'];
                        $_SESSION['user'][]=$data['prenom'];
                        $_SESSION['user'][]=$data['mail'];
                        echo "<script> alert('Login')</script>";
                        header('Location: index.php');
                        die();

                    }else{echo "<script> alert('password')</script>";}

                }else{echo "<script> alert('mail')</script>";}
             }else{echo "<script> alert('account')</script>";}


        }
    }
}
?>