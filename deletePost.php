<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 17/7/18
 * Time: 10:41 PM
 */

require_once ('config.php');

if (!empty($_POST['postID']) AND !empty($_POST['admin'])) {
    $st = $db->prepare("DELETE FROM comments where postid = :id");
    $commentsErased = $st->execute([
        ":id" => $_POST['postID']
    ]);
    if ($commentsErased) {
        $st2 = $db->prepare("DELETE FROM posts where id = :id");
        $deleteWasSuccessful = $st2->execute([
            ':id' => $_POST['postID']
        ]);
        echo(json_encode($deleteWasSuccessful));
    } else {
        echo(json_encode(false));
    }
} else {
    echo(json_encode(false));
}