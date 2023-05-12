<?php

class login
{
    public static function getHTML(){
        $html = '<div class="login">';
        $html .= '<h2>Connexion</h2>';
        require_once('profil_image.php');
        $html .= profil_image::getPhoto();
        $html .= '<form method="post">';
        $html .= '<div class="input-group">';
        $html .= '<input type="email" name="mail"placeholder="Adresse e-mail" required>';
        $html .= '</div>';
        $html .= '<div class="input-group">';
        $html .= '<input type="password" name="mdp" placeholder="Mot de passe" required>';
        $html .= '</div>';
        $html .= '<button type="submit" name="logsubmit">Connexion</button>';
        $html .= '<div class="forgot-password">';
        $html .= '<img src="ressources/cle.png" width="20px"><a href="#">Mot de passe perdu ?</a>';
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';

        return $html;
    }
}
?>