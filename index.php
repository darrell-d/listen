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
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js' defer ></script>
<script src='scripts.js' defer></script>
<script src='bootstrap/js/bootstrap.min.js' defer></script>

</body>
</html>
