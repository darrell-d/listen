<?php 
session_start(); 
include('classes/Common.php');
 
printHeader("darrelld - eghm-blah!");
?>

<body>
    <span id ="banner">Hello Friend! What you see before you is a work in progress...things might break or just look funny(including the color scheme).</span>
	<span id ="navigation">
		<?php printNav($_SERVER['PHP_SELF'])?>
	</span>
	
	<?php
		if(isset($_GET['pid']))
		{
			/*TODO: Clean input
			* Fix ability to go to negative pages and future pages
			*/
			if(is_int(intval($_GET['pid']) ) )
			{
				$id =$_GET['pid'];
				$next = $id +1;
				$prev = $id -1;
				$query = "SELECT * FROM posts WHERE id =" . $id;
				
				$result = $mySQL_connection->query($query);
				$post = $result->fetch_assoc();
				
				printPosts($post);
				echo
				"
					<br>
					<span id ='prev'><a href='eghm-blah.php?pid=". $prev ."'>Previous</a></span>
					<span id ='next'><a href='eghm-blah.php?pid=". $next ."'>Next</a></span>
				";
				
			}
			else
			{
				echo "error";
			}
		}
		else
		{
			$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 25";
			$result = $mySQL_connection->query($query);
			while($row = $result->fetch_assoc() )
			{
				printPosts($row);
			}
		}
		

	?>
	<?php
		include('footer.php');
	?>
</body>
</html>