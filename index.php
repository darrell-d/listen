<?php
/*****Dev Settings*****/
error_reporting(E_ALL);
	if(!file_exists('config.php'))
	{
		header('Location:first-setup.php');
		die();
	}
    session_start();
	//Check if setup has been don.

	
    include('classes/Common.php');
    $queryBits = getLatestPost();

    printHeader("darrelld - " . $queryBits['post']['title']); 
?>
<body>
<?php 
    printNav($_SERVER['PHP_SELF']);
    //Display the latest post
    printPosts($queryBits['post']);
    printFooter();
?>

