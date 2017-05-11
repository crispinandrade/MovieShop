<?php
	if(!isset($_GET["movie_id"])){
		echo "<strong>Please select a movie. \nPress the back button on your browser to fix this";
	}
	else{
		include("connectdb.php");
		//movie query
		$movieID = $_GET["movie_id"];
		
		$movie_query = "SELECT * FROM movie
						WHERE movie_id = $movieID";
		$result = mysql_query($movie_query);
		$row = mysql_fetch_row($result);
		
		//year query
		
		$year_query = "SELECT DISTINCT rental_period FROM movie";
		$result = mysql_query($year_query);
		$num_rows = mysql_num_rows($result);
		$Yrow = mysql_fetch_row($result);
		
		//form to edit/delete the movie
		echo "<form method=\"post\" action=\"admin.php\">\n";
		// field for movie information
		echo "<fieldset style=\"width\">\n";
		echo "<legend>Movie Information</legend>";
		if ($row[4] == ""){
			echo "no image available";
		}
		else{
			echo "<img class=\"moviePoster\" src=\"images/$row[4]\" alt=\"Item $row[0]\" />\n";
		}
		echo "<div style=\"display: block;\">";
		echo "<label>Movie ID:";
		echo "<input type=\"text\" name=\"movieID\" size=\"4\" value=\"$row[0]\" disabled>";
		echo "</div>";
		echo "<div>";
		echo "<label>Title:</label>";
		echo "<input type=\"text\" name=\"title\" size=\"45\" value=\"$row[1]\" disabled>";
		echo "</div>";
		echo "<div>";
		echo "<label>Year:		";
		echo "<input type=\"text\" name=\"year\" size=\"4\" value=\"$row[10]\" disabled>";
		echo "</div>";
		echo "<div>";
		echo "<label>Tag line:		";
		echo "<input type=\"text\" name=\"tagline\" size=\"100\" value=\"$row[2]\" disabled>";
		echo "</div>";
		echo "</fieldset>";
		//field for stock information
		echo "<fieldset>\n";
		echo "<legend>Stock Information</legend>";
		echo "<div>";
		echo "<label>Rental Period:		</label>";
		echo "<select name = 'rental_period'>\n";
		echo "<option value=\"".$row[9]."\">" .$row[9]."</option>";
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$Yrow[0]. "\">" .$Yrow[0]."</option>\n";
				$Yrow = mysql_fetch_row($result);
			}  
		echo "</select><span style=\"color:red;\"> *</span>";
		echo "</div>";
		// DVD Field
		echo "<fieldset>
				<legend>DVD</legend>
				<div>
				<label for=\"dvdrental\">Rental price:</label>
				<input type=\"text\" name=\"dvdrental\" size=\"5\" maxlength=\"10\" value=\"$row[11]\">
				<span style=\"color:red;\">*</span>
				</div>";
		echo "<div id=\"dvdpurchaserow\">
			<label for=\"dvdpurchase\">Purchase price:</label>
			<input type=\"text\" name=\"dvdpurchase\" size=\"5\" maxlength=\"10\" value=\"$row[12]\">
			<span style=\"color:red;\">*</span>
			</div>";
		echo "<div id=\"dvdstockrow\">
			<label for=\"dvdstock\">In-stock:</label>
			<input type=\"text\" name=\"dvdstock\" size=\"5\" maxlength=\"10\" value=\"$row[13]\">
			<span style=\"color:red;\">*</span>
			</div>";
		echo "<div id=\"dvdrentedrow\">
			<label for=\"dvdrented\">Currently rented:</label>
			<input type=\"text\" name=\"dvdrented\" size=\"5\" maxlength=\"10\" value=\"$row[14]\">
			<span style=\"color:red;\"> * Overwrite only if a rental has failed to be returned.</span>
			</div>";
		echo "<div id=\"dvdshelfrow\">
			<label for=\"dvdshelf\">In Store:</label>
			<input type=\"text\" name=\"dvdshelf\" size=\"5\" maxlength=\"10\" value=\"$row[13]\" disabled/>
			</div></fieldset>";
			//BluRay Field
		echo "<fieldset><legend>BluRay:</legend><div id=\"blurentalrow\">
			<label for=\"blurental\">Rental price:</label>
			<input type=\"text\" name=\"blurental\" size=\"5\" value=\"$row[15]\">
			<span style=\"color:red;\">*</span>
			</div><div id=\"blupurchaserow\">
			<label for=\"blupurchase\">Purchase price:</label>
			<input type=\"text\" name=\"blupurchase\" size=\"5\" value=\"$row[16]\">
			<span style=\"color:red;\">*</span>
			</div><div id=\"blustockrow\">
			<label for=\"blustock\">In-stock:</label>
			<input type=\"text\" name=\"blustock\" size=\"5\" value=\"$row[17]\">
			<span style=\"color:red;\">*</span>
			</div><div id=\"blurentedrow\">
			<label for=\"blurented\">Currently rented:</label>
			<input type=\"text\" name=\"blurented\" size=\"5\" value=\"$row[18]\">
			<span style=\"color:red;\"> * Overwrite only if a rental has failed to be returned.</span>
			</div><div id=\"blurentedrow\">
			<label for=\"blushelf\">In Store:</label>
			<input type=\"text\" name=\"blushelf\" size=\"5\" value=\"$row[17]\" disabled>
			</div></fieldset></fieldset>";
		echo "<div>
            <input type=\"submit\" value=\"Update Movie\">
			<input type='hidden' name='action' value='UpdateMovie'>
			<input type =\"hidden\" name=\"movieID\" value =\"$row[0]\" />
          </div><br></form>";
		echo "<form method=\"post\" action=\"admin.php\">
            <div>
			<input type=\"submit\" value=\"Delete Movie\"> 
               <input type=\"hidden\" name=\"action\" value=\"DeleteMovie\"> 
			   <input type=\"hidden\" name=\"movieID\" value=\"$row[0]\"> 
               <input type=\"hidden\" name=\"movie\" value=\"$row[0].\" - \" .$row[1].\"> 
               <input type=\"hidden\" name=\"thumb\" value=\"$row[4]\">               
               
            </div>                   
             </form>";
	}
?>