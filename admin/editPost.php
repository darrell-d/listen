<?php 
    session_start();
    include('../classes/Common.php');
    if(!empty($_POST['editPostGo']) && strcmp($_POST['editPostGo'],'Post!' ) == 0)
    {
        
        $title = clean($_POST['title']);
        $post = clean($_POST['post']);
        $tags = clean($_POST['tags']);
        $id = clean($_SESSION['id']);

        /*$query = $mySQL_connection->prepare("UPDATE posts SET title = ?, post = ?, tags = ? WHERE id = ?");
        $query->bind_param('ssss',$title,$post,$tags,$id);
        $result = $query->execute();*/

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
if(!empty($_POST['id']))
{
	$_SESSION['id'] = clean($_POST['id']);
}

$query = "SELECT *  FROM posts WHERE id = '" . $_SESSION['id'] . "'";
$result = $mySQL_connection->query($query);
$data= $result->fetch_assoc();

?>
<body>
	<span id ='editPost'>
		<form action = 'editPost.php' method='POST'>
			<fieldset name><legend>Edit Post</legend>
				Title: <input type = 'text' name = 'title' value = "<?php echo $data['title']; ?>"><br>
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