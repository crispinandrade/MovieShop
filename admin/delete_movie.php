<?php
include("connectdb.php");
	$movieID = $_POST["movieID"];
	$thumb = $_POST["thumb"];
	$success = 0;
	
	$query1 = "DELETE FROM movie WHERE movie_id = $movieID"; 
	$query2 = "DELETE FROM movie_actor WHERE movie_id = $movieID"; 
		 
		if(file_exists("images/".$thumb.""))
		{
			// remove image from images folder
			unlink("images/".$thumb."");
			$success = 1;
		}
	$success = 1;
	if($success){
		$result = mysql_query($query1);
		$result = mysql_query($query2);
		if ($success == 1){
			echo "<strong>Movie $movieID has been successfully deleted</strong>";
		}
	}
?>