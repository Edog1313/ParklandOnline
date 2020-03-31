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

?>

