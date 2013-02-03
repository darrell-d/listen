<?php
/*
*Administrative login
*By: Darrell De Freitas 02/01/2012
*/
session_start();
if(!isset($_SESSION['priv']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<title>!</title>
	<meta charset = "UTF-8">
</head>
<body>
	<form method = "post" action ="auth.php">

			<div id = "auth">
				<p id ="auth">
					<img src = '../images/pass.png' alt ='Login'>
					<input type = "text" name = "user" value = "User">
					<input type = "password" name = "password" value = "Password">
					<input type ="submit" name ="submit" value ="Login">
				</p>
			</div>
	</form>
</body>
</html>
<?php
}
else
{
	header('location: adminPanel.php');
}
?>