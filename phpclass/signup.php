<?php
class signup
{
    public static function getHTML()
    {
        $html = <<<HTML
        <div class="signup">
            <h2>Inscription</h2>
            <form method="post">
                <div class="input-group">
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="input-group">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="input-group" >
                    <label>Année Scolaire</label>
                    <select class="classe" name="classe" required>
                        <optgroup label="Année Scolaire">
                            <option>E1</option> 
                            <option>E2</option>
                            <option>E3e</option>
                            <option>E4e</option>
                            <option>E5e</option>
                        </optgroup>
                    </select>
                </div>
                <div class="input-group">
                    <input type="email" name="mail" placeholder="Adresse e-mail" required>
                </div>
                <div class="input-group">
                    <input type="password" name="mdp" placeholder="Mot de passe" required>
                </div>
                <div class="input-group">
                    <input type="password"  name="cmdp" placeholder="Confirmer le Mot de passe" required>
                </div>
                <button type="submit" name="signsubmit">Inscription</button>
            </form>
        </div>
HTML;

        return $html;
        }
    }
?>