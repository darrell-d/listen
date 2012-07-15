<?php
echo "
<form action = 'newpost.php' method='POST'>
<fieldset>
<legend style = 'background:#231243; size:30px; padding: 5px;'>New Post</legend>
<legend><a href= javascript:onclick=loadPanel('edit.php')>Edit Post</a></legend>
<legend><a href= javascript:onclick=loadPanel('delete.php')>Delete Post</a></legend><br><br>
	Title: <input type = 'text' name = 'title'><br>
	Word Vomit:<br>
	<textarea rows = '15' cols = '50' name = 'post'></textarea><br>
	Tags: <input type = 'text' size = '50' name = 'tags'> <br>
	<input type = 'submit' name = 'newPostGo' value='Post!'>
</fieldset>
</form>

";
?>