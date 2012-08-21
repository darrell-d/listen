<?php
include('../classes/Comments.php');
//TODO: clean data
$id = $_POST['id'];

$comments =  Comments::loadComments($id);
foreach($comments as $c)
{
    echo "<i> " . $c['name'] . "</i>:  <br>" . $c['comment'] . " on " . date("jS F  Y",$c[time]) . "<p>--<p>";
}
?>
