<?php
include('../classes/Common.php');
global $mySQL_connection;
session_start(); //Regsiter session

$user = clean($_POST['user']);
$pass = clean($_POST['password']);
//Search for user
/*Assumes unique user names. 
**TODO: Gauruantee in sign up process.
*/
$query = $mySQL_connection->prepare("SELECT pass, type FROM authentic_users WHERE `user` = ?");
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
        $_SESSION['priv'] = "noauth";
        echo "Incorrect user name or password";
}

?>
