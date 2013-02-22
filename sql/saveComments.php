<?php
    include_once(dirname(__FILE__) .' /../classes/Comments.php');
    
    $name = clean($_POST['name']);
    $comment = clean(['comment']);
    $id = clean($_POST['id']);

    Comments::saveComment($id,$name,$comment, time());

?>
