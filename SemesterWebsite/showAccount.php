<html>
<head>
<title>All Accounts</title>
<?php

require ('./library/functions.php');
//checkAccount("none");
//checkAccount("user");
checkAccount("admin");

$conn = getDBConnection();

?>
</head>
<body>
<?php printUserTable($conn); ?>
</body>
