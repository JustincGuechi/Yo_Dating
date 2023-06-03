<?php

class profil_image
{
    public static function image($data)
    {
        if (isset($_SESSION['id'])) {
            $html = '<link rel="stylesheet" href="ressources/profil_style.css">';
            $html .= '<img class="photo2profile" src="' . $data . '" alt="Image de Profil">';
            return $html;
        }
    }
}