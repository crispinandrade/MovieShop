<!-- set up password HTML form to be displayed and posted to admin.php -->       
<form method = "post" action = "admin.php">
   <center>
      <h3 style = "color: blue">
	     You must be authorised to use this administration system
	  </h3>
      <table align="center" width ="200" border ="2">
         <tr>
		    <td width ="50%" align ="right"><b>User: </b></td>
			<td><input type="text" name="user" size="30" maxlength="30"  /></td>
		 </tr>
		 <tr><td width ="50%" align ="right"><b>Password: </b></td>
		    <td><input type="password" name="passwd" size="30" maxlength="30"  /></td>
		 </tr>
      </table>
	  <br />
	  <input type="submit" name="authorised" value="Submit" />
   </center>
</form>