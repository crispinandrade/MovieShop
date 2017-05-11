<?php
 // Takes the error checked user data from join form, processes it where needed, 
 //and then attempts to insert it into the DB.


include_once 'connectdb.php';

function createUser($formdata){
    //Return value
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    // if field is empty = "" (an empty string)
    // null for $member_id as the is key auto_increment
    $member_id = null; 
    $surname = $formdata['surname'];
    $other_name = $formdata['othername'];
    $contactmethod = $formdata['contactmethod'];
    $email = $formdata['email'];
    $mobilenum = $formdata['mobilenum'];
    $phonenum = $formdata['phonenum'];
    $occupation = $formdata['occupation'];    
    $joinusername = $formdata['joinusername'];
    $userpass = $formdata['userpass'];
    $joindate = date("Y-m-d"); // used server date this time not client
    if(!isset($formdata['magazine']))
       $magazine = 0;
    else
       $magazine = 1;

    //Get ready to talk to the DB
    $db = getDBConnection();
    //Make a prepared query so that we can use data binding and avoid SQL injections. 
    $insertUser = $db->prepare('INSERT into member VALUES
                              (:member_id, :surname, :other_name, :contact_method,
                               :email, :mobile, :landline, :magazine, :street,
                               :suburb, :postcode, :username, :password,
                               :occupation, :join_date)');
    //Bind the data from the form to the query variables.
    //Doing it this way means PDO sanitises the input which prevents SQL injection.
    $insertUser->bindParam(':member_id', $member_id, PDO::PARAM_STR);
    $insertUser->bindParam(':surname', $surname, PDO::PARAM_STR);
    $insertUser->bindParam(':other_name', $other_name, PDO::PARAM_STR);
    $insertUser->bindParam(':contact_method', $contactmethod, PDO::PARAM_STR);
    $insertUser->bindParam(':email', $email, PDO::PARAM_STR);
    $insertUser->bindParam(':mobile', $mobilenum, PDO::PARAM_STR);
    $insertUser->bindParam(':landline', $phonenum, PDO::PARAM_STR);
    $insertUser->bindParam(':magazine', $magazine, PDO::PARAM_INT);
    $insertUser->bindParam(':street', $streetaddr, PDO::PARAM_STR);
    $insertUser->bindParam(':suburb', $suburbstate, PDO::PARAM_STR);
    $insertUser->bindParam(':postcode', $postcode, PDO::PARAM_INT);
    $insertUser->bindParam(':username', $joinusername, PDO::PARAM_STR);
    $insertUser->bindParam(':password', $userpass, PDO::PARAM_STR);
    $insertUser->bindParam(':occupation', $occupation, PDO::PARAM_STR);
    $insertUser->bindParam(':join_date', $joindate, PDO::PARAM_STR);

    //Try and insert the user, if there is a DB exception return
    //the error message to the caller.
    try {
        //Execute the query and thus insert the user
        $queryResult['succeeded'] = $insertUser->execute();
    }catch (PDOException $e) {
        //Return the error message to the caller
        $queryResult['error'] = $e->getMessage();
    }

    //DB connection closed when PDO object isn't referenced
    //ie setting $db to null closes the connection
    $db = null;

    return $queryResult;
}