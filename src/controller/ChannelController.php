<?php

class ChannelController extends BaseObject
{
    private $commentRepository;

    const ACTION = 'action';
    const METHOD_POST = 'POST';
    const ACTION_ADD_COMMENT = 'addComment';
    const ACTION_EDIT_COMMENT = 'editComment';
    const ACTION_DELETE_COMMENT = 'deleteComment';
    const ACTION_ADD_FAVORITE = 'addFavorite';
    const ACTION_REMOVE_FAVORITE = 'removeFavorite';

    const CHANNEL_ID = 'channelId';
    const COMMENT_ID = 'commentId';
    const COMMENT = 'comment';
    const EDIT_MODE = 'edit';

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function handleAction()
    {
        if (!isset($_REQUEST[self::ACTION])) {
            Logger::saveRequestLog('Action not specified');
            throw new Exception('Action not specified');
            return null;
        }

        $action = $_REQUEST[self::ACTION];

        switch ($action) {
            case self::ACTION_ADD_COMMENT:
                Logger::saveRequestLog("Trying to perform addComment.");
                $this->addComment();
                break;
            case self::ACTION_EDIT_COMMENT:
                Logger::saveRequestLog("Trying to perform editComment.");
                $this->editComment();
                break;
            case self::ACTION_DELETE_COMMENT:
                Logger::saveRequestLog("Trying to perform deleteComment.");
                $this->deleteComment();
                break;
            case self::ACTION_ADD_FAVORITE:
                Logger::saveRequestLog("Trying to perform addFavorite.");
                $this->addFavorite();
                break;
            case self::ACTION_REMOVE_FAVORITE:
                Logger::saveRequestLog("Trying to perform removeFavorite.");
                $this->removeFavorite();
                break;
            default :
                Logger::saveRequestLog('Unknown controller action ' . $action);
                throw new Exception('Unknown controller action ' . $action);
        }

    }

    private function addComment()
    {
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $comment = Util::readKeyFromRequest(self::COMMENT);
        $userId = SessionContext::getCurrentUser();
        $commentId = $this->commentRepository->createComment($comment, $channelId, $userId);
        Logger::saveRequestLog('Added comment with id ' . $commentId . ' successfully');
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function editComment(){
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $comment = Util::readKeyFromRequest(self::COMMENT);
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $this->commentRepository->updateComment($comment, $commentId);
        Logger::saveRequestLog('Updated comment with id ' . $commentId . 'successfully');
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function deleteComment(){
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $this->commentRepository->deleteComment($commentId);
        Logger::saveRequestLog('Deleted comment with id ' . $commentId . ' successfully');
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function addFavorite()
    {
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $userId =  SessionContext::getCurrentUser();
        $favoriteId = $this->commentRepository->createFavoriteForComment($commentId, $userId);
        Logger::saveRequestLog('Added favorite with id ' . $favoriteId . ' successfully');
        if($channelId != null)
            Util::redirect("index.php?view=main&channelId=" . $channelId);
        else
            Util::redirect("index.php?view=main");
    }

    private function removeFavorite()
    {
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $userId =  SessionContext::getCurrentUser();
        $this->commentRepository->deleteFavoriteForComment($commentId, $userId);
        Logger::saveRequestLog('Deleted favorite with commentId ' . $commentId . ' and userId ' . $userId . 'successfully');
         if($channelId != null)
            Util::redirect("index.php?view=main&channelId=" . $channelId);
        else
            Util::redirect("index.php?view=main");
    }
}
?>