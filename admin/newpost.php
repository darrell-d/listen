<?php
/*TODO:*Sanitize user input
*Preview mode
*Redirect on post
*/
session_start();
include('../classes/Common.php');
if($_SESSION['priv'] != "Owner")
{
	die("You don't belong here!");
}

$title = $_POST['title'];
$post = $_POST['post']; //NEITHER CAN BE TUSTED! But I'll allow it for now
$date = strtotime("now");

$query = "INSERT INTO posts (title,post, date, poster) VALUES ('". $title ."','". $post ."','". $date ."','". $_SESSION['user'] ."')";

if ($mySQL_connection->query($query))
{
    $result =  "Post Sucessful!";
}
else
{
    $result = "Error in saving post";
}
?>
<script type="text/javascript">
    window.location = "adminPanel.php?result=<? echo $result;?>"
</script>