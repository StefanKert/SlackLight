<?php
    $userRepository = new UserRepository();
    $channelRepository = new ChannelRepository();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SlackLight</title>

        <link href="assets/foundation/css/foundation.min.css" rel="stylesheet">
        <link href="assets/foundation/css/normalize.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/main.css" rel="stylesheet">
    </head>
    <body>
    <?php
        if(AuthenticationManager::isAuthenticated()) {
            $user = AuthenticationManager::getAuthenticatedUser();
            if($user == null){
                AuthenticationManager::signOut();
                Util::redirect("index.php");
            }
            ?>
            <div class="user-label">
                Hi <?php echo $user->getFirstName() . " " .  $user->getLastName();  ?>!
                <a href="index.php?controller=authentication&action=logout"><i class="fa fa-sign-out"></i></a>
            </div>
            <?php
        } ?>
        <header>
            <h1>Slack Light - Version 1.0</h1>
        </header>
        <?php   if(AuthenticationManager::isAuthenticated()) {
                    $channelId = Util::readKeyFromRequest(ChannelController::CHANNEL_ID);
        ?>
        <div id="menu" class="row">
            <ul class="sub-nav">
                <li class="<?php if($channelId == null) echo 'active' ?>"><a href="index.php?view=main"/>Favoriten</a></li>
                <?php
                    $channels = $channelRepository->getChannelsForUser(SessionContext::getCurrentUser());
                    foreach ($channels as $channel){
                        ?>
                            <li class="<?php
                                    if($channel->getId() === $channelId)
                                        echo 'active';
                                ?>">
                                <a href="index.php?view=main&channelId=<?php echo $channel->getId()?>"/><?php
                                echo $channel->getTitle() . ' ';
                                if($channelRepository->hasChannelNewPostsForUser($channel->getId(), SessionContext::getCurrentUser())){
                                    echo "(Neue Antworten)";
                                }?>

                                </a>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <?php } ?>
    <div class="main">