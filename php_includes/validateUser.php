<?php
/* functions to validate user information. */

include_once 'validEmail.php';
include_once 'connectdb.php';


function validateUserForm ($formdata) { // for join.php
   
   if(!validateName($formdata)) {
      print "<div class = \"centre\">
            Error in \"Name\" - Too many characters or missing.<br>
            You need to fill in both Use the back button to fix this problem./div>";
      
   }
   else if(!validateContactMethod($formdata)) {
      print "<div class = \"centre\">Error in \"Preferred Contact Method\" you have not provided 
            the \"Contact Details\" of the method you have chosen. <br> 
            Use the back button on your browser to correct this error.</div>";
   }
   else if(!validateMobile($formdata)) {
      print "<div class = \"centre\">Error in \"Contact Details - Mobile\" you have not provided 
            the correct format for your number.<br> 
            Use the back button on your browser to correct this error.</div>";
   }         
   else if(!validateLand($formdata)) {
      print "<div class = \"centre\">Error in \"Contact Details - Landline\" you have not provided 
            the correct format for your number.<br> 
            Use the back button on your browser to correct this error.</div>";
   }
   else if(!validateEmail($formdata)) {
      print "<div class = \"centre\">Error in \"Contact Details - Email\" you have not provided 
            a correct email address.<br> 
            Use the back button on your browser to correct this error.</div>";
   }
   else if(!validateOccup($formdata)) {
      print "<div class = \"centre\">Error in \"Occupation\" you have not selected an occupation.<br> 
            Use the back button on your browser to correct this error.</div>";
   }
   else if(!checkMagazine($formdata)) {
      print "<div class = \"centre\">Error in \"Address\" You have chosen to have our magazine 
             delivered but have not provided all of your address information.<br>
             Use the back button on your browser to correct this error.</div>";
   }
   else if(!checkAddress ($formdata)) {
      print "<div class = \"centre\">Error in \"Address\" The information provided in the address is 
            not in the format requested.<br>
            Use the back button on your browser to correct this error.</div>";
   }   
   else if(!validateUsername($formdata)) {
      print "<div class = \"centre\">Error in \"Username and Password\" Your Username must be 
             between 6 and 10 characters.<br>
             Use the back button on your browser to correct this error.</div>";
   }
   else if(usernameAlreadyExists($formdata)) {
      print "<div class = \"centre\">Error in \"Username and Password\" The Username you have 
             entered is already in use, Please try again.<br>
             Use the back button on your browser to correct this error.</div>";
   }
   else if(!validateUserPass($formdata)) {
      print "<div class = \"centre\">Error in \"Username and Password\" The Password you have 
             entered is in the wrong format, Please try again.<br>
             Use the back button on your browser to correct this error.</div>";
   }
   else if(!validatePasswdMatch($formdata)) {
      print "<div class = \"centre\">Error in \"Username and Password\" The Passwords you have 
             entered do not match, Please try again.<br>
             Use the back button on your browser to correct this error.</div>";
   }  
   else
      return true;
}


// check name fields and num chars
function validateName($formdata) {
    // Why is this here? Because Safari and Android do not support HTML5 required
    $nameValid = true;

    //Check it isn't blank or too big 
    if($formdata['surname'] == "" && strlen($formdata['surname']) < 50){
        $nameValid = false;
    }
    //Check it isn't blank or too big
    if($formdata['othername'] == "" && strlen($formdata['othername']) < 60){
        $nameValid = false;
    }
    return $nameValid;
} 
    //Make sure the selected contact method isn't blank
function validateContactMethod($formdata){
    $contactValid = true;
    if ($formdata['contactmethod'] == 'mobile' && $formdata['mobilenum'] == ""){
        $contactValid = false;
    }else if ($formdata['contactmethod'] == 'landline' && $formdata['phonenum'] == ""){
        $contactValid = false;
    }else if ($formdata['contactmethod'] == 'email' && $formdata['email'] == ""){
        $contactValid = false;
    }
    else 
       return true;
}
// check format of mobile
function validateMobile($formdata) {
   //  If contact methods aren't empty make sure they are in valid format
   if($formdata['mobilenum'] != "")
      if(!preg_match('/^0[4,5]\d\d \d\d\d \d\d\d$/', $formdata['mobilenum']))
         return false;
   return true;
}

