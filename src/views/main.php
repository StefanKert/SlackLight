<?php
    if(!AuthenticationManager::isAuthenticated()){
        Util::redirect(Util::generateUrl('index.php', 'login'));
    }
    $channelId = Util::readKeyFromRequest(ChannelController::CHANNEL_ID);
    if(isset($channelId)) {
        $channel = $channelRepository->getChannelForId($channelId);
        $comments = $commentRepository->getCommentsForChannel($channelId);
        $channelCreator = $userRepository->getUserForId($channel->getCreationUserId());
        $lastTimeChannelSeen = $channelRepository->getChannelLastSeenToCurrentTimeForUser($channelId, SessionContext::getCurrentUser());
        $channelRepository->setChannelLastSeenToCurrentTimeForUser($channelId, SessionContext::getCurrentUser());
        $editMode = Util::readKeyFromRequest(ChannelController::EDIT_MODE);
?>
        <?php
        if($editMode){
            $commentId = Util::readKeyFromRequest(ChannelController::COMMENT_ID);
            $comment = $commentRepository->getCommentById($commentId);
            ?>
            <div class="add-message-box">
                <form method="post" action="<?php echo Util::generateUrl('index.php', null, 'channel', 'editComment', array('channelId' => $channelId, 'commentId' => $commentId)) ?>">
                    <label>
                        <textarea style="width: 700px; min-width: 700px; max-width: 700px; height: 120px;" name="comment" placeholder="Geben Sie den editierten Text ein."><?php echo Util::escape($comment->getText()); ?></textarea>
                    </label>
                    <button type="submit" style="width: 700px;" class="button info">Speichern</button>
                </form>
            </div>
        <?php }
        else { ?>
            <div class="add-message-box">
                <form method="post" action="<?php echo Util::generateUrl('index.php', null, 'channel', 'addComment', array('channelId' => $channelId)) ?>">
                    <label>
                        <textarea style="width: 700px; min-width: 700px; max-width: 700px; height: 120px;" name="comment" placeholder="Neue Antwort......"></textarea>
                    </label>
                    <button type="submit" style="width: 700px;" class="button info">Antworten</button>
                </form>
            </div>
        <?php }?>
        <div class="large-12 columns channel-view">
            <div class="large-6 columns">
                <h3><?php echo $channel->getTitle() ?> erstellt von <?php echo $channelCreator->getUserName() ?> am <?php echo date("d.m.Y", strtotime($channel->getCreationDate())) ?></h3>
                <div class="messageBox">
                    <p class="message-content"><?php echo $channel->getDescription() ?></p>
                </div>
            </div>
            <div class="small-12 columns comments" id="comments">
                <?php
                if(count($comments) === 0){ ?>
                    <div class="messageBox">
                        <p class="message-content">F&uuml;r denn Channel sind keine Antworten vorhanden.</p>
                    </div>
                <?php }
                else {
                    foreach ($comments as $comment) {
                        include("partials/comment.php");
                    }
                }
                ?>
            </div>
        </div>
   <?php } else {
        ?>
        <div class="large-12 columns channel-view">
            <div class="large-6 columns">
                <h3>Favoriten <i class="fa fa-star" style="color: #FC0"></i></h3>
            </div>
            <div class="small-12 columns comments">
                <?php
                $channels = $channelRepository->getChannelsForUser(SessionContext::getCurrentUser());
                foreach($channels as $channel) {
                    echo("<h3>" . $channel->getTitle() . "</h3>");
                    $channelId = $channel->getId();
                    $comments = $commentRepository->getAllFavoredCommentsForUserByChannel(SessionContext::getCurrentUser(), $channel->getId());
                    if(count($comments) === 0){ ?>
                        <div class="messageBox">
                            <p class="message-content">F&uuml;r denn Channel sind keine Favoriten vorhanden.</p>
                        </div>
                    <?php }
                    else{
                        foreach ($comments as $comment) {
                            $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
                            $channel = $channelRepository->getChannelForId($comment->getChannelId());
                            include("partials/comment.php");
                        }
                    }
                }
                ?>
            </div>
        </div>
<?php
    }
?>
<script src="assets/jquery-1.11.2.min.js"></script>
<script>
    $("#comments").animate({ scrollTop: $('#comments')[0].scrollHeight}, 1000);
</script>
