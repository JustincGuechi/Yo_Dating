<?php
require_once("sql_database.php");
$database = sql_database::log_database();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('/Users/maximeweber/vendor/autoload.php');
require('/Users/maximeweber/vendor/phpmailer/phpmailer/src/Exception.php');
require('/Users/maximeweber/vendor/phpmailer/phpmailer/src/PHPMailer.php');
require('/Users/maximeweber/vendor/phpmailer/phpmailer/src/SMTP.php');

class mailRecup
{

    public static function getHTML($database)
    {
        $html = <<<HTML
        <div class="mailRec">
        <p1>Saisir votre adresse mail</p1>
        <form method="post">
            <dl>
                <dt>
                    <input type="email" name="Mail" placeholder="Email" required>
                </dt>
                <dt class="Boutonc">
                    <button type="submit" name ="validation" >VALIDEZ</button>
                </dt>
            </dl>
        </form>
        </div>
    HTML;
        if (isset($_POST['validation'])) {

            $mail2 = htmlspecialchars($_POST['Mail']);

            $mail2 = strtolower($mail2);
            $mql = "SELECT count(*) as count FROM Etudiant WHERE mail = '$mail2'";
            $sql = mysqli_query($database, $mql);
            if ($sql != false) {
                $mailexists = mysqli_fetch_assoc($sql);
            }
            $dateActuelle = new DateTime();

            $dateActuelle->modify('+15 minutes');

            $dateFormatee = $dateActuelle->format('Y-m-d H:i:s');

            $hashmail = hash('sha256', $mail2);

            $mql1 = "UPDATE Etudiant SET token = '$hashmail' and expiration = '$dateFormatee' WHERE mail = ?";
            $sql1 = mysqli_query($database, $mql1);
            $redirect = 'http://localhost:8081/mdpPerdu.php?token=' . $hashmail;
            //Create an instance; passing `true` enables exceptions

            try {
                //Server settings
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '5223bd5c6ad480';
                $mail->Password = 'e5d46113d69a13';                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress($mail2);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Reinitialisation du MDP';
                $mail->Body = "<a href=$redirect>ICI</a>";

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            /*
            if ($mailexists["count"] > 0) {

            }
            */
        }
        return $html;
    }
}
