<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 6/7/18
 * Time: 2:01 PM
 */
require_once("config.php");

try {
    if (!empty($_POST['email'])) {
        $st = $db->prepare("SELECT * FROM users WHERE email = :email");
        $st->execute([
            ':email' => $_POST['email']
        ]);
        $emailExists = $st->fetch();
        if ($emailExists) {echo "Email already exists, Please try again with a different address.";}
    }
    if (!empty($_POST['username'])) {
        $st = $db->prepare("SELECT * FROM users WHERE username = :username");
        $st->execute([
            ':username' => $_POST['username']
        ]);
        $emailExists = $st->fetch();
        if ($emailExists) {echo "Username already exists, Please use a different one.<br>";} else {echo "";}
    }
} catch (Exception $e) {
    var_export($e);
}
