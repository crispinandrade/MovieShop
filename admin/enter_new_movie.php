<?php
// create queries for drop downs and if movies exist maybe?
include("connectdb.php");

	echo "<form id=\"joinform\" name=\"joinform\" method=\"post\" action=\"admin.php\" enctype=\"multipart/form-data\" autocomplete=\"on\">
         <input type=\"hidden\" name=\"action\" value=\"InsertNewMovie\">
		 <input type=\"hidden\" name=\"submitted\" value=\"true\">
		 <fieldset>
         <fieldset>
            <legend style=\"\">New movie:</legend><div id=\"titlerow\">
          <label for=\"title\">Title:</label>
          <input type=\"text\" name=\"title\" size=\"45\" maxlength=\"45\"> 
          <span style=\"color:red;\">*</span>
          </div><div id=\"yearrow\">
          <label for=\"year\">Year:</label>
          <input type=\"text\" name=\"year\" size=\"4\" maxlength=\"4\">
          <span style=\"color:red;\">*</span>
          </div><div id=\"taglinerow\">
          <label for=\"tagline\">Tag line:</label>
          <input type=\"text\" name=\"tagline\" size=\"60\" maxlength=\"128\">
          <span style=\"color:red;\">*</span>
          </div><div id=\"plotrow\">
         <label for=\"plot\">Plot:</label>
         <textarea name=\"plot\" rows=\"1\" cols=\"60\" maxlength=\"256\"></textarea>
         <span style=\"color:red;\">*</span>
         </div><div id=\"posterrow\">
         <label for=\"poster\">Poster:</label>
         <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\">
         <input type=\"file\" name=\"upload_images[]\">
         <span style=\"color:red;\">*</span>
         </div><div class=\"dropdownrow\" id=\"director_namerow\"><div>
        <label for=\"director_name\">Director:</label>
        <select name=\"director_name\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// Director dd
		$query = "SELECT * FROM director ORDER BY director_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "</select><span style=\"color:red;\"> *</span></div><div><label for=\"director_namenew\">Or new director:</label>
           <input type=\"text\" name=\"director_namenew\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"studio_namerow\"><div>
        <label for=\"studio_name\">Studio:</label>
        <select name=\"studio_name\">
		// fill with option loop
		<option selected='selected'>Please Select</option>";
// Studio dd
		$query = "SELECT * FROM studio ORDER BY studio_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "</select><span style=\"color:red;\"> *</span></div><div><label for=\"studio_namenew\">Or new studio:</label>
           <input type=\"text\" name=\"studio_namenew\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"genre_namerow\"><div>
        <label for=\"genre_name\">Genre:</label>
        <select name=\"genre_name\">
		// fill with option loop
		<option selected='selected'>Please Select</option>";
// genre dd
		$query = "SELECT * FROM genre ORDER BY genre_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "</select><span style=\"color:red;\"> *</span></div><div><label for=\"genre_namenew\">Or new genre:</label>
           <input type=\"text\" name=\"genre_namenew\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"classificationrow\"><div>
        <label for=\"classification\">Classification:</label>
        <select name=\"classification\">
		// fill with option loop
		<option selected='selected'>Please Select</option>";
