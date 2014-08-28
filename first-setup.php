<?php
/*
*Setup Configuration file for the first time software is  run
*/

function writeINI($arr, $file)
{
	try
	{
		$file = fopen('config.ini','w');
		fwrite($file,'[SQL Details]' . PHP_EOL);
		foreach($arr as $key => $value)
		{
			if($key == 'description')
			{
				fwrite($file, PHP_EOL . '[META Data]'. PHP_EOL);
			}
			fwrite($file, $key .'	=		\'' .  $value . '\'' . PHP_EOL);
		}
	}
	catch(Exception $e)
	{
		echo "Error found: " . $e->GetMessage();
	}
	fclose($file);
}

if(isset($_POST['first-submit']))
{
		unset($_POST['first-submit']);
		writeINI($_POST,'config.ini');
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
