<?
include('../classes/Common.php');

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
	$query = "SELECT pass, type FROM authentic_users WHERE `user` ='" . $user . "'";
	$result = $mySQL_connection->query($query);
	$rowData = $result->fetch_assoc();
	
	
	if(md5($pass) == $rowData["pass"])
	{
		$_SESSION['priv'] = $rowData["type"];
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