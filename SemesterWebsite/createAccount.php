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
		if  ($_POST['password']== $_POST['confirmPassword'])
		{
			//build SQL Command
			$stmt = $conn->prepare ("INSERT INTO users (firstname, lastname, username, encrypted_password, usergroup, email) 
					VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssss", $firstname, $lastname, $username, $encrypted_password, $usergroup, $email);
		
			//define variables
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$username=$_POST['username'];
			$encrypted_password=password_hash($_POST['password'], PASSWORD_DEFAULT);
			$usergroup=$_POST['usergroup'];
			$email=$_POST['email'];
		

			//ececutes code
			$stmt->execute();
			header( 'Location: welcome.php' );
		}
		else
		{
			displayError("Passwords don't match");
		}
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
<tr><td>Firstname: </td><td><input type='text' name='firstname' value='<?php echo
showPost("firstname")?>'> </td></tr>
<tr><td>Lastname: </td><td><input type='text' name='lastname' value='<?php echo
showPost("lastname")?>'></td></tr>
<tr><td>Username: </td><td><input type='text' name='username' value='<?php echo
showPost("username")?>'></td></tr>
<tr><td>Password: </td><td><input type='text' name='password' ></td></tr>
<tr><td>Confirm Password: </td><td><input type='text' name='confirmPassword' ></td></tr>
<tr><td>Email: </td><td><input type='text' name='email' value='<?php echo
showPost("email")?>'><td></tr>
<tr><td>User Group: </td><td>User: <input type='radio' name='usergroup' value='user' checked> Admin: <input
type='radio' name='usergroup' value='admin'></td></tr>
<tr><td><input type='submit' name='selection' value='Create Account'></td>
<td><input type='submit' name='selection' value='Cancel'></td></tr>
</table>
</form>

