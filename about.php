<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 17/7/18
 * Time: 2:57 PM
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
    <article class="post">
        <h3 class="title"><span>About this website</span></h3><br><br>
        <p class="post-text white-text">
            This website was made as a learning endeavor, a way to learn and mess around with PHP, JS (AJAX and jQuery), and other web technologies (Bootstrap, jQuery Validate and reCAPTCHA). This is in no way meant to be a commercial site. The full source-code can be found on <a class = "link" href="https://github.com/09eragera09/absolute-despair">Github</a>.
        </p>
        <br><br>
        <h4 class="title"><span>Contact me</span></h4><br><br>
        <p class="post-text white-text">You can contact me through the following:</p>
        <ul class="links contact">
            <li><a class="link contact-link" href="https://www.reddit.com/user/09eragera09/">Reddit</a></li>
            <li><a class="link contact-link" href="https://myanimelist.net/profile/09eragera09">MyAnimeList</a></li>
            <li><a class="link contact-link" href="http://steamcommunity.com/id/09eragera09">Steam</a></li>
            <li><a class="link contact-link" href="https://github.com/09eragera09/">GitHub</a></li>
        </ul>
        <p>You can also contact me on discord, I go by Era#4669. Also if you find a user named "09eragera09" online, its me.</p>
    </article>
</div>
<?php require_once("script.php")?>
</body>
</html>
