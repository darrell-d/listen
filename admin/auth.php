<?php
include('../classes/Common.php');
global $mySQL_connection;

if(!isset($_POST['submit']))
{
	echo "Error, Could not validate";
}

else
{
	session_start(); //Regsiter session
	
	//TODO: Write clean function to clean user input
	$user = $_POST['user'];
	$pass = $_POST['password'];
	//Search for user
	//Assumes unique user names. Gauruantee in sign up process.
	//$query = "SELECT pass, type FROM authentic_users WHERE `user` ='" . $user . "'";
        $query = $mySQL_connection->prepare("SELECT pass, type FROM authentic_users WHERE `user` = ?");
	//$result = $mySQL_connection->query($query);
        $query->bind_param('s',$user);
        $query->execute();
        $query->bind_result($dbPass,$type);
        $query->fetch();
	
	
	if(md5($pass) == $dbPass)
	{
		$_SESSION['priv'] = $type;
		$_SESSION['user'] = $user;
		header('Location: adminPanel.php');
	}
	else
	{
		$_SESSION['priv'] = "noAuth";
		echo "Incorrect user name or password";
	}
	
}


?>
