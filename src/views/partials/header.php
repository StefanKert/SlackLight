<?php
    $userRepository = new UserRepository();
    $channelRepository = new ChannelRepository();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SCM4 Bootstrap</title>

        <link href="assets/foundation/css/foundation.min.css" rel="stylesheet">
        <link href="assets/foundation/css/normalize.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/main.css" rel="stylesheet">
    </head>
    <body>
        <?php   if(AuthenticationManager::isAuthenticated()) { ?>
        <a class="logout-button button tiny secondary" href="index.php?controller=authentication&action=logout">Logout</a>
        <?php } ?>
        <header>
            <h1>Slack Light - Version 1.0</h1>
            <?php   if(AuthenticationManager::isAuthenticated()) {
                $user = AuthenticationManager::getAuthenticatedUser();
                if($user == null){
                    AuthenticationManager::signOut();
                    Util::redirect("index.php");
                }
                echo("<p>Hi ". $user->getFirstName() . " " .  $user->getLastName() .  "!</p>");
        } ?>
        </header>
        <?php   if(AuthenticationManager::isAuthenticated()) { ?>
        <div id="menu" class="row">
            <ul class="sub-nav">
                <li><a href="index.php?view=main"/>Favoriten</a></li>
                <?php
                    $channels = $channelRepository->getChannelsForUser($_SESSION['user']);
                    foreach ($channels as $channel){
                        echo('<li><a href="index.php?view=main&channelId='. $channel->getId() .'"/>' .  $channel->getTitle() . '(' .$channelRepository->getCountOfNewPosts($channel->getId()) . ')</a></li>');
                    }
                ?>
            </ul>
        </div>
        <?php } ?>
    <div class="main">