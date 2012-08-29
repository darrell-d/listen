<?php
//Read in db_setup file
include('../classes/MySQL.php');
include('../classes/config.php');

$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

$mySQL_connection = new mysqli("localhost","root","understand");
$command = "";
$file = fopen('db_setup.sql','r');

while($data = fgets($file) )
{
	$command = $data;
	echo $command . "<br>";
	$mySQL_connection->query($command) or die ($mySQL_connection->error);
}
echo "Database structure created";
?>