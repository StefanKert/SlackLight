<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SCM4 Bootstrap</title>

        <link href="assets/foundation/css/foundation.min.css" rel="stylesheet">
        <link href="assets/foundation/css/normalize.css" rel="stylesheet">
        <link href="assets/main.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Slack Light - Version 1.0</h1>
        </header>
        <?php if(isset($user)) { ?>
        <div id="menu" class="row">
            <div class="large-12 columns">
                <dl class="sub-nav">
                    <dd><a href="#">Link 1</a></dd>
                    <dd><a href="#">Link 2</a></dd>
                    <dd><a href="#">Link 3</a></dd>
                    <dd><a href="#">Link 4</a></dd>
                </dl>
            </div>
        </div>
        <?php } ?>
    <div class="container">
