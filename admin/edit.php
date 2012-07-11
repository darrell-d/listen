<span id ='editPost'>
	<form action = 'editPost.php' method='POST'>
		<fieldset name><legend>Edit Post</legend>
			<?
				$query = "SELECT id, title FROM posts";
				$result = $mySQL_connection->query($query);
				while ($row = $result->fetch_assoc() )
				{
					echo
					"<input type ='radio' name ='id' value ='" .  $row['id'] . "'>"
					. $row['id'] . " " . $row['title'] . "<br>";
				}
			?>
			<input type = "submit" name = "editPost" value="Edit!">
		</fieldset>
	</form>
</span>	