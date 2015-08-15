<?php
    if(!AuthenticationManager::isAuthenticated()){
        Util::redirect("index.php?view=login");
    }
?>
