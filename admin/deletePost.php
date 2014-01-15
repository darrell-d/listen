<?php 
    session_start();
    include('../classes/Common.php');
    global $mySQL_connection;
    
    if(!empty($_POST['deletePostGo']) )
    {
        if(strcmp($_POST['confirmation'],"yes") == 0)
        {
            foreach($_SESSION['id'] as $var)
            {
                $query = $mySQL_connection->prepare("DELETE FROM posts WHERE id = ?");
                $query->bind_param('i',$var);
                $query->execute();
            }
            header('Location: adminPanel.php?result=Post sucessfully deleted');
        }
        else
        {
            header('Location: adminPanel.php?result=Post deletion cancelled');
        }
        
    }
?>

<html>
<head>
	<title>Delete Post</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<?php
//Get the current ID
 $id = clean($_POST['id']);
if(isset($id))
{
	$_SESSION['id'] = $id;
}

$query = "SELECT *  FROM posts WHERE id =";

$size = count($_SESSION['id']);
foreach($_SESSION['id'] as $key=>$var)
{
    if($key == $size -1)
    {
        $query.= " '$var'";
    }
    else
    {
        $query.= " '$var' OR id =";
    }
}


$result = $mySQL_connection->query($query);
$demAdj= $result->num_rows > 1? "this" : "these";

echo
'
<body>
    <span id ="delConf">
    Are you sure you want to delete'. $demAdj .' post below?
    </span>';
while ($data= $result->fetch_assoc())
{
    printPosts(
            array(
                "id"=>$data['id'],
                "title"=>$data['title'],
                "post"=>$data['post'],
                "poster"=>$data['poster'],
                "date"=>$data['date'],
                "tags"=>$data['tags']
                ),
            false
            );
}
echo'
    <form action ="deletePost.php" method ="POST">
        <center>
            <input type ="submit" name ="confirmation" value = "yes">
            <input type ="submit" name ="confirmation" value ="no">
        </center>
            <input type ="hidden" name = "deletePostGo" value ="true">
    </form>
	
</body>
</html>
';


?>