<?php
include("connectdb.php");

//Vars
$success = 0;
	//New movie
	$title = $_POST["title"];
	$year = $_POST["year"];
	$tagline = $_POST["tagline"];
	$plot = $_POST["plot"];
	$director_name = $_POST["director_name"];
	$director_namenew = $_POST["director_namenew"];
	$studio_name = $_POST["studio_name"];
	$studio_namenew = $_POST["studio_namenew"];
	$genre_name = $_POST["genre_name"];
	$genre_namenew = $_POST["genre_namenew"];
	$classification = $_POST["classification"];
	$classificationnew = $_POST["classificationnew"];
	
	//Stars and Co-Stars
	$star1 = $_POST["star1"];
	$star1new = $_POST["star1new"];
	$star2 = $_POST["star2"];
	$star2new = $_POST["star2new"];
	$star3 = $_POST["star3"];
	$star3new = $_POST["star3new"];
	$costar1 = $_POST["costar1"];
	$costar1new = $_POST["costar1new"];
	$costar2 = $_POST["costar2"];
	$costar2new = $_POST["costar2new"];
	$costar3 = $_POST["costar3"];
	$costar3new = $_POST["costar3new"];

	//Stock information
	$rental_period = $_POST["rental_period"];
	//DVD
	$dvdrental = $_POST["dvdrental"];
	$dvdpurchase = $_POST["dvdpurchase"];
	$dvdstock = $_POST["dvdstock"];
	$dvdrented = $_POST["dvdrented"];
	//BluRay
	$blurental = $_POST["blurental"];
	$blupurchase = $_POST["blupurchase"];
	$blustock = $_POST["blustock"];
	$blurented = $_POST["blurented"];

