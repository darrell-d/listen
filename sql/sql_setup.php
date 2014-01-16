<?php
//Read in db_setup file
include('../classes/MySQL.php');
include('../config.php');

//$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass);

$mySQL_connection = new mysqli($mysql_server,$mysql_user,$mysql_pass);
$command = "";
$file = fopen('db_setup.sql','r');

while($data = fgets($file) )
{
	$command = eval($data);
	echo $command . "<br>";
	$stmt = $mySQL_connection->prepare($command);
	$stmt->execute();
}
echo "Database structure created";
?>
