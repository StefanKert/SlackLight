<?php

class CommentRepository extends BaseObject
{
    public function __construct(){
    }

    public function createComment($text, $channelId, $creationUserId) {
        return DataManager::performInsertion("INSERT INTO comments (creationDate, updatedDate, text, channelId, creationUserId, deleted) VALUES (now(), now(), ?, ?, ?, false);", array($text, $channelId, $creationUserId));
    }

    public function createFavoriteForComment($commentId, $userId) {
        return DataManager::performInsertion("INSERT INTO favorites (commentId, userId) VALUES (?, ?);", array($commentId, $userId));
    }

    public function deleteFavoriteForComment($commentId, $userId) {
        return DataManager::performAction("DELETE FROM favorites WHERE commentId = ? AND userId = ?;", array($commentId, $userId));
    }

    public function getCommentsForChannel($channelId){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, text, channelId, creationUserId, deleted FROM comments WHERE channelId = ? AND deleted = 0;", array($channelId), function($res){
            return $this->fetchCommentObjects($res);
        });
    }

    public function getCommentById($commentId){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, text, channelId, creationUserId, deleted FROM comments WHERE id = ?;", array($commentId), function($res){
            return $this->fetchCommentObject($res);
        });
    }

    public function updateComment($comment, $commentId){
        return DataManager::performAction("UPDATE comments SET text = ? AND updatedDate = now() WHERE id = ?;", array($comment, $commentId));
    }

    public function deleteComment($commentId){
        return DataManager::performAction("UPDATE comments SET deleted = 1 WHERE id = ?;", array($commentId));
    }

    public function getAllFavoredComments(){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, text, channelId, creationUserId FROM comments WHERE deleted = 0 AND EXISTS (SELECT * FROM favorites WHERE favorites.commentId = comments.id AND favorites.userId = ?);", array($_SESSION['user']), function($res){
            return $this->fetchCommentObjects($res);
        });
    }

    public function isCommentFavorite($commentId){
        return DataManager::performSelectWithFetch("SELECT * FROM favorites WHERE userId = ? AND commentId = ?;", array($_SESSION['user'], $commentId), function($res){
            return $this->fetchFavorite($res);
        });
    }

    public function isCommentLastForUserInChannel($channelId, $commentId, $userId){
        $lastComment = DataManager::performSelectWithFetch("SELECT * FROM comments WHERE deleted = 0 AND channelId = 1 ORDER BY creationDate DESC LIMIT 1;", array($channelId, $commentId), function($res){
            return $this->fetchCommentObject($res);
        });

        return $lastComment->getId() === $commentId && $lastComment->getCreationUserId() === $userId;
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
            $comments[] = new Comment($cat->id, $cat->creationDate, $cat->updatedDate, $cat->text, $cat->channelId, $cat->creationUserId, $cat->deleted);
        }
        return $comments;
    }

    private function fetchCommentObject($res){
        if ($c = DataManager::fetchObject($res)) {
            return new Comment($c->id, $c->creationDate, $c->updatedDate, $c->text, $c->channelId, $c->creationUserId, $c->deleted);
        }
        else{
            return null;
        }
    }
}