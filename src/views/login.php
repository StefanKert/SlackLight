<?php
    if(AuthenticationManager::isAuthenticated()){
        Util::redirect("index.php?view=main");
    }
?>

<div class="large-3 large-centered columns">
    <div class="login-box">
        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="index.php?controller=authentication&action=login">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Benutzername
                                <input type="text" name="username" placeholder="Benutzername" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Passwort
                                <input type="password" name="password" placeholder="Passwort" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <?php include("views/partials/errors.php"); ?>
                    </div>
                    <div class="row">
                        <div class="large-12 large-centered columns">
                            <input type="submit" class="button expand" value="Login"/>
                        </div>
                    </div>
                    <p>
                        Haben Sie noch keinen Benutzer? Dann vergeuden Sie keine weitere Sekunde ohne Slack Light
                        und    <a href="index.php?view=register"> Registrieren </a> Sie sich jetzt!
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>