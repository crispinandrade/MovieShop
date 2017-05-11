<?php
	if(isset($_SESSION['user'])){
		session_unset(); // remove session variables
		session_destroy(); // destroy session
		header("Location: admin.php");
		die();
	}
?>