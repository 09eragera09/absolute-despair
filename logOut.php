<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 22/7/18
 * Time: 2:28 AM
 */

require_once('config.php');

if (!empty($_POST['username']) && $_POST['username'] === $_SESSION['user']['username']) {
    session_destroy();
    unset($_SESSION);
    echo (json_encode(true));
} else echo(json_encode(false));