<?php
/*
*Administrative login
*By: Darrell De Freitas 02/01/2012
*/
session_start();
if(!isset($_SESSION['priv']) || strcmp($_SESSION['priv'], "noauth") == 0)
{

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<title>Admin Login</title>
	<meta charset = "UTF-8">
</head>
<body>
	<form method = "post" action ="auth.php">

			<div id = "auth">
				<p id ="auth">
					<img src = '../images/pass.png' alt ='Login'>
					<input type = "text" name = "user" placeholder = "User">
					<input type = "password" name = "password" placeholder = "Password">
                                        <input type ="hidden" name ="" value="">
					<input type ="submit" name ="submit" value ="Login" id = "adminLoginBtn">
				</p>
			</div>
	</form>
</body>
</html>
<?php
}
else if(strcmp($_SESSION['priv'], "Owner") == 0 )
{
	header('location: adminPanel.php');
}
?>