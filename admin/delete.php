<?php
include(dirname(__FILE__) . "/../config.php"); // Configuration files
include('../classes/MySQL.php');
$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
echo
"
<span id ='deletePost'>
	<form action = 'deletePost.php' method='POST'>
		<fieldset>
<legend><a href= javascript:onclick=loadPanel('new.php')>New Post</a></legend>
<legend><a href= javascript:onclick=loadPanel('edit.php')>Edit Post</a></legend>
<legend style = 'background:#231243; size:30px; padding: 5px;'>Delete Post</legend><br><br>
";

        $query = $mySQL_connection->prepare("SELECT id, title FROM posts");
        $query->execute();
        $result = $query->get_result();
        while ($row = $result->fetch_assoc() )
        {
                echo
                "<input type ='checkbox' name ='id[]' value = '" .  $row['id'] . "'>"
                    . $row['id'] . " " . $row['title'] . "<br>";
        }

echo"
			<input type = \"submit\" name = \"deletePost\" value=\"Delete!\">
		</fieldset>
	</form>
</span>	
";
?>