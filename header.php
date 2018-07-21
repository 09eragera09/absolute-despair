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
                <div class="btn-group">
                    Welcome Back, <?=$_SESSION['user']['username']?>
                    <button id="dropdownToggle" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="contextImage userContext" src="assets/down-arrow.svg" /></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item js-log-out" href="#">Log Out</a>
                    </div>
                </div>
            <?php } else {?>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul> <?php }?>
        </div>
    </nav>
    <?php require_once('script.php') ?>
    <script>
        $('.js-log-out').on('click', function (e) {
            e.preventDefault();
            new Promise((resolve, reject)=>{
                $.ajax({
                url: 'logOut.php',
                method: 'post',
                data: {
                    username: "<?=$_SESSION['user']['username']?>"
                },
                dataType: 'JSON',
                success: function (res) {
                    if (res) {
                        resolve("Success!")
                    } else { reject(res)}
                }
            })}).then(()=>{location.reload(true)}).catch((err) => {console.log(err)});
        })
    </script>
</header>
