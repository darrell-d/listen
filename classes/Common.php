<?php
    session_start();
    
	include("config.php"); // Configuration files
	include("MySQL.php"); //SQL connection
	
	global $mySQL_connection;
	$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
        $_SESSION['mySQL_connection'] = $mySQL_connection;
	//Print out posts
	function printPosts($post)
	{
		$id = $post['id'];
		$title = $post['title'];
		$postBody = $post['post'];
		$author = $post['poster'];
		$date = $post['date'];
		$tags = $post['tags'];
		if($post == null)
		{
			echo
			"
				<div id ='entry'>
					<span id = 'title'> No Post!</span><span id ='author'> -- SYSTEM </span><br>
					<span id = 'post'>
					<p id = 'para'>
					Nothing to see here as yet. Move on.
					</p></span><br>
					<span id ='date'> BEFORE TIME</span>
					<span id ='tags'>
					tags:None</span>
					<span id = 'comments'>
					<a href=''>.......</a>
					</span>
				</div>
							<div id = 'commentsPID". $id ."' style = 'display:none;'></div>
			";
			return;
		}
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
				."</a></span><span id ='author'> -- ". $author ."</span><br>
				<span id = 'post'>
				<p id = 'para'>
				".
				$postBody
				."</p></span><br>
				<span id ='date'>".
				$date
				."</span>
				<span id ='tags'>
				tags:". $tags
				."</span>
				<span id = 'comments'>
				<a href='javascript:loadComments(\"commentsPID". $id ."\")'>other noise</a>
				</span>
			</div>
                        <div id = 'commentsPID". $id ."' style = 'display:none;'></div>
		";
	}
        function printHeader($title)
        {
		global $description,$keywords,$author,$charset;
            echo
            "
				<!DOCTYPE html>
				<html>
				<head>
					<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
					<script language = 'javascript' type='text/javascript' src='scripts.js'></script>
                    <link rel='stylesheet' type='text/css' href='style.css' />
                    <title>". $title ."</title>
                    <meta name ='description' content = '". $description."'>
                    <meta name ='keywords' content = '".  $keywords."'>
                    <meta name ='author' content = '".  $author."'>
                    <meta charset = '".  $charset."'> 
				</head>
            ";
        }
	
	//Print out the Nav bar
	function printNav($pageName)
	{
		global $mySQL_connection;
		
		$fileName = explode("/", $pageName);
		$arrCount = count($fileName);
		if($arrCount < 2)
		{
			$fileName = explode("\\", $pageName);
			$arrCount = count($fileName);
		}
		
		
		$pageName = $fileName[$arrCount - 1];
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
