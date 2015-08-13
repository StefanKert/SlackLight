<?php require_once("views/partials/header.php") ?>

<?php
    $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'login';
    if(file_exists(__DIR__. '/views/' . $view . '.php'))
        require_once('views/' . $view . '.php');
?>
<?php require_once("views/partials/footer.php") ?>