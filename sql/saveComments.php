<?php
    include_once(dirname(__FILE__) .' /../classes/Comments.php');
    include_once(dirname(__FILE__) .' /../classes/Common.php');
    
    $name = clean($_POST['name']);
    $comment = clean($_POST['comment']);
    $id = clean($_POST['id']);

    Comments::saveComment($id,$name,$comment, time());

?>
