<?php
    if(!AuthenticationManager::isAuthenticated()){
        Util::redirect("index.php?view=login");
    }

    $channelRepository = new ChannelRepository();
    $userRepository = new UserRepository();
    $commentRepository = new CommentRepository();
    $channelId = isset($_GET["channelId"]) ? $_GET["channelId"] : null;
    if(isset($channelId)) {
        $channel = $channelRepository->getChannelForId($channelId);
        $comments = $commentRepository->getCommentsForChannel($channelId);
        $channelCreator = $userRepository->getUserForId($channel->getCreationUserId());
        $lastTimeChannelSeen = $channelRepository->getChannelLastSeenToCurrentTime($channelId);
        $channelRepository->setChannelLastSeenToCurrentTime($channelId);

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
                        $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
                ?>
                        <div class="messageBox">
                            <div class="row">
                                <div class="large-6 large-offset-11 columns">
                                <?php

                                    if($lastTimeChannelSeen == null || strtotime($lastTimeChannelSeen) < strtotime($comment->getCreationDate())){
                                        echo "NEUER POST";
                                    }

                                if($commentRepository->isCommentFavorite($comment->getId())){
                                    echo('<a href="index.php?controller=channel&action=removeFavorite&channelId=' . $channelId . '&commentId=' . $comment->getId() .'"/><i class="fa fa-star"></i></a>');
                                }
                                else{
                                    echo('<a href="index.php?controller=channel&action=addFavorite&channelId=' . $channelId . '&commentId=' . $comment->getId() .'"/><i class="fa fa-star-o"></i></a>');
                                }
                                ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-6 columns">
                                    <?php echo($comment->getText());?>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="large-6 columns">
                                    <span></span><?php echo($commentCreator->getUserName()); ?> schrieb um <?php echo($comment->getCreationDate()); ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
        </div>
        <div class="large-3 columns add-message-box">
            <form method="post" action="index.php?controller=channel&action=addComment&channelId=<?php echo $channelId?>">
                <label>
                    <textarea style="width: 100%; height: 50px;" name="comment"></textarea>
                </label>
                <button type="submit" style="width: 100%;" class="button info">Antworten</button>
            </form>
        </div>
        <?php
    } else {
        $comments = $commentRepository->getAllFavoredComments();
        ?>
        <div class="large-9 columns message-box">
            <h1>Favoriten <i class="fa fa-star" style="color: #FC0"></i></h1>
            <hr/>
            <?php
                foreach($comments as $comment) {
                    $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
                    $channel = $channelRepository->getChannelForId($comment->getChannelId());
            ?>
                <div class="messageBox">
                    <p class="message-content"><?php echo($comment->getText());?></p>
                    <hr/>
                    <?php
                        if($commentRepository->isCommentFavorite($comment->getId())){
                            echo('<a href="index.php?controller=channel&action=removeFavorite&commentId=' . $comment->getId() .'"/><i class="fa fa-star"></i></a>');
                        }
                        else{
                            echo('<a href="index.php?controller=channel&action=addFavorite&commentId=' . $comment->getId() .'"/><i class="fa fa-star-o"></i></a>');
                        }
                    ?>
                    <div class="message-footer"><span></span><?php echo($commentCreator->getUserName()); ?> schrieb um <?php echo($comment->getCreationDate()); ?> im Channel <?php echo($channel->getTitle()); ?> </div>
                </div>
            <?php
                }
            ?>
        </div>
<?php
    }
?>