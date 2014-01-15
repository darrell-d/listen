<?php
/*
*Setup Configuration file for the first time software is  run
*/

if(isset($_POST['first-submit']))
{
		$file = fopen('config.php','w');
		fwrite($file,"<?php \n\n" );
		fwrite($file, '$mysql_server = \'' .$_POST['server'] . "';\n" );
		fwrite($file, '$mysql_user = \'' .$_POST['user'] . "';\n");
		fwrite($file, '$mysql_pass = \'' .$_POST['pass'] . "';\n");
		fwrite($file, '$mysql_db = \'' .$_POST['db'] . "';\n");
		
		fwrite($file, '$description = \'' .$_POST['description'] . "';\n" );
		fwrite($file, '$author = \'' .$_POST['author'] . "';\n" );
		fwrite($file, '$keywords = \'' .$_POST['keywords'] . "';\n" );
		fwrite($file, '$charset = \'' .$_POST['charset'] . "';\n\n" );
		
		fwrite($file,"?>" );
		
		fclose($file);
		$redirect = true;
}
?>
<html>
	<head>
		<title>First Setup</title>
<?php
if(isset($redirect))
{
	echo"<script> window.location ='sql/sql_setup.php'; </script>";
}
?>
	</head>
	<body>
		<form id = 'setup-form' action = 'first-setup.php' method = 'POST'>
			<label>Server Name<input type = 'text' name = 'server'></label><br/>
			<label>Username<input type = 'text' name = 'user'></label><br/>
			<label>password<input type = 'text' name = 'pass'></label><br/>
			<label>Server database<input type = 'text' name = 'db'></label><br/>
			
			<label>Description<input type = 'text' name = 'description'></label><br/>
			<label>Your Name<input type = 'text' name = 'author'></label><br/>
			<label>Keywords<input type = 'text' name = 'keywords'></label><br/>
			<label>Charset<input type = 'text' name = 'charset' value = 'UTF8'></label><br/>
			<input type = 'submit' value = 'Submit'>
			<input type ='hidden' name ='first-submit'>
		</form>
	</body>
</html>
