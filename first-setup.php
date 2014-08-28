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
<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8"/>
	</head>
	<body>
		<div id = "first-setup">
			<form id = 'setup-form' action = 'first-setup.php' method = 'POST'>
				<h4 id = "setup-header">Blog setup</h4>
				<table>
					<tr>
						<td>Server Name</td>
						<td><input type = 'text' name = 'server'></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type = 'text' name = 'user'></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type = 'text' name = 'pass'></td>
					</tr>
					<tr>
						<td>Server Database</td>
						<td><input type = 'text' name = 'db'></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type = 'text' name = 'description'></td>
					</tr>
					<tr>
						<td>Your Name</td>
						<td><input type = 'text' name = 'author'></td>
					</tr>
					<tr>
						<td>Keywords</td>
						<td><input type = 'text' name = 'keywords'></td>
					</tr>
					<tr>
						<td>Charset</td>
						<td><input type = 'text' name = 'charset' value = 'UTF8'></td>
					</tr>
				</table>

				<input type = 'submit' value = 'Submit'>
				<input type ='hidden' name ='first-submit'>
			</form>
		</div>
	</body>
</html>
