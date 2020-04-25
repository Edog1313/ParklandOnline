<html>
<head>
<title>Welcome</title>
<?php

require ('library/functions.php');

// depending on the zone, call one of
checkAccount("none");
//checkAccount("user");
//checkAccount("admin");

$conn = getDBConnection();

if (isset($_POST['selection']))
{
    if ($_POST['selection'] == 'Login')
    {
        if (checkAndStoreLogin($conn, $_POST['username'], $_POST['password']))
        {
		if ($_SESSION['usergroup'] == 'user')
		{
            		header('Location: home.php');
		}
		if ($_SESSION['usergroup'] == 'admin')
 		{	
                        header('Location: admin.php');
                }
                if ($_SESSION['usergroup'] == 'su')
                {
                        header('Location: su.php');
                }
        }
        else
        {
            displayError("Login Failed");
        }
    }
    else if ($_POST['selection'] == 'Create Account')
    {
        header("Location: createAccount.php");
    }
}


 
?>
</head>
<style>
.center {
  margin: auto;
  width: 90%;
  font-size: 8px;
  color: grey;
  padding: 10px;
  text-align: center;
}

.bar{
  width: 80%;
  height: 4px;
  background-color: #9B9B9B;
  margin: 0 auto;
}

</style>


<body>

<div class="center">

<h1>Welcome to Eli's Semester Website</h1>
</div>

<div class="bar"></div></head>
<h1>I'm glad you could make it.</h1>



<table>
<form method='POST'>
<tr><td>Username: </td><td><input type='text' name='username' value='<?php echo showPost("username")?>'></td></tr>
<tr><td>Password: </td><td><input type='text' name='password' ></td></tr>
<tr><td><input type='submit' name='selection' value='Login'></td><td><input type='submit'
name='selection' value='Create Account' ></a></td></tr>




</form>
</table>


<div><a href="./welcome.php">Welcome Page</a></div>
<div><a href="./home.php">User's Home</a></div>
<div><a href="./su.php">Super User's Home</a></div>
<div><a href="./admin.php">Admin's Home</a></div>
</body>
</html>














