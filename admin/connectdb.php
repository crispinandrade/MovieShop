<?php
// This include simply connects to the correct database for cars

// connect to MySQL server (host,user,password)
$db = mysql_connect("localhost", "root", "") or die ("<h1>Error - No connection to MySQL</h1>\n");

// select the correct database
$er = mysql_select_db("moviezone_db")or die ("<h1>Error - No connection to Database</h1>\nProbably don't have Privileges\n");


?>