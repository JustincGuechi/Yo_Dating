<?php
require_once("sql_database.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require('C:\xampp\composer\vendor\autoload.php');
require('C:\xampp\composer\vendor\phpmailer\phpmailer\src\Exception.php');
require('C:\xampp\composer\vendor\phpmailer\phpmailer\src\PHPMailer.php');
require('C:\xampp\composer\vendor\phpmailer\phpmailer\src\SMTP.php');

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
            $database = sql_database::log_database();
            $mail2 = htmlspecialchars($_POST['Mail']);
            $mail2 = strtolower($mail2);
            $mail3 = $mail2;
            $mql = "SELECT count(*) as count FROM Etudiant WHERE mail = '$mail2'";
            $sql = mysqli_query($database, $mql);
            $mailexists = mysqli_fetch_assoc($sql);
            if ($mailexists['count']) {
                $dateActuelle = new DateTime();

                $dateActuelle->modify('+15 minutes');

                $dateFormatee = $dateActuelle->format('Y-m-d H:i:s');

                $hashmail = hash('sha256', $mail2);

                $mql1 = "UPDATE Etudiant SET token = '$hashmail', dateFormatee = '$dateFormatee' WHERE mail = '$mail3'";
                $sql1 = mysqli_query($database, $mql1);
                $redirect = 'http://localhost:80/mdpPerdu.php?token=' . $hashmail;
            //Create an instance; passing `true` enables exceptions

            try {
                //Server settings
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '241c3f617b52a4';
                $mail->Password = '1c78cfe6aff50f';

                //Recipients
                $mail->setFrom('yo_Dating@gmail.com', 'Mailer');
                $mail->addAddress($mail2);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Reinitialisation du MDP';
                $htmlContent = file_get_contents('mail.html');
                $htmlContent = str_replace('href="#"', "href=$redirect", $htmlContent);
                $mail->Body = $htmlContent;


                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            }
        }
        return $html;
    }
}
