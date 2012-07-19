<?php
include('classes/Common.php');
?>
<!DOCTYPE html>
<html>
<head>
<? printHeader("darrelld - Projects!");?>
</head>
<body>
    <span id ="banner">Hello Friend! What you see before you is a work in progress...things might break or just look funny.</span>
	<span id ="navigation">
		<? printNav($_SERVER['PHP_SELF'])?>
	</span>
	<span id = "item">
            <a href="https://github.com/darrell-d/listen">listen!</a><br>
                You want to speak. 
                <br>You have words that need to be heard. 
                <br>You need people to listen.
                
                <br><br><em>listen</em> lets you do that. 
                <br>Be heard.
	</span>
	
	<?
		include('footer.php');
	?>
	
</body>
</html>