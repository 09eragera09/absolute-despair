<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 30/6/18
 * Time: 1:44 AM
 */

require_once('config.php');
?>
<html>
    <head>
        <?php require_once("head.php");?>
    </head>
    <body>
        <?php require_once("header.php")?>
        <div class="content alpha my-5 p-5 col-7">
            <article class="form-parent">
                <!-- Material form login -->
                <form class="loginForm" action="loginLanding.php" method="post">
                    <p class="h4 text-center mb-4 title"><span>Sign in</span></p><br>
                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input name="username" type="text" id="materialFormLoginEmailEx" class="form-control" required>
                        <label for="materialFormLoginEmailEx">Your username</label>
                    </div>

                    <!-- Material input password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input name="password" type="password" id="materialFormLoginPasswordEx" class="form-control" required>
                        <label for="materialFormLoginPasswordEx">Your password</label>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-outline-secondary" type="submit">Login<i class="fa fa-paper-plane-o ml-2"></i></button>
                    </div>
                </form>

                <?php require_once("script.php")?>
                <script>
                    $(".loginForm").validate()
                </script>
                <!-- Material form login -->
            </article>
        </div>
    </body>
</html>
