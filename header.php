<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 28/6/18
 * Time: 12:40 AM
 */

require_once("config.php");
?>
<header>
    <div class="titlecard">
        <div class="titleImage"><img src="./assets/1141.jpg"></div>
        <p>Absolute Despair (working title)</p>
    </div>
    <nav>
        <ul class="links">
            <li><a class="link" href="blog.php">Home</a></li>
            <li><a class="link" href="about.php">About</a></li>
            <li><a class="link" href="http://09eragera09.github.io" target="_blank">Main Site</a></li>
        </ul>
        <div class="login">
            <?php if(!empty($_SESSION['user'])){?>
                Welcome Back, <?=$_SESSION['user']['username']?>
            <?php } else {?>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul> <?php }?>
        </div>
    </nav>

</header>
