<html>
<head>
<title>All Accounts</title>
<link rel="stylesheet" type="text/css" href="library/style.css">
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
</html>