<?php
/*TODO:
 * Make Mysql variable global
 */
include('../classes/config.php');
include('../classes/MySQL.php');
$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
echo
"
<span id ='editPost'>
	<form action = 'editPost.php' method='POST'>
		<fieldset>
<legend><a href= javascript:onclick=loadPanel('new.php')>New Post</a></legend>
<legend style = 'background:#231243; size:30px; padding: 5px;'>Edit Post</legend>
<legend><a href= javascript:onclick=loadPanel('delete.php')>Delete Post</a></legend><br><br>
";

        $query = "SELECT id, title FROM posts";
        $result = $mySQL_connection->query($query);
        while ($row = $result->fetch_assoc() )
        {
                echo
                "<input type ='radio' name ='id' value ='" .  $row['id'] . "'>"
                . $row['id'] . " " . $row['title'] . "<br>";
        }

echo"
			<input type = \"submit\" name = \"editPost\" value=\"Edit!\">
		</fieldset>
	</form>
</span>	
";
?>