<?php
    if(AuthenticationManager::isAuthenticated()){
        Util::redirect(Util::generateUrl('index.php', 'main'));
    }
?>

<div class="large-3 large-centered columns">
    <div class="login-box">
        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="<?php echo Util::generateUrl('index.php', null, 'authentication', 'login') ?>">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Benutzername
                                <input type="text" name="<?php echo AuthenticationController::USER_NAME; ?>" placeholder="Benutzername" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Passwort
                                <input type="password" name="<?php echo AuthenticationController::PASSWORD; ?>" placeholder="Passwort" required/>
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
                        und    <a href="<?php echo Util::generateUrl('index.php', 'register') ?>"> Registrieren </a> Sie sich jetzt!
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>