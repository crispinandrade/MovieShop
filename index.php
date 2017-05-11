<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>EZ DVD</title>
   <link href="css/styles.css" rel="stylesheet">   
   
</head>
<body style="position:relative">
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
         </div>      
            
            <div id="column2">
               <div style="position:relative">
                  <h1 class="title">Featured New Release</h1>
                  <hr>
               </div>
               <div id="description">
                    <?php
                        //connect to server
                        $connect = mysql_connect("localhost","root","");
                        //connect to database
                        mysql_select_db("moviezone_db");
						
						$query ="SELECT title, thumbpath, rental_period, genre, year, director, classification, star1, star2, star3, costar1, costar2, costar3, studio, tagline, plot, DVD_rental_price, BluRay_rental_price, DVD_purchase_price, BluRay_purchase_price, numDVD, numBluRay
                                       FROM movie_detail_view
                                       WHERE rental_period = 'Overnight'
									   ORDER BY RAND()
									   LIMIT 1";
									   include("query.php");
					?>
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
