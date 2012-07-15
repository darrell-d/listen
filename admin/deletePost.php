<?php 
//TODO:Allow for deleting multiple posts at once
session_start();
include('../classes/Common.php');
	
	if(isset($_POST['deletePostGo']))
	{
		//TODO: Scrub and clean data later
		$query = "DELETE FROM posts WHERE id = '". $_SESSION['id'] ."'";
		$mySQL_connection->query($query) or die($mySQL_connection->error);
		header('Location: adminPanel.php?result=Post sucessfully deleted');
	}
?>

<html>
<head>
	<title>Delete Post</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<?php
//Get the current ID
if(isset($_POST['id']))
{
	$_SESSION['id'] = $_POST['id'];
}

$query = "SELECT *  FROM posts WHERE id = '" . $_SESSION['id'] . "'";
$result = $mySQL_connection->query($query);
$data= $result->fetch_assoc();
?>
<body>
	
	<span id ="delConf">
	Are you sure you want to delete this post below? (No take backs)
        </span>
	<?php printPosts($_SESSION['id'],$data['title'], $data['post'],$data['poster'],$data['date'],$data['tags']); ?>
	<form action ='deletePost.php' method ='POST'>
            <center>
		<input type ='submit' name ='YES' value = 'YES'>
                <input type ='submit' name ='NO' value ='NO'>
            </center>
		<input type ='hidden' name = 'deletePostGo' value ='true'>
	</form>
	
</body>
</html>