<?php
//Prevent un authorized access
session_start();
include_once('../classes/Common.php');
if($_SESSION['priv'] != "Owner")
{
	die("You don't belong here!");
}
//Load up administrative tools
?>
<!doctype html>
<html>
<head>
	<title>Admin Power toys</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<script language = "javascript" type="text/javascript" src="../ajax/ajax.js"></script>
</head>

<body onload = 'loadPanel("new.php")'>
	<h1>Welcome admin!</h1>
        <span id = "notification">
            <?php
                if(isset($_GET['result']))
                {
                    echo clean($_GET['result']);
                }
            ?>
        </span>
	<span id = "admin_area">
		<div id = 'action'>
		</div>
	</span>
</body>

</html>