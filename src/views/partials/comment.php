<?php
    $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
    $isLastPost = $commentRepository->isCommentLastForUserInChannel($channelId, $comment->getId(), SessionContext::getCurrentUser());
    $isNewPost = $lastTimeChannelSeen == null || strtotime($lastTimeChannelSeen) < strtotime($comment->getCreationDate());
?>

    <div class="row messageBox">
        <div class="small-2 columns message-information">
            <h3>
                <?php if(isNewPost) { ?> <i class="fa fa-exclamation"></i> <?php } ?>
                <?php echo($commentCreator->getUserName()); ?>
            </h3>
            <br/>
            <?php echo(date("d.m.Y h:m:s", strtotime($comment->getCreationDate()))); ?>
        </div>
        <div class="small-10 columns">
            <div class="row message-header">
                <div class="small-12 columns">
                    <?php

                    if($isLastPost) {
                        echo '<a href="index.php?view=main&channelId=' . $channelId . '&commentId=' . $comment->getId() . '&edit=true"><i class="fa fa-pencil"></i></a>';
                        echo '<a href="index.php?controller=channel&action=deleteComment&channelId=' . $channelId . '&commentId=' . $comment->getId() . '&edit=true"><i class="fa fa-remove"></i></a>';
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
            <hr/>
            <div class="row message-content">
                <div class="small-12 columns">
                    <?php echo($comment->getText());?>
                </div>
            </div>
        </div>
    </div>