// check format of landline
function validateLand($formdata) {
   //  If contact methods aren't empty make sure they are in valid format
   if($formdata['phonenum'] != "")
      if(!preg_match('/^\(0[2,3,6,7,8,9]\)\s\d\d\d\d\d\d\d\d$/', $formdata['phonenum']))
         return false;
   return true;
}

// check 50 characters and if is valid email domain (via validEmail.php) 
function validateEmail ($formdata) {
   if($formdata['email'] != "")
      if(!validEmail($formdata['email'])) 
         return false;
   if(strlen($formdata['email']) > 50) 
      return false;
   return true;
}

// check occupation chosen
function validateOccup($formdata) {
   if($formdata['occupation'] == "blank")
      return false;
   return true;
}

// is a username there?\ and between 6 & 10 chars
function validateUsername($formdata){
   if($formdata['joinusername'] == "")
      return false;
   if(strlen($formdata['joinusername']) < 6 || strlen($formdata['joinusername']) > 10)
      return false;      
   return true;
}

 //Check to see if username is already taken
function usernameAlreadyExists($formdata){
   $alreadyExists = false;
   
   $db = getDBConnection();
   $members = $db->query("SELECT username FROM member");

   //Check each one
    foreach ($members as $member){
      //If the username is already in the DB stop looking
      if($formdata['joinusername'] == $member['username']){
         $alreadyExists = true;
         break; //
        }
    }
   //DB connection closed when PDO object isn't referenced
   //ie setting $db to null closes the connection
   $db = null;

    return $alreadyExists;
}

//validate the password entered....
function validateUserPass($formdata){
   //print $formdata['userpass']."<br>"; // - debug
   //Check that the password isn't blank or too long
   if($formdata['userpass'] == "")
      return false;
   else if(! preg_match('/^\S{4,10}$/', $formdata['userpass']))
      return false;  //first white space and 4 to 10 chars
   else if(! preg_match('/\d/', $formdata['userpass']))
      return false;  // next is there a digit
   else if(! preg_match('/[A-Z]/', $formdata['userpass']))
      return false;  // next is there an upper case
   else if(! preg_match('/[a-z]/', $formdata['userpass']))
      return false;  // next is there a lower case  
   else if(! (preg_match('/\W/', $formdata['userpass']) || preg_match('/_/', $formdata['userpass']))) {
      // \W is a non-word char i.e. NOT a-z, A-Z, 0-9, including the _ (underscore) 
      // hence the OR to get the _ (underscore) char 
      return false;  
   }
   else
      return true;      
}

//match passwords
function validatePasswdMatch($formdata){

   if($formdata['userpass'] != $formdata['verifypass']){
      return false;
   }
   return true;
}

// if magazine checked need address
function checkMagazine($formdata) {
   if(isset($formdata['magazine'])) 
      if($formdata['streetaddr'] == "" || $formdata['suburbstate'] == "" 
       || $formdata['postcode'] == "")  
         return false;
   return true;         
}

//basic check of format of address 
function checkAddress ($formdata) { 
 
  //if some of address there need it all
  if($formdata['streetaddr'] != "" || $formdata['suburbstate'] != "" || $formdata['postcode'] != "") {
   
   if(!preg_match('/[A-Za-z1-9\/#, -]{8,50}/', $formdata['streetaddr']))
      return false; // allows upper/lower numbers / - # , and spaces (also between 8 and 50 chars)
   
   if(!preg_match('/^[A-Za-z ]*, [A-Za-z]*$/',$formdata['suburbstate']))
      return false; //upper/lower for suburb, upper/lower for state
   
   if(strlen($formdata['suburbstate']) > 50)
      return false;
   
   if(!preg_match('/^\d\d\d\d$/',$formdata['postcode']))
      return false; // 4 digits only
  }
  return true;
}     
