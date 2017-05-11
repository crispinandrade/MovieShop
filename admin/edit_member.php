<?php
	if(!isset($_GET["member_id"])){
		echo "<strong>Please select a member. \nPress the back button on your browser to fix this";
	}
	else{
		include("connectdb.php");
		
		//member query
		$memberID = $_GET["member_id"];
		
		$member_query = "SELECT * FROM member
						WHERE member_id = $memberID";
		$result = mysql_query($member_query);
		$row = mysql_fetch_row($result);
		
		
		//form to edit/delete the movie
		echo "<form name=\"joinform\" id=\"joinform\" method=\"post\" action=\"admin.php\">
             <input type=\"hidden\" name=\"action\" value=\"EditMember\">
             <fieldset>
			 <fieldset>
                 <legend>Member ID: $row[0]</legend>
                 <div>
                    <label>Surname:</label>
                    <input type=\"text\" name=\"surname\" size=\"50\" maxlength=\"50\" value=\"$row[1]\" required=\"\">
                 </div>
                 <div>
                    <label>Other Names:</label>
                    <input type=\"text\" name=\"othername\" size=\"50\" maxlength=\"60\" value=\"$row[2]\" required=\"\">
                 </div>
                 <div>
                    <label>Username:</label>
                    <input type=\"text\" name=\"joinusername\" size=\"10\" value=\"$row[11]\" disabled=\"\">
                    <span style=\"color:red\">Can't be changed</span> 
                 </div>
                 <div>
                    <label>Password:</label>
                    <input type=\"text\" name=\"userpass\" size=\"10\" value=\"$row[12]\">
                    <span style=\"color:red\">Must have upper/lower/digit/special characters 
                    (10 chars max)</span>
                 </div>                
                 <div>
                    <label>Occupation:</label><select name=\"occupation\"><option value=\"Student\">Student</option><option value=\"Manager\">Manager</option><option value=\"Medical worker\">Medical worker</option><option value=\"Trades worker\">Trades worker</option><option value=\"Education\" selected=\"\">Education</option><option value=\"Technician\">Technician</option><option value=\"Clerical Worker\">Clerical Worker</option><option value=\"Retail worker\">Retail worker</option><option value=\"Researcher\">Researcher</option><option value=\"Other\">Other</option> </select></div>
					<div>
                     <label>Join date:</label>
                     <input type=\"text\" value=\"$row[14]\" disabled=\"\">
                     <span style=\"color:red\">Can't be changed</span>
                 </div>
              </fieldset>
              <fieldset>
                 <legend>Contact details</legend>
                 <div>
                    <label>Contact method:</label><select name=\"contactmethod\"><option value=\"email\" selected=\"\">email</option><option value=\"landline\">landline</option><option value=\"mobile\">mobile</option> </select>
                    <label>Email:</label>
                    <input type=\"text\" name=\"email\" size=\"50\" maxlength=\"50\" value=\"$row[4]\">
                    <span style=\"color:red\">If chosen must be provided</span>
                 </div>
                 <div>
                    <label>Mobile:</label>
                    <input type=\"text\" name=\"mobilenum\" size=\"13\" maxlength=\"12\" value=\"$row[5]\">
                    <span style=\"color:red\">Format 0[4 or 5]XX XXX XXX where X is a digit</span>
                 </div>
                 <div>
                    <label>Landline:</label>
                    <input type=\"text\" name=\"phonenum\" size=\"13\" maxlength=\"13\" value=\"$row[6]\">
                    <span style=\"color:red\">Format 0[2,3,6,7,8 or 9]XXXXXXXX where X is a digit</span>
                 </div>
              </fieldset> 
              <fieldset>
                 <legend>Magazine</legend>              
                 <div><input type=\"checkbox\" name=\"magazine\" value=\"$row[7]\" checked=\"checked\">&nbsp;&nbsp;Receive Magazine? 
                 </div>
                 <div>
                    <label>Street address:</label>
                    <input type=\"text\" name=\"streetaddr\" size=\"50\" maxlength=\"50\" value=\"$row[8]\">
                 </div>
                 <div>
                    <label>Suburb and State:</label>
                    <input type=\"text\" name=\"suburbstate\" size=\"50\" maxlength=\"50\" value=\"$row[9]\">
                    <span style=\"color:red\">Format Suburb, State</span>
                 </div>
                 <div>
                    <label>Postcode:</label>
                    <input type=\"text\" name=\"postcode\" size=\"4\" maxlength=\"4\" value=\"$row[10]\"> <span style=\"color:red\">
                              Format four digits only</span></div>
              </fieldset> </fieldset>
			  <div>
                 <input type=\"submit\" value=\"Update User\">
				<input type=\"hidden\" name=\"action\" value=\"UpdateMember\">
				<input type =\"hidden\" name=\"memberID\" value =\"$row[0]\" />
				 
               </div>
			                   
             </form>";
			 echo "<form method=\"post\" action=\"admin.php\">
            <div>
			<input type=\"submit\" value=\"Delete User\"> 
               <input type=\"hidden\" name=\"action\" value=\"DeleteMember\"> 
			   <input type=\"hidden\" name=\"id\" value=\"$row[0]\">
               <input type=\"hidden\" name=\"user\" value=\".$row[1].", ".$row[2]." - ".$row[3].\">               
               
            </div>                   
             </form>";
			   
	}
?>