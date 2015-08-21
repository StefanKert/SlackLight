<?php
    error_reporting(E_ALL);
    ini_set('display_error', 'On');

    include 'common/BaseObject.php';
    include 'common/Logger.php';
    include 'common/StringUtils.php';
    include 'common/Util.php';
    include 'common/SessionContext.php';
    include 'common/AuthenticationManager.php';
    include 'data/DataManager.php';
    include 'data/UserRepository.php';
    include 'data/ChannelRepository.php';
    include 'data/CommentRepository.php';
    include 'models/Entity.php';
    include 'models/User.php';
    include 'models/Channel.php';
    include 'models/Comment.php';
    include 'controller/AuthenticationController.php';
    include 'controller/ChannelController.php';
?>
