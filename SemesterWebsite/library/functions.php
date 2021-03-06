<?php



function checkAccount($zone)
{
    // zone is 'user or admin anything else is none 

    session_start();
    if ($zone == 'user')
    {
        if (!isset($_SESSION['username']))
        {
            header('Location: welcome.php');
        }
    }


    if ($zone == 'su')
    {   
        if (!isset($_SESSION['username']))
        {   
            header('Location: welcome.php');
        }
        if ($_SESSION['usergroup'] == 'user' )
        {   
            header('Location: welcome.php');
        }
    }
    if ($zone == 'admin')
    {
        if (!isset($_SESSION['username']))
        {
            header('Location: welcome.php');
        }
        if ($_SESSION['usergroup'] != 'admin')
        {
            header('Location: welcome.php');
        }
    }
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


function printEditButton($id)
{
	echo "<td>";
	echo "<form action='modifyAccount.php' method='POST'>";
        echo "<input type='text' name='id' value='$id' />";
	echo "<input type='submit' name='selection' value='Edit' >";
	echo "</form>";
	echo "</td>";
}


function printUserTable($conn)
{   
	$sql = "SELECT * FROM users;";
	$result = $conn->query($sql);

	echo "<table id='usershow'>";
	if ($result->num_rows > 0)
	{   
		echo "<tr>";
		echo "<th>ID</th><th>USERNAME</th><th>NAME</th><th>ENCRYPTED PASSWORD</th><th>USER GROUP</th><th>EMAIL</th><th>ADDRESS</th><th> </th>";
		echo "</tr>";

		// loop through all the rows
		while( $row = $result->fetch_assoc() )
			{   
			// output the data from each row
			echo "<tr>";
			echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["username"] . "</td>";
			echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
			echo "<td style='font-size: 10px'>" . $row["encrypted_password"] . "</td>";
			echo "<td>" . $row["usergroup"] . "</td>";
			echo "<td>" . $row["email"] . "</td>";
			echo "<td><div>" . $row["address1"] . "</div><div>" . $row["address2"] . "</div><div>" . $row["city"] . ", " . $row["state"] . " " . $row["zipcode"] . "</div></td>";
			printEditButton($row["id"]);
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


function checkAndStoreLogin($conn, $usernameToTest, $passwordToTest)
{
    $result=lookupUserName($conn, $usernameToTest);
    if ($result != FALSE)
    {
        $row = $result->fetch_assoc();
        $encrpytedFromDB = $row['encrypted_password'];
        if ( password_verify($passwordToTest, $encrpytedFromDB) )
        {
            $_SESSION['username'] = $row['username'];
            $_SESSION['usergroup'] = $row['usergroup'];
            return TRUE;
        }
    }
    return FALSE;
}



function lookUpUserName($conn, $usernameToFind)
{
    $sql = "SELECT * FROM users WHERE username=? ;"; // SQL with parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernameToFind);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if ($result->num_rows == 1) {
        return $result;
    }
    else {
        return FALSE;
    }
}


function lookUpUserNameByID($conn, $idToFind)
{
    $sql = "SELECT * FROM users WHERE id=? ;"; // SQL with parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idToFind);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if ($result->num_rows == 1) {
        return $result;
    }
    else {
        return FALSE;
    }
}



function updateUserRecord($conn)
{
    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, address1=?, address2=?, city=?, state=?, zipcode=? WHERE id=? ");
    $stmt->bind_param("ssssssssi", $firstname, $lastname, $email, $address1, $address2, $city, $state, $zipcode, $id);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $id = $_POST['id'];
    $stmt->execute();
}





?>

