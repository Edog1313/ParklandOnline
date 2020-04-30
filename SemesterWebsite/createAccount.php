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
			$stmt = $conn->prepare ("INSERT INTO users (firstname, lastname, username, encrypted_password, usergroup, email, address1, address2, city, state, zipcode) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssssssi", $firstname, $lastname, $username, $encrypted_password, $usergroup, $email, $address1, $address2, $city, $state, $zipcode);
		
			//define variables
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$username=$_POST['username'];
			$encrypted_password=password_hash($_POST['password'], PASSWORD_DEFAULT);
			$usergroup=$_POST['usergroup'];
			$email=$_POST['email'];
			$address1=$_POST['address1'];	
			$address2=$_POST['address2'];
			$city=$_POST['city'];
			$state=$_POST['state'];
			$zipcode=$_POST['zipcode'];
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
<tr><td>Firstname: </td><td><input type='text' name='firstname' value='<?php echo showPost("firstname")?>'> </td></tr>
<tr><td>Lastname: </td><td><input type='text' name='lastname' value='<?php echo showPost("lastname")?>'></td></tr>
<tr><td>Username: </td><td><input type='text' name='username' value='<?php echo showPost("username")?>'></td></tr>
<tr><td>Password: </td><td><input type='text' name='password' ></td></tr>
<tr><td>Confirm Password: </td><td><input type='text' name='confirmPassword' ></td></tr>
<tr><td>Email: </td><td><input type='text' name='email' value='<?php echo showPost("email")?>'><td></tr>

<tr><td>Address 1: </td><td><input type='text' name='address1'value='<?php echo showPost("address1")?>'> </td></tr>
<tr><td>Address 2: </td><td><input type='text' name='address2'value='<?php echo showPost("address2")?>'> </td></tr>
<tr><td>City: </td><td><input type='text' name='city'value='<?php echo showPost("city")?>'> </td></tr>
<tr><td>State: </td><td><input type='text' name='state'value='<?php echo showPost("state")?>'> </td></tr>
<tr><td>Zipcode: </td><td><input type='text' name='zipcode'value='<?php echo showPost("zipcode")?>'> </td></tr>

<tr><td>User Group: </td><td>User: <input type='radio' name='usergroup' value='user' checked>Super User: <input
type='radio' name='usergroup' value='su'> Admin: <input
type='radio' name='usergroup' value='admin'></td></tr>
<tr><td><input type='submit' name='selection' value='Create Account'></td>
<td><input type='submit' name='selection' value='Cancel'></td></tr>
</table>
</form>

