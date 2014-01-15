<?php
	if(!file_exists('config.php'))
	{
		header('Location:first-setup.php');
		die();
	}
    session_start();
	//Check if setup has been don.

	
    include('classes/Common.php');
    //Queyy for front page post
    $query = "SELECT * from posts ORDER BY id DESC LIMIT 1";
    $result = $mySQL_connection->query($query);
    $post = $result->fetch_assoc();
    $rowCount =  $result->num_rows;

    printHeader("darrelld - " . $post['title']); 
?>
<body>
<?php 
    printNav($_SERVER['PHP_SELF']);
    //Display the latest post
    printPosts($post);
    printFooter();
?>

