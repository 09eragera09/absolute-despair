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
        <div class="content alpha message my-5 p-5 col-7">
            <article class="post">
                <?php if (!empty($userFound)) {
                    $_SESSION['user'] = $userFound
                    ?>
                    <h3 class="title"><span>Logged In</span></h3><br><br>
                    <div>Logged in successfully. You will be redirected in 5 seconds</div><br>
                    <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back instantly.</a><br><br>
                    <script>
                        setTimeout(function() {
                            window.location = '<?=BASE_URL?>/blog.php';
                        }, 1000 * 5);
                    </script>
                <?php } elseif (empty($userFound)) {?>
                    <h3 class="title"><span>User Error</span></h3><br><br>
                    <p class="post-text white-text">User not found. Please check the username and password.</p>
                    <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back to the homepage.</a>
                <?php } else {?>
                    <h3 class="title"><span>Error</span></h3><br><br>
                    <div>Internal Server Error</div>
                    <pre><?php var_export($err)?></pre>
                    <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back to the homepage.</a>
                <?php }?></article></div>
        <?php require_once("script.php")?>
    </body>
</html>
