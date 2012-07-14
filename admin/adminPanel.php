<?php
/*TODO:
* Delete Post
* Edit post
*/

//Prevent un authorized access
session_start();
if($_SESSION['priv'] != "Owner")
{
	die("You don't belong here!");
}
//Load up administrative tools
?>
<!doctype html>
<html>
<head>
	<title>Admin Power toys</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<script language = "javascript" type="text/javascript" src="../ajax/ajax.js"></script>
</head>

<body onload = 'loadPanel("new.php")'>
	<h1>Welcome admin!</h1>
	<span id = "admin_area">
		<form action = 'newpost.php' method='POST'>
		<div id = 'action'>
		</div>
		</form>
	</span>
</body>

</html>