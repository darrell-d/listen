<?php
include('../classes/Common.php');
echo
"
<span id ='editPost'>
	<form action = 'editPost.php' method='POST'>
		<fieldset>
<legend><a href= javascript:onclick=loadPanel('new.php')>New Post</a></legend>
<legend style = 'background:#231243; size:30px; padding: 5px;'>Edit Post</legend>
<legend><a href= javascript:onclick=loadPanel('delete.php')>Delete Post</a></legend><br><br>
";

        $query = $mySQL_connection->prepare("SELECT id, title FROM posts");
        $query->execute();
        $result = $query->get_result();
        
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