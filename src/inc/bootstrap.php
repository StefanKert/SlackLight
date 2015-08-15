<?php
    error_reporting(E_ALL);
    ini_set('display_error', 'On');

    include 'common/BaseObject.php';
    include 'common/Util.php';
    include 'common/SessionContext.php';
    include 'common/AuthenticationManager.php';
    include 'data/DataManager.php';
    include 'data/UserRepository.php';
    include 'models/Entity.php';
    include 'models/User.php';
    include 'controller/AuthenticationController.php';

    /*spl_autoload_register(function($className){
        include 'controller/' . $className . '.php';
        include 'common/' . $className . '.php';
    });*/
?>
