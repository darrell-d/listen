<?php
//MySQL connection info

$mysql_user = "web";
$mysql_pass = "und3rstand";
$mysql_server = "darrelld.com";
$mysql_db = "blog";

$title = "darrelld - Index!";
$description = "Hi I'm Darrell De Freitas. This is my blog about software and technology. Come in and hopefully you'll leave with more than you came with.";
$keywords = "software developer, Darrell De Freitas, java, yip yap";
$author = "Darrell De Freitas";
$charset = "UTF-8";

function printHeader($title)
{
	echo
	"
		<link rel='stylesheet' type='text/css' href='style.css' />
		<title>". $title ."</title>
		<meta name ='description' content = '". $description."'>
		<meta name ='keywords' content = '".  $keywords."'>
		<meta name ='author' content = '".  $author."'>
		<meta charset = '".  $charset."'> 
	";
}
?>