// classification dd
		$query = "SELECT DISTINCT classification FROM movie";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[0]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "</select><span style=\"color:red;\"> *</span></div><div><label for=\"classificationnew\">Or new classification:</label>
           <input type=\"text\" name=\"classificationnew\" size=\"25\" maxlength=\"128\"></div></div></fieldset><fieldset><legend>Movies Stars and Co-stars:</legend><div class=\"dropdownrow\" id=\"star1row\"><div>
        <label for=\"star1\">First star:</label>
        <select name=\"star1\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// star1 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "</select><span style=\"color:red;\"> *</span></div><div><label for=\"star1new\">Or new star1:</label>
           <input type=\"text\" name=\"star1new\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"star2row\"><div>
        <label for=\"star2\">Second star:</label>
        <select name=\"star2\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// star2 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "
		</select><span style=\"color:red;\"> *</span></div><div><label for=\"star2new\">Or new star2:</label>
           <input type=\"text\" name=\"star2new\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"star3row\"><div>
        <label for=\"star3\">Third star:</label>
        <select name=\"star3\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// star3 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			}  
		echo "
		</select></div><div><label for=\"star3new\">Or new star3:</label>
           <input type=\"text\" name=\"star3new\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"costar1row\"><div>
        <label for=\"costar1\">First costar:</label>
        <select name=\"costar1\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// costar1 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "
		</select></div><div><label for=\"costar1new\">Or new costar1:</label>
           <input type=\"text\" name=\"costar1new\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"costar2row\"><div>
        <label for=\"costar2\">Second costar:</label>
        <select name=\"costar2\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// costar2 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "
		</select></div><div><label for=\"costar2new\">Or new costar2:</label>
           <input type=\"text\" name=\"costar2new\" size=\"25\" maxlength=\"128\"></div></div><div class=\"dropdownrow\" id=\"costar3row\"><div>
        <label for=\"costar3\">Third costar:</label>
        <select name=\"costar3\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// costar3 dd
		$query = "SELECT * FROM actor ORDER BY actor_name";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "
		</select></div><div><label for=\"costar3new\">Or new costar3:</label>
           <input type=\"text\" name=\"costar3new\" size=\"25\" maxlength=\"128\"></div></div></fieldset><fieldset id=\"stockfield\"><legend>Stock Information:</legend><div class=\"dropdownrow\" id=\"rental_periodrow\"><div>
        <label for=\"rental_period\">Rental Period:</label>
        <select name=\"rental_period\">
        // fill with option loop
		<option selected='selected'>Please Select</option>";
// rental period dd
		$query = "SELECT DISTINCT rental_period FROM movie";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_row($result);
			for($i = 0; $i < $num_rows; $i++){
				echo "<option value = \"" .$row[0]. "\">" .$row[0]. "</option>\n";
				$row = mysql_fetch_row($result);
			} 
		echo "
		</select><span style=\"color:red;\"> *</span></div><br><fieldset><legend>DVD:</legend><div id=\"dvdrentalrow\">
           <label for=\"dvdrental\">Rental price:</label>
           <input type=\"text\" name=\"dvdrental\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"dvdpurchaserow\">
           <label for=\"dvdpurchase\">Purchase price:</label>
           <input type=\"text\" name=\"dvdpurchase\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"dvdstockrow\">
           <label for=\"dvdstock\">In-stock:</label>
           <input type=\"text\" name=\"dvdstock\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"dvdrentedrow\">
           <label for=\"dvdrented\">Rented:</label>
           <input type=\"text\" name=\"dvdrented\" size=\"5\" maxlength=\"10\" value=\"0\">
           <span style=\"color:red;\">* Overwrite only if some rented before system entry.</span>
        </div></fieldset><fieldset><legend>BluRay:</legend><div id=\"blurentalrow\">
           <label for=\"blurental\">Rental price:</label>
           <input type=\"text\" name=\"blurental\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"blupurchaserow\">
           <label for=\"blupurchase\">Purchase price:</label>
           <input type=\"text\" name=\"blupurchase\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"blustockrow\">
           <label for=\"blustock\">In-stock:</label>
           <input type=\"text\" name=\"blustock\" size=\"5\" maxlength=\"10\">
           <span style=\"color:red;\">*</span>
        </div><div id=\"blurentedrow\">
           <label for=\"blurented\">Rented:</label>
           <input type=\"text\" name=\"blurented\" size=\"5\" maxlength=\"10\" value=\"0\">
           <span style=\"color:red;\">* Overwrite only if some rented before system entry.</span>
        </div></fieldset></fieldset></div></fieldset><div id=\"formbuttons\" '=\"\">
            <input type=\"submit\">
            <input type=\"reset\">
        </div></form>";
?>