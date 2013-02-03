<?php

$query = "SELECT id,title from posts ORDER BY id DESC";
$result = $mySQL_connection->query($query);
$recentCount = $result->num_rows;

if(0 < $recentCount)
{
	while($row = $result->fetch_assoc() )
	{
		echo
		"
			<tr id = 'recentTitles'>
				<td><a href='eghm-blah.php?pid=". $row['id'] ."'>". $row['title'] ."</a></td>
			</tr>
		";
	}
}
else
{
	echo "<tr><td>Nothing but dust...</tr></td>";
}

?>