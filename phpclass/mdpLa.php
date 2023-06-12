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
                    $database = sql_database::log_database();
                    $mdp = htmlspecialchars($_POST['mdp']);
                    $token = $_GET['token'];

                    $cost = ['cost' => 12];
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);

                    $mql = "SELECT id FROM Etudiant dateExpiration WHERE token = '$token' ";
                    $sql = mysqli_query($database, $mql);
                    $result1 = mysqli_fetch_assoc($sql);
                    $row = mysqli_num_rows($sql);
                    $dateActuelle = new DateTime();
                    $dateFormatee = $dateActuelle->format('Y-m-d H:i:s');
                    if (isset($result1)) {
                        if ($row > 0) {
                            if ($result1 > $dateFormatee) {
                                $check = $database->prepare("UPDATE Etudiant SET password = '$mdp' WHERE token = '$token'");
                                $check->execute();

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