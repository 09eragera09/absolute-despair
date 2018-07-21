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
$st2 = $db->prepare("select * from users where userid=:userid");
$st2->execute([
        ':userid'=>$post['userid']
]);
$user = $st2->fetch();
$st3 = $db->prepare("select * from comments where postid = :postid");
$st3->execute([
        ':postid' => $_GET['id']
]);
$postdate = new DateTime($post['date_created']);
?>
<html>
    <head>
        <?php require_once('head.php')?>
    </head>
    <body>
        <?php require_once('header.php')?>
        <div class="content alpha my-5 p-5 col-8">
            <article class="post" data-post-id="<?=$post['id']?>">
                <div class="btn-group post-context">
                    <button id="dropdownToggle" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="contextImage" src="assets/button-of-three-vertical-squares.svg" /></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <?php if(!empty($_SESSION['user']['admin'])){?><a class="dropdown-item js-delete-post" href="#">Delete Post</a><?php }?>
                    </div>
                </div>
                <h3 class="title"><span><?= $post['title'] ?></span></h3>
                <div class="metadata d-flex justify-content-between">
                    <p class="flex-item">Posted <?php echo $postdate->format('Y') < (new DateTime)->format('Y') ? $postdate->format('dS F Y') : $postdate->format('dS F');?></p>
                    <p class="flex-item">By <?=$user['username']?></p>
                </div>
                <p class="post-text white-text"><?= $post['text']?></p>
            </article>
        </div>
        <div class="content alpha my-5 p-5 col-8">
            <article class="comments">
                <h3 class="title pb-5"><span>Comments</span></h3>
                <div class="d-flex flex-column" id="commentsAll">
                <?php while ($comment = $st3->fetch()) {
                    $commentsExist = true;
                    $st4 = $db->prepare("select * from users where userid = :userid");
                    $st4->execute([
                            ":userid" => $comment['userid']
                    ]);
                    $commenter = $st4->fetch();
                    $date = new DateTime($comment['date_created']);
                    ?>
                    <div class="comment d-flex flex-column my-2 p-2" data-comment-id="<?=$comment['id']?>">
                        <section class="d-flex flex-row justify-content-between">
                            <span class="d-flex flex-column">
                                <span class="commenter">By <?=$commenter['username']?></span>
                                <span class="comment-date">On <?php echo $date->format('Y') < (new DateTime)->format('Y') ? $date->format('dS F Y') : $date->format('dS F');?></span>
                            </span>
                            <div class="btn-group">
                                <button id="dropdownToggle" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="contextImage" src="assets/button-of-three-vertical-squares.svg" /></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <?php if((!empty($_SESSION['user']['username'])) && $_SESSION['user']['username'] === $commenter['username']){?>
                                        <a class="dropdown-item js-edit-comment" href="#">Edit Comment</a>
                                    <?php }?>
                                    <div class="dropdown-divider"></div>
                                    <?php if(!empty($_SESSION['user']['admin'])){?><a class="dropdown-item js-delete-comment" href="#">Delete Comment</a><?php }?>
                                </div>
                            </div>
                        </section>
                        <div class="d-flex flex-row justify-content-between comment-content">
                            <span class="comment-body p-3"><?=$comment['text']?></span>
                        </div>
                    </div>
                <?php }?>
                </div>
                <?php if (empty($commentsExist)) {?>
                <div class="no-comments text-center" id="noComment">No Comments</div>
                <?php }?>
            </article>
            <?php if(!empty($_SESSION['user'])) {?>
            <div class="create-comment pt-5">
                <form id="commentForm">
                    <div class="md-form mb-4 pink-textarea active-pink-textarea">
                        <i class="fa fa-pencil prefix"></i>
                        <textarea id="commentFormTextarea" class="md-textarea form-control" rows="1" maxlength="255"></textarea>
                        <label for="commentFormTextarea">Write a comment!</label>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-secondary" type="button" id="commentBtn">Create<i class="fa fa-paper-plane-o ml-2"></i></button>
                    </div>
                </form>
            </div><?php }?>
        </div>
        <?php require_once("script.php")?>
        <!--suppress JSUnresolvedVariable -->
        <script>
            <?php if (!empty($_SESSION['user'])){?>
            $("#commentBtn").on('click', function (event){
                event.isDefaultPrevented = true;
                $.ajax({
                    url: 'insertComment.php',
                    method: 'post',
                    data: {
                        text:$("#commentFormTextarea").val(),
                        user: <?php echo json_encode($_SESSION['user']);?>,
                        postId: <?php echo json_encode($_GET['id'])?>
                    },
                    success: function (res) {
                        if (res) {
                            $("#commentFormTextarea").val('');
                            addComments(JSON.parse(res));
                        }
                    }
                });
            });
            function addComments(comment){
                let $noComment = $("#noComment");
                if ($noComment.length) {$noComment.remove()}
                let content = `<div class="comment d-flex flex-column my-2 p-2" data-comment-id="${comment.id}">
                        <section class="d-flex flex-row justify-content-between">
                            <span class="d-flex flex-column">
                                <span class="commenter">By ${comment.user.username}</span>
                                <span class="comment-date">On ${comment.date_created}</span>
                            </span>
                            <div class="btn-group">
                                <button id="dropdownToggle" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="contextImage" src="assets/button-of-three-vertical-squares.svg" /></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <?php if((!empty($_SESSION['user']['username']))){?>
                                        <a class="dropdown-item js-edit-comment" href="#">Edit Comment</a>
                                    <?php }?>
                                    <div class="dropdown-divider"></div>
                                    <?php if(!empty($_SESSION['user']['admin'])){?><a class="dropdown-item js-delete-comment" href="#">Delete Comment</a><?php }?>
                                </div>
                            </div>
                        </section>
                        <div class="d-flex flex-row justify-content-between comment-content">
                            <span class="comment-body p-3">${comment.text}</span>
                        </div>
                    </div>`;
                $("#commentsAll").append(content).children().last().fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
            }
            let $allComments = $("#commentsAll");
            $allComments.on('click', '.js-edit-comment', function (event){
                event.preventDefault();
                const $commentContent = $(this).closest('.comment').find('.comment-content');
                const $commentBody = $commentContent.find('.comment-body');
                $commentBody.remove();
                const $textarea = `<form id="commentEditForm" class = "d-flex flex-column">
                    <div class="md-form mb-4 pink-textarea active-pink-textarea">
                        <textarea id="commentEditTextarea" class="md-textarea form-control" rows="2" maxlength="255">${$commentBody.text()}</textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-secondary" type="button" id="commentEditBtn">Edit<i class="fa fa-paper-plane-o ml-2"></i></button>
                    </div>
                </form>`;
                $commentContent.prepend($textarea);
                $commentContent.children().first().css("width",  "100%")
            });
            $allComments.on('click', '#commentEditBtn', function (event){
                event.isDefaultPrevented = true;
                const $comment = $(this).closest('.comment');
                const textAreaValue = $comment.find('#commentEditTextarea').val();
                $.ajax({
                    url: 'editComment.php',
                    method: 'post',
                    data: {
                        text: textAreaValue,
                        user: <?php echo json_encode($_SESSION['user']);?>,
                        commentID: $comment.data('comment-id')
                    },
                    dataType: 'JSON',
                    success: function (res) {
                        if (res) {
                            $("#commentEditForm").remove();
                            let content = `<span class="comment-body p-3">${textAreaValue}</span>`;
                            $comment.find('.comment-content').prepend(content)
                        }
                    }
                });
            });
            <?php if (!empty($_SESSION['user']['admin'])) {?>
            $allComments.on('click','.js-delete-comment', function (event){
                event.preventDefault();
                const $comment = $(this).closest('.comment');
                const commentID = $comment.data('comment-id');
                let confirmDelete = confirm("Are you sure you want to delete this comment?");
                if (confirmDelete) {deleteComment(commentID).then(() => {$comment.remove()}).catch((err) => console.log(err))}
            });
            function deleteComment(id){
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: 'deleteComment.php',
                        method: 'post',
                        data: {
                            commentID: id,
                            admin: <?=$_SESSION['user']['admin']?>
                        },
                        success: function (res) {
                            console.log(res);
                            if (res) {
                                resolve("Success!")
                            } else { reject(res)}
                        }
                    });
                })
            }

            $(".js-delete-post").on('click', function (event){
                event.preventDefault();
                const $post = $(this).closest('.post');
                const postID = $post.data('post-id');
                let confirmDelete = confirm("Are you sure you want to delete this post?");
                if (confirmDelete) {deletePost(postID).then(() => {
                    alert("Post has been deleted!");
                    window.location = '<?=BASE_URL?>/blog.php';
                }).catch((err) => console.log(err))}
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
                            if (res) {
                                resolve("Success!")
                            } else { reject(res)}
                        }
                    });
                })
            }
            <?php }}?>
        </script>
    </body>
</html>

