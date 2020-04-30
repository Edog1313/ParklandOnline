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
//checkAccount("su");
// get connection object
$conn = getDBConnection();

$result = lookUpUserNameByID($conn, $_POST['id']);
$row = $result->fetch_assoc();


if ($_POST['selection'] == 'Edit')
{
    echo ' You are editing';
}
else if ($_POST['selection'] == 'Apply Changes')
{
    echo 'You are applying changes to';
}
else if ($_POST['selection'] == 'Reset Changes')
{
    echo ' You are resetting changes made to';
}
else if ($_POST['selection'] == 'Cancel')
{
    echo 'You chose to cancel editing';
}
else
{
   echo 'unknown selection';
}

?>
</head>
<body>

 record <?php echo showPost('id'); ?>
<br>
<br>
<form method='POST'>
    <input type='hidden' name='id' value='<?php echo showPost('id'); ?>' />
<div style='border-width: 2px'>
<table>
<tr>
  <td>Username</td>
  <td><?php echo $row["username"]; ?></td>
</tr>

<tr>
  <td>Firstname:</td>
  <td> <input type='text' name='firstname' value='<?php echo $row["firstname"]; ?>'/></td>
</tr>

<tr>
  <td>Lastname:</td>
  <td> <input type='text' name='lastname' value='<?php echo $row["lastname"];
?>'/></td>
</tr>


<tr>
  <td>Email:</td>
  <td> <input type='text' name='email' value='<?php echo $row["email"]; ?>'/></td>
</tr>

<tr>
  <td>Address 1:</td>
  <td> <input type='text' name='email' value='<?php echo $row["address1"]; ?>'/></td>
</tr>

<tr>
  <td>Address 2:</td>
  <td> <input type='text' name='email' value='<?php echo $row["address2"]; ?>'/></td>
</tr>

<tr>
  <td>City:</td>
  <td> <input type='text' name='email' value='<?php echo $row["city"]; ?>'/></td>
</tr>

<tr>
  <td>State:</td>
  <td> <input type='text' name='email' value='<?php echo $row["state"]; ?>'/></td>
</tr>

<tr>
  <td>Zipcode:</td>
  <td> <input type='text' name='email' value='<?php echo $row["zipcode"]; ?>'/></td>
</tr>



<tr>
  <td colspan='2'>
    <input type='submit' name='selection' value='Apply Changes' />
    &nbsp;
    <input type='submit' name='selection' value='Reset Changes' />
    &nbsp;
    <input type='submit' name='selection' value='Cancel' />
  </td>
















</body>
