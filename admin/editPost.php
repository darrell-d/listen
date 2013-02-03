<?php 
	session_start();
        include('../classes/Common.php');
	if(isset($_POST['editPostGo']))
	{
            //TODO: Scrub and clean data later
            $title = addslashes($_POST['title']);
            $post = addslashes($_POST['post']);
            $tags = addslashes($_POST['tags']);
            $id = addslashes($_SESSION['id']);
            
            
            $query = "UPDATE posts SET title = '". $title ."', post = '". $post ."', tags = '".  $tags."' WHERE id = '".  $id."'";
            $mySQL_connection->query($query) or die($mySQL_connection->error);
            echo "Post sucessfully updated";
	}
?>

<html>
<head>
	<title>Edit Post</title>
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