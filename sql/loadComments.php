<?php
include_once('../classes/Common.php');
include_once('../classes/Comments.php');

$id = clean($_POST['id']);

$comments =  Comments::loadComments($id);
foreach($comments as $c)
{
    echo
    "
        <span class = 'commenterName'>$c[name]</span> said:
        <div class = 'userComment'>$c[comment]</div>
        <div class ='commentDate'>". date('d F Y \a\t g:i',$c['time']) ."</div>
    ";
}
?>
