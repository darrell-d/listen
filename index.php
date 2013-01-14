<?php
session_start();
/*****Dev Settings*****/
//error_reporting(E_ALL);
/*****End Dev Settings*****/
include('classes/Common.php');

printHeader("darrelld - Index!"); 
?>
<body>

	<?php //printNav($_SERVER['PHP_SELF']);?>
	
	<?php
		/*//Display the latest post
		$query = "SELECT * from posts ORDER BY id DESC LIMIT 1";
		$result = $mySQL_connection->query($query);
		$post = $result->fetch_assoc();
		$rowCount =  $result->num_rows;
		
		$title = $post['title'];
		$postBody = $post['post'];
		$author = $post['poster'];
		$date = $post['date'];
		$tags = $post['tags'];
		printPosts($post);*/
                printPosts(
                        array(
                            "id" => "999",
                            "post" => "Ah downtime.
                                
I'm having some issues with my hosting company. Lots of data loss and apologies all around from them. I'll be re-configuring shortly and getting everything back up and running once I get a chance to sit down and properly reconfigure everything.",
                            "title" => "Be Right Back",
                            "poster" => "darrelld",
                            "date" => "1358137634",
                            "tags" => "maintenance"
                            ))
		
	?>
	
	
	<?php
		include('footer.php');
	?>
	
</body>
</html>