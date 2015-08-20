<?php

/**
 * Created by IntelliJ IDEA.
 * User: Stefan
 * Date: 15.08.2015
 * Time: 12:46
 */
class ChannelRepository extends BaseObject
{
    public function __construct(){
    }

    public function getChannels(){
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, title, description, creationUserId FROM channels;", array(), function($res){
            return $this->fetchChannelObjects($res);
        });
    }

    public function getChannelsForUser($userId){
        return DataManager::performSelectWithFetch("SELECT channels.id, channels.creationDate, channels.updatedDate, channels.title, channels.description, channels.creationUserId FROM channels INNER JOIN userchannelregestrations ON channels.id =userchannelregestrations.channelId where userchannelregestrations.userId = ?", array($userId), function($res){
            return $this->fetchChannelObjects($res);
        });
    }


    public function getChannelForId($channelId) {
        return DataManager::performSelectWithFetch("SELECT id, creationDate, updatedDate, title, description, creationUserId FROM channels WHERE id = ?;", array($channelId), function($res){
            return $this->fetchChannelObject($res);
        });
    }

    public function setChannelLastSeenToCurrentTimeForUser($channelId, $userId){
        return DataManager::performAction("UPDATE userchannelregestrations SET lastTimeOpenedChannel = now() WHERE channelId = ? AND userId = ?;", array($channelId, $userId));
    }

    public function getChannelLastSeenToCurrentTimeForUser($channelId, $userId){
        return DataManager::performSelectWithFetch("SELECT lastTimeOpenedChannel FROM userchannelregestrations WHERE channelId = ? AND userId = ?;", array($channelId, $userId), function($res){
            return $res->fetchColumn();
        });
    }

    public function getCountOfNewPostsForUser($channelId, $userId){
        return DataManager::performSelectWithFetch("SELECT COUNT(*) FROM comments WHERE comments.deleted = 0 comments.channelId = ? AND comments.creationDate > (SELECT lastTimeOpenedChannel FROM userchannelregestrations WHERE userchannelregestrations.channelId = ? AND userchannelregestrations.userId = ?);", array($channelId, $channelId, $userId), function($res){
            return $res->fetchColumn();
        });
    }

    public function createUserChannelRegistration($channelId, $userId, $lastTimeOpenedChannel) {
        return DataManager::performInsertion("INSERT INTO userchannelregestrations (channelId, userId, lastTimeOpenedChannel) VALUES (?, ?, ?);", array($channelId, $userId, $lastTimeOpenedChannel));
    }


    private function fetchChannelObjects($res){
        $channels = array();
        while ($cat = DataManager::fetchObject($res)) {
            $channels[] = new Channel($cat->id, $cat->creationDate, $cat->updatedDate, $cat->title, $cat->description, $cat->creationUserId);
        }
        return $channels;
    }

    private function fetchChannelObject($res){
        if ($c = DataManager::fetchObject($res)) {
            return new Channel($c->id, $c->creationDate, $c->updatedDate, $c->title, $c->description, $c->creationUserId);
        }
        else{
            return null;
        }
    }
}
?>