<?php
    if(isset($_GET["errors"])){
        $errors = unserialize(urldecode($_GET["errors"]));
    }
    if (isset($errors) && is_array($errors)) {
?>
    <div>
        <?php foreach ($errors as $errMsg){ ?>
            <div data-alert class="alert-box alert radius">
                <?php echo(Util::escape($errMsg)); ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>