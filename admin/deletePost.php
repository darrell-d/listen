<?php 
    //TODO:Allow for deleting multiple posts at once
    session_start();
    include('../classes/Common.php');

    $deletePostGo = clean($_POST['deletePostGo']);
    $id = clean($_POST['id']);

    if(isset($deletePosGo))
    {
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
if(isset($id))
{
	$_SESSION['id'] = $id;
}

$query = "SELECT *  FROM posts WHERE id = '" . $_SESSION['id'] . "'";
$result = $mySQL_connection->query($query);
$data= $result->fetch_assoc();
?>
<body>
    <span id ="delConf">
    Are you sure you want to delete this post below? (No take backs)
    </span>
    <?php printPosts(
            array(
                "id"=>$_SESSION['id'],
                "title"=>$data['title'],
                "post"=>$data['post'],
                "poster"=>$data['poster'],
                "date"=>$data['date'],
                "tags"=>$data['tags']
                )
            ) ; ?>
    <form action ='deletePost.php' method ='POST'>
        <center>
            <input type ='submit' name ='YES' value = 'YES'>
            <input type ='submit' name ='NO' value ='NO'>
        </center>
            <input type ='hidden' name = 'deletePostGo' value ='true'>
    </form>
	
</body>
</html>