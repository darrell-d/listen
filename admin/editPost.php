<?php 
    session_start();
    include('../classes/Common.php');
    if(!empty($_POST['editPostGo']) && strcmp($_POST['editPostGo'],'Post!' ) == 0)
    {
        
        $title = $_POST['title'];
        $post = $_POST['post'];
        $tags = $_POST['tags'];
        $id = $_SESSION['id'];

        /*$query = $mySQL_connection->prepare("UPDATE posts SET title = ?, post = ?, tags = ? WHERE id = ?");
        $query->bind_param('ssss',$title,$post,$tags,$id);
        $result = $query->execute();*/


        $query = $mySQL_connection->prepare("UPDATE posts SET title = ?, post = ?, tags = ? WHERE id = ?");
        $query->bind_param('sssi',$title,$post,$tags,$id);
        $query->execute();
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

$query = $mySQL_connection->prepare("SELECT *  FROM posts WHERE id = ?");

$query->bind_param('i',$_SESSION['id']);
$query->execute();

$data = $query->get_result();
$data= $data->fetch_assoc();

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