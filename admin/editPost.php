<?php 
	session_start();
	if(isset($_POST['editPostGo']))
	{
		//TODO: Scrub and clean data later
		$mysqli = new mysqli('ddefreitas.startlogicmysql.com','ddefreitas','understand','my_site');
		$query = "UPDATE posts SET title = '". $_POST['title'] ."', post = '". $_POST['post'] ."', tags = '".  $_POST['tags']."' WHERE id = '".  $_SESSION['id']."'";
		$mysqli->query($query) or die($mysqli->error);
		Echo "Post sucessfully updated";
	}
?>

<html>
<head>
	<title>Edit Post</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<?php
//Connect to DB
$mysqli = new mysqli('ddefreitas.startlogicmysql.com','ddefreitas','understand','my_site');
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
	<h1>Edit Post</h1>
	<span id ='editPost'>
		<form action = 'editPost.php' method='POST'>
			<fieldset name><legend>Edit Post</legend>
				Title: <input type = 'text' name = 'title' value = '<?php echo $data['title']; ?>'><br>
				Word Vomit:<br>
				<textarea rows = '15' cols = '50' name = 'post'><?php echo $data['post']; ?></textarea><br>
				Tags: <input type = 'text' size = '50' name = 'tags' value = '<?php echo $data['tags']; ?>'> <br>
				<input type = "submit" name = "editPostGo" value="Post!">
			</fieldset>
		</form>
	</span>
	<br>
	<a href = 'adminPanel.php'>Back to Admin Panel</a>
</body>
</html>