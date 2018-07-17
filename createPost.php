<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 7/7/18
 * Time: 2:33 PM
 */

require_once("config.php");
?>

<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    <body>
        <?php require_once("header.php")?>
        <?php require_once("script.php")?>
        <div class="content alpha my-5 p-5 col-7">
            <article class="post form-parent">
                <?php if(!empty($_SESSION['user']['admin'])) {?>
                <!-- Material form contact -->
                <form action="createPostLanding.php" method="post">
                    <h3 class="title"><span>Create New Post</span></h3>
                    <br><br>
                    <!-- Material input subject -->
                    <div class="md-form">
                        <i class="fa fa-tag prefix grey-text"></i>
                        <input type="text" name="title" id="materialFormContactSubjectEx" class="form-control" maxlength="255">
                        <label for="materialFormContactSubjectEx">Title</label>
                    </div>

                    <!-- Material textarea message -->
                    <div class="md-form">
                        <i class="fa fa-pencil prefix grey-text"></i>
                        <textarea type="text" name="text" id="materialFormContactMessageEx" class="form-control md-textarea" rows="3"></textarea>
                        <label for="materialFormContactMessageEx">Post Text</label>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-outline-secondary" type="submit">Create<i class="fa fa-paper-plane-o ml-2"></i></button>
                    </div>
                </form><?php } else {?>
                <h3 class="title"><span>User Error</span></h3><br><br>
                <p class="post-text white-text">You do not have enough permissions for this action.</p><?php }?>
            </article>
        </div>
    </body>
</html>
