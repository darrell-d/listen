<span id ='deletePost'>
	<form action = 'deletePost.php' method='POST'>
		<fieldset name><legend>Delete</legend>
			<?
				$query = "SELECT id, title FROM posts";
				$result = $mySQL_connection->query($query);
				while ($row = $result->fetch_assoc() )
				{
					echo
					"<input type ='checkbox' name ='id' value = '" .  $row['id'] . "'>"
					. $row['id'] . " " . $row['title'] . "<br>";
				}
			?>
			<input type = "submit" name = "newPostGo" value="Delete!">
		</fieldset>
	</form>
</span>