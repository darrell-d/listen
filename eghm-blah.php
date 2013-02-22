<?php 
session_start(); 
include('classes/Common.php');
 
printHeader("darrelld - eghm-blah!");
?>

<body>
	<span id ="navigation">
		<?php printNav($_SERVER['PHP_SELF'])?>
	</span>
	
	<?php
        global $mySQL_connection;
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
                else if(isset($_GET['tag']) )
                {
                    $tag = $_GET['tag'];
                    $query = $mySQL_connection->prepare("SELECT * FROM posts WHERE tags LIKE '%$tag%'");
                    $query->execute();

                    $query->bind_result($id_result,$title_result,$post_result,$date_result,$comments_result,$tags_result,$posters_result);
                    while($query->fetch() )
                    {
                        $post = array(
                          "id" => $id_result,
                            "title" => $title_result,
                            "post" => $post_result,
                            "poster" => $posters_result,
                            "date" =>$date_result,
                            "comments" => $comments_result,
                            "tags" => $tags_result
                        );
                        printPosts($post);
                        
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
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js' defer ></script>
<script src='scripts.js' defer></script>
<script src='bootstrap/js/bootstrap.min.js' defer></script>
</body>
</html>