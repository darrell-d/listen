<?php
/*TODO:
*Sanitize user input
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

$mySQL_connection->query($query);

echo "Post Sucessful!";

?>