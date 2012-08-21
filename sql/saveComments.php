<?php
include('../classes/Comments.php');
//TODO: clean data
$name = $_POST['name'];
$comment = $_POST['comment'];
$id = $_POST['id'];

$comments =  Comments::saveComment($id,$name,$comment, time());
?>
