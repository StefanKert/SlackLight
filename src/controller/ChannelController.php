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

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function handleAction()
    {
        if (!isset($_REQUEST[self::ACTION])) {
            throw new Exception('Action not specified');
            return null;
        }


        $action = $_REQUEST[self::ACTION];

        switch ($action) {
            case self::ACTION_ADD_COMMENT:
                $this->addComment();
                break;
            case self::ACTION_EDIT_COMMENT:
                $this->editComment();
                break;
            case self::ACTION_DELETE_COMMENT:
                $this->deleteComment();
                break;
            case self::ACTION_ADD_FAVORITE:
                $this->addFavorite();
                break;
            case self::ACTION_REMOVE_FAVORITE:
                $this->removeFavorite();
                break;
            default :
                throw new Exception('Unknown controller action ' . $action);
        }

    }

    private function addComment()
    {
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $comment = Util::readKeyFromRequest(self::COMMENT);
        $userId = SessionContext::getCurrentUser();
        $this->commentRepository->createComment($comment, $channelId, $userId);
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function editComment(){
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $comment = Util::readKeyFromRequest(self::COMMENT);
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $this->commentRepository->updateComment($comment, $commentId);
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function deleteComment(){
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $this->commentRepository->deleteComment($commentId);
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function addFavorite()
    {
        $channelId = Util::readKeyFromRequest(self::CHANNEL_ID);
        $commentId = Util::readKeyFromRequest(self::COMMENT_ID);
        $userId =  SessionContext::getCurrentUser();
        $this->commentRepository->createFavoriteForComment($commentId, $userId);
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
         if($channelId != null)
            Util::redirect("index.php?view=main&channelId=" . $channelId);
        else
            Util::redirect("index.php?view=main");
    }
}
?>