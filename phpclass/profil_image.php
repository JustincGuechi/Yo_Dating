<?php

class profil_image
{
    public static function getPhoto()
    {
        $html = null;
        if (isset($_SESSION['user'])) {
            $html = '<link rel="stylesheet" href="ressources/profil_style.css">';
            $html .= '<img class="image_profil" src="' . $_SESSION['user'][4] . '" alt="Image de Profil">';
        }
        return $html;
    }
}