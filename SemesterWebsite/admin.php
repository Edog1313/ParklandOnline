<html>
<head>
<title>CSC155 001DR Survey Thing</title>
<link rel="stylesheet" type="text/css" href="library/styles.css">
<?php

require ('library/functions.php');

// depending on the zone, call one of
//checkAccount("none");
//checkAccount("user");
checkAccount("admin");

// get connection object
$conn = getDBConnection();

?>
</head>
<body>
<h1>Welcome,<?php echo $_SESSION['usergroup'] ?> <?php echo $_SESSION['username'] ?> to the Admin's home</h1>
<div><a href="./welcome.php">Welcome Page</a></div>
<div><a href="./home.php">User's Home</a></div>
<div><a href="./su.php">Super User's Home</a></div>
</body>
