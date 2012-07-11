<?php 
	session_start();
	if(isset($_POST['deletePostGo']))
	{
		//TODO: Scrub and clean data later
		$mysqli = new mysqli('ddefreitas.startlogicmysql.com','ddefreitas','understand','my_site');
		$query = "DELETE FROM posts WHERE id = '". $_SESSION['id'] ."'";
		$mysqli->query($query) or die($mysqli->error);
		header('Location: adminPanel.php');
	}
?>

<html>
<head>
	<title>Delete Post</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<?php
//Connect to DB
$mysqli = new mysqli('ddefreitas.startlogicmysql.com','ddefreitas','understand','my_site');
include('../classes/Common.php');
//Get the current ID
if(isset($_POST['id']))
{
	$_SESSION['id'] = $_POST['id'];
}

$query = "SELECT *  FROM posts WHERE id = '" . $_SESSION['id'] . "'";
$result = $mysqli->query($query);
$data= $result->fetch_assoc();
?>
<body>
	
	<span id = "body" style = "background:#dd0011;">
	Are you sure you want to delete this post below? (No take backs)
	<?php printPosts($_SESSION['id'],$data['title'], $data['post'],$data['poster'],$data['date'],$data['tags']); ?>
	<form action ='deletePost.php' method ='POST'>
		<input type ='submit' name ='YES' value = 'YES'><input type ='submit' name ='NO' value ='NO'>
		<input type ='hidden' name = 'deletePostGo' value ='true'>
	</form>
	</span>
</body>
</html>