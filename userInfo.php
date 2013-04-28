 <?php

	require './config.php';
	session_start();
	if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] != true)
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

	if ($_SESSION['usrtype'] == 'stud')
	{	
		$query = "SELECT * from ".$dbprefix."students WHERE USN='".$user."'";
		$result = mysql_query($query,$con);
		while($row=mysql_fetch_array($result))
		{
			$name = $row['name'];
			$usn = $user;
			$email = $row['email'];
			$phno = $row['mobile'];
			$sem = $row['semester'];
			$clist = $row['clist'];
			break;
		}
		echo '<html lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
			<link href='images/favicon.ico' rel='icon' type='image/x-icon' />
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
			<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
			<title>Welcome to Course Manager</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		';
	}

?>