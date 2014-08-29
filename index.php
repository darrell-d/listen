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
    $path = getLatestPost();

    $post = readMarkDownFile($path);

    printHeader("darrelld - " . $post['title']); 
?>
<body>
<?php 
    printNav($_SERVER['PHP_SELF']);
    //Display the latest post
    printPosts($post);
    printFooter();
?>

