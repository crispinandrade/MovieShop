<?php
	include("connectdb.php");
	
	$movie_query = "SELECT movie_id, title, year 
					FROM movie
					ORDER BY title";
	$result = mysql_query($movie_query);
	$num_rows = mysql_num_rows($result);
	$row = mysql_fetch_row($result);

	echo "<strong>Select a movie to edit/delete</strong>\n
			<form method = 'get' action = 'admin.php'>\n
			<input type='hidden' name='action' value='EditMovie'>
			<select name = 'movie_id'>\n
			<option selected='selected' disabled='disabled'>Please Select</option>";
	for($i = 0; $i < $num_rows; $i++){
		echo "<option value = \"" .$row[0]. "\">" .$row[1]." - ".$row[2]."</option>\n";
		$row = mysql_fetch_row($result);
	}  
	echo "</select><input type=submit value=Search />";
	echo "</form>";
?>