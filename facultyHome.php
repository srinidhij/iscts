<?php
session_start();
$_SESSION['isloggedin'] = true;
$_SESSION['usrtype'] = "fac";
echo 'Logged in successfully as '.$_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='./favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Student Home</title>
	
</head>
<body>
	<div class="navbar navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
<ul class="nav">  
  <li class="active">  
    <a class="brand" href="#">View profile</a>  
  </li>  
  <li><a href="upatt.php">Update Attendance</a></li>  
  <li><a href="upmarks.php">Update Marks</a></li>  
  <li><a href="contact.php">Contact</a></li>
    <li><a href="logout.php">Logout</a></li>
  
</ul>    <!--navigation does here-->  
    </div>  
  </div>  
</div>
<div class="pagewrapper">
</div>
</body>
</html>