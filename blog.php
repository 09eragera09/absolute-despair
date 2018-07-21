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
                <?php while ($post = $st->fetch()) {
                    $date = new DateTime($post['date_created']);
                    $text = substr($post['text'], 0, 100)?>
                <div class="d-flex card card-inverse col-sm-6 col-md-4 col-xl-3" data-post-id="<?=$post['id']?>">

                    <div class="btn-group card-context">
                        <button id="dropdownToggle" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="contextImage" src="assets/button-of-three-vertical-squares.svg" /></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <?php if(!empty($_SESSION['user']['admin'])){?><a class="dropdown-item js-delete-post" href="#">Delete Post</a><?php }?>
                        </div>
                    </div>
                    <div class="view gradient-card-header blue-gradient">
                        <h2 class="h2-responsive"><?= $post['title']?></h2>
                        <p>Published on <?php echo $date->format('Y') < (new DateTime)->format('Y') ? $date->format('dS F Y') : $date->format('dS F');?></p>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <p class="card-text white-text"><?=$text.'...'?></p>
                        <a href="<?= BASE_URL?>/post.php?id=<?=$post['id']?>" class="pink-text d-flex flex-row-reverse have-flex">
                            <h5 class="waves-effect p-2 read-more">
                                Read More
                                <i class="fa fa-chevron-right"></i>
                            </h5>
                        </a></div>
                </div><?php }
                if (!empty($_SESSION['user']['admin'])) {
                ?>
                <div class="d-flex card card-inverse col-sm-6 col-md-4 col-xl-3">
                    <div class="view gradient-card-header blue-gradient">
                        <h2 class="h2-responsive">Create Post</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text white-text"><a href="<?=BASE_URL?>/createPost.php"><img id="newPost" src="assets/add.svg"></a></p><br></div>
                </div><?php }?>
            </article>
        </div>
        <?php require_once("script.php")?>
        <script><?php if (!empty($_SESSION['user']) AND (!empty($_SESSION['user']['admin']))) {?>
            $(".js-delete-post").on('click', function (event){
                event.preventDefault();
                const $post = $(this).closest('.card');
                const postID = $post.data('post-id');
                let confirmDelete = confirm("Are you sure you want to delete this post?");
                if (confirmDelete) {deletePost(postID).then(() => {$post.remove()}).catch((err) => console.log(err))}
            });
            function deletePost(id){
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: 'deletePost.php',
                        method: 'post',
                        data: {
                            postID: id,
                            admin: <?=$_SESSION['user']['admin']?>
                        },
                        dataType: 'JSON',
                        success: function (res) {
                            console.log(res);
                            if (res) {
                                resolve("Success!")
                            } else { reject(res)}
                        }
                    });
                })
            }<?php }?>
        </script>
    </body>
</html>

