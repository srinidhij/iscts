<?php
session_start();
require './config.php';
$user = $_POST['username'];
$passwd = $_POST['password'];
$type = $_POST['logintype'];

function hash_internal_user_password($password) 
{
    global $CFG;
    return md5($password.$CFG->passwordsaltmain);
}
global $CFG;
$dbhost = $CFG->dbhost;
$dbuser = $CFG->dbuser;
$dbname = $CFG->dbname;
$dbpass = $CFG->dbpass;
$dbprefix = $CFG->prefix;
//echo 'Database name : '.$dbname.'<br/>';
//echo 'Username name : '.$user.'<br/>';

$con = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
mysql_select_db($dbname,$con) or die (mysql_error());  
if ($type == "student")
{
	$query = "SELECT pass,name from ".$dbprefix."students WHERE USN='".$user."'";
	//echo $query.'<br/>';
	$result = mysql_query($query, $con) or die(mysql_error());
	while($row=mysql_fetch_array($result))
	{
		$pass = $row['pass'];
		$name = $row['name'];
	}
	$hashpass = hash_internal_user_password($passwd);
	if($pass === $hashpass)
	{
		$_SESSION['name'] = $name;
		$_SESSION['usrtype'] = 'stud';
		$_SESSION['user'] = $user;
		echo 'success';	
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=studentHome.php">';    

	} 

	else
	{
		$_SESSION['wrongpass'] = true;
		if(!isset($_SESSION['attempts']))
		{
			$_SESSION['attempts'] = 0;
		} 
		else
		{
			$_SESSION['attempts'] += 1;
		}
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
	}
}
else if ($type == "faculty")
{
	$query = "SELECT pass from ".$dbprefix."faculty WHERE id='".$user."'";
	//echo $query.'<br/>';
	$result = mysql_query($query, $con) or die(mysql_error());
	while($row=mysql_fetch_array($result))
	{
		$pass = $row['pass'];
	}
	$hashpass = hash_internal_user_password($passwd);
	if($pass === $hashpass)
	{
		$_SESSION['user'] = $user;
		echo 'success';	
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facultyHome.php">';    

	} 

	else
	{
		$_SESSION['wrongpass'] = true;
		if(!isset($_SESSION['attempts']))
		{
			$_SESSION['attempts'] = 0;
		} 
		else
		{
			$_SESSION['attempts'] += 1;
		}
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
	}
}
else
{
	$query = "SELECT pass from ".$dbprefix."admin WHERE id='".$user."'";
	//echo $query.'<br/>';
	$result = mysql_query($query, $con) or die(mysql_error());
	while($row=mysql_fetch_array($result))
	{
		$pass = $row['pass'];
	}
	$hashpass = hash_internal_user_password($passwd);
	if($pass === $hashpass)
	{
		$_SESSION['user'] = $user;
		echo 'success';	
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=adminHome.php">';    

	} 

	else
	{
		$_SESSION['wrongpass'] = true;
		if(!isset($_SESSION['attempts']))
		{
			$_SESSION['attempts'] = 0;
		} 
		else
		{
			$_SESSION['attempts'] += 1;
		}
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
	}

}
//echo 'User name : '.$user.'<br/>'.' password :'.$pass.'<br/>Type : '.$type.'<br/>';
?>
