<?php

class login
{
    public static function getHTML(){
        $html = <<<HTML
        <div class="login">
            <h2>Connexion</h2>
            <form method="post">
                <div class="input-group">
                    <input type="email" name="mail"placeholder="Adresse e-mail" required>
                </div>
                <div class="input-group">
                    <input type="password" name="mdp" placeholder="Mot de passe" required>
                </div>
                <button type="submit" name="logsubmit">Connexion</button>
                <div class="forgot-password">
                    <img src="ressources/cle.png" width="20px"><a href="#">Mot de passe perdu ?</a>
                </div>
            </form>
        </div>
HTML;
        return $html;
    }
}
?>