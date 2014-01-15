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
	$mySQL_connection->query($command) or die ($mySQL_connection->error);
}
echo "Database structure created";
?>
