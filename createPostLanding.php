<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 7/7/18
 * Time: 11:56 PM
 */

require_once("config.php");

try {
    if(!empty($_SESSION['user']['admin'])){
        $st = $db->prepare("INSERT INTO posts(title, text, userid) values(:title, :text, :userid)");
        $insertWasSuccessful = $st->execute([
            ':title'=> $_POST['title'],
            ':text'=> $_POST['text'],
            ':userid'=> $_SESSION['user']['userid']
        ]);
    }
} catch (Exception $e) {
    $err = $e;
}
?>
<html>
<head><?php require_once('./head.php') ?></head>
<body>
    <?php require_once("./header.php") ?>
    <div class="content alpha message my-5 p-5 col-7">
        <article class="post">
        <?php if ($insertWasSuccessful) {?>
            <h3 class="title"><span>Post Created</span></h3><br><br>
            <div>Post created successfully. You will be redirected in 5 seconds</div><br>
            <a class="link" href="<?= BASE_URL?>/blog.php">Click here to go back instantly.</a><br><br>
            <script>
                setTimeout(function() {
                    window.location = 'blog.php';
                }, 1000 * 5);
            </script>
        <?php } elseif (empty($insertWasSuccessful)) {?>
            <h3 class="title"><span>User Error</span></h3><br><br>
            <p class="post-text white-text">You do not have enough permissions for this action.</p>
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

