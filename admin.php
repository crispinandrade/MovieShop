<?php
session_start();

	if(isset($_POST["authorised"]))
    {  
        if($_POST["user"] != "" && $_POST["passwd"] == "webdev2")
		{
			$_SESSION["user"] = $_POST["user"];
			$_SESSION["passwd"] = $_POST["passwd"];
		}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>EZ DVD</title>
   <link href="css/styles.css" rel="stylesheet">
   <link href="css/emporium.css" rel="stylesheet">
</head>
<body style="position: relative">
<div id="container">
   
      <div id="banner"> 
         <h1>Ez DVD</h1>
      </div>
      
      <div id="nav">
      </div>

   <div id="divCenter">
      <div id="page">
         <div id="sidebar">
               <h3>Search Menu</h3>
			   <?php
			   // if session is active then display sidebar if user is logged in or out
			   	if(isset($_GET["action"])){
					if($_GET["action"] == "logout"){
						echo"<ul>
							<li><a href=\"moviezone.php\">Return to MovieZone</a></li>
						</ul>";
					}else{
						echo"<ul>
							<li><a href=\"admin.php\">Display Menu</a></li><br/>
						</ul>";
					}
				}
			   
			   else if(isset($_SESSION["user"])){
				echo"<ul>
						<li><a href=\"admin.php?action=NewMovie\">Enter Movie</a></li>
						<li><a href=\"join.php\">Create New Member</a></li>
						<li><a href=\"admin.php?action=SelectMovie\">Edit/Delete Movie</a></li>
						<li><a href=\"admin.php?action=SelectMember\">Edit/Delete Member</a></li>
						<li><a href=\"admin.php?action=logout\">Logout</a></li>
					</ul>";
			   } else{
				   echo"<ul>
						<li><a href=\"moviezone.php\">Return to MovieZone</a></li>
					</ul>";
			   }

			   ?>
         </div>   
            
            <div id="column2">
               <div style="position:relative">
                  <h1 class="title">Admin</h1>
                  <hr>
               </div>
               <div class="description">
                     <?php
					 //Database actions
					 if(isset($_POST["action"])){
						 if($_POST['action'] == "UpdateMovie"){
							 include("admin/update_movie.php"); // update movie to database
						 }
						 else if($_POST['action'] == "InsertNewMovie"){
							 include("admin/insert_new_movie.php"); // Inserting movie into database
						 }
						 else if($_POST['action'] == "DeleteMovie"){
							 include("admin/delete_movie.php"); // Delete movie from database
						 }
						 else if($_POST['action'] == "UpdateMember"){
							 //debug
							   print "<h2>POST result</h2>";
							   $formdata = $_POST;
							   foreach ($formdata as $element => $value)
							   print "$element : $value <br />\n";
							 include_once 'php_includes/validateUser.php'; // validates member 
							 echo "The member has been updated to the database"; // Updates member from database
						 }
						 else if($_POST['action'] == "DeleteMember"){
							 echo "The member has been deleted from the database"; // Delete member from database
						 }
						 
					 }
					 // Admin menu buttons
					 else if(isset($_GET['action'])){
						 if($_GET['action'] == "NewMovie"){
							 include("admin/enter_new_movie.php");
						 }
						 else if($_GET['action'] == "SelectMovie"){
							 include("admin/choose_movie.php"); // choose movie
						 }
						 else if($_GET['action'] == "EditMovie"){
							 include("admin/edit_movie.php"); // edit/delete movie form
						 }
						 else if($_GET['action'] == "SelectMember"){
							 include("admin/choose_member.php"); // choose member 
						 }
						 else if($_GET['action'] == "EditMember"){
							 include("admin/edit_member.php"); // edit/delete member form
						 }
						 else if($_GET['action'] == "logout"){
							 include("admin/logout.php");
						 }
					 }
					 //checks if user has successfully logged in
					 else if (isset($_SESSION["user"])){
							echo"<strong>WELCOME ".$_SESSION["user"]."<br/><br/>";
							echo"Choose a menu option from the sidebar";
						} else{
							// get authorisation
							include("admin/login.inc");
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
