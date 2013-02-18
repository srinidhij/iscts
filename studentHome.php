<?php
session_start();
$_SESSION['isloggedin'] = true;
$_SESSION['usrtype'] = "stud";
echo 'Logged in successfully as '.$_SESSION['user'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Student Home</title>
	<style type="text/css">
	body{
		background: #eeeeee;
	}
	</style>
</head>
<body>
	<p><a href="logout.php">Click here to Logout</a></p>
</body>
</html>