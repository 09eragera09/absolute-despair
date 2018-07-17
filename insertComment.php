<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 13/7/18
 * Time: 5:51 PM
 */

require_once("config.php");
if(!empty($_POST['text']) AND !empty($_POST['user']) AND !empty($_POST['postId'])) {
    $st = $db->prepare("INSERT INTO comments(text, userid, postid) values (:text, :userid, :postid)");
    $commentInserted = $st->execute([
        ":text" => $_POST['text'],
        ":userid" => $_POST['user']['userid'],
        ":postid" => $_POST['postId']
    ]);
    if ($commentInserted) {
        $commentID = $db->lastInsertId();
        $st2 = $db->prepare("SELECT * FROM comments WHERE id = :id");
        $st2->execute([
            ":id" => $commentID
        ]);
        $comment = $st2->fetch();
        $comment['user'] = $_POST['user'];
        $date = new DateTime($comment['date_created']);
        $comment['date_created'] = $date->format('Y') < (new DateTime)->format('Y') ? $date->format('dS F Y') : $date->format('dS F');
        echo json_encode($comment);
    }
}