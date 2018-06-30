<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 28/6/18
 * Time: 3:32 PM
 */

require_once("config.php");
$st = $db->prepare("SELECT * FROM posts WHERE id = :id");
$st->execute([
    ':id' => $_GET['id']
]);
$post = $st->fetch();
?>
<html>
    <head>
        <?php require_once('head.php')?>
    </head>
    <body>
        <?php require_once('header.php')?>
        <div class="content alpha my-5 p-5">
            <article class="post">
                <h3 class="title"><span><?= $post['title'] ?></span></h3>
                <div class="metadata d-flex justify-content-between">
                    <p class="flex-item"><?= $post['date_created'] ?></p>
                    <p class="flex-item">Author Name</p>
                </div>
                <hr>
                <p class="post-text white-text"><?= $post['text']?></p>
            </article>
        </div>
        <?php require_once("script.php")?>
    </body>
</html>

