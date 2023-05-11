<?php

class foot
{
    public static function GetHtml($OWNER, $YEAR){
        $html= <<<HTML
    <footer>
        <div class="footer-content">
            <div class="commercial">
                <h3>&copy; $YEAR - $OWNER -</h3>
            </div>
            <div class="text">
                <p> Tous droits réservés </p>
            </div>
        </div>
    </footer>
HTML;
    return $html;
    }
}
?>