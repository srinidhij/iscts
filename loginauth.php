<?php
session_start();
require './config.php';
$user = $_POST['username'];
$passwd = $_POST['password'];
$type = $_POST['logintype'];
/*
if($user=="abc" && $pass == "xyz")
{
	$_SESSION['user'] = $user;
	//echo 'success';	
    //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=studentHome.php">';    

}*/

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
$query = "SELECT pass from ".$dbprefix."students WHERE USN='".$user."'";
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
//echo 'User name : '.$user.'<br/>'.' password :'.$pass.'<br/>Type : '.$type.'<br/>';
?>
