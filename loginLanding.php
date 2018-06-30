<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 30/6/18
 * Time: 2:30 AM
 */

require_once('./config.php');

try {if (!empty($_POST)) {
    $st = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $st->execute([
        ':username' => $_POST['username'],
        ':password' => $_POST['password']
    ]);
    $userFound = $st->fetch();
} else {
    $userFound = false;
}} catch (Exception $e) {
    $err = $e;
}
?>
<html>
    <head><?php require_once('./head.php') ?></head>
    <body>
        <?php require_once("./header.php") ?>
        <?php if ($userFound) {
            $_SESSION['user'] = $userFound;
            unset($_SESSION['user']['password']);
            ?>
            <div class="content alpha message">
                <div>Logged in successfully. You will be redirected in 5 seconds</div><br>
                <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back instantly.</a>
            </div>
            <script>
                setTimeout(function() {
                    window.location = 'blog.php';
                }, 1000 * 5);
            </script>
        <?php } elseif (empty($userFound)) {?>
            <div class="content alpha message">
                <div>User not found. Check that the username and password are correct.</div><br>
                <a class="link" href="<?= BASE_URL?>/signup.php">Click here to sign up.</a><br>
                <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back to the homepage.</a>
            </div>
        <?php } else {?>
            <div class="content alpha message">
                <div>Internal Server Error</div>
                <pre><?php var_export($err)?></pre>
                <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back to the homepage.</a>
            </div>
        <?php } require_once("script.php")?>
    </body>
</html>
