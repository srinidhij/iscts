<?php
require './config.php';
session_start();
if ($_SESSION['usrtype'] != 'stud')
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=getdata.php">'; 
	die;
}
else 
{
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href='images/favicon.ico' rel='icon' type='image/x-icon' />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>Welcome to Course Manager</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<style type="text/css">
input.radio{
	padding: 20px;
	margin-left: 30px;	
	margin-right: 30px;
}
div.getip{
	margin-top: 50px;
	width:20%;
}
</style>
</head>
<body>
	<div class="pagewrapper">
		<div>
			<h2>Choose subject</h2>
			<form action="geta.php" method="post">
				<?php
					$clistarr = explode(',',$clist);
					$_SESSION['clistarr'] = $clistarr;
					$length = sizeof($clistarr);
					for ($i=0;$i<$length;$i++)
					{
						$temp = '<input class="radio" type="radio" name="course" id="'.$clistarr[$i].'" value="'.$clistarr[$i].'">'.$clistarr[$i].'<br/>';
						echo $temp;
					}
				?>
				<div class="getip">
				<input type="submit" value="View" class="btn btn-large btn-block btn-info"> 
			</div>
			</form>  
		</div>
	</div>
</body>