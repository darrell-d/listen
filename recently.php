<?php

$query = "SELECT id,title from posts WHERE tags NOT LIKE '%_test%' ORDER BY id DESC";
$stmt = $mySQL_connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$recentCount = $result->num_rows;

if(0 < $recentCount)
{
	while($row = $result->fetch_assoc() )
	{
		echo
		"
			<tr class = 'recentTitles'>
				<td><a href='previous.php?pid=". $row['id'] ."'>". $row['title'] ."</a></td>
			</tr>
		";
	}
}
else
{
	echo "<tr><td>Nothing but dust...</tr></td>";
}

?>
