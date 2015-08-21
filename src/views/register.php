<?php
    $userName =  Util::readKeyFromRequest(AuthenticationController::USER_NAME);
    $firstName =  Util::readKeyFromRequest(AuthenticationController::FIRST_NAME);
    $lastName =  Util::readKeyFromRequest(AuthenticationController::LAST_NAME);
    $mail =  Util::readKeyFromRequest(AuthenticationController::MAIL);
    $channels = $channelRepository->getChannels();
?>
<div class="large-3 large-centered columns">
    <div class="login-box">
        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="<?php echo Util::generateUrl('index.php', 'register', 'authentication', 'register') ?>">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Benutzername
                                <input type="text" name="<?php echo AuthenticationController::USER_NAME; ?>" value="<?php echo htmlentities($userName); ?>" placeholder="Benutzername" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Passwort
                                <input type="password" name="<?php echo AuthenticationController::PASSWORD; ?>"  placeholder="Passwort" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Passwort wiederholen
                                <input type="password" name="<?php echo AuthenticationController::PASSWORD_CHECK; ?>"  placeholder="Passwort" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Vorname
                                <input type="text" name="<?php echo AuthenticationController::FIRST_NAME; ?>" value="<?php echo htmlentities($firstName); ?>" placeholder="Vorname" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Nachname
                                <input type="text" name="<?php echo AuthenticationController::LAST_NAME; ?>" value="<?php echo htmlentities($lastName); ?>" placeholder="Nachname" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                EMail Adresse
                                <input type="email" name="<?php echo AuthenticationController::MAIL; ?>" value="<?php echo htmlentities($mail); ?>" placeholder="EMail Adresse" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <?php
                            foreach ($channels as $channel){
                                echo('<input id="' . $channel->getId() . '" value="' . htmlentities($channel->getId()) .'" name="' . AuthenticationController::CHANNELS . '[]" type="checkbox"/><label for="' . $channel->getId() . '">' . $channel->getTitle() . '</label>');
                            }
                            ?>
                        </div>
                    </div>
                    <?php include("views/partials/errors.php"); ?>
                    <div class="row">
                        <div class="large-12 large-centered columns">
                            <input type="submit" class="button expand" value="Registrieren"/>
                        </div>
                    </div>
                    <p>
                        <a href="<?php echo Util::generateUrl('index.php', 'login') ?>"> Zur&uuml;ck zum Login. </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>