// do-while for the sql queries
// if statements with sql queries would stop the if-else nest and all error checks would not run through
do{
	// Movie Information Check
	if($title == "" || strlen($title) > 45){
		echo "<strong>Title must be filled and be less than 45 characters in length</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!is_numeric($year) || !$year == 4){
		echo "<strong>Year must be a 4 digit number</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($tagline == ""){
		echo "<strong>Tagline must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$tagline == ""){
		$result = mysql_query("SELECT movie_id FROM movie WHERE tagline = \"$tagline\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The tagline entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($plot == ""){
		echo "<strong>Plot must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$plot == ""){
		$result = mysql_query("SELECT movie_id FROM movie WHERE plot = \"$plot\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The plot entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if(isset($_FILES['upload_images']) && empty($_FILES['upload_images']['name'][0])) {
		echo "<strong>Poster image file was not selected</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($director_name == "Please Select" && $director_namenew == ""){
		echo "<strong>Director must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($director_name != "Please Select" && $director_namenew != ""){
		echo "<strong>Use the dropdown for director or enter a new director in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$director_namenew == ""){
		$result = mysql_query("SELECT director_id FROM director WHERE director_name = \"$director_namenew\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The director entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($studio_name == "Please Select" && $studio_namenew == ""){
		echo "<strong>Studio must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($studio_name != "Please Select" && $studio_namenew != ""){
		echo "<strong>Use the dropdown for studio or enter a new studio in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$studio_namenew == ""){
		$result = mysql_query("SELECT studio_id FROM studio WHERE studio_name = \"$studio_namenew\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The studio entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($genre_name == "Please Select" && $genre_namenew == ""){
		echo "<strong>Genre must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($genre_name != "Please Select" && $genre_namenew != ""){
		echo "<strong>Use the dropdown for genre or enter a new genre in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$genre_namenew == ""){
		$result = mysql_query("SELECT genre_id FROM genre WHERE genre_name = \"$genre_namenew\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The genre entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($classification == "Please Select" && $classificationnew == ""){
		echo "<strong>Classification must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($classification != "Please Select" && $classificationnew != ""){
		echo "<strong>Use the dropdown for classification or enter a new classification in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$classificationnew == ""){
		$result = mysql_query("SELECT DISTINCT classification FROM movie WHERE classification = \"$classificationnew\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The classification entered already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
// Stars Check
	if($star1 == "Please Select" && $star1new == ""){
		echo "<strong>Star1 must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star1 != "Please Select" && $star1new != ""){
		echo "<strong>Use the dropdown for star1 or enter a new star1 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$star1new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$star1new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in star1 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($star2 == "Please Select" && $star2new == ""){
		echo "<strong>Star2 must be filled</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star2 != "Please Select" && $star2new != ""){
		echo "<strong>Use the dropdown for star2 or enter a new star2 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$star2new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$star2new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in star2 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($star3 != "Please Select" && $star3new != ""){
		echo "<strong>Use the dropdown for star3 or enter a new star3 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$star3new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$star3new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in star3 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($costar1 != "Please Select" && $costar1new != ""){
		echo "<strong>Use the dropdown for costar1 or enter a new costar1 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$costar1new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$costar1new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in costar1 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($costar2 != "Please Select" && $costar2new != ""){
		echo "<strong>Use the dropdown for costar2 or enter a new costar2 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$costar2new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$costar2new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in costar2 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
	if($costar3 != "Please Select" && $costar3new != ""){
		echo "<strong>Use the dropdown for costar3 or enter a new costar3 in the textbox</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if(!$costar3new == ""){
		$result = mysql_query("SELECT actor_id FROM actor WHERE actor_name = \"$costar3new\"");
		if(mysql_num_rows($result) != 0) {
		echo "<strong>The actor in costar3 already exists in the database</strong><br/>
		Use the back button on your browser to fix this."; break;
		}
	}
// Check if same star is entered multiple times
	if($costar3 != "Please Select" && in_array($costar3, array($star1, $star2, $star3, $costar1, $costar2))){
		echo "<strong>The actor in costar3 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($costar2 != "Please Select" && in_array($costar2, array($star1, $star2, $star3, $costar1, $costar3))){
		echo "<strong>The actor in costar2 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($costar1 != "Please Select" && in_array($costar1, array($star1, $star2, $star3, $costar2, $costar3))){
		echo "<strong>The actor in costar1 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star3 != "Please Select" && in_array($star3, array($star1, $star2, $costar1, $costar2, $costar3))){
		echo "<strong>The actor in star3 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star2 != "Please Select" && in_array($star2, array($star1, $star3, $costar1, $costar2, $costar3))){
		echo "<strong>The actor in star2 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($costar3new != "" && in_array($costar3new, array($star1new, $star2new, $star3new, $costar1new, $costar2new))){
		echo "<strong>The actor in new costar3 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($costar3new != "" && in_array($costar2new, array($star1new, $star2new, $star3new, $costar1new, $costar3new))){
		echo "<strong>The actor in new costar2 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($costar3new != "" && in_array($costar1new, array($star1new, $star2new, $star3new, $costar2new, $costar3new))){
		echo "<strong>The actor in new costar1 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star3new != "" && in_array($star3new, array($star1new, $star2new, $costar1new, $costar2new, $costar3new))){
		echo "<strong>The actor in new star3 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if($star2new != "" && in_array($star2new, array($star1new, $star3new, $costar1new, $costar2new, $costar3new))){
		echo "<strong>The actor in new star2 has already been entered</strong><br/>
		Use the back button on your browser to fix this."; break;
	}

// Stock Information Check
	if ($rental_period == "Please Select"){
		echo "<strong>Rental Period must be selected</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
//dvd check
	if (!is_numeric($dvdrental)){ // price
		echo "<strong>DVD Rental Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdrental > 9999999.99 || $dvdrental < .01){
		echo "<strong>DVD Rental Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if (!is_numeric($dvdpurchase)){ // price
		echo "<strong>DVD Purchase Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdpurchase > 9999999.99 || $dvdpurchase < .01){ // price
		echo "<strong>DVD Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdrental > 9999999.99 || $dvdrental < .01){
		echo "<strong>DVD Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if (!is_numeric($dvdstock)){
		echo "<strong>DVD stock must have the number of stock</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdstock > 9999999 || $dvdstock < 0){
		echo "<strong>DVD stock must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if (!is_numeric($dvdrented)){
		echo "<strong>DVDs rented must have the number of DVDs currently rented</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdrented > 9999999 || $dvdrented < 0){
		echo "<strong>DVDs currently rented must be in range of 0 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($dvdrented > $dvdstock){
		echo "<strong>DVDs currently rented must be less or equal to the number of stock</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
//BluRay Check
	if (!is_numeric($blurental)){ // price
		echo "<strong>BluRay Rental Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($blurental > 9999999.99 || $blurental < .01){ //price
		echo "<strong>BluRay Rental Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if (!is_numeric($blupurchase)){ // price
		echo "<strong>BluRay Purchase Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($blupurchase > 9999999.99 || $blupurchase < .01){ //price
		echo "<strong>BluRay Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($blustock > 9999999 || $blustock < 0){ 
		echo "<strong>BluRay stock must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if (!is_numeric($blustock)){
		echo "<strong>BluRay stock must have the number of stock</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($blurented > 9999999 || $blurented < 0){
		echo "<strong>BluRay currently rented must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	if ($blurented > $blustock ){
		echo "<strong>BluRay currently rented must less or equal to the number of stock</strong><br/>
		Use the back button on your browser to fix this."; break;
	}
	$success = 1;
}while (0);

if($success == 1){
	$uploadFileName = basename($_FILES["upload_images"]["name"][0]);
	include ("upload.php");
	
	// insert everything into database
	
		if (!$director_namenew == ""){
			$sql_insert = "INSERT INTO director (director_name) VALUES (\"$director_namenew\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT director_id FROM director WHERE director_name = \"$director_namenew\"";
			$director_name = $query;
		}
		if (!$studio_namenew == ""){
			$sql_insert = "INSERT INTO studio (studio_name) VALUES (\"$studio_namenew\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT studio_id FROM studio WHERE studio_name = \"$studio_namenew\"";
			$studio_name = $query;
		}
		if (!$genre_namenew == ""){
			$sql_insert = "INSERT INTO genre (genre_name) VALUES (\"$genre_namenew\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT genre_id FROM genre WHERE genre_name = \"$genre_namenew\"";
			$genre_name = $query;
		}
		if (!$classificationnew == ""){
			$classification = $classificationnew;
		}
		if (!$star1new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$star1new\")";
			$result = mysql_query($sql_insert) or die("<h1>Error - Insert Item failed!</h1>\n");
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$star1new\"";
			$star1 = $query;
		}
		if (!$star2new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$star2new\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$star2new\"";
			$star2 = $query;
		}
		if (!$star3new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$star3new\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$star3new\"";
			$star3 = $query;
		}
		if (!$costar1new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$costar1new\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$costar1new\"";
			$costar1 = $query;
		}
		if (!$costar2new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$costar2new\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$costar2new\"";
			$costar2 = $query;
		}
		if (!$costar3new == ""){
			$sql_insert = "INSERT INTO actor (actor_name) VALUES (\"$costar3new\")";
			$result = mysql_query($sql_insert);
			
			$query = "SELECT actor_id FROM actor WHERE actor_name = \"$costar3new\"";
			$costar3 = $query;
		}
		$movie_insert = "INSERT INTO movie (title, tagline, plot, thumbpath, director_id, studio_id, genre_id, classification, rental_period, year, DVD_rental_price, DVD_purchase_price, numDVD, numDVDout, BluRay_rental_price, BluRay_purchase_price, numBluRay, numBluRayOut) VALUES (\"$title\", \"$tagline\", \"$plot\", \"$uploaded_file_name\", $director_name, $studio_name, $genre_name, \"$classification\", \"$rental_period\", $year, $dvdrental, $dvdpurchase, $dvdstock, $dvdrented, $blurental, $blupurchase, $blustock, $blurented)";
		$result = mysql_query($movie_insert) or die("<h1>Error - Insert Item failed!</h1>\n");
		echo "<strong>Movie $title has been inserted</strong>";
		echo "<strong>FILE $uploadFileName HAS BEEN UPLOADED<strong>";
	
	
}
?>