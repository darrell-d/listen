<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/config.php'); // Configuration files
	include('MySQL.php'); //SQL connection
	
	global $mySQL_connection;	
	$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
	
	//Print out posts
	function printPosts($id,$title, $post,$author,$date,$tags)
	{
		if($date!= "" && $date != null)
		{
			$date = date("j M y",$date);
		}
		else
		{
			$date = "before time";
		}
		if($tags =="")
		{
			$tags = "none";
		}
		echo
		"
			<div id ='entry'>
				<span id = 'title'><a href='eghm-blah.php?pid=". $id ."'>".
				$title
				."</a></span><span id ='author'> by ". $author ."</span><br>
				<span id = 'post'>
				<p id = 'para'>
				".
				$post
				."</p></span><br>
				<span id ='date'>".
				$date
				."</span>
				<span id ='tags'>
				tags:". $tags
				."</span>
				<span id = 'comments'>
				<a href='#'>other noise</a>
				</span>
			</div>
		";
	}
	
	//Print out the Nav bar
	function printNav($pageName)
	{
		global $mySQL_connection;
		$pageName = trim(str_replace("/","",$pageName));
		
		if(strcmp($pageName,"index.php") == 0 )
		{
			echo "
				<table id = 'navigation'>
					<tr><td><b>Home<b></td></tr>
					<tr><td><a href = 'projects.php'>Projects</a></td></tr>
					<tr><td><a href = 'eghm-blah.php'>blah blah blah</a></td></tr>
					<tr><td></td></tr>
					<tr id= 'recent'><td>Recently</td></tr>";
					include('recently.php');
			echo "
					<tr id= 'sidebar-posts'>
					</tr>
				</table>
				";
		}
		else if(strcmp($pageName,"projects.php") == 0 )
		{
			echo "
				<table>
					<tr><td><a href='index.php'>Home</a></td></tr>
					<tr><td><b>Projects</b></td></tr>
					<tr><td><a href = 'eghm-blah.php'>blah blah blah</a></td></tr>
					<tr></tr>
					<tr id= 'recent'><td>Recently</td></tr>";
					include('recently.php');
			echo "
					<tr id= 'sidebar-posts'>
					</tr>
				</table>
				";
		}
		else if(strcmp($pageName,"eghm-blah.php") == 0 )
		{
			echo "
				<table>
					<tr><td><a href='index.php'>Home</a></td></tr>
					<tr><td><a href = 'projects.php'>Projects</a></td></tr>
					<tr><td><b>blah blah blah<b></td></tr>
					<tr></tr>
					<tr id= 'recent'><td>Recently</td></tr>";
					include('recently.php');
			echo "
					<tr id= 'sidebar-posts'>
					</tr>
				</table>
				";
		}
	}
?>