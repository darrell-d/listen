<?php
//Read in db_setup file
$mysqli = new mysqli("localhost","root","understand");
$command = "";
$file = fopen('db_setup.sql','r');

while($data = fgets($file) )
{
	$command = $data;
	echo $command . "<br>";
	$mysqli->query($command) or die ($mysqli->error);
}
echo "Database structure created";
?>