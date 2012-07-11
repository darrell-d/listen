<?php
echo "
<fieldset>
<legend style = 'background:#231243; size:30px; padding: 5px;'>New Post</legend>
<legend><a href= '#'>Edit Post</a></legend>
<legend><a href= '#'>Delete Post</a></legend><br><br>
	Title: <input type = 'text' name = 'title'><br>
	Word Vomit:<br>
	<textarea rows = '15' cols = '50' name = 'post'></textarea><br>
	Tags: <input type = 'text' size = '50' name = 'tags'> <br>
	<input type = 'submit' name = 'newPostGo' value='Post!'>
</fieldset>
";
?>