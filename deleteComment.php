<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 17/7/18
 * Time: 5:46 PM
 */

require_once ('config.php');

if (!empty($_POST['commentID']) AND !empty($_POST['admin'])) {
    $st = $db->prepare("DELETE FROM comments where id = :id");
    $deleteWasSuccessful = $st->execute([
        ':id'=>$_POST['commentID']
    ]);
    echo(json_encode($deleteWasSuccessful));
} else {
    echo(json_encode(false));
}