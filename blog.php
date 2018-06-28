<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 28/6/18
 * Time: 8:58 AM
 */

require_once("config.php");
$st = $db->prepare("SELECT * FROM posts");
$st->execute();
?>

<html>
    <?php require("head.php")?>
    <body>
        <?php require("header.php")?>
        <div class="container-fluid">
            <article class="container-row row">
                <?php while ($post = $st->fetch()) {?>
                <div class="card card-inverse col-sm-6 col-md-4 col-xl-3">
                    <div class="view gradient-card-header blue-gradient">
                        <h2 class="h2-responsive"><?= $post['title']?></h2>
                        <p>Published <?=$post['date_created']?></p>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text white-text"><?=$post['text']?></p>
                        <a href="<?= BASE_URL?>/post.php?id=<?=$post['id']?>" class="pink-text d-flex flex-row-reverse have-flex">
                            <h5 class="waves-effect p-2 read-more">
                                Read More
                                <i class="fa fa-chevron-right"></i>
                            </h5>
                        </a></div>
                </div><?php }?>
            </article>
        </div>
        <?php require("script.php")?>
    </body>
</html>

