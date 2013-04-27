 <?php

	require './config.php';
	session_start();
	if ($_SESSION['usrtype'] != 'stud')
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=getdata.php">'; 
		die;
	}
	$user = $_SESSION['user'];
	global $CFG;
	$dbhost = $CFG->dbhost;
	$dbuser = $CFG->dbuser;
	$dbname = $CFG->dbname;
	$dbpass = $CFG->dbpass;
	$dbprefix = $CFG->prefix;

	$con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
	mysql_select_db($dbname,$con) or die (mysql_error()); 

	$query = "SELECT clist from ".$dbprefix."students WHERE USN='".$user."'";
	$result = mysql_query($query,$con);
	while($row=mysql_fetch_array($result))
	{
		$clist = $row['clist'];
	}
	$query = "SELECT name from ".$dbprefix."students WHERE USN='".$user."'";
	$result = mysql_query($query,$con);
	while($row=mysql_fetch_array($result))
	{
		$name = $row['name'];
	}

	$clistarr = explode(',',$clist);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='images/favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>Welcome to Course Manager</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<style type="text/css">
div.row{
	padding-left: 25%;
}
div.gohome
{
	width:20%;
	margin-left: 35%;
}
td
{	
	font-size: 25px;
}
div.pagewrapper{
	margin-top: 40px;
}
</style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="jingi.php"><em><strong>ICSTS</strong></em></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right"><strong>
              Logged in as <a href="userInfo.php" class="navbar-link"><?php echo $_SESSION['name'];?></strong></a> 
              <a style = "padding-left:50px;" href = "logout.php" class="navbar-link"><strong>Logout</strong></a>
            </p>
            <ul class="nav">
              <li><a href="studentHome.php"><strong>Home</strong></a></li>
              <li><a href="about.php"><strong>About</strong></a></li>
              <li><a href="contact.php"><strong>Contact</strong></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
    <div class="pagewrapper" style="margin-top:60px;">
	<div class="row">
	<div class= "twelve columns centered">

<?php
	echo '<h1>Welcome '.$name.'</h1>';
	echo '<h2>List of courses you have registered to : </h2>';
	echo '</div></div>';
	$length = sizeof($clistarr);
	$flag = 0;
	$ntest = 2;
	for ($tests=1; $tests<=$ntest; $tests++)
	{
		echo '<div class="row">
	<div class= "twelve columns centered">';
		echo '<h3>Test '.$tests.'</h3>';
		echo '<table class="info" border="2">	
		<thead><th>Subject</th>
		<th>Marks Obtained</th><th>Max marks</th><th>Percentage</th>
		<tbody>';

		for ($i=0; $i<$length; $i++)
		{ 
		$query = "SELECT marks FROM ".$dbprefix."marks WHERE USN='".$user."' AND subject='".$clistarr[$i]."' AND test='t".$tests."'";
		$prec = '';
		$result = mysql_query($query,$con);
		if($result)
		{
			while($row=mysql_fetch_array($result))
			{
				$prec = $row['marks'];
				break;
			}
			$att = explode('/',$prec);
			$pr  = round(floatval($att[0]/$att[1])*100,2);

			if ($flag == 0)
			{
				$flag = 1;
				echo '<tr class="even"><td>'.$clistarr[$i].'</td><td>'.$att[0].'</td><td>'.$att[1].'</td><td>'.$pr.'</td></tr>';
			}
			else 
			{
				$flag = 0;
				echo '<tr class="even"><td>'.$clistarr[$i].'</td><td>'.$att[0].'</td><td>'.$att[1].'</td><td>'.$pr.'</td></tr>';
			}	
		}
	}
	echo '</tbody></table></div></div>';
	}
?>

</div>
&nbsp;
</body>
</html>