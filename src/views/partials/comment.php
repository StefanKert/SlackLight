<?php
    $commentCreator = $userRepository->getUserForId($comment->getCreationUserId());
    $isLastPost = $commentRepository->isCommentLastForUserInChannel($channelId, $comment->getId(), SessionContext::getCurrentUser());
    if(isset($lastTimeChannelSeen)) {
        $isNewPost = $lastTimeChannelSeen == null || strtotime($lastTimeChannelSeen) < strtotime($comment->getCreationDate());
        $status = $isNewPost ? 'new-post' : '';
    }

?>

<div class="row messageBox <?php echo $status ?>">
    <div class="small-2 columns message-information">
        <h3>
            <?php if(isset($isNewPost) && $isNewPost) { ?> <i class="fa fa-exclamation"></i> <?php } ?>
            <?php echo($commentCreator->getUserName()); ?>
        </h3>
        <br/>
        <?php echo(date("d.m.Y H:m:s", strtotime($comment->getCreationDate()))); ?>
        <?php
        if(strtotime($comment->getUpdatedDate()) > strtotime($comment->getCreationDate())){
            echo('<br/><br/>Zuletzt aktualisiert: ' . date("d.m.Y H:m:s", strtotime($comment->getUpdatedDate())));
        }
        ?>
    </div>
    <div class="small-10 columns">
        <div class="small-12 columns message-icons">
            <?php
                if($isLastPost) {
                    echo '<a href="index.php?view=main&channelId=' . $channelId . '&commentId=' . $comment->getId() . '&edit=true"><i class="fa fa-pencil" style="color: #3e8f3e;"></i></a>';
                    echo '<a href="index.php?controller=channel&action=deleteComment&channelId=' . $channelId . '&commentId=' . $comment->getId() . '&edit=true"><i class="fa fa-remove" style="color: #c12e2a;"></i></a>';
                }

                if($commentRepository->isCommentFavorite($comment->getId())){
                    echo('<a href="index.php?controller=channel&action=removeFavorite&channelId=' . $channelId . '&commentId=' . $comment->getId() .'"/><i class="fa fa-star" style="color: #FC0"></i></a>');
                }
                else{
                    echo('<a href="index.php?controller=channel&action=addFavorite&channelId=' . $channelId . '&commentId=' . $comment->getId() .'"/><i class="fa fa-star-o" style="color: #FC0"></i></a>');
                }
            ?>
        </div>
        <hr/>
            <div class="small-12 columns message-content">
                <?php echo($comment->getText());?>
            </div>
    </div>
</div>