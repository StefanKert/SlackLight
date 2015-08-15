<?php
    require_once('inc/bootstrap.php');
    SessionContext::create();
    require_once("views/partials/header.php");
    $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'login';
    if(file_exists(__DIR__. '/views/' . $view . '.php'))
        require_once('views/' . $view . '.php');
    $controllerName = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : '';
    switch($controllerName){
        case "authentication":
            $controller = new AuthenticationController(new UserRepository());
            $controller->handleAction();
            break;
        default:
            break;
    }
    require_once("views/partials/footer.php")
?>