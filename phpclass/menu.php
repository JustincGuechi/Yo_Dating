<?php

class menu
{
    public static function GetHtml(){
            $html = '<header>';
            $html.='<nav>';
            $html.='<div class="logo">';
            $html.='<img src="ressources/eseo.png" alt="LogoEseo">' ;
            $html.='</div>';
            $html.='<ul>';
            $html.='<li><a href="#" class="menu">Accueil</a></li>';
            $html.='<li><a href="#" class="menu">Etudiant</a></li>';
            $html.='</ul>';
            $html.='</nav>';
        if (isset($_SESSION['user'])) {

            $html .= '<div class="session-menu">';
            $html .= '<a href="#">Session</a>';
            $html .= '<ul>';
            $html .= '<li><a href="#">Mon compte</a></li>';
            $html .= '<li><a href="deconnexion.php">Déconnexion</a></li>';
            $html .= '</ul>';
            $html .= '</div>';
        }
            $html.='</header>';


    return $html;
    }
}

?>
