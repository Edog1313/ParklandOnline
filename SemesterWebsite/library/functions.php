<?php


function checkAccount($zone)
{

//zone is either 'user' or 'admin' everything else is 'none'
session_start();
}


function getDBConnection()
{
	$user = "eremington2";
	$conn = mysqli_connect("localhost",$user,$user,$user);
	// Check connection and shutdown if broken
	if (mysqli_connect_errno()) {
		die("<b>Failed to connect to MySQL: " . mysqli_connect_error() . "</b>");
	}

	return $conn;
}





function printUserTable($conn)
{   
	$sql = "SELECT * FROM users;";
	$result = $conn->query($sql);

	echo "<table id='usershow'>";
	if ($result->num_rows > 0)
	{   
		echo "<tr>";
		echo "<th>ID</th><th>USERNAME</th><th>NAME</th><th>ENCRYPTED PASSWORD</th><th>USER GROUP</th><th>EMAIL</th>";
		echo "</tr>";

		// loop through all the rows
		while( $row = $result->fetch_assoc() )
			{   
			// output the data from each row
			echo "<tr>";
			echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["username"] . "</td>";
			echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
			echo "<td>" . $row["encrypted_password"] . "</td>";
			echo "<td>" . $row["usergroup"] . "</td>";
			echo "<td>" . $row["email"] . "</td>";
			echo "</tr>";
			}
		}
	else
	{   
		// empty table
		echo "<tr><td> The table is empty B;)</td></tr>";
	}
	echo "</table>";
}


function displayError($mesg)
{
	echo "<div id='errorMessage'>";
	echo $mesg;
	echo "</div>";
}
function showPost( $name )
{
	if ( isset($_POST[$name]) )
	{
		return $_POST[$name];
	}
	return "";
}




?>

