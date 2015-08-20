<?php
    ob_start();
    require_once('inc/bootstrap.php');
    SessionContext::create();

    $userRepository = new UserRepository();
    $channelRepository = new ChannelRepository();
    $commentRepository = new CommentRepository();

    require_once("views/partials/header.php");
    $view = Util::readKeyFromRequest('view', 'login');
    if(file_exists(__DIR__. '/views/' . $view . '.php'))
        require_once('views/' . $view . '.php');
    $controllerName = Util::readKeyFromRequest('controller', '');
    switch($controllerName){
        case "authentication":
            $controller = new AuthenticationController($userRepository, $channelRepository);
            $controller->handleAction();
            break;
        case "channel":
            $controller = new ChannelController($commentRepository);
            $controller->handleAction();
            break;
        default:
            break;
    }
    require_once("views/partials/footer.php");
    ob_end_flush();
?>