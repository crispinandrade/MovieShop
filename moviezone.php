
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>EZ DVD</title>
   <link href="css/styles.css" rel="stylesheet">
</head>
<body style="position: relative">
<div id="container">
   
      <div id="banner"> 
         <h1>Ez DVD</h1>
      </div>
      
      <div id="nav">
         <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="techzone.html">TechZone</a></li>
            <li><a href="join.php">Join</a></li>
            <li><a href="moviezone.php">MovieZone</a></li>
            <li><a href="contact.html">Contact</a></li>
         </ul>
      </div>

   <div id="divCenter">
      <div id="page">
         <div id="sidebar">
               <h3>Search Menu</h3>
               <ul>
                  <li><a href="moviezone.php?action=ShowAllMovies">Show All Movies</a></li>
                  <li><a href="moviezone.php?action=NewReleases">New Releases</a></li>
                  <li><a href="moviezone.php?action=Actor">Search by Actor</a></li>
                  <li><a href="moviezone.php?action=Director">Search by Director</a></li>
                  <li><a href="moviezone.php?action=Genre">Search by Genre</a></li>
                  <li><a href="moviezone.php?action=Classification">Search by Classification</a></li><br/>
               </ul>
			   <h3>User Menu</h3>
               <ul>
				  <li><a href="admin.php">Admin</a></li>
               </ul>
         </div>   
            
            <div id="column2">
               <div style="position:relative">
                  <h1 class="title">MovieZone</h1>
                  <hr>
               </div>
               <div class="description">
                     <?php
                        include ("admin/connectdb.php");
                        
						// isset is not set and will display new release movies
                        if(!isset($_GET["action"])){
							$query ="SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay
                                       FROM movie_detail_view
                                       WHERE rental_period = 'Overnight'
									   ORDER BY title";
									   include("query.php");
						}
						// isset is set and will check what action equals to display a page
						else
                        {
                           // show all movies
                           if($_GET["action"] == "ShowAllMovies")
                           {
                              $query ="SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay
                                       FROM movie_detail_view
									   ORDER BY title";
									   include("query.php");
                           }
                           // new releases            
                           else if($_GET["action"] == "NewReleases")
                           {
                              $query ="SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay
                                       FROM movie_detail_view
                                       WHERE rental_period = 'Overnight'
									   ORDER BY title";
									   include("query.php");
                           }
                           // search by actors with drop-down            
                           else if($_GET["action"] == "Actor")
                           {
							    $actor_query = "SELECT * 
												FROM actor
												ORDER BY actor_name";
								$result = mysql_query($actor_query);
								$num_rows = mysql_num_rows($result);
								$row = mysql_fetch_row($result);
									  
								echo "<strong>Select an actor</strong>\n
									<form method = 'get' action = 'moviezone.php?action=Actor'>\n
									<input type='hidden' name='action' value='Actor'>
									<select name = 'name'>\n
									<option selected='selected' disabled='disabled'>Please Select</option>";
									for($i = 0; $i < $num_rows; $i++){
										echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
										$row = mysql_fetch_row($result);
									}  
								echo "</select><input type=submit name=submit value=Search />";
								echo "</form>";
								
								if(isset($_GET["submit"])){
									$query_name = "SELECT actor_name
												   FROM actor
												   WHERE actor.actor_id =".$_GET['name']."";
									$result = mysql_query($query_name);
									while($actor=mysql_fetch_array($result)):
										echo "<strong>Movies starring ".$actor['actor_name'].".</strong><br><br>\n";
									endwhile;
									
									$query = "SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay 
									FROM movie_actor, movie_detail_view
									WHERE movie_actor.actor_id =".$_GET['name']." 
									AND movie_actor.movie_id = movie_detail_view.movie_id
									ORDER BY title";
									include("query.php");
								}
								
						    }
                           // search by director with drop-down            
                           else if($_GET["action"] == "Director")
                           {
							    $director_query = "SELECT * 
												   FROM director
												   ORDER BY director_name";
								$result = mysql_query($director_query);
								$num_rows = mysql_num_rows($result);
								$row = mysql_fetch_row($result);
									  
								echo "<strong>Select a director</strong>\n
									<form method = 'get' action = 'moviezone.php?action=Director'>\n
									<input type='hidden' name='action' value='Director'>
									<select name = 'name'>\n
									<option selected='selected' disabled='disabled'>Please Select</option>";
									for($i = 0; $i < $num_rows; $i++){
										echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
										$row = mysql_fetch_row($result);
									}  
								echo "</select><input type=submit name=submit value=Search />";
								echo "</form>";
								
								if(isset($_GET["submit"])){
									$query_director = "SELECT director_name
													   FROM director
												       WHERE director.director_id =".$_GET['name']."";
									$result = mysql_query($query_director);
									while($director=mysql_fetch_array($result)):
										echo "<strong>Movies directed by ".$director['director_name'].".</strong><br><br>\n";
									endwhile;
									
									$query = "SELECT movie_detail_view.title, movie_detail_view.thumbpath, movie_detail_view.rental_period, movie_detail_view.genre, movie_detail_view.year, movie_detail_view.director, movie_detail_view.classification, movie_detail_view.star1, movie_detail_view.star2, movie_detail_view.star3, movie_detail_view.costar1, movie_detail_view.costar2, movie_detail_view.costar3, movie_detail_view.studio, movie_detail_view.tagline, movie_detail_view.plot, movie_detail_view.DVD_rental_price, movie_detail_view.BluRay_rental_price, movie_detail_view.DVD_purchase_price, movie_detail_view.BluRay_purchase_price, movie_detail_view.movie_detail_view.numDVD, movie_detail_view.numBluRay 
									FROM movie, movie_detail_view
									WHERE movie.director_id =".$_GET['name']." 
									AND movie.movie_id = movie_detail_view.movie_id
									ORDER BY title";
									include("query.php");
								}
								
						    }
                           // search by actors with drop-down            
                           else if($_GET["action"] == "Genre")
                           {
							    $genre_query = "SELECT * 
												FROM genre
												ORDER BY genre_name";
								$result = mysql_query($genre_query);
								$num_rows = mysql_num_rows($result);
								$row = mysql_fetch_row($result);
									  
								echo "<strong>Select a genre</strong>\n
									<form method = 'get' action = 'moviezone.php?action=Genre'>\n
									<input type='hidden' name='action' value='Genre'>
									<select name = 'genre'>\n
									<option selected='selected' disabled='disabled'>Please Select</option>";
									for($i = 0; $i < $num_rows; $i++){
										echo "<option value = \"" .$row[0]. "\">" .$row[1]. "</option>\n";
										$row = mysql_fetch_row($result);
									}  
								echo "</select><input type=submit name=submit value=Search />";
								echo "</form>";
								
								if(isset($_GET["submit"])){
									$query_genre = "SELECT genre_name
												    FROM genre
												    WHERE genre.genre_id =".$_GET['genre']."";
									$result = mysql_query($query_genre);
									while($genre=mysql_fetch_array($result)):
										echo "<strong>Movies' genre as ".$genre['genre_name'].".</strong><br><br>\n";
									endwhile;
									
									$query = "SELECT movie_detail_view.title, movie_detail_view.thumbpath, movie_detail_view.rental_period, movie_detail_view.genre, movie_detail_view.year, movie_detail_view.director, movie_detail_view.classification, movie_detail_view.star1, movie_detail_view.star2, movie_detail_view.star3, movie_detail_view.costar1, movie_detail_view.costar2, movie_detail_view.costar3, movie_detail_view.studio, movie_detail_view.tagline, movie_detail_view.plot, movie_detail_view.DVD_rental_price, movie_detail_view.BluRay_rental_price, movie_detail_view.DVD_purchase_price, movie_detail_view.BluRay_purchase_price, movie_detail_view.movie_detail_view.numDVD, movie_detail_view.numBluRay 
									FROM movie, movie_detail_view
									WHERE movie.genre_id =".$_GET['genre']." 
									AND movie.movie_id = movie_detail_view.movie_id
									ORDER BY title";
									include("query.php");
								}
								
						    }
                           // search by classification with drop-down            
                           else if($_GET["action"] == "Classification")
                           {
							    $classification_query = "SELECT DISTINCT classification 
														 FROM movie_detail_view";
								$result = mysql_query($classification_query);
								$num_rows = mysql_num_rows($result);
								$row = mysql_fetch_row($result);
									  
								echo "<strong>Select a classification</strong>\n
									<form method = 'get' action = 'moviezone.php?action=Classification'>\n
									<input type='hidden' name='action' value='Classification'>
									<select name = 'classification'>\n
									<option selected='selected' disabled='disabled'>Please Select</option>";
									for($i = 0; $i < $num_rows; $i++){
										echo "<option value = \"" .$row[0]. "\">" .$row[0]. "</option>\n";
										$row = mysql_fetch_row($result);
									}  
								echo "</select><input type=submit name=submit value=Search />";
								echo "</form>";
								
								if(isset($_GET["submit"])){
									echo "<strong>Movies classified as ".$_GET['classification'].".</strong><br><br>\n";
									
									$query = "SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay 
									FROM movie_detail_view
									WHERE classification ="."'".$_GET['classification']."'
									ORDER BY title";
									include("query.php");
								}
								
						    }
						}
                     ?>
                  </table>
               </div>
            </div>
         
         <div id="footer">
            <?php include 'html_includes/footer.inc'; ?>
         </div>
      </div>
   </div>
</div>
</body>
</html>
