<?php
require_once("sql_database.php");


class mdpLa
{
    public static function getHTML()
    {
        $html = <<<HTML
        <div class="mdperdu">
        <p1>Mot de passe perdu</p1>
        <form method="post">
            <dl>
                <dt>
                    <input type="password" name="mdp" placeholder="Nouveau Mot De Passe" required>
                </dt>
                <dt>
                    <input type="password" name="mdpconfirm" placeholder="Confirmez Nouveau Mot De Passe" required>
                </dt>
                <dt class="Boutonc">
                    <button type="submit" name ="changepass" >VALIDEZ</button>
                </dt>

            </dl>
        </form>
        </div>
    HTML;
        if (isset($_POST['changepass'])) {
            if (isset($_POST['mdp']) && isset($_POST['mdpconfirm'])) {
                if ($_POST['mdp'] == $_POST['mdpconfirm']) {
                    $mdp = $_POST['mdp'];
                    $token = $_GET['token'];

                    $database = sql_database::log_database();

                    $mql = "SELECT Etudiant dateExpiration WHERE token = ? ";
                    $sql = mysqli_query($database, $mql);
                    if ($sql != false) {
                        $result1 = mysqli_fetch_assoc($sql);
                    }

                    $dateActuelle = new DateTime();
                    $dateFormatee = $dateActuelle->format('Y-m-d H:i:s');
                    if (isset($result1)) {
                        if ($result1["count"] > 0) {
                            if ($result1 > $dateFormatee) {
                                $check = $database->prepare("UPDATE Etudiant SET password = '$mdp' WHERE token = '$token'");
                                $check->execute(array($token));

                                header('Location: index.php');
                                die();
                            }
                        }
                    }
                }
            }
        }
        return $html;
    }
}