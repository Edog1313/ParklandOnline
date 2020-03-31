<html>
<head>
<title>Crypt a Password</title>
<?php

if (isset ($_POST['passwd']))
{
    echo "<code>";
    for ($i=0;$i<10; $i++)
    {
	echo password_hash($_POST['passwd'], PASSWORD_DEFAULT);
	echo "<br />";
    }
    echo "</code>";
}
?>
</head>
<body>
<form method='POST'>
Enter a password: <input type='text' name='passwd' /> <br />
<!-- Enter a salt: <input type='text' name='salt' /> <br /> --!>
<input type='submit'>
</form>

</body>
</html>
