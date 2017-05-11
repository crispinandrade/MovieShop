<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>EZ DVD</title>
   <link href="css/styles.css" rel="stylesheet"> 
   <link href = "css/emporium.css" rel = "stylesheet" type = "text/css" />   
   <script type = "text/javascript" src = "scripts/form_validation.js"></script>
</head>
<body style="position: relative">
<div id="container">
   
      <div id="banner"> 
         <h1>Ez DVD</h1>
      </div>
      
      <div id="nav">
         <ul>
            <li><a href="index.php"> Home</a></li>
            <li><a href="techzone.html">TechZone</a></li>
            <li><a href="join.php">Join</a></li>
            <li><a href="moviezone.php">MovieZone</a></li>
            <li><a href="contact.html">Contact</a></li>
         </ul>
      </div>

   <div id="divCenter">
      <div id="page">
         <div id = "sidebar">
      </div>      
            
            <div id="column2">
               <div style="position:relative">
                  <h1 class="title">Join Ez DVD Now!</h1>
                  <hr>
               </div>
               <div id="description">
					<?php
						//If the access method was post then process the form
						if(isset($_POST['submit'])){
						   
						   // For DEBUG
						   //print "<h2>POST result</h2>";
						   //$formdata = $_POST;
						   //foreach ($formdata as $element => $value)
						   //  print "$element : $value <br />\n";
							   
						   print "<h2>Status</h2>";
						   include_once 'php_includes/validateUser.php';
						   if(ValidateUserForm($_POST)) { // all entered data good
							  include_once 'php_includes/createUser.php';
							  $queryResult = createUser($_POST); // add time to this    
							  //See if the creation worked.
							  if($queryResult['succeeded']){
								 //Success message
								 print "<p class = 'centre'>Congratulations $_POST[othername] 
										you have successfully signed up at the DVD Emporium and can 
										now book movies!<br><a href='moviezone.php'>Would you like to
										go to the MovieZone page and Log In?</a></p>";

							  }
							  else {
								 //Failure message
								 print "<p class = 'centre'>There was a database failure while 
									   creating your user account. Please contact the site administrator.
									   </p> <p class = 'centre'>Error message: $queryResult[error]</p>";
							  }
						   } 
						}
						else
							  include 'html_includes/join_form.inc';                  
					 ?>
               </div>
            </div>
      </div>
         
         <div id="footer">
            <?php include 'html_includes/footer.inc'; ?>
         </div>
   </div>
</div>
</body>
</html>
