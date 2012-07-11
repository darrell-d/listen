<?php
include('classes/Common.php');
?>
<!DOCTYPE html>
<html>
<head>
<? printHeader("darrelld - Projects!");?>
</head>
<body>
	<span id ="navigation">
		<? printNav($_SERVER['PHP_SELF'])?>
	</span>
	<span id = "item">
	Current: This blog / website thing.
	</span>
	
	<?
		include('footer.php');
	?>
	
</body>
</html>