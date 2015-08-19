<?php

class CommentRepository extends BaseObject
{
    public function __construct(){
    }

    public function createComment($text, $channelId, $creationUserId) {
        return DataManager::performInsertion("INSERT INTO comments (creationDate, updatedDate, text, channelId, creationUserId) VALUES (now(), now(), ?, ?, ?);", array($text, $channelId, $creationUserId));
    }

    public function createFavoriteForComment($commentId, $userId) {
        return DataManager::performInsertion("INSERT INTO favorites (commentId, userId) VALUES (?, ?);", array($commentId, $userId));
    }

    public function deleteFavoriteForComment($commentId, $userId) {
        return DataManager::performAction("DELETE FROM favorites WHERE commentId = ? AND userId = ?;", array($commentId, $userId));
    }

    public function getCommentsForChannel($channelId){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, text, channelId, creationUserId FROM comments WHERE channelId = ?;", array($channelId), function($res){
            return $this->fetchCommentObjects($res);
        });
    }

    public function getAllFavoredComments(){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, text, channelId, creationUserId FROM comments WHERE EXISTS (SELECT * FROM favorites WHERE favorites.commentId = comments.id AND favorites.userId = ?);", array($_SESSION['user']), function($res){
            return $this->fetchCommentObjects($res);
        });
    }

    public function isCommentFavorite($commentId){
        return DataManager::performSelectWithFetch("SELECT * FROM favorites WHERE userId = ? AND commentId = ?;", array($_SESSION['user'], $commentId), function($res){
            return $this->fetchFavorite($res);
        });
    }

    private function fetchFavorite($res){
        if ($u = DataManager::fetchObject($res)) {
            return true;
        }
        else{
            return false;
        }
    }

    private function fetchCommentObjects($res){
        $comments = array();
        while ($cat = DataManager::fetchObject($res)) {
            $comments[] = new Comment($cat->id, $cat->creationDate, $cat->updatedDate, $cat->text, $cat->channelId, $cat->creationUserId);
        }
        return $comments;
    }

    private function fetchCommentObject($res){
        if ($c = DataManager::fetchObject($res)) {
            return new Comment($c->id, $c->creationDate, $c->updatedDate, $c->text, $c->channelId, $c->creationUserId);
        }
        else{
            return null;
        }
    }
}