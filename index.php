<?php
session_start();
/*****Dev Settings*****/
error_reporting(E_ALL);
/*****End Dev Settings*****/
include('classes/Common.php');

printHeader("darrelld - Home"); 
?>
<body>
	<?php printNav($_SERVER['PHP_SELF']);?>
	
	<?php
		//Display the latest post
		$query = "SELECT * from posts ORDER BY id DESC LIMIT 1";
		$result = $mySQL_connection->query($query);
		$post = $result->fetch_assoc();
		$rowCount =  $result->num_rows;
		
		
		printPosts($post);
		
	?>
</body>
</html>