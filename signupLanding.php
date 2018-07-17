<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 11/7/18
 * Time: 5:32 PM
 */

require_once("config.php");
try {
    if (!empty($_POST['email'])) {
        $st = $db->prepare("select * from users where email = :email");
        $st->execute([
            ':email' => $_POST['email']
        ]);
        $email = $st->fetch();
    }
    if (!empty($_POST['username'])) {
        $st = $db->prepare("select * from users where username = :username");
        $st->execute([
            ':username'=>$_POST['username']
        ]);
        $username = $st->fetch();
    }
    if (!empty($_POST['password'])) {
        preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST['password'],$matches);
    }
    if (!empty($_POST['g-recaptcha-response'])) {
        $data = array(
            'secret' => RECAPTCHA_SECRET_KEY,
            'response' => $_POST['g-recaptcha-response']
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data),
                'header' => "Content-Type: application/x-www-form-urlencoded"
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents(RECAPTCHA_URL, false, $context);
        $captcha_success=json_decode($verify);

        if(empty($username) AND empty($email) AND !empty($matches) AND $captcha_success->success == true) {
            $st = $db->prepare("insert into users(username, email, password) values(:username, :email, :password)");
            $userCreated = $st->execute([
                ':username' => $_POST['username'],
                ':email' => $_POST['email'],
                ':password' => $_POST['password']
            ]);
        }
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
        <?php if (!empty($userCreated)) {?>
            <h3 class="title"><span>User Created</span></h3><br><br>
            <div>User created successfully. You will be redirected in 5 seconds</div><br>
            <a class="link" href="<?= BASE_URL?>/login.php">Click here to go back instantly.</a><br><br>
            <script>
                setTimeout(function() {
                    window.location = '<?=BASE_URL?>/login.php';
                }, 1000 * 5);
            </script>
        <?php } elseif (empty($userCreated)) {?>
            <h3 class="title"><span>User Error</span></h3><br><br>
            <p class="post-text white-text">Invalid data sent to server</p>
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
