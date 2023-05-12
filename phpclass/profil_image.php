<?php

class profil_image
{
    public static function getPhoto()
    {
        $html = null;
        if (isset($_SESSION['user'])) {
            $html = '<img src="' . $_SESSION['user'][4] . '"alt="LogoEseo" width="100px">';
        }
        return $html;
    }
}