<?php
session_start();
/*****Dev Settings*****/
//error_reporting(E_ALL);
/*****End Dev Settings*****/
include('classes/Common.php');

?>
<!DOCTYPE html>
<html>
<head>
    
<? printHeader("darrelld - Index!"); ?>

<script language = "javascript" type="text/javascript" src="scripts.js"></script>
</head>
<body>
    <span id ="banner">Hello Friend! What you see before you is a work in progress...things might break or just look funny.</span>

	<? printNav($_SERVER['PHP_SELF'])?>
	
	
	<?
		//Display the latest post
		$query = "SELECT * from posts ORDER BY id DESC LIMIT 1";
		$result = $mySQL_connection->query($query);
		$post = $result->fetch_assoc();
		
		
		printPosts($post['id'],$post['title'], $post['post'],$post['poster'],$post['date'],$post['tags']);
		
	?>
	
	
	<?
		include('footer.php');
	?>
	
</body>
</html>