<?php

class ChannelController extends BaseObject
{
    private $repository;

    const ACTION = 'action';
    const METHOD_POST = 'POST';
    const ACTION_ADD_COMMENT = 'addComment';
    const ACTION_ADD_FAVORITE = 'addFavorite';
    const ACTION_REMOVE_FAVORITE = 'removeFavorite';

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
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
        $channelId = $_GET['channelId'];
        $comment = $_POST['comment'];
        $userId = $_SESSION['user'];
        $this->repository->createComment($comment, $channelId, $userId);
        Util::redirect("index.php?view=main&channelId=" . $channelId);
    }

    private function addFavorite()
    {
        $channelId = $_GET['channelId'];
        $commentId = $_GET['commentId'];
        $userId = $_SESSION['user'];
        $this->repository->createFavoriteForComment($commentId, $userId);
        if($channelId != null)
            Util::redirect("index.php?view=main&channelId=" . $channelId);
        else
            Util::redirect("index.php?view=main");
    }

    private function removeFavorite()
    {
        $channelId = $_GET['channelId'];
        $commentId = $_GET['commentId'];
        $userId = $_SESSION['user'];
        $this->repository->deleteFavoriteForComment($commentId, $userId);
         if($channelId != null)
            Util::redirect("index.php?view=main&channelId=" . $channelId);
        else
            Util::redirect("index.php?view=main");
    }
}

?>