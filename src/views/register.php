<div class="large-3 large-centered columns">
    <div class="login-box">
        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="index.php?controller=authentication&action=register&view=register">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Benutzername
                                <input type="text" name="userName" placeholder="Benutzername" required/>
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
                        <div class="large-12 columns">
                            <label>
                                Passwort wiederholen
                                <input type="password" name="passwordCheck" placeholder="Passwort" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Vorname
                                <input type="text" name="firstName" placeholder="Vorname" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                Nachname
                                <input type="text" name="lastName" placeholder="Nachname" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>
                                EMail Adresse
                                <input type="text" name="mail" placeholder="EMail Adresse" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <?php
                                $channels = $channelRepository->getChannels();
                                foreach ($channels as $channel){
                                    echo(' <input id="' . $channel->getId() . '" type="checkbox"><label for="' . $channel->getId() . '">' . $channel->getTitle() . '</label>');
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
                        <a href="index.php?view=login"> Zur&uuml;ck zum Login. </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>