<?php
    if(!AuthenticationManager::isAuthenticated()){
        Util::redirect("index.php?view=login");
    }
    $channelId = Util::readKeyFromRequest('channelId');
    if(isset($channelId)) {
        $channel = $channelRepository->getChannelForId($channelId);
        $comments = $commentRepository->getCommentsForChannel($channelId);
        $channelCreator = $userRepository->getUserForId($channel->getCreationUserId());
        $lastTimeChannelSeen = $channelRepository->getChannelLastSeenToCurrentTimeForUser($channelId, SessionContext::getCurrentUser());
        $channelRepository->setChannelLastSeenToCurrentTimeForUser($channelId, SessionContext::getCurrentUser());
        $editMode = Util::readKeyFromRequest('edit');

?>
        <div class="large-8 columns message-box">
                <?php
                    echo('<h1>' . $channel->getTitle() . ' erstellt von ' . $channelCreator->getUserName() . '</h1>');
                    echo('<p>' . $channel->getCreationDate() . '</p>');
                ?>
                <div class="messageBox">
                    <?php echo('<p class="message-content">' . $channel->getDescription() . '</p>'); ?>
                </div>
                <hr/>
                <?php
                    foreach($comments as $comment) {
                        include("partials/comment.php");
                    }
                ?>
        </div>
        <?php if($editMode){
            $commentId = Util::readKeyFromRequest('commentId');
            $comment = $commentRepository->getCommentById($commentId);
            ?>
            <div class="large-3 columns add-message-box">
                <form method="post" action="index.php?controller=channel&action=editComment&channelId=<?php echo $channelId?>&commentId=<?php echo $commentId?>">
                    <label>
                        <textarea style="width: 100%; height: 50px;" name="comment"><?php echo htmlentities($comment->getText()); ?></textarea>
                    </label>
                    <button type="submit" style="width: 100%;" class="button info">Speichern</button>
                </form>
            </div>
            <?php
        } else { ?>
        <div class="large-3 columns add-message-box">
            <form method="post" action="index.php?controller=channel&action=addComment&channelId=<?php echo $channelId?>">
                <label>
                    <textarea style="width: 100%; height: 50px;" name="comment"></textarea>
                </label>
                <button type="submit" style="width: 100%;" class="button info">Antworten</button>
            </form>
        </div>
            <?php
        }
    } else {
        $comments = $commentRepository->getAllFavoredComments();
        ?>
        <div class="large-9 columns message-box">
            <h1>Favoriten <i class="fa fa-star" style="color: #FC0"></i></h1>
            <hr/>
            <?php
                if(count($comments) === 0){
            ?>
                <div class="messageBox">
                    <p class="message-content">Es sind noch keine Favoriten vorhanden</p>
                </div>
            <?php
                }
                else {

                    foreach ($comments as $comment) {
                        $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
                        $channel = $channelRepository->getChannelForId($comment->getChannelId());
                        ?>
                        <div class="messageBox">
                            <p class="message-content"><?php echo($comment->getText());?></p>
                            <hr/>
                            <?php
                            if ($commentRepository->isCommentFavorite($comment->getId())) {
                                echo('<a href="index.php?controller=channel&action=removeFavorite&commentId=' . $comment->getId() . '"/><i class="fa fa-star"></i></a>');
                            } else {
                                echo('<a href="index.php?controller=channel&action=addFavorite&commentId=' . $comment->getId() . '"/><i class="fa fa-star-o"></i></a>');
                            }
                            ?>
                            <div class="message-footer"><span></span><?php echo($commentCreator->getUserName()); ?>
                                schrieb um <?php echo($comment->getCreationDate()); ?> im
                                Channel <?php echo($channel->getTitle()); ?> </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
<?php
    }
?>