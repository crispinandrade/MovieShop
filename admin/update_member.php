<?php
include("connectdb.php");
	$movieID = $_POST["movieID"];
	$rental_period = $_POST["rental_period"];
	//DVD vars
	$dvdrental = $_POST["dvdrental"];
	$dvdpurchase = $_POST["dvdpurchase"];
	$dvdstock = $_POST["dvdstock"];
	$dvdrented = $_POST["dvdrented"];
	//BluRay vars
	$blurental = $_POST["blurental"];
	$blupurchase = $_POST["blupurchase"];
	$blustock = $_POST["blustock"];
	$blurented = $_POST["blurented"];
	
	$success = 0;
	
//dvd check
	if (!is_numeric($dvdrental)){ // price
		echo "<strong>DVD Rental Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdrental > 9999999.99 || $dvdrental < .01){
		echo "<strong>DVD Rental Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if (!is_numeric($dvdpurchase)){ // price
		echo "<strong>DVD Purchase Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdpurchase > 9999999.99 || $dvdpurchase < .01){ // price
		echo "<strong>DVD Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdrental > 9999999.99 || $dvdrental < .01){
		echo "<strong>DVD Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if (!is_numeric($dvdstock)){
		echo "<strong>DVD stock must have the number of stock</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdstock > 9999999 || $dvdstock < 0){
		echo "<strong>DVD stock must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if (!is_numeric($dvdrented)){
		echo "<strong>DVDs rented must have the number of DVDs currently rented</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdrented > 9999999 || $dvdrented < 0){
		echo "<strong>DVDs currently rented must be in range of 0 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($dvdrented > $dvdstock){
		echo "<strong>DVDs currently rented must be less or equal to the number of stock</strong><br/>
		Use the back button on your browser to fix this.";
	}
//BluRay Check
	else if (!is_numeric($blurental)){ // price
		echo "<strong>BluRay Rental Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($blurental > 9999999.99 || $blurental < .01){ //price
		echo "<strong>BluRay Rental Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if (!is_numeric($blupurchase)){ // price
		echo "<strong>BluRay Purchase Price must be in dollar format</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($blupurchase > 9999999.99 || $blupurchase < .01){ //price
		echo "<strong>BluRay Purchase Price must be in range of 0.01 and 9999999.99</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($blustock > 9999999 || $blustock < 0){ 
		echo "<strong>BluRay stock must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if (!is_numeric($blustock)){
		echo "<strong>BluRay stock must have the number of stock</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($blurented > 9999999 || $blurented < 0){
		echo "<strong>BluRay currently rented must be in range of 0 and 9999999</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else if ($blurented > $blustock ){
		echo "<strong>BluRay currently rented must less or equal to the number of stock</strong><br/>
		Use the back button on your browser to fix this.";
	}
	else{
		$query = "UPDATE movie SET rental_period=\"$rental_period\", DVD_rental_price=\"$dvdrental\", DVD_purchase_price=\"$dvdpurchase\", numDVD=\"$dvdstock\", numDVDout=\"$dvdrented\", BluRay_rental_price=\"$blurental\", BluRay_purchase_price=\"$blupurchase\", numBluRay=\"$blustock\", numBluRayOut=\"$blurented\"	
		WHERE movie_id = $movieID";
		$success = 1;
	}
	if($success){
		$result = mysql_query($query);
		
		if ($success == 1){
			echo "<strong>Movie $movieID has been successfully updated</strong>";
		}
	}
?>