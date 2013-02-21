<?php
    include(dirname(__FILE__) .' /../classes/Comments.php');
    //TODO: clean data
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $id = $_POST['id'];

    Comments::saveComment($id,$name,$comment, time());

?>
