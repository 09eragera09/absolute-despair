<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 19/7/18
 * Time: 12:37 AM
 */

require_once('config.php');

if (!empty($_POST['text']) AND !empty($_POST['user']) AND !empty($_POST['commentID'])) {
    $st = $db->prepare("UPDATE comments SET text = :text WHERE id = :id");
    $updateWasSuccessful = $st->execute([
        ':text' => $_POST['text'],
        ':id' => $_POST['commentID']
    ]);
    echo(json_encode($updateWasSuccessful));
} else {
    echo(json_encode(false));
}