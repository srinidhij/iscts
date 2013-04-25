<?php
session_start();
if ($_SESSION['isloggedin'] == true && $_SESSION['usrtype']!= 'adm')
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
    die;
}
$_SESSION['isloggedin'] = true;
$_SESSION['usrtype'] = "adm";
echo 'Logged in successfully as '.$_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='./favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="calendar/css/style.css">
	<title>Student Home</title>
	
	<style type="text/css">
	body{
		background: #eeeeee;
	}
	div.pagewrapper{
		margin-top: 1%;
		margin-left: 1%;
		width: 98%;
		height: 100%;
		padding-top: 2%;
		padding-bottom: 10%;
		background: #f5f5f5;
		overflow:hidden;
	}
	h3{
		text-align: center;
		font-family: calibre;
		font-size: 25;
		font-color: #1919a3;
		text-shadow :0.08em 0.08em 0.08em #1919a3;
	}

	div.calendar{
		padding: 30px;
		float: right;
	}
	</style>
</head>
<body>
	<div class="navbar navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
<ul class="nav">  
  <li class="active">  
    <a class="brand" href="#">View profile</a>  
  </li>  
  <li><a href="attendance.php">View Attendance</a></li>  
  <li><a href="marks.php">View Marks</a></li>  
  <li><a href="centact.php">Contact</a></li>
    <li><a href="logout.php">Logout</a></li>
  
</ul>    <!--navigation does here-->  
    </div>  
  </div>  
</div>

<div class="pagewrapper">
<a href="getfiles.php"><h3>Upload data</h3></a>
</div>
</body>
</html>