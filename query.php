						
<?php
$result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
while($movie=mysql_fetch_array($result)):
                           
echo "<fieldset>";
                           
echo "<legend>".$movie['title']."</legend>";
                           
echo "<img class='moviePoster' src='images/".$movie['thumbpath']."' height='150' width='105'>";
                           
echo "<span class='movieHeading'>".$movie['rental_period'].' Rental'."</span>"; 
echo "<br>";
                           
echo "<span class='movieHeading'>".'Genre: '."</span>";
echo $movie['genre']; 
echo "<br>";
                           
echo "<span class='movieHeading'>".'Year: '."</span>";
echo $movie['year'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Director: '."</span>";
echo $movie['director'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Classification: '."</span>";
echo $movie['classification']; 
echo "<br>";
                           
echo "<span class='movieHeading'>".'Stars: '."</span>";
echo $movie['star1'].', '.$movie['star2'].', '.$movie['star3'].', '.$movie['costar1'].', '.$movie['costar2'].', '.$movie['costar3']; 
echo "<br>";
                           
echo "<span class='movieHeading'>".'Studio: '."</span>";
echo $movie['studio'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Tagline: '."</span>";
echo $movie['tagline'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Plot: '."</span>";
echo $movie['plot'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Rental Price: '."</span>";
echo 'DVD: $'.$movie['DVD_rental_price'].' BlueRay: $'.$movie['BluRay_rental_price'];
echo "<br>";
                           
echo "<span class='movieHeading'>".'Purchase Price: '."</span>";
echo 'DVD: $'.$movie['DVD_purchase_price'].' BlueRay: $'.$movie['BluRay_purchase_price']; 
echo "<br>";
                           
echo "<span class='movieHeading'>".'Availablility: '."</span>";
echo 'DVD: '.$movie['numDVD'].' BlueRay: '.$movie['numBluRay']; 
echo "<br>";
                           
echo "</fieldset>";
                           
endwhile;
?>