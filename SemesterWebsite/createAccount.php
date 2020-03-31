<title>Create Account</title>
<?php

require ('library/functions.php');

//check the zone
checkAccount("none");
//checkAccount("user");
//checkAccount("admin");

//get connection
$conn = getDBConnection();

if (isset($_POST['selection']))//form loads itself
{
	if ($_POST['selection'] == 'Create Account')//insert new record
	{
		//build SQL Command
		$stmt = $conn->prepare ("INSERT INTO users (firstname, lastname, username, encrypted_password, usergroup, email) 
					VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $firstname, $lastname, $username, $encrypted_password, $usergroup, $email);
		
		//define variables
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$encrypted_password="none set";
		$usergroup="user";
		$email="none set";
		

		//ececutes code
		$stmt->execute();
		header( 'Location: welcome.php' );
	}
	if ($_POST['selection'] == "Cancel")
	{
		header('Location: welcome.php');
	}
}
?>

<!--This is where the layout of the form is created-->
<h2>Create Account</h2>
<form method='POST'>
<table>
<tr><td>Firstname: </td><td><input type='text' name='firstname'> </td></tr>
<tr><td>Lastname: </td><td><input type='text' name='lastname'></td></tr>
<tr><td>Username: </td><td><input type='text' name='username'></td></tr>
<tr><td>Password: </td><td><input type='text' name='password' placeholder="ERRRRR"></td></tr>
<tr><td>Confirm Password: </td><td><input type='text' name='confirmPassword' placeholder="ERRRRR"></td></tr>
<tr><td>Email: </td><td><input type='text' name='email' placeholder="ERRRRR"></td></tr>
<tr><td><input type='submit' name='selection' value='Create Account'></td>
<td><input type='submit' name='selection' value='Cancel'></td></tr>
</table>
</form>

