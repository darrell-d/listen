<?php
/*
*Preview mode
*Redirect on post
*/
session_start();
include('../classes/Common.php');
global $mySQL_connection;
if($_SESSION['priv'] != "Owner")
{
	die("You don't belong here!");
}

$title = clean($_POST['title']);
$post = clean($_POST['post']); 
$date = strtotime("now");

$query = $mySQL_connection->prepare("INSERT INTO posts (title,post, date, poster) VALUES (?,?,?,?)");

$query->bind_param('ssss',$title,$post,$date,$_SESSION['user']);
$result = $query->execute();

if($result ==1)
{
    $result = 'Post successful';
}
else
{
    $result = 'Error in posting';
}
?>
 
<script type="text/javascript">
    window.location = "adminPanel.php?result=<?php echo $result;?>"
</script>