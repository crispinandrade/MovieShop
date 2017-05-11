<?php
/* Returns a PDO DB connection.*/


function getDBConnection(){

    $database = 'mysql:host=localhost;dbname=moviezone_db';
    $user = 'root';
    $password = '';

    //Catch a possible exception to stop a stack trace being displayed to the user
    try {
        //Try and get the new PDO connection
        $dbConn = new PDO($database, $user, $password);
        //Set the error mode to throw exceptions
        //I did this because exceptions are more verbose than the error codes
        //and this also stops warnings being displayed to end users.
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        //Print the error and then crash the script
        print "<p>Error connecting to database: " . $e->getMessage() . "</p>";
        die();
    }
    return $dbConn;
}